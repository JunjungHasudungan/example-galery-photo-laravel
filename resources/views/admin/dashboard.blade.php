<x-app-layout>
    <title> {{ $pageTitle }} | {{ config('app.name', 'Laravel') }}</title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                        <div class="border border-gray-100 rounded p-2">
                            <div class="flex items-center mb-5">
                                <p class="bg-blue-100 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded dark:bg-blue-200 dark:text-blue-800">8.7</p>
                                <p class="ms-2 font-medium text-gray-900 dark:text-white">Komentar</p>
                                <span class="w-1 h-1 mx-2 bg-gray-900 rounded-full dark:bg-gray-500"></span>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $post_comment_amount }} reviews</p>
                                <a href="{{ route('admin-galeri-photo') }}" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Read all reviews</a>
                            </div>
                            <div class="gap-8 sm:grid sm:grid-cols-1">
                                <div>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Makanan') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width:{{$post_comment_makanan}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{$post_comment_makanan}} </span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Pendidikan') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width:{{$post_comment_pendidikan}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ $post_comment_pendidikan }} </span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Traveling') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{ $post_comment_travelling }}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $post_comment_travelling }}</span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Elektronik') }} </dt>
                                        <dd class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{$post_comment_eleketronik}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ $post_comment_eleketronik }} </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded p-2">
                            <div class="flex items-center mb-5">
                                <p class="bg-blue-100 text-blue-800 text-sm font-semibold inline-flex items-center p-1.5 rounded dark:bg-blue-200 dark:text-blue-800">8.7</p>
                                <p class="ms-2 font-medium text-gray-900 dark:text-white">Suka</p>
                                <span class="w-1 h-1 mx-2 bg-gray-900 rounded-full dark:bg-gray-500"></span>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$post_like_amount}} reviews</p>
                                <a href="{{ route('admin-galeri-photo') }}" class="ms-auto text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Read all reviews</a>
                            </div>
                            <div class="gap-8 sm:grid sm:grid-cols-1">
                                <div>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Makanan') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{$post_like_makanan}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$post_like_makanan}}</span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Pendidikan') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{$post_like_pendidikan}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$post_like_pendidikan}}</span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Travelling') }} </dt>
                                        <dd class="flex items-center mb-3">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{$post_like_travelling}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$post_like_travelling}}</span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400"> {{ __('Elektronik') }} </dt>
                                        <dd class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded h-2.5 dark:bg-gray-700 me-2">
                                                <div class="bg-blue-600 h-2.5 rounded dark:bg-blue-500" style="width: {{$post_like_elektronik}}%"></div>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$post_like_elektronik}}</span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
