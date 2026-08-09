@props([
    'totalDataAmi' => 0,
    'tahunAkademikAktif' => null,
    'totalUnitSubUnit' => 0,
    'totalUnit' => 0,
    'totalSubUnit' => 0,
    'totalAuditor' => 0,
    'totalAuditorAktif' => 0,
    'totalAuditorNonAktif' => 0,
])

{{-- metrics-cards.blade.php --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-5">
    {{-- Tahun Akademik --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <div
        class="flex items-center justify-center w-12 h-12 bg-indigo-50 rounded-xl dark:bg-indigo-500/10"
      >
        <svg
          class="fill-indigo-600 dark:fill-indigo-400"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M6.75 2.25C6.75 1.83579 6.41421 1.5 6 1.5C5.58579 1.5 5.25 1.83579 5.25 2.25V3.75H3.75C2.50736 3.75 1.5 4.75736 1.5 6V18C1.5 19.2426 2.50736 20.25 3.75 20.25H20.25C21.4926 20.25 22.5 19.2426 22.5 18V6C22.5 4.75736 21.4926 3.75 20.25 3.75H18.75V2.25C18.75 1.83579 18.4142 1.5 18 1.5C17.5858 1.5 17.25 1.83579 17.25 2.25V3.75H6.75V2.25ZM3.75 5.25H20.25C20.6642 5.25 21 5.58579 21 6V8.25H3V6C3 5.58579 3.33579 5.25 3.75 5.25ZM3 9.75H21V18C21 18.4142 20.6642 18.75 20.25 18.75H3.75C3.33579 18.75 3 18.4142 3 18V9.75ZM7.5 12C7.5 11.5858 7.83579 11.25 8.25 11.25H15.75C16.1642 11.25 16.5 11.5858 16.5 12C16.5 12.4142 16.1642 12.75 15.75 12.75H8.25C7.83579 12.75 7.5 12.4142 7.5 12Z"
            fill=""
          />
        </svg>
      </div>

      <div class="flex items-end justify-between mt-5">
        <div>
          <span class="text-sm text-gray-500 dark:text-gray-400">Tahun Akademik</span>
          <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
              {{ $tahunAkademikAktif?->tahun_akademik ?? '-' }}
          </h4>
        </div>

        <span
          class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500"
        >
          <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span>
          {{ $tahunAkademikAktif?->status ?? '-' }}
        </span>
      </div>
    </div>

    {{-- Total Data AMI Prodi & AMI Unit Aktif --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <div
        class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-xl dark:bg-blue-500/10"
      >
        <svg
          class="fill-blue-600 dark:fill-blue-400"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M3 6C3 4.34315 4.34315 3 6 3H18C19.6569 3 21 4.34315 21 6V18C21 19.6569 19.6569 21 18 21H6C4.34315 21 3 19.6569 3 18V6ZM6 4.5C5.17157 4.5 4.5 5.17157 4.5 6V18C4.5 18.8284 5.17157 19.5 6 19.5H18C18.8284 19.5 19.5 18.8284 19.5 18V6C19.5 5.17157 18.8284 4.5 18 4.5H6ZM8 8.25C7.58579 8.25 7.25 8.58579 7.25 9C7.25 9.41421 7.58579 9.75 8 9.75H16C16.4142 9.75 16.75 9.41421 16.75 9C16.75 8.58579 16.4142 8.25 16 8.25H8ZM7.25 13C7.25 12.5858 7.58579 12.25 8 12.25H13C13.4142 12.25 13.75 12.5858 13.75 13C13.75 13.4142 13.4142 13.75 13 13.75H8C7.58579 13.75 7.25 13.4142 7.25 13ZM8 16.25C7.58579 16.25 7.25 16.5858 7.25 17C7.25 17.4142 7.58579 17.75 8 17.75H11C11.4142 17.75 11.75 17.4142 11.75 17C11.75 16.5858 11.4142 16.25 11 16.25H8Z"
              fill=""
            />
        </svg>
      </div>

      <div class="flex items-end justify-between mt-5">
        <div>
          <span class="text-sm text-gray-500 dark:text-gray-400">Total Data AMI prodi & AMI Unit Aktif</span>
          <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
              {{ number_format($totalDataAmi) }}
          </h4>
        </div>
        <span
          class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500"
        >
          <span class="h-1.5 w-1.5 rounded-full bg-success-500"></span>
          Aktif
        </span>
      </div>
    </div>
    
    {{-- Semester --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <div
        class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-xl dark:bg-amber-500/10"
      >
        <svg
          class="fill-amber-600 dark:fill-amber-400"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M5.25 4.5C5.25 3.25736 6.25736 2.25 7.5 2.25H16.5C17.7426 2.25 18.75 3.25736 18.75 4.5V18.75C18.75 19.9926 17.7426 21 16.5 21H7.5C6.25736 21 5.25 19.9926 5.25 18.75V4.5ZM7.5 3.75C7.08579 3.75 6.75 4.08579 6.75 4.5V18.75C6.75 19.1642 7.08579 19.5 7.5 19.5H16.5C16.9142 19.5 17.25 19.1642 17.25 18.75V4.5C17.25 4.08579 16.9142 3.75 16.5 3.75H7.5ZM9 7.5C9 7.08579 9.33579 6.75 9.75 6.75H14.25C14.6642 6.75 15 7.08579 15 7.5C15 7.91421 14.6642 8.25 14.25 8.25H9.75C9.33579 8.25 9 7.91421 9 7.5ZM9.75 11.25C9.33579 11.25 9 11.5858 9 12C9 12.4142 9.33579 12.75 9.75 12.75H14.25C14.6642 12.75 15 12.4142 15 12C15 11.5858 14.6642 11.25 14.25 11.25H9.75ZM9 16.5C9 16.0858 9.33579 15.75 9.75 15.75H12.75C13.1642 15.75 13.5 16.0858 13.5 16.5C13.5 16.9142 13.1642 17.25 12.75 17.25H9.75C9.33579 17.25 9 16.9142 9 16.5Z"
            fill=""
          />
        </svg>
      </div>

      <div class="flex items-end justify-between mt-5">
        <div>
          <span class="text-sm text-gray-500 dark:text-gray-400">Semester</span>
          <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
              {{ $tahunAkademikAktif?->semester ?? '-' }}
          </h4>
        </div>

        <span
          class="flex items-center gap-1 rounded-full bg-gray-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-400"
        >
          {{ $tahunAkademikAktif?->tahun_akademik ?? '-' }}
        </span>
      </div>
    </div>

    {{-- Total Unit & Sub Unit --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <div
        class="flex items-center justify-center w-12 h-12 bg-purple-50 rounded-xl dark:bg-purple-500/10"
      >
        <svg
          class="fill-purple-600 dark:fill-purple-400"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V6.75H16.5C16.9142 6.75 17.25 7.08579 17.25 7.5V12H21C21.4142 12 21.75 12.3358 21.75 12.75C21.75 18.2761 17.2761 22.75 11.75 22.75C6.22386 22.75 1.75 18.2761 1.75 12.75C1.75 7.22386 6.22386 2.75 11.75 2.75C11.8338 2.75 11.9172 2.75049 12 2.75146V2.25ZM11.25 4.27986C7.22302 4.57544 4.03134 7.74251 3.76617 11.75H11.25V4.27986ZM11.25 13.25H3.76956C4.16002 17.5097 7.57762 20.9175 11.8415 21.2317C11.9775 20.9275 12.12 20.5256 12.198 20.0528C12.3107 19.3776 12.3006 18.5135 11.8591 17.6606C11.4258 16.8227 10.5981 16.087 9.16207 15.6133C8.76956 15.4844 8.55446 15.0617 8.68335 14.6692C8.81224 14.2767 9.23496 14.0616 9.62747 14.1905C11.4019 14.7783 12.5742 15.7429 13.2034 16.9569C13.6445 17.8199 13.7794 18.7307 13.7218 19.5586C13.848 19.4642 13.9721 19.3624 14.0928 19.2526C15.3769 18.0814 15.75 16.3393 15.75 13.25H11.25ZM17.25 13.3175C17.1664 15.7996 16.5996 17.9752 15.0522 19.3865C14.4322 19.9518 13.7229 20.361 12.9768 20.6288C12.3617 19.4392 12.3744 18.3721 12.7106 17.5429C13.0456 16.7165 13.6784 16.101 14.4072 15.6656C15.1331 15.2321 15.9129 14.9942 16.5017 14.8641C16.8206 14.7934 17.0821 14.7537 17.25 14.7332V13.3175Z"
              fill=""
            />
        </svg>
      </div>

      <div class="flex items-end justify-between mt-5">
        <div>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Total Unit & Sub Unit
            </span>

            <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                {{ $totalUnitSubUnit }}
            </h4>

            <p class="mt-1 text-xs text-gray-500">
                {{ $totalUnit }} Unit • {{ $totalSubUnit }} Sub Unit
            </p>
        </div>
      </div>
    </div>

    {{-- Auditor Aktif --}}
    <div
      class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6"
    >
      <div
        class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl dark:bg-gray-800"
      >
        <svg
          class="fill-gray-800 dark:fill-white/90"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549ZM15.3042 11.4955C14.4702 11.4955 13.7006 11.2193 13.0821 10.7533C13.3742 10.3314 13.6054 9.86419 13.7632 9.36432C14.1597 9.75463 14.7039 9.99545 15.3042 9.99545C16.5176 9.99545 17.5012 9.01185 17.5012 7.79851C17.5012 6.58517 16.5176 5.60156 15.3042 5.60156C14.7039 5.60156 14.1597 5.84239 13.7632 6.23271C13.6054 5.73284 13.3741 5.26561 13.082 4.84371C13.7006 4.37777 14.4702 4.10156 15.3042 4.10156C17.346 4.10156 19.0012 5.75674 19.0012 7.79851C19.0012 9.84027 17.346 11.4955 15.3042 11.4955ZM19.9248 19.8987H16.3901C16.7014 19.4736 16.9159 18.969 16.9827 18.3987H19.9248C20.1341 18.3987 20.2991 18.3141 20.3936 18.2112C20.4796 18.1175 20.5169 18.0034 20.4837 17.861C20.2969 17.0607 19.913 16.088 19.1382 15.3208C18.4047 14.5945 17.261 13.9921 15.4231 13.9566C15.2232 13.6945 14.9995 13.437 14.7491 13.1891C14.5144 12.9566 14.262 12.7384 13.9916 12.5362C14.3853 12.4831 14.8044 12.4549 15.2503 12.4549C17.5447 12.4549 19.1291 13.2008 20.1936 14.2549C21.2395 15.2906 21.7206 16.5607 21.9444 17.5202C22.2657 18.8971 21.107 19.8987 19.9248 19.8987Z"
              fill=""
            />
        </svg>
      </div>

      <div class="flex items-end justify-between mt-5">
        <div>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                Total Auditor
            </span>

            <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                {{ number_format($totalAuditor) }}
            </h4>

            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                {{ $totalAuditorAktif }} Aktif • {{ $totalAuditorNonAktif }} Non Aktif
            </p>
        </div>
      </div>
    </div>

</div>