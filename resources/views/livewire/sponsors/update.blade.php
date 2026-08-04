<div>
    <form wire:submit="update">
        <div class="row">
            <div class="col-sm-8">
                <img src="{{ Storage::url($image) }}" alt="{{ $titre }}" class="w-100" srcset="">
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="">Nouvelle photo</label>
                    <input type="file" wire:model="image"    class="form-control">
                    @error('photo')
                        <span class="small text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Nom</label>
                    <input type="text" class="form-control"  wire:model="titre">
                    @error('titre')
                        <span class="small text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Adresse E-mail *
                    </label>
                    <input type="email" id="email" wire:model="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Numéro de téléphone
                    </label>
                    <input type="text" id="telephone" wire:model="telephone" class="form-control">
                    @error('telephone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" wire:model="adresse" class="form-control">
                    @error('adresse')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea rows="5" id="description" wire:model="description" class="form-control"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                @include('components.alert')

                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm px-5" type="submit" wire:loading.attr="disabled">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
                        </span>
                    Mettre à jour
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>
