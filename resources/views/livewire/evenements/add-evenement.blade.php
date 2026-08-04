<div>
    <div>

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form wire:submit.prevent="create"  enctype="multipart/form-data">
            <div class="modal-body">
                  @include('components.alert') 
                <div class="row">

                    <div class="col-sm-12">
                        <label for="type">Type d'événement</label><br>
                    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"   wire:model.lazy="type"  wire:click="type"{{-- wire:model="type" --}} id="webinaire" value="webinaire" checked>
                            <label class="form-check-label" for="webinaire">Webinaire</label>
                        </div>
                    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio"  wire:model.lazy="type"
                            wire:click="type" {{-- wire:model="type" --}} id="presentiel" value="presentiel">
                            <label class="form-check-label" for="presentiel">Présentiel</label>
                        </div>


                        <div class="form-check form-check-inline">
                            <div class="form-check form-switch">
                
                                <input name="sur_devis" class="form-check-input"  class="switch"   type="checkbox" id="sur_devis" wire:model.lazy="free"
                                   wire:click="free">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Evènement gratuit</label>
                                @error('free')
                                    <span class="text-danger small"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Titre de l'évènement *
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
                                Téléphone *
                            </label>
                            <input type="text" id="titre" wire:model="telephone" class="form-control">
                            @error('telephone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($type === 'presentiel')

                    <div class="col-sm-6">
                        <label>Pays</label>
                        <input type="text" wire:model="country" class="form-control">
                        @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-sm-6">
                        <label>Adresse</label>
                        <input type="text" wire:model="adresse" class="form-control">
                        @error('adresse') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-sm-6">
                        <label>Location</label>
                        <input type="text" wire:model="location" class="form-control">
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif
                    <div class="col-sm-6">
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

                     <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="start" class="form-label">
                                Date debut de l'évènement *
                            </label>
                            <input type="datetime-local" id="start" wire:model="start" class="form-control">
                            @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="start" class="form-label">
                                Date fin de  l'évènement *
                            </label>
                            <input type="datetime-local" id="end" wire:model="end" class="form-control">
                            @error('end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
 
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Image
                            </label>
                            <input type="file" class="form-control" accept="image/*" wire:model="image">
                            @error('image')
                                <span class="text-danger small"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Pétite description *
                            </label>
                            <textarea  type="text" id="titre" wire:model="meta_description" class="form-control">
                            </textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    {{-- <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea id="description" wire:model="description" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    <div wire:ignore class="form-group row">
                       
                        <div class="col-md-12">
                            <textarea  id="description"   wire:model="description" class="form-control"  >Message</textarea>
                           
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Autres descriptions(1)
                            </label>
                            <textarea  type="text" id="titre" wire:model="autre_description" class="form-control">
                            </textarea>
                            @error('autre_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                             <label for="name" class="form-label">
                                 (2)
                            </label> 
                            <textarea  type="text" id="titre" wire:model="autre_description1" class="form-control">
                            </textarea>
                            @error('autre_description1')
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


</div>

<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
        const editor = CKEDITOR.replace('description');
        editor.on('change', function(event){
            console.log(event.editor.getData())
            @this.set('description', event.editor.getData());
        })
</script>
