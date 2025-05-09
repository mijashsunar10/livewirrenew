<div>
    <div class="max-w-md mx-auto mt-10">
        <form wire:submit.prevent="submit" class="space-y-4" enctype="multipart/form-data">
            @if (session()->has('message'))
                <div class="bg-green-100 text-green-800 p-2 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <div>
                <label class="block">Title</label>
                <input type="text" wire:model="title" class="w-full border p-2 rounded">
                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
    
            <div wire:ignore>
                <label class="block">Description</label>
                <textarea id="description" class="w-full border p-2 rounded">{{ $description }}</textarea>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block">Image</label>
                <input type="file" wire:model="image" class="w-full border p-2 rounded">
                @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer">Submit</button>
        </form>

        <a class="bg-blue-600 text-white px-4 py-2 mt-4 rounded inline-block" href="{{route('posts.view')}}">View Post</a>
    </div>

    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/yefhnnw3pe7wp6973ntpshfk1zrgvx879j3pni68yvvzdhop/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('livewire:init', function () {
            tinymce.init({
                selector: '#description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
                setup: function(editor) {
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                    });
                }
            });
        });
    </script>
    @endpush
</div>