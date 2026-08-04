<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre *</label>
            <input type="text" id="titre" wire:model="titre" class="form-control">
            @error('titre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description *</label>
            <textarea id="description" wire:model="description" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Vidéo *</label>
            <input type="file" id="video" wire:model="video" class="form-control">

            @error('video') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image *</label>
            <input type="file" id="image" wire:model="image" class="form-control">

            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
