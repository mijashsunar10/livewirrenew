<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="max-w-md mx-auto mt-10">
        <form wire:submit.prevent="submit" class="space-y-4" enctype="multipart/form-data"> {{-- wire:submit.prevent = "submit" => it prevents page from relead and runs the submit() method in your post.php--}}
            {{--action="{{ route('posts.store') }}" method="POST" it is sam elike this in laravel  --}}

            @if (session()->has('message'))
                <div class="bg-green-100 text-green-800 p-2 rounded">
                    {{ session('message') }}
                </div>
            @endif    {{--  sent a success messsage in laravel --}}

            {{--  --}}
            <div>
                <label class="block">Title</label>
                <input type="text" wire:model="title" class="w-full border p-2 rounded">
                {{-- In laravel <input type="text" name="title" value="{{ old('title') }}"> but lin livewire both is done by wire:model = "title" --}}
                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
    
            <div>
                <label class="block">Description</label>
                <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block">Image</label>
                <input type="file" wire:model="image" class="w-full border p-2 rounded">
                @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer">Submit</button>
        </form>

       
    </div>

    <a class="bg-blue-600 text-white px-4 py-2 mt-4 rounded " href="{{route('posts.view')}}">View Post</a>
</div>
