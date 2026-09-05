<div class="container py-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Modifier le Pack : {{ $titre }}</h3>
            <p class="text-muted mb-0">Mettez à jour les informations du pack et les formations qui le composent.</p>
        </div>
        <a href="{{ route('packs') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form wire:submit.prevent="updatePack">
                <div class="row g-4">

                    <!-- Titre du Pack (Affiche l'ancien titre) -->
                    <div class="col-md-8">
                        <label for="titre" class="form-label fw-bold">Titre du Pack <span class="text-danger">*</span></label>
                        <input type="text" id="titre" wire:model="titre" class="form-control @error('titre') is-invalid @enderror" placeholder="Ex: Pack Développeur Fullstack">
                        @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prix (Affiche l'ancien prix) -->
                    <div class="col-md-4">
                        <label for="prix" class="form-label fw-bold">Prix (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" id="prix" wire:model="prix" class="form-control @error('prix') is-invalid @enderror" placeholder="Ex: 50000">
                        @error('prix')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description (Affiche l'ancienne description) -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea id="description" wire:model="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Décrivez le contenu et les avantages de ce pack..."></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image de couverture (Affiche l'ancienne image si aucun nouveau fichier n'est choisi) -->
                    <div class="col-md-6">
                        <label for="newImage" class="form-label fw-bold">Changer l'image du Pack</label>
                        <input type="file" id="newImage" wire:model="newImage" class="form-control @error('newImage') is-invalid @enderror" accept="image/*">
                        @error('newImage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mt-3 d-flex align-items-center gap-3">
                            @if ($newImage)
                                <div>
                                    <span class="small text-muted d-block mb-1">Nouvelle image :</span>
                                    <img src="{{ $newImage->temporaryUrl() }}" alt="Nouvelle image" class="img-thumbnail" style="max-height: 120px;">
                                </div>
                            @elseif ($oldImage)
                                <div>
                                    <span class="small text-muted d-block mb-1">Image actuelle (enregistrée) :</span>
                                    <img src="{{ Storage::url($oldImage) }}" alt="{{ $titre }}" class="img-thumbnail" style="max-height: 120px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Statut (Case cochée selon l'état actuel) -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="active" wire:model="active">
                            <label class="form-check-label fw-bold ms-2" for="active">
                                Rendre ce pack actif et visible pour les étudiants
                            </label>
                        </div>
                    </div>

                    <!-- Sélection des Formations (Coche automatiquement les formations déjà rattachées au pack) -->
                    <div class="col-12">
                        <hr class="my-2">
                        <label class="form-label fw-bold mb-1">Formations incluses dans le Pack <span class="text-danger">*</span></label>
                        <p class="text-muted small mb-3">Les formations actuellement incluses sont pré-cochées. Cochez/décochez selon vos besoins.</p>

                        @error('selectedFormations')
                            <div class="alert alert-danger py-2 mb-3">{{ $message }}</div>
                        @enderror

                        <div class="row g-3 max-vh-50 overflow-y-auto border rounded p-3 bg-light">
                            @forelse ($formations as $formation)
                                <div class="col-md-6 col-lg-4" wire:key="f-{{ $formation->id }}">
                                    <div class="form-check card h-100 p-2 ps-4 border-0 shadow-sm">
                                        <input class="form-check-input mt-1" 
                                               type="checkbox" 
                                               value="{{ $formation->id }}" 
                                               id="formation_{{ $formation->id }}" 
                                               wire:model="selectedFormations">
                                        
                                        <label class="form-check-label w-100 cursor-pointer ms-2" for="formation_{{ $formation->id }}">
                                            <div class="fw-bold text-dark">{{ $formation->titre }}</div>
                                            @if(isset($formation->prix))
                                                <span class="text-muted small">{{ number_format($formation->prix, 0, ',', ' ') }} FCFA</span>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-3 text-muted">
                                    Aucune formation disponible en base de données.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Boutons de soumission -->
                    <div class="col-12 text-end pt-3">
                        <a href="{{ route('packs') }}" class="btn btn-light me-2">Annuler</a>
                        <button type="submit" class="btn btn-primary px-4" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fa-solid fa-floppy-disk me-1"></i> Enregistrer les modifications
                            </span>
                            <span wire:loading>
                                <i class="fa-solid fa-spinner fa-spin me-1"></i> Enregistrement...
                            </span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>