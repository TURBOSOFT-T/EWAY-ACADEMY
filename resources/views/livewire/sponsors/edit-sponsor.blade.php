<div>
    <form wire:submit.prevent="update">
        
            
     
        <div class="modal-body">
              @include('components.alert') 
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nom du sponsor *
                        </label>
                        <input type="text" id="titre" wire:model="titre"  class="form-control">
                        @error('titre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
               
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Adresse E-mail *
                        </label>
                        <input type="email" id="email" wire:model="email" class="form-control">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Numéro de téléphone
                        </label>
                        <input type="text" id="telephone" wire:model="telephone" class="form-control">
                        @error('telephone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" wire:model="adresse" class="form-control">
                    @error('adresse')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea id="description" wire:model="description" class="form-control"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>

                 <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Logo
                        </label>
                        <input type="file" class="form-control" wire:model="image">
                        @error('image')
                            <span class="text-danger small"> {{ $message }} </span>
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
                Mettre à jour
            </button>
        </div>
    </form>

</div>
