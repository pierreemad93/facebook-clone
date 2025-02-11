<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-grow">
                {{ __('Posts') }}
            </h2>
            <a class="btn btn-neutral px-4 py-2" href="{{ route('admin.posts.create') }}">
                {{ __('addPost') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="postSearch()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        {{-- search bar and filter --}}
                        <div class="join flex">
                            <div class="flex-1">
                                <input x-model="query" class="input input-bordered join-item w-full"
                                    placeholder="Search" @input.debounce.500ms="search" />
                            </div>
                            <select x-model="filter" class="select select-bordered join-item flex-1">

                                <option value="">{{ __('Status') }}</option>
                                <option value="active">{{ __('active') }}</option>
                                <option value="pending">{{ __('pending') }}</option>
                                <option value="suspended">{{ __('suspended') }}</option>
                            </select>

                        </div>
                        {{-- all posts --}}
                        <div class="divider"></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('addedBy') }}</th>
                                    <th>{{ __('content') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th>{{ __('views') }}</th>
                                    <th>{{ __('control') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(post, index) in results" :key="post.id">
                                    <tr>
                                        <th x-text="index + 1"></th>
                                        <td x-text="post.user.name"></td>
                                        <td x-text="post.content"></td>
                                        <td>
                                            <span x-text="post.status"
                                                x-bind:class="{
                                                    'text-green-600 font-bold': post.status === 'active',
                                                    'text-yellow-600 font-bold': post.status === 'pending',
                                                    'text-red-600 font-bold': post.status === 'suspended'
                                                }">
                                            </span>
                                        </td>
                                        <td x-text="post.views"></td>
                                        <td>
                                            <a :href="`/admin/posts/${post.id}/edit`"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button @click="deletePost(post.id)"
                                                class="btn btn-sm btn-error">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function postSearch() {
            return {
                query: '',
                filter: '',
                results: @json($posts), // 
                search() {
                    fetch(`posts/search?query=${this.query}&filter=${this.filter}`)
                        .then(response => response.json())
                        .then(data => this.results = data);
                },
                deletePost(id) {
                    if (confirm('Are you sure you want to delete this post?')) {
                        fetch(`/admin/posts/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => this.results = this.results.filter(post => post.id !== id));
                    }
                }
            };
        }
    </script>
</x-app-layout>
