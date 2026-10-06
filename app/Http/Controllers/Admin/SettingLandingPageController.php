<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminInputBerita;
use App\Models\AdminInputBeritaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use ImagickException;

class SettingLandingPageController extends Controller
{
    private const ALLOWED_EXTENSIONS = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    private const MAX_FILE_SIZE_KB = 10240;
    private const MIME_MAP = [
        'pdf' => 'application/pdf',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
    ];

    public function index()
    {
        $beritas = AdminInputBerita::with(['user', 'files'])->orderBy('id', 'asc')->get();
        return view('pages.admin.setting-landing-page', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => ['required', 'string', 'max:255'],
            'file' => ['required', 'array', 'min:1'],
            'file.*' => ['required', 'file', 'mimes:' . implode(',', self::ALLOWED_EXTENSIONS), 'max:' . self::MAX_FILE_SIZE_KB],
        ]);

        $storedPaths = [];
        DB::beginTransaction();

        try {
            $berita = AdminInputBerita::create([
                'users_id' => auth()->id(),
                'nama_file' => $request->nama_file,
                'thumbnail' => null,
                'diupload_oleh' => auth()->user()->name,
            ]);

            $files = $request->file('file');

            foreach ($files as $index => $file) {
                $filePath = $this->storeFile($file);
                $storedPaths[] = $filePath;

                if ($index === 0) {
                    if ($this->isPdf($filePath)) {
                        $thumbnailPath = $this->generatePdfThumbnail($filePath);
                        $storedPaths[] = $thumbnailPath;
                    } else {
                        $thumbnailPath = $filePath;
                    }
                    $berita->update(['thumbnail' => $thumbnailPath]);
                }

                AdminInputBeritaFile::create([
                    'admin_input_berita_id' => $berita->id,
                    'users_id' => auth()->id(),
                    'nama_file' => $file->getClientOriginalName(),
                    'file' => $filePath,
                ]);
            }

            DB::commit();
            return $this->success($request, 'Berita dan semua file berhasil diupload!', route('setting-landing-page.index'));
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach (array_unique($storedPaths) as $path) $this->deleteFile($path);
            report($e);
            return $this->failure($request, 'Gagal upload berita: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $berita = AdminInputBerita::with(['user', 'files.user'])->findOrFail($id);
        return response()->json([
            'id' => $berita->id,
            'nama_file' => $berita->nama_file,
            'thumbnail' => $berita->thumbnail,
            'thumbnail_url' => $berita->thumbnail ? Storage::disk('public')->url($berita->thumbnail) : null,
            'diupload_oleh' => $berita->diupload_oleh,
            'created_at' => optional($berita->created_at)->format('d-m-Y H:i'),
            'updated_at' => optional($berita->updated_at)->format('d-m-Y H:i'),
            'files' => $berita->files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'admin_input_berita_id' => $file->admin_input_berita_id,
                    'users_id' => $file->users_id,
                    'nama_file' => $file->nama_file,
                    'file' => $file->file,
                    'file_url' => $file->file ? Storage::disk('public')->url($file->file) : null,
                    'extension' => strtolower(pathinfo($file->file, PATHINFO_EXTENSION)),
                    'created_at' => optional($file->created_at)->format('d-m-Y H:i'),
                    'updated_at' => optional($file->updated_at)->format('d-m-Y H:i'),
                ];
            })->values(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $berita = AdminInputBerita::with('files')->findOrFail($id);

        $request->validate([
            'nama_file' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'array', 'min:1'],
            'file.*' => ['required', 'file', 'mimes:' . implode(',', self::ALLOWED_EXTENSIONS), 'max:' . self::MAX_FILE_SIZE_KB],
        ]);

        $newPaths = [];
        DB::beginTransaction();

        try {
            $berita->update(['nama_file' => $request->nama_file]);

            if (!$request->hasFile('file')) {
                DB::commit();
                return $this->success($request, 'Berita berhasil diupdate!', route('setting-landing-page.index'));
            }

            $oldFiles = $berita->files->pluck('file')->filter()->values()->all();
            $oldThumbnail = $berita->thumbnail;

            $berita->files()->delete();
            $berita->update(['thumbnail' => null]);

            $files = $request->file('file');

            foreach ($files as $index => $file) {
                $filePath = $this->storeFile($file);
                $newPaths[] = $filePath;

                if ($index === 0) {
                    if ($this->isPdf($filePath)) {
                        $thumbnailPath = $this->generatePdfThumbnail($filePath);
                        $newPaths[] = $thumbnailPath;
                    } else {
                        $thumbnailPath = $filePath;
                    }
                    $berita->update(['thumbnail' => $thumbnailPath]);
                }

                AdminInputBeritaFile::create([
                    'admin_input_berita_id' => $berita->id,
                    'users_id' => auth()->id(),
                    'nama_file' => $file->getClientOriginalName(),
                    'file' => $filePath,
                ]);
            }

            DB::commit();

            foreach (array_unique($oldFiles) as $oldFile) $this->deleteFile($oldFile);
            if ($oldThumbnail && !in_array($oldThumbnail, $oldFiles, true)) {
                $this->deleteFile($oldThumbnail);
            }

            return $this->success($request, 'Berita dan semua file berhasil diupdate!', route('setting-landing-page.index'));
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach (array_unique($newPaths) as $path) $this->deleteFile($path);
            report($e);
            return $this->failure($request, 'Gagal update berita: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $berita = AdminInputBerita::with('files')->findOrFail($id);
            $filePaths = $berita->files->pluck('file')->filter()->values()->all();
            $thumbnailPath = $berita->thumbnail;

            $berita->files()->delete();
            $berita->delete();

            DB::commit();

            foreach (array_unique($filePaths) as $path) $this->deleteFile($path);
            if ($thumbnailPath && !in_array($thumbnailPath, $filePaths, true)) {
                $this->deleteFile($thumbnailPath);
            }

            return $this->success(request(), 'Berita dan semua file berhasil dihapus!');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return $this->failure(request(), 'Gagal hapus berita: ' . $e->getMessage());
        }
    }

    public function destroyFile($id)
    {
        DB::beginTransaction();

        try {
            $file = AdminInputBeritaFile::with('berita')->findOrFail($id);
            $berita = $file->berita;
            $filePath = $file->file;
            $isThumbnail = $berita && $berita->thumbnail === $filePath;

            $file->delete();

            if ($isThumbnail && $berita) {
                $berita->update(['thumbnail' => null]);
            }

            DB::commit();
            $this->deleteFile($filePath);

            return $this->success(request(), 'File berhasil dihapus!');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return $this->failure(request(), 'Gagal menghapus file: ' . $e->getMessage());
        }
    }

    public function download($id)
    {
        $file = AdminInputBeritaFile::findOrFail($id);

        if (!$file->file || !Storage::disk('public')->exists($file->file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan!');
        }

        $extension = strtolower(pathinfo($file->file, PATHINFO_EXTENSION));
        $downloadName = trim($file->nama_file ?: 'berita');

        if (!Str::endsWith(strtolower($downloadName), '.' . $extension)) {
            $downloadName .= '.' . $extension;
        }

        $downloadName = preg_replace('/[\/\\\\:*?"<>|]/', '-', $downloadName);

        return Storage::disk('public')->download($file->file, $downloadName);
    }

    public function preview($id)
    {
        $berita = AdminInputBerita::findOrFail($id);

        $file = AdminInputBeritaFile::where('admin_input_berita_id', $berita->id)
            ->orderBy('id', 'asc')
            ->first();

        if (!$file || !$file->file) {
            abort(404, 'File berita tidak ditemukan.');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($file->file)) {
            abort(404, 'File berita tidak tersedia di storage.');
        }

        $path = $disk->path($file->file);
        $mimeType = $this->getMimeType($path, $file->file);

        if (!in_array($mimeType, self::MIME_MAP, true)) {
            abort(415, 'Format file tidak mendukung preview.');
        }

        $sizeBytes = filesize($path);
        if ($sizeBytes === false || $sizeBytes > self::MAX_FILE_SIZE_KB * 1024) {
            abort(413, 'Ukuran file terlalu besar untuk preview.');
        }

        $contents = file_get_contents($path);
        if ($contents === false) {
            abort(404, 'File berita gagal dibaca.');
        }

        return response()->json([
            'id' => $file->id,
            'berita_id' => $berita->id,
            'mime' => $mimeType,
            'filename' => $file->nama_file ?: basename($file->file),
            'data' => base64_encode($contents),
        ]);
    }

    public function getData(Request $request)
    {
        $beritas = AdminInputBerita::with(['user', 'files'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'data' => $beritas->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_file' => $item->nama_file,
                    'thumbnail' => $item->thumbnail,
                    'thumbnail_url' => $item->thumbnail ? Storage::disk('public')->url($item->thumbnail) : null,
                    'diupload_oleh' => $item->diupload_oleh,
                    'created_at' => optional($item->created_at)->format('d-m-Y H:i'),
                    'updated_at' => optional($item->updated_at)->format('d-m-Y H:i'),
                    'files' => $item->files->map(function ($file) {
                        return [
                            'id' => $file->id,
                            'users_id' => $file->users_id,
                            'nama_file' => $file->nama_file,
                            'file' => $file->file,
                            'file_url' => $file->file ? Storage::disk('public')->url($file->file) : null,
                            'extension' => strtolower(pathinfo($file->file, PATHINFO_EXTENSION)),
                            'created_at' => optional($file->created_at)->format('d-m-Y H:i'),
                            'updated_at' => optional($file->updated_at)->format('d-m-Y H:i'),
                        ];
                    })->values(),
                ];
            })->values(),
        ]);
    }

    private function uploadRules(bool $required = true): array
    {
        return [
            'nama_file' => ['required', 'string', 'max:255'],
            'file' => [$required ? 'required' : 'nullable', 'array', 'min:1'],
            'file.*' => ['required', 'file', 'mimes:' . implode(',', self::ALLOWED_EXTENSIONS), 'max:' . self::MAX_FILE_SIZE_KB],
        ];
    }

    private function storeFile($file): string
    {
        $safeOriginalName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $fileName = time() . '_' . Str::random(10) . '_' . $safeOriginalName;
        return $file->storeAs('uploads/berita', $fileName, 'public');
    }

    private function isPdf(string $filePath): bool
    {
        return strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) === 'pdf';
    }

    private function getMimeType(string $path, string $filePath): string
    {
        $detected = mime_content_type($path) ?: null;
        if ($detected && in_array($detected, self::MIME_MAP, true)) {
            return $detected;
        }
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        if (isset(self::MIME_MAP[$extension])) {
            return self::MIME_MAP[$extension];
        }
        throw new \RuntimeException('MIME type file tidak dapat ditentukan.');
    }

    private function deleteFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    private function generatePdfThumbnail(string $pdfPath): string
    {
        $disk = Storage::disk('public');

        if (!extension_loaded('imagick')) {
            throw new \RuntimeException('PHP Imagick extension belum aktif.');
        }

        $pdfFullPath = $disk->path($pdfPath);
        if (!file_exists($pdfFullPath)) {
            throw new \RuntimeException('File PDF tidak ditemukan: ' . $pdfFullPath);
        }

        $baseName = pathinfo($pdfPath, PATHINFO_FILENAME);
        $thumbnailPath = 'uploads/berita/thumbnails/' . $baseName . '.jpg';
        $disk->makeDirectory('uploads/berita/thumbnails');
        $thumbnailFullPath = $disk->path($thumbnailPath);

        $imagick = new Imagick();

        try {
            $imagick->setResolution(150, 150);
            $imagick->readImage($pdfFullPath . '[0]');
            $imagick->setIteratorIndex(0);
            $imagick->setImageBackgroundColor('white');
            $imagick = $imagick->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
            $imagick->thumbnailImage(600, 800, true, true);
            $imagick->setImageFormat('jpg');
            $imagick->setImageCompressionQuality(85);
            $imagick->stripImage();
            $imagick->writeImage($thumbnailFullPath);
        } catch (ImagickException $e) {
            throw new \RuntimeException('Gagal membuat thumbnail PDF: ' . $e->getMessage(), 0, $e);
        } finally {
            $imagick->clear();
            $imagick->destroy();
        }

        if (!$disk->exists($thumbnailPath)) {
            throw new \RuntimeException('Thumbnail gagal dibuat.');
        }

        return $thumbnailPath;
    }

    private function success(Request $request, string $message, ?string $redirect = null)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(array_filter([
                'success' => true,
                'message' => $message,
                'redirect' => $redirect,
            ]));
        }

        return $redirect
            ? redirect($redirect)->with('success', $message)
            : redirect()->route('setting-landing-page.index')->with('success', $message);
    }

    private function failure(Request $request, string $message)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => $message], 500);
        }
        return redirect()->back()->with('error', $message)->withInput();
    }
}