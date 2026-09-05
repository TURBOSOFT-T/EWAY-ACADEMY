<div class="container py-4">
    <h2 class="mb-4 fw-bold">Mes Inscriptions</h2>

    @forelse($inscriptions as $inscription)
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            {{-- En-tête de l'inscription --}}
            <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                <div>
                    <span class="fw-bold me-2">Inscription #{{ $inscription->id }}</span>
                    <small class="text-muted">
                        du {{ $inscription->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
                <div>
                    {{-- Badges de statut --}}
                    @switch($inscription->statut)
                        @case('valide')
                        @case('validé')
                        @case('confirme')
                            <span class="badge bg-success">Validée</span>
                            @break
                        @case('attente')
                            <span class="badge bg-warning text-dark">En attente</span>
                            @break
                        @case('annule')
                        @case('annulée')
                        @case('rejete')
                            <span class="badge bg-danger">Annulée</span>
                            @break
                        @default
                            <span class="badge bg-secondary">{{ ucfirst($inscription->statut) }}</span>
                    @endswitch

                    <span class="badge bg-info text-dark ms-1">
                        Paiement : {{ ucfirst($inscription->mode) }}
                    </span>
                </div>
            </div>

            {{-- Corps de la carte : Contenu de l'inscription --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Élément souscrit</th>
                                <th class="text-end">Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscription->contenus as $contenu)
                                <tr>
                                    <td>
                                        <span class="badge bg-outline-primary border border-primary text-primary">
                                            {{ $contenu->type }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($contenu->type === 'Pack' && $contenu->packFormation)
                                            <div class="fw-semibold text-dark">
                                                {{ $contenu->packFormation->nom ?? $contenu->packFormation->titre }}
                                            </div>
                                            <small class="text-muted">Pack de formations</small>
                                        @elseif($contenu->type === 'Formation' && $contenu->formation)
                                            <div class="fw-semibold text-dark">
                                                {{ $contenu->formation->nom ?? $contenu->formation->titre }}
                                            </div>
                                            <small class="text-muted">Cours individuel</small>
                                        @else
                                            <span class="text-muted">Élément non disponible</span>
                                        @endif
                                    </td>
                                    <td class="text-end fw-bold">
                                        {{ number_format($contenu->prix, 0, ',', ' ') }} FCFA
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="2" class="text-end fw-bold">Montant Total :</th>
                                <th class="text-end fw-bold text-primary">
                                    {{ number_format($inscription->contenus->sum('prix'), 0, ',', ' ') }} FCFA
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center py-4">
            <i class="fa-solid fa-folder-open mb-2 fa-2x d-block"></i>
            Vous n'avez encore effectué aucune inscription.
        </div>
    @endforelse
</div>