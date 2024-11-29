<x-app-layout>

    {{ Breadcrumbs::render('role') }}

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
                                        Роль
                                    </h2>
                                    <p class="text-sm text-gray-600">
                                        Добавление и редактирование списка ролей
                                    </p>
                                </div>

                                <div>
                                    <div class="inline-flex gap-x-2">
                                        <form method="GET" action="{{ route('roles.index') }}">
                                            <div class="max-w-sm space-y-3">
                                                <input value="{{ request('search') }}" name="search" type="text"
                                                    class="block w-full px-5 py-3 text-sm border-gray-200 rounded-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                    placeholder="Поиск">
                                            </div>
                                        </form>

                                        <form class="inline-flex" method="POST" action="{{ route('roles.store') }}">
                                            @csrf
                                            <div class="max-w-lg space-y-3">
                                                <input name="roles" type="text"
                                                    class="block w-full px-5 py-3 text-sm border-gray-200 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                    placeholder="Роль" required>
                                            </div>
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                                href={{ route('roles.create') }}>
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="M12 5v14" />
                                                </svg>
                                                Добавить
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200">
                                @if (count($roles) > 0)
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="ml-6 text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        No
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                <div class="flex items-center gap-x-2">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Имя
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6 text-start">
                                                <div class="flex gap-x-2">
                                                    <span
                                                        class="mr-4 text-xs font-semibold tracking-wide text-gray-800 uppercase">
                                                        Привилегий
                                                    </span>
                                                </div>
                                            </th>

                                            <th scope="col" class="px-6 py-3 text-end"></th>
                                        </tr>
                                    </thead>
                                @endif
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($roles as $index => $row)
                                        <tr>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $index + $roles->firstItem() }}</span>
                                                </div>
                                            </td>

                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div>
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800">{{ $row->name }}</span>
                                                </div>
                                            </td>

                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800">
                                                        {{-- закоментировано
                                                        {{ $row->permissions->count() }}
                                                        --}}
                                                        @foreach ($row->permissions as $permission)
                                                            <span
                                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $permission->name ?? '-' }}</span>
                                                        @endforeach

                                                    </span>
                                                </div>
                                            </td>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5 flex gap-2">
                                                    <a class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline"
                                                        href="{{ route('roles.edit', $row->id) }}">
                                                        Edit
                                                    </a>
                                                    <form
                                                        onsubmit="return confirm('Вы уверены, что хотите удалить эту роль?')"
                                                        method="post" action="{{ route('roles.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline"
                                                            href="{{ route('roles.edit', $row->id) }}">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h2 class="text-xl font-semibold text-center text-gray-800">
                                            Нет данных
                                        </h2>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="grid gap-3 px-6 py-4 border-t border-gray-200 md:flex md:justify-between md:items-center">
                                {{ $roles->links('pagination::simple-tailwind') }}
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
