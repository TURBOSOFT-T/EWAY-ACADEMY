<div>

    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-6">
            
            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control btn-sm" wire:model="key"
                        placeholder="Titre,Description des articles">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Barre de recherche et filtres -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               class="form-control border-start-0 ps-0" 
                               placeholder="Rechercher par titre ou description...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="1">Actifs uniquement</option>
                        <option value="0">Inactifs uniquement</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    @include('components.alert')
<!-- Alertes de succès -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive-sm">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead class="table-dark cusor">
                <tr>
                   
                    <th>Photo</th>
                    <th>Nom </th>
                    <th>Nombre formation(s)</th>
                    <th>Prix</th>
                   
                  
                    <th>Description</th>
                   
                    <th> Date création</th>
                    <th style="text-align: right;">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20" class="rounded shadow"
                                alt="">
                        </span>
                    </th>
                </tr>
            </thead>


            <tbody>
              <div class="row g-4">
        @forelse ($packs as $pack)
            <div class="col-lg-6 col-xl-6" wire:key="pack-{{ $pack->id }}">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="row g-0 h-100">
                        
                        <!-- Image du Pack -->
                        <div class="col-sm-4 bg-light position-relative min-vh-20">
                            @if ($pack->image)
                                <img src="{{ Storage::url($pack->image) }}" 
                                     alt="{{ $pack->titre }}" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover; min-height: 180px;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted bg-secondary-subtle" style="min-height: 180px;">
                                    <i class="fa-solid fa-cubes fa-3x opacity-50"></i>
                                </div>
                            @endif

                            <!-- Badge de prix -->
                            <span class="position-absolute top-0 start-0 bg-dark text-white fw-bold fs-7 px-2 py-1 rounded-end mt-2">
                                {{ number_format($pack->prix, 0, ',', ' ') }} FCFA
                            </span>
                        </div>

                        <!-- Contenu du Pack -->
                        <div class="col-sm-8 d-flex flex-column justify-content-between p-3">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold text-dark mb-0">{{ $pack->titre }}</h5>
                                    
                                    <!-- Toggle Statut -->
                                    <button wire:click="toggleStatus({{ $pack->id }})" 
                                            class="btn btn-sm {{ $pack->active ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-2 py-0" 
                                            title="Cliquer pour changer le statut">
                                        {{ $pack->active ? 'Actif' : 'Masqué' }}
                                    </button>
                                </div>

                                <p class="text-muted small mb-3">
                                    {{ Str::limit($pack->description ?? 'Aucune description disponible.', 90) }}
                                </p>

                                <!-- Formations incluses dans ce pack -->
                                <div class="mb-3">
                                    <div class="fw-bold small text-secondary mb-1">
                                        <i class="fa-solid fa-graduation-cap me-1"></i> Formations incluses ({{ $pack->formations_count }}) :
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @forelse ($pack->formations as $formation)
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill fw-normal">
                                                {{ $formation->titre }}
                                            </span>
                                        @empty
                                            <span class="text-danger small fst-italic">Aucune formation rattachée</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-end align-items-center gap-2 pt-2 border-top">
                                <button type="button" 
                                        wire:click="deletePack({{ $pack->id }})" 
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer ce pack ?" 
                                        class="btn btn-sm btn-outline-danger" 
                                        title="Supprimer le pack">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm p-5 text-center">
                    <div class="text-muted mb-3">
                        <i class="fa-solid fa-box-open fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Aucun pack de formation trouvé</h5>
                    <p class="text-muted">Créez votre premier pack pour regrouper plusieurs formations dans une seule offre.</p>
                    <div>
                        <a href="{{ route('admin.packs.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Créer un Pack
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
            </tbody>


        </table>
    </div>
    {{ $packs->links('pagination::bootstrap-4') }}



</div>
