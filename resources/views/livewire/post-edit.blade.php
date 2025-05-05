<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="max-w-md mx-auto mt-10">
        <form wire:submit.prevent="update" class="space-y-4">
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

        <div>
            <label class="block">Description</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded cursor-pointer">Update</button>
    </form>

    <a href="{{ route('posts.view') }}" class="text-blue-600 hover:underline mt-4">Back to View Posts</a>

        </form>
    </div>
</div>
