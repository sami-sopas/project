<x-app-layout>
    <section class="container">
        <div class="antialiased">
            <div class="py-6">
                <!-- Breadcrumbs -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-2 text-gray-400 text-sm">
                        <a href="#" class="hover:underline hover:text-gray-600">Home</a>
                        <span>
                            <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <a href="#" class="hover:underline hover:text-gray-600">Electronics</a>
                        <span>
                            <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <span>Headphones</span>
                    </div>
                </div>
                <!-- ./ Breadcrumbs -->

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="flex flex-col md:flex-row -mx-4">
                        <div class="md:flex-1 px-4">
                            <div x-data="{ image: 1 }" x-cloak>
                                <div class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4">
                                    <div x-show="image === 1"
                                        class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                        <span class="text-5xl">1</span>
                                    </div>

                                    <div x-show="image === 2"
                                        class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                        <span class="text-5xl">2</span>
                                    </div>

                                    <div x-show="image === 3"
                                        class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                        <span class="text-5xl">3</span>
                                    </div>

                                    <div x-show="image === 4"
                                        class="h-64 md:h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center">
                                        <span class="text-5xl">4</span>
                                    </div>
                                </div>

                                <div class="flex -mx-2 mb-4">
                                    <template x-for="i in 4">
                                        <div class="flex-1 px-2">
                                            <button x-on:click="image = i"
                                                :class="{ 'ring-2 ring-indigo-300 ring-inset': image === i }"
                                                class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                                                <span x-text="i" class="text-2xl"></span>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="md:flex-1 px-4">
                            <span class="text-lg font-medium text-rose-500 dark:text-rose-200">New</span>
                            <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                                Shoes</h2>
                            <div class="flex items-center mb-6">
                                <ul class="flex mr-2">
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <p class="text-xs dark:text-gray-400 ">(2 customer reviews)</p>
                            </div>

                            <div class="flex items-center space-x-4 my-4">
                                <div>
                                    <div class="rounded-lg bg-gray-100 flex py-2 px-4 mx-auto">
                                        <span class="text-indigo-400 mr-1 mt-1">$</span>
                                        <span class="font-bold text-indigo-600 text-3xl">25</span>
                                    </div>
                                </div>
                            </div>





                            <p class="text-green-600 dark:text-green-300 ">7 in stock</p>

                            <div class="flex items-center mb-8">
                                <h2 class="w-16 mr-6 text-xl font-bold dark:text-gray-400">
                                    Colors:</h2>
                                <div class="flex flex-wrap -mx-2 -mb-2">
                                    <button
                                        class="p-1 mb-2 mr-2 border border-transparent hover:border-yellow-400 dark:border-gray-800 dark:hover:border-gray-400 ">
                                        <div class="w-6 h-6 bg-cyan-300"></div>
                                    </button>
                                    <button
                                        class="p-1 mb-2 mr-2 border border-transparent hover:border-yellow-400 dark:border-gray-800 dark:hover:border-gray-400">
                                        <div class="w-6 h-6 bg-green-300 "></div>
                                    </button>
                                    <button
                                        class="p-1 mb-2 border border-transparent hover:border-yellow-400 dark:border-gray-800 dark:hover:border-gray-400">
                                        <div class="w-6 h-6 bg-red-200 "></div>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center mb-8">
                                <h2 class="w-16 text-xl font-bold dark:text-gray-400">
                                    Size:</h2>
                                <div class="flex flex-wrap -mx-2 -mb-2">
                                    <button
                                        class="py-1 mb-2 mr-1 border w-11 hover:border-yellow-400 dark:border-gray-400 hover:text-yellow-600 dark:hover:border-gray-300 dark:text-gray-400">XL
                                    </button>
                                    <button
                                        class="py-1 mb-2 mr-1 border w-11 hover:border-yellow-400 hover:text-yellow-600 dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">S
                                    </button>
                                    <button
                                        class="py-1 mb-2 mr-1 border w-11 hover:border-yellow-400 hover:text-yellow-600 dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">M
                                    </button>
                                    <button
                                        class="py-1 mb-2 mr-1 border w-11 hover:border-yellow-400 hover:text-yellow-600 dark:border-gray-400 dark:hover:border-gray-300 dark:text-gray-400">XS
                                    </button>
                                </div>
                            </div>

                            <div class="flex py-4 space-x-4">
                                <div class="relative">
                                    <div
                                        class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">
                                        Qty</div>
                                    <select
                                        class="cursor-pointer appearance-none rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>

                                    <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>

                                <button type="button"
                                    class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
