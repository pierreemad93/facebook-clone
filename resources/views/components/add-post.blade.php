@props(['route'])
@if (!isset($route) || empty($route))
    @php
        throw new Exception('The "route" prop is required.');
    @endphp
@endif
<div class="p-6 text-gray-900">
    <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea class="textarea textarea-bordered w-full mb-2" placeholder="{{ __('What\'s in your mind?') }}" name="content"
            required maxlength="500"></textarea>

        @error('content')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-neutral mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ __('Submit') }}
        </button>
    </form>
</div>
