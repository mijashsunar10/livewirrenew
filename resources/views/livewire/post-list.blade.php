<div>
    {{-- Success is as dangerous as failure. --}}

    @if (session()->has('message'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show"
        class="bg-green-100 text-green-800 p-2 rounded mb-4"
    >
        {{ session('message') }}
    </div>
@endif



    <div class="max-w-2xl mx-auto mt-10 space-y-4">
        @foreach ($posts as $post)
            <div class="border p-4 rounded shadow {{ $loop->first ? 'border-green-200' : '' }}">
                {{-- {{ $loop->first ? 'border-green-200' : '' }}: This condition adds a light green border (border-green-200) to the first post (most recent one). --}}
    
                <!-- Title -->
                <h2 class="text-xl font-bold">{{ $post->title }}</h2>
    
                <!-- Description -->
                <p>{{ $post->description }}</p>

                <a href="{{route('posts.edit',$post->id)}}" class="bg-blue-900 text-white px-2 py-1 m-2 hover:underline">Edit</a>
    
                <button onclick="if(confirm('Are u want to delete this post?')){@this.call('delete',{{$post->id}})}" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                    {{-- onclick="if(confirm('Are u want to delete this post?'))  = This is the inline javascript onclick event handler showw the confirmation if u want to delete the post--}}
                    {{-- @this.call => this is the livewire mthid to call a method on current livewire component , delete => name of the method inside your current livewire component, $post->id =>Passes the current post’s ID to the method. --}}
                    Delete
                </button>
                <!-- Created At -->
                <p class="text-sm text-gray-500 mt-1">
                    {{ $post->updated_at->diffForHumans() }}
                </p>
    
                <!-- Additional "Just Now" indicator for the most recent post -->
                @if ($loop->first)
                    <span class="text-green-600 font-semibold text-sm">Created just now</span>
                @endif
            </div>
        @endforeach
    
        @if ($posts->isEmpty())
            <p>No posts yet.</p>
        @endif
    </div>
    
    <a href="{{ route('posts.create') }}" class="bg-blue-600  text-white my-2 px-4 py-2 rounded">
       Go back to post..
        </a>
    <a href="{{ route('posts.trash') }}" class="bg-blue-600 mx-2 text-white mt-2 px-4 py-2 rounded">
      Trash
        </a>


    
</div>
