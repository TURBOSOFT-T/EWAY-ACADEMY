<div>
{{-- 
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}
    
    <form wire:submit.prevent="create">
        <div class="modal-body">
              @include('components.alert') 
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Nom du sponsor *
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
                Enregistrer
            </button>
        </div>
    </form>

    <script>
        Livewire.on('sponsorAdded', () => {
            // Logic to handle the event, if needed
        });
    </script>

</div>


{{-- 

<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="create">
        <div class="col-sm-6">
            <div class="mb-3">
            <label for="titre">Titre</label>
            <input type="text" id="titre" wire:model="titre" class="form-control">
            @error('titre')
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
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        </div>

        <div class="col-sm-6">
            <div class="mb-3">
            <label for="telephone">Téléphone</label>
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

        <button type="submit" class="btn btn-primary">
            <span wire:loading>
                <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
            </span>
            Ajouter Sponsor
        </button>
    </form>
</div>
 --}}