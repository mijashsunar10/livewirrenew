<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}


   Title: {{$title}}
   <p>Name: {{$author}}</p>
   <p>Name:{{$teacher}}</p>
  
    <a href="{{ route('posts.create') }}" class="bg-blue-600  text-white my-2 px-4 py-2 rounded">
    Create New Post
    </a>



   <livewire:create-post/>
</div>
