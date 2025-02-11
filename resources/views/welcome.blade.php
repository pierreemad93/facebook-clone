 <x-app-layout>
     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <x-add-post :route="'posts.store'" />
             </div>
         </div>
     </div>
     @foreach ($posts as $post)
         <div class="hero bg-base-200 w-full">
             <div class="hero-content flex-col lg:flex-row-reverse container mx-auto p-6">
                 <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                     class="w-full lg:w-1/4 rounded-lg shadow-2xl" />
                 <div class="w-full lg:w-3/4">
                     <h5 class="text-xl font-bold">
                         {{ __('addedBy') }} <span>{{ $post->user->name }}</span>
                     </h5>
                     <p class="py-4">
                         {{ $post->content }}
                     </p>
                     <h5 class="text-xl font-bold">
                         {{ __('created_at') }} <span>{{ $post->created_at->diffForHumans() }}</span>
                     </h5>
                 </div>
             </div>
         </div>
     @endforeach

 </x-app-layout>
