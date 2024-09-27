<x-app-layout>
    <title> {{ $pageTitle }} | {{ config('app.name', 'Laravel') }}</title>

    <div class="py-12" id="app">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-2 mb-2">
                        <div class="flex items-center gap-4">
                            <button
                                ref="addPostButton"
                                data-modal-toggle="crud-modal"
                                data-modal-target="crud-modal"
                                v-show="!isFormCreate"
                                type="button"
                                @click="openModalCreate"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                Album
                            </button>


                            {{-- <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <a href="{{route('admin-galeri-photo-create')}}">
                                    Tambah Postingan
                                </a>
                            </button> --}}
                            @if (session('status'))
                                <div    x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)">
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div v-show="isFormCreate">
                            @include('admin.posts.create')
                        </div>
                    </div>
                    {{-- <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        @forelse ($posts as $post)
                            <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex justify-end px-4 pt-4">
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link href="{{ route('admin-galeri-photo-edit', ['post' => $post->slug])}}">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link href="{{route('admin-galeri-photo-view', ['post' => $post->slug] ) }}">
                                                {{ __('View') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link onclick="return confirm('yakin untuk menghapus?')">
                                                <a href="{{ route('admin-galeri-photo-delete', ['post'=> $post->id]) }}">
                                                    {{ __('Delete') }}
                                                </a>
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('admin-galeri-photo-delete', $post) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link href="#"
                                                    onclick="event.preventDefault();
                                                    if (confirm('Yakin untuk menghapus?')) {
                                                        this.closest('form').submit();
                                                    }">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                <div class="flex flex-col items-left mx-2 my-2 pb-4">
                                    <div class="mb-4">
                                        <h5 class="mb-1 text-xl font-medium px-6 text-gray-900 dark:text-white"> {{ $post->title }} </h5>
                                        <div class="px-6">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                {{ $post->category }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex mt-4 md:mt-6">
                                        <div class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                            </svg>
                                            <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                            2
                                            </span>
                                        </div>

                                        <div class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>

                                            <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                            2
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                <span class="font-medium">Album galeri photo belum ada..
                                </div>
                            </div>
                        @endforelse
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import { createApp, ref, reactive  } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

        createApp({
            setup() {

                const message = ref('Hello Vue!');
                const isFormCreate = ref(false);
                const addPostButton = ref(null);
                const cancelPostButton = ref(null);
                const  categories = ref(['General', 'Pendidikan', 'Makanan', 'Traveling'])

                // State untuk form data
                const formData = reactive({
                    'title': '',
                    'photos': null,
                    'description': '',
                    'category' : ''
                });

                // state untuk error form Data
                const errors = reactive({
                    'title': '',
                    'photos': null,
                    'description': '',
                    'category' : ''
                });

                const handleFileUpload = (event) => {
                    formData.photos = Array.from(event.target.files);
                }

                const openModalCreate = () => {
                    isFormCreate.value = true;
                }

                const closeFormCreatePost = () => {
                    isFormCreate.value = false;

                    if (addPostButton.value) {
                        addPostButton.value.style.display = 'inline-block'; // Tampilkan tombol "Tambah Postingan" kembali
                        cancelPostButton.value.style.display = 'inline-block';
                    }

                }
                // function for submit form create
                const submitForm = () => {
                    axios.post('admin-galeri-photo-store', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })
                    .then((response) => {
                        console.log('Data berhasil disimpan:', response);
                    })
                    .catch((error) => {
                    // console.error('Terjadi kesalahan saat menyimpan data:', error);
                        if (error.response && error.response.status === 422) {
                        // Loop melalui errors dari response Laravel dan set error di objek `errors`
                            const validationErrors = error.response.data.errors;
                                Object.keys(validationErrors).forEach((field) => {
                                    errors[field] = validationErrors[field][0]; // Set pesan error pertama untuk field yang ada error
                                });
                        } else {
                            console.log('Terjadi kesalahan:', error);
                        }
                    });
                }

                return {
                    message,
                    openModalCreate,
                    isFormCreate,
                    submitForm,
                    errors,
                    formData,
                    handleFileUpload,
                    cancelPostButton,
                    addPostButton,
                    closeFormCreatePost,
                };
            }
        }).mount('#app')
      </script>
</x-app-layout>
