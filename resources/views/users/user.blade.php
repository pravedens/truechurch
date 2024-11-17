<x-app-layout>

    <x-slot name="header">
        <!-- Breadcrumb -->
        <ol class="flex items-centerwhitespace-nowrap">
            <li class="flex items-center text-sm text-gray-800">

                {{ Breadcrumbs::render('dashboard') }}

                <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400" width="16" height="16"
                    viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </li>
            <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
                Dashboard
            </li>
        </ol>
        <!-- End Breadcrumb -->
    </x-slot>


    <div class="mx-auto max-w-7xl sm:px-3 lg:px-3">

        <!-- Table Section -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                            <!-- Header -->
                            <div
                                class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        Users
                                    </h2>
                                    <p class="text-sm text-gray-600">
                                        Add users, edit and more.
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <form method="GET" action="{{ route('users.index') }}">
                                            <div class="max-w-sm space-y-3">
                                                <input value="{{ request('search') }}" name="search" type="text"
                                                    class="block w-full px-5 py-3 text-sm border-gray-200 rounded-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                    placeholder="Поиск">
                                            </div>
                                        </form>

                                        <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                            href="{{ route('users.create') }}">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Добавить
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200">
                                @if (count($users) > 0)
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="ml-4 text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        No
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="ml-2 text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Имя
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-start">
                                                <div class="flex items-center ml-5 gap-x-2">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Email
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Дата рождения
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Церковь
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Город
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-end"></th>
                                        </tr>
                                    </thead>
                                @endif
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($users as $index => $row)
                                        <tr>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3 ml-2 ">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $index + $users->firstItem() }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                    <div class="flex items-center gap-x-3">
                                                        <img class="inline-block size-[38px] rounded-full"
                                                            src="{{ asset('storage/images/' . $row->photo_profile) }}"
                                                            alt="Avatar">
                                                        <div class="grow">
                                                            <span
                                                                class="block text-sm font-semibold text-gray-800">{{ $row->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3 ml-4 ">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $row->email }}</span>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $row->birthdate ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $row->church ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $row->city ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5 flex gap-2">
                                                    <a class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline"
                                                        href="{{ route('users.edit', $row->id) }}">
                                                        Edit
                                                    </a>
                                                    <form
                                                        onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?')"
                                                        method="post"
                                                        action="{{ route('users.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline"
                                                            href="{{ route('users.edit', $row->id) }}">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h2 class="text-xl font-semibold text-gray-800">
                                            Нет данных
                                        </h2>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center">
                                {{ $users->links('pagination::simple-tailwind') }}
                                <!--<div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold text-gray-800">12</span> results
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <button type="button"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button"
                                            class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50">
                                            Next
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>-->
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
    </div>

</x-app-layout>
