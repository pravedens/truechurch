<x-app-layout>
    <x-slot name="header">
        <!-- Breadcrumb -->
        <ol class="flex items-centerwhitespace-nowrap">
            <li class="flex items-center text-sm text-gray-800">

                {{ Breadcrumbs::render('dashboard') }}

            </li>
        </ol>
        <!-- End Breadcrumb -->
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
