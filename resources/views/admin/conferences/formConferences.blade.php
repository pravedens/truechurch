<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $title }}
        </h2>
    </x-slot>


    <div class="mx-auto max-w-7xl sm:px-3 lg:px-3">
        <!-- Card Section -->
        <div class="max-w-4xl px-4 py-10 mx-auto sm:px-6 lg:px-8 lg:py-14">
            <form action="{{ route('conferences.store') }}" method="post">
                @csrf
                <!-- Card -->
                <div class="bg-white shadow rounded-xl">
                    <div
                        class="relative h-40 rounded-t-xl bg-[url('https://preline.co/assets/svg/examples/abstract-bg-1.svg')] bg-no-repeat bg-cover bg-center">
                        <div class="absolute top-0 p-4 end-0">
                            <!--<button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" x2="12" y1="3" y2="15" />
                                </svg>
                                Upload header
                            </button>-->
                        </div>
                    </div>

                    <div class="p-4 pt-0 sm:pt-0 sm:p-7">
                        <!-- Grid -->
                        <div class="space-y-4 sm:space-y-6">

                            <div class="space-y-2">
                                <label for="af-submit-app-project-name"
                                    class="inline-block text-sm font-medium text-gray-800 mt-2.5">
                                    Мероприятие
                                </label>

                                <input name="title" id="af-submit-app-project-name" type="text"
                                    class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                    placeholder="Мероприятие">
                                @error('title')
                                    <span class="text-sm text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <!--<div class="space-y-2">
                                <label for="af-submit-app-category"
                                    class="inline-block text-sm font-medium text-gray-800 mt-2.5">
                                    Category
                                </label>

                                <select id="af-submit-app-category"
                                    class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-9 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <option selected>Select a category</option>
                                    <option>Ecommerce</option>
                                    <option>Finance</option>
                                    <option>Marketplace</option>
                                    <option>Social</option>
                                    <option>Others</option>
                                </select>
                            </div>-->
                        </div>
                        <!-- End Grid -->

                        <div class="flex justify-center mt-5 gap-x-2">
                            <a href="{{ route('conferences.index') }}" onclick="return confirm('Вернуться. уверены?')"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                Отменить
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </form>
        </div>
        <!-- End Card Section -->
    </div>

</x-app-layout>
