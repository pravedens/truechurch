<x-app-layout>
    <div class="w-full lg:ps-64">
        <div class="p-4 space-y-4 sm:p-6 sm:space-y-6">

            {{ Breadcrumbs::render('rolesEdit', $role) }}

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Table Section -->
                <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-5 mx-auto">
                    <!-- Card -->
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="w-full card">
                                    <div class="card-body">
                                        <form action="{{ route('roles.update', $role->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <div class="flex w-full gap-2">
                                                <div class="w-1/2 space-y-3">
                                                    <input name='role' type="text"
                                                        class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                        value="{{ $role->name }}" required>
                                                </div>
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    Изменить
                                                </button>
                                            </div>
                                            <hr class="w-1/2 mt-8 bg-gray-800" />
                                            <h1 class="mt-8 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Привилегии</h1>
                                            <ul class="flex flex-col max-w-sm">
                                                @foreach ($permissions as $permission)
                                                    <li
                                                        class="inline-flex items-center px-4 py-3 -mt-px text-sm font-medium text-gray-800 bg-white border gap-x-2 first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                                        <div class="relative flex items-start w-full">
                                                            <div class="flex items-center h-5">
                                                                <input value="{{ $permission->id }}" name="permissions[]" id="hs-list-group-item-checkbox-{{ $permission->id }}"
                                                                    type="checkbox"
                                                                    class="border-gray-200 rounded disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                                    {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                                            </div>
                                                            <label for="hs-list-group-item-checkbox-{{ $permission->id }}"
                                                                class="ms-3.5 block w-full text-sm text-gray-400 dark:text-neutral-500 ml-2">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Table Section -->
            </div>
        </div>
    </div>
</x-app-layout>
