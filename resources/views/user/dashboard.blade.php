<x-app-layout>
    <title> {{ $pageTitle }} | {{ config('app.name', 'Laravel') }}</title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('status'))
                        <div    x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)">
                            <div class="alert alert-success">
                                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        <span class="font-medium">
                                            {{ session('status') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @forelse ($posts as $post)
                        <div class="w-full mb-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <div>
                                <a href="#" class="flex flex-col bg-white rounded-lg shadow md:flex-row hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="h-24 w-24">
                                        <img class="object-cover w-full rounded-t-lg  md:rounded-none md:rounded-s-lg" src="{{ asset('storage/'. $post->photo->path) }}" alt="">
                                    </div>
                                    <div class="flex flex-col p-4 leading-normal">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> {{ $post->title }} </h5>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            {{ $post->description }}
                                        </p>
                                    </div>
                                </a>
                            </div>

                            <div class="px-5 pb-5">
                                <div class="flex items-start mt-2.5 mb-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3"> {{ $post->category }} </span>
                                </div>
                                <div class="flex mt-2 md:mt-2">
                                    <div x-data="{ open: false, content: '' }" class="w-full">
                                        <!-- Button with SVG and badge, hidden when open is true -->
                                        <div class="flex">
                                            <button @click="open = true" x-show="!open" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                                <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                    {{ count($post->comments) }}
                                                </span>
                                            </button>
                                            <div x-data="{ open: false }">
                                                <form id="likeForm-{{ $post->id }}" action="{{ route('user-store-like', $post->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" x-show="!open" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ count($post->likes) > 0 ? 'red' : 'none'}}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                                        </svg>
                                                        <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                                            {{ count($post->likes) }}
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Form shown when open is true -->
                                        <div x-show="open" class="mt-4">
                                            <div class="w-full">
                                                <form method="POST" action="{{ route('user-create-comment', $post->id) }}" class="mx-auto">
                                                    @csrf
                                                    <textarea id="content" name="content" rows="4" x-model="content" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>

                                                    <div class="mt-2">
                                                        <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-blue-500 hover:bg-blue-700">
                                                            Submit
                                                        </button>
                                                        <button type="button" @click="open = false; content = ''" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white rounded-lg bg-red-500 hover:bg-red-700">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (count($post->comments) > 0)
                                <div class="mt-2">
                                    @foreach ($post->comments->take(2) as $comment)
                                        <ol class="relative border-gray-200 dark:border-gray-700">
                                            <li class="mb-2 ms-2">
                                                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                                    <div class="items-center justify-between mb-3 sm:flex">
                                                        <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0"> {{ $post->created_at->format('j M Y, g:i a') }} </time>
                                                        <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300"> {{ $comment->user->name }} commented on  <a href="#" class="font-semibold text-gray-900 dark:text-white hover:underline"> {{ config('app.name') }} </a></div>
                                                    </div>
                                                    <div class="p-3 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                                                       {{$comment->content}}
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    @empty
                    <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                          <span class="font-medium">Galeri Photo belum Tersedia..</span>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
