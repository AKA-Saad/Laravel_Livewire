<div class="w-1/2 mx-auto">
    @if(session()->has('notify'))
        <div class="bg-green-400 rounded text-white px-4 py-2">
            {{ session('notify') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile">

        {{-- <x-forms.filepond wire:model="image" /> --}}
        <x-forms.filepond
            wire:model="images"
            multiple
            allowImagePreview
            imagePreviewMaxHeight="200"
            allowFileTypeValidation
            acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
            allowFileSizeValidation
            maxFileSize="4mb"
        />

        @error('image') <p class="mt-2 text-sm text-danger">{{ $message }}</p> @enderror

        <button type="submit" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
    </form>
</div>
