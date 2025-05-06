<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="max-w-2xl mx-auto mt-10 space-y-4">
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-2 rounded">
                {{ session('message') }}
            </div>
        @endif
    
        

        <a href="{{route('posts.view')}}">Go back to view</a>

          
  


    </div>

    @foreach ($trashedPosts as $post)
    <div class="border p-4 rounded shadow">
        <!-- Title -->
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>

        <!-- Description -->
        <p>{{ $post->description }}</p>

        <!-- Image Preview -->
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full max-h-60 object-cover rounded my-2">
        @endif

        <!-- Time left until auto-deletion -->
        @if(now()->lt($post->will_be_deleted_at))
            <p class="text-sm text-gray-500">Auto-deletes in: {{ $post->time_left }}</p>
        @else
            <p class="text-sm text-red-500">About to be deleted...</p>
        @endif

        <!-- Deletion time -->
        <p class="text-sm text-gray-500">Deleted {{ $post->deleted_at->diffForHumans() }}</p>

        <!-- Restore & Delete Buttons -->
        <div class="flex gap-2 mt-2">
            <button wire:click="restore({{ $post->id }})" class="bg-green-600 text-white px-3 py-1 rounded">Restore</button>
            <button wire:click="forceDelete({{ $post->id }})" class="bg-red-600 text-white px-3 py-1 rounded">Delete Permanently</button>
        </div>
    </div>
@endforeach
    
</div>
