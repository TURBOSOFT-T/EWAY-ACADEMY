<div>

    @include('components.alert')

    @if ($blog)
        <form wire:submit="update_blogs"  enctype="multipart/form-data">
        @else
            <form wire:submit="create">
    @endif

    <div class="row">
        <div class="col-sm-8">
<br>
           
            <br>
            <div class="mb-3">
                <label for="">Nom </label>
                <input type="text" name="title" class="form-control" wire:model="title">
                @error('title')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>

            <div class="mb-3">
                <label><strong> Pétite Description :</strong></label>
                <textarea class=" form-control"   name="description" wire:model="meta_description"></textarea>
                @error('meta_description')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>
            <div wire:ignore class="mb-3">
    <label><strong>Description :</strong></label>
    <textarea class="form-control" id="description" name="description">{{ old('description', $description) }}</textarea>
    @error('description')
        <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>


            <div class="row">
                 <div class="col-sm-6 mb-3">
                    <label for="">Categorie </label>
                    <select wire:model='category_id' class="form-control @error('category_id') is-invalid @enderror">
                        <option value=""></option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div> 
             
               
       
            </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="">image d'illustration (1366*768)</label>
                <div class="preview-blogs-illustration" onclick="preview_illustration('new-prosduit')">
                    @if ($blog)
                        @if ($image2 && is_null($image))
                            <img src="{{ Storage::url($image2) }}" alt="" class="w-100">
                        @else
                            <img src="{{ $image->temporaryUrl() }}" alt="" srcset="">
                        @endif
                    @else
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="" class="w-100">
                        @else
                            <img src="/icons/no-image.webp" alt="" class="w-100">
                        @endif
                    @endif
                </div>
                <input type="file" name="image" accept="image/*" class=" d-none" id="file-input-new-prosduit"
                    wire:model="image">
                @error('image')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>

   
        </div>
    </div>
    <div style="text-align: right;">
        <button class="btn btn-primary btn-sm px-5" type="submit" wire:loading.attr="disabled">
            <span wire:loading>
                <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
            </span>
            @if ($blogs)
                Mettre a jour
            @else
                Enregistrer le blog
            @endif
        </button>
    </div>
    </form>
</div>


<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
        const editor = CKEDITOR.replace('description');
        editor.on('change', function(event){
            console.log(event.editor.getData())
            @this.set('description', event.editor.getData());
        })
</script>
