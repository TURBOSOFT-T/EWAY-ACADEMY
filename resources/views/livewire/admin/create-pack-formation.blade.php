<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Créer un nouveau Pack de Formations</h5>
                    <a href="{{ route('packs') }}" class="btn btn-sm btn-light">
                        <i class="fa-solid fa-arrow-left me-1"></i> Retour
                    </a>
                </div>

                <div class="card-body p-4">

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="savePack">
                        
                        <div class="row g-3">
                            <!-- Titre du Pack -->
                            <div class="col-md-8">
                                <label for="titre" class="form-label fw-bold">Titre du Pack <span class="text-danger">*</span></label>
                                <input type="text" id="titre" wire:model="titre" class="form-control @error('titre') is-invalid @enderror" placeholder="Ex: Pack Développement Web Complet">
                                @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Prix -->
                            <div class="col-md-4">
                                <label for="prix" class="form-label fw-bold">Prix du Pack (FCFA / €) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" id="prix" wire:model="prix" class="form-control @error('prix') is-invalid @enderror" placeholder="50000">
                                @error('prix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">Description du Pack</label>
                                <textarea id="description" wire:model="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Présentation synthétique du pack..."></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Image d'illustration -->
                            <div class="col-md-8">
                                <label for="image" class="form-label fw-bold">Image de couverture</label>
                                <input type="file" id="image" wire:model="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Statut Actif -->
                            <div class="col-md-4 d-flex align-items-center mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="active" wire:model="active">
                                    <label class="form-check-label fw-bold" for="active">Publier directement ce pack</label>
                                </div>
                            </div>

                            <!-- Prévisualisation Image -->
                            @if ($image)
                                <div class="col-12 mt-2">
                                    <p class="text-muted small mb-1">Aperçu :</p>
                                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-height: 120px;">
                                </div>
                            @endif
                        </div>

                        <hr class="my-4">

                        <!-- SECTION : Sélection des Formations incluses -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold text-dark mb-0">
                                    Associer des Formations au Pack 
                                    <span class="badge bg-secondary">{{ count($selectedFormations) }} sélectionnée(s)</span>
                                </h5>

                                <!-- Champ de recherche -->
                                <div style="width: 250px;">
                                    <input type="text" wire:model.live.debounce.300ms="searchFormation" class="form-control form-control-sm" placeholder="Rechercher une formation...">
                                </div>
                            </div>

                            @error('selectedFormations')
                                <div class="text-danger small mb-2">{{ $message }}</div>
                            @enderror

                            <!-- Liste sous forme de grille de cartes cocheuses -->
                            <div class="border rounded p-3 bg-light" style="max-height: 350px; overflow-y: auto;">
                                @forelse($formations as $formation)
                                    <div class="card mb-2 shadow-sm border-0">
                                        <div class="card-body p-2 d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       value="{{ $formation->id }}" 
                                                       wire:model.live="selectedFormations" 
                                                       id="formation-{{ $formation->id }}">
                                            </div>
                                            
                                            @if($formation->image)
                                                <img src="{{ Storage::url($formation->image) }}" class="rounded me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white rounded me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                </div>
                                            @endif

                                            <label class="form-check-label flex-grow-1 cursor-pointer" for="formation-{{ $formation->id }}">
                                                <div class="fw-bold text-dark">{{ $formation->titre }}</div>
                                                <small class="text-muted">
                                                    Type: {{ ucfirst($formation->type) }} 
                                                    @if($formation->category) | Catégorie: {{ $formation->category->name ?? '' }} @endif
                                                </small>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-3">
                                        Aucune formation trouvée.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Bouton d'enregistrement -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success px-4" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="fa-solid fa-check me-1"></i> Créer le Pack</span>
                                <span wire:loading><i class="fa-solid fa-spinner fa-spin me-1"></i> Enregistrement...</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>