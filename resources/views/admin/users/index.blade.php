<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            @if($search)
                <a href="{{ route('admin.users.index') }}">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ $search }}
                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                    </button>
                </a>
            @else
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <input
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="text"
                        name="search"
                    />
                    <x-primary-button>Search</x-primary-button>
                </form>
            @endif
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <table class="bg-white table-fixed border-collapse border border-slate-400 mt-6">
            <thead>
                <tr>
                    <x-table-heading>Id</x-table-heading>
                    <x-table-heading>Name</x-table-heading>
                    <x-table-heading>Email</x-table-heading>
                    <th class="border border-slate-300">Edit</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border border-slate-300 px-6">
                        <span>{{ $user->id }}</span>

                    </td>
                    <td class="border border-slate-300 px-6">{{ $user->name }}</td>
                    <td class="border border-slate-300 px-6">{{ $user->email }}</td>
                    <td class="border border-slate-300 px-6">
                        <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                            More
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
