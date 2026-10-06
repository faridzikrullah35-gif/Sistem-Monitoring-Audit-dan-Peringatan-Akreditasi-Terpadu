<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * Memproses data user dari Excel.
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {

            User::create([
                'name' => $this->nullableValue(
                    $row['name'] ?? null
                ),

                'unit' => $this->nullableValue(
                    $row['unit'] ?? null
                ),

                'sub_unit' => $this->nullableValue(
                    $row['sub_unit'] ?? null
                ),

                'email' => $this->nullableValue(
                    $row['email'] ?? null
                ),

                'password' => Hash::make(
                    $row['password'] ?? ''
                ),

                'role' => $this->nullableValue(
                    $row['role'] ?? null
                ),
            ]);
        }
    }

    /**
     * Mengubah nilai kosong menjadi NULL.
     */
    private function nullableValue($value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}