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

<style>
    h1 {
        font-size: 2.25rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.875rem;
    }

    h3 {
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 0.75rem;
    }

    h4 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.625rem;
    }

    h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    h6 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
</style>


@foreach($posts as $post)

    <h1>{{$post->title}}</h1>
    <h2>{!! $post->description !!}</h2>


    @if($post->image)
    
        <img src="{{asset('storage/'.$post->image)}}" alt="" class="w-full max-h-60 object-cover rounded mb-2">

    
    @endif
@endforeach

</div>
