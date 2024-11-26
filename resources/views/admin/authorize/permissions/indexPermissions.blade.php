<x-app-layout>

    {{ Breadcrumbs::render('permission') }}

    <div class="justify-between w-full px-6 pt-4 text-gray-900 flex-column sm:px-6 dark:text-gray-100 md:px-8 md:flex">
        <!-- Table Section -->
        <div class="m-2 md:w-2/3">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <!-- Header -->
                            <div
                                class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                        Привилегии
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Добавление и редактирование списка привилегий
                                    </p>
                                </div>
                                <form method="GET" action="{{ route('permissions.index') }}">
                                    <div class="max-w-sm space-y-3">
                                        <input value="{{ request('search') }}" name="search" type="text"
                                            class="block w-full px-5 py-3 text-sm border-gray-200 rounded-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                            placeholder="Поиск">
                                    </div>
                                </form>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="py-3 ps-6 text-start">
                                            <span
                                                class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">No</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 pe-6 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                    Привилегия
                                                </span>
                                            </div>
                                        </th>


                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                    Роль
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-end"></th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($permissions as $row)
                                        <tr>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="py-3 ps-6">
                                                    <span
                                                        class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">{{ $no++ }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                    <div class="flex items-center gap-x-3">
                                                        <div class="grow">
                                                            <span
                                                                class="block text-gray-800 fot-semibold te-xt-sm dark:text-neutral-200">{{ $row->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                    <div class="flex items-center gap-x-3">
                                                        <div class="grow">

                                                            @foreach ($row->roles as $role)
                                                                <span
                                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $role->name }}</span>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5 flex gap-2">
                                                    <a href="{{ route('permissions.index') }}?edit={{ $row->id }}"
                                                        class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500"
                                                        href="#">
                                                        Edit
                                                    </a>
                                                    <form onsubmit="return confirm('Вы уверенны?')" method="post"
                                                        action="{{ route('permissions.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-red-500"
                                                            href="#">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h1 class="mt-4 text-2xl text-center dark:text-gray-300">Данные отсутствуют
                                        </h1>
                                    @endforelse

                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
        <div class="m-2 md:w-1/3">

            <!-- Card -->
            <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-neutral-900">
                <div class="mb-8 text-center">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        @if ($edit)
                            Edit Permission
                        @else
                            Form Permission
                        @endif
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Add & Edit Permission
                    </p>
                </div>

                @if ($edit)
                    <form method="post" action="{{ route('permissions.update', $edit->id) }}">
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('permissions.store') }}">
                @endif

                @csrf
                <!-- Section -->
                <div
                    class="py-6 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">

                    <div class="space-y-3">
                        <input id="af-payment-payment-method" type="text"
                            class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="Name Permission" name="permission"
                            value="@if ($edit) {{ $edit->name }} @endif" required>
                        @error('permission')
                            <span class='text-red-400'>{{ $message }}</span>
                        @enderror
                        <select required name="roles[]" multiple
                            class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 select-multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ in_array($role->name, $permissionRoles) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- End Section -->
                <div class="flex justify-end mt-5 gap-x-2">
                    <a href="{{ route('permissions.index') }}" <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        Cancel
                        </button>
                    </a>
                    @if ($edit)
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-lg gap-x-2 hover:bg-yellow-700 focus:outline-none focus:bg-yellow-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update
                        </button>
                    @else
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save
                        </button>
                    @endif
                </div>
                </form>
            </div>
            <!-- End Card -->

            <!-- End Card Section -->
        </div>

        @push('scriptselect2')
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.select-multiple').select2();
                });
            </script>
        @endpush
    </div>

</x-app-layout>
