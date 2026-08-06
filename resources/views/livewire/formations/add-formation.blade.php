<div>
    <div>

     
        <form wire:submit.prevent="create">
            <div class="modal-body">
                @include('components.alert')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Titre *
                            </label>
                            <input type="text" id="titre" wire:model="titre" class="form-control">
                            @error('titre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Date debut *
                            </label>
                            <input type="date" id="titre" wire:model="date_debut" class="form-control">
                            @error('date_debut')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Image
                            </label>
                            <input type="file" class="form-control" wire:model="image" accept="image/*">
                            @error('image')
                            <span class="text-danger small"> {{ $message }} </span>
                            @enderror
                        </div>

                        {{-- @if ($image)
                        <div class="mt-2">
                            <strong>Image prévisualisée :</strong>
                            <img src="{{ $image->temporaryUrl() }}" width="100" height="100" alt="Image prévisualisée">
                    </div>
                    @endif --}}
                </div>

                {{--
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="description">Meta Description</label>
                            <textarea id="meta_description" wire:model="meta_description" class="form-control"></textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    </div>
    --}}
    <div class="col-sm-6 mb-3">
        <label for="">Categorie </label>
        <select wire:model='category_id'
            class="form-control @error('category_id') is-invalid @enderror">
            <option value=""></option>
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
            @endforeach
        </select>
        @error('category_id')
        <span class="text-danger small"> {{ $message }} </span>
        @enderror
    </div>




    <div wire:ignore class="form-group row">

        <div class="col-md-12">
            <textarea id="description" wire:model="description" class="form-control">Message</textarea>

        </div>
    </div>

    {{--
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea id="description" wire:model="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div> --}}

<div class="col-sm-6">
    <div class="mb-3">
        <label for="description"> Meta Description</label>
        <textarea id="description" wire:model="meta_description" class="form-control"></textarea>
        @error('meta_description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>




</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-sm btn-primary">
        <span wire:loading>
            <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
        </span>
        Enregistrer
    </button>
</div>
</form>



</div>

<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
    const editor = CKEDITOR.replace('description');
    editor.on('change', function(event) {
        console.log(event.editor.getData())
        @this.set('description', event.editor.getData());
    })
</script>
</div>