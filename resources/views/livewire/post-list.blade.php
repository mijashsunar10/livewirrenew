<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="max-w-2xl mx-auto mt-10 space-y-4">
        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="border p-4 rounded shadow">
                    <h2 class="text-xl font-bold">{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @else
            <p>No posts yet.</p>
        @endif
    </div>

    <a href="{{ route('posts.create') }}" class="bg-blue-600  text-white my-2 px-4 py-2 rounded">
       Go back to post..
        </a>
    
</div>
