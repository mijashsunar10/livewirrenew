<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="max-w-2xl mx-auto mt-10 space-y-4">
        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-2 rounded">
                {{ session('message') }}
            </div>
        @endif
    
        @forelse($trashedPosts as $post)
            <div class="border p-4 rounded bg-red-50">
                <h2 class="text-lg font-bold">{{ $post->title }}</h2>
                <p>{{ $post->description }}</p>
                <div class="flex space-x-2 mt-2">
                    <button wire:click="restore({{ $post->id }})" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Restore</button>
                    {{--  It's the Livewire version of calling a method when a button is clicked ..This calls the restore() method in your Livewire component and passes the specific post's ID to it. --}}
                    {{-- {{ $post->id }} This dynamically passes the ID of the current post in the loop. --}}
                    <button wire:click="forceDelete({{ $post->id }})" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete Permanently</button>
                </div>
            </div>
        @empty
            <p>No trashed posts.</p>
        @endforelse

        <a href="{{route('posts.view')}}">Go back to view</a>
    </div>
    
</div>
