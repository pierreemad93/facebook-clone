<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('addPost') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.posts.store') }}" method="POST">
                        @csrf
                        <textarea class="textarea textarea-bordered w-full" placeholder="{{ __('what\'s in your mind?') }}" name="content"></textarea>
                        <button type="submit" class="btn btn-neutral">{{ __('submit') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
