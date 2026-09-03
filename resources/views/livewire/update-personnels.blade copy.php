<form wire:submit.prevent="update">
    <div class="modal-body">
        <div class="row g-3">
            <!-- Champ Avatar / Photo de profil -->
            <div class="col-12">
                <label class="form-label fw-bold">Photo de profil / Avatar</label>
                <div class="d-flex align-items-center gap-3">
                    <div class="position-relative">
                        @if ($avatar)
                            <!-- Prévisualisation de la nouvelle image sélectionnée -->
                            <img src="{{ $avatar->temporaryUrl() }}" class="rounded-circle object-fit-cover border" style="width: 75px; height: 75px;">
                        @elseif ($oldAvatar)
                            <!-- Image actuelle enregistrée en base de données -->
                            <img src="{{ asset('storage/' . $oldAvatar) }}" class="rounded-circle object-fit-cover border" style="width: 75px; height: 75px;">
                        @else
                            <!-- Image par défaut -->
                            <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle object-fit-cover border" style="width: 75px; height: 75px;">
                        @endif

                        <!-- Loader pendant le téléversement de l'image -->
                        <div wire:loading wire:target="avatar" class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 rounded-circle d-flex align-items-center justify-content-center">
                            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <input type="file" wire:model="avatar" id="avatarUpload" class="form-control @error('avatar') is-invalid @enderror" accept="image/png, image/jpeg, image/webp">
                        <small class="text-muted d-block mt-1">Formats acceptés : JPG, PNG, WEBP. Max 2Mo.</small>
                        @error('avatar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" wire:model="nom" class="form-control @error('nom') is-invalid @enderror">
                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" wire:model="prenom" class="form-control @error('prenom') is-invalid @enderror">
                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Téléphone</label>
                <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Rôle</label>
                <select wire:model="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="">-- Sélectionner un rôle --</option>
                    <option value="etudiant">Etudiant</option>
                    <option value="personnel">Personnel</option>
                    <option value="enseignant">Enseignant</option>
                    <option value="admin">Administrateur</option>
                    <option value="commercial">Commercial</option>
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-sm btn-warning" wire:loading.attr="disabled" wire:target="avatar, update">
            <span wire:loading.remove wire:target="update">Enregistrer les modifications</span>
            <span wire:loading wire:target="update">
                <span class="spinner-border spinner-border-sm me-1" role="status"></span> Mise à jour...
            </span>
        </button>
    </div>
</form>