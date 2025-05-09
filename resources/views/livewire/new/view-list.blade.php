<div>
    {{-- Be like water. --}}

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

@foreach($posts as $post)

    <h1>{{$post->title}}</h1>
    <h2>{{$post->description}}</h2>

    @if($post->image)
    
        <img src="{{asset('storage/'.$post->image)}}" alt="" class="w-full max-h-60 object-cover rounded mb-2">

    
    @endif
@endforeach

</div>
