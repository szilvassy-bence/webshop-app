<th class="border border-slate-300">
    <a href="{{ route('admin.users.index', [
        'orderBy' => strtolower($slot)
    ]) }}">
        <div class="flex justify-center items-center gap-2">
            <span>{{ $slot }}</span>
            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20V10m0 10-3-3m3 3 3-3m5-13v10m0-10 3 3m-3-3-3 3"/>
            </svg>
        </div>
    </a>
</th>
