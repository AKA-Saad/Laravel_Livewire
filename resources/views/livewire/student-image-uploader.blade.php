<div>
    <input type="file" wire:model="image">
    @error('image') <span class="error">{{ $message }}</span> @enderror

    <button wire:click="save">Upload</button>

    @if (session()->has('message'))
        <div class="success">{{ session('message') }}</div>
    @endif
</div>