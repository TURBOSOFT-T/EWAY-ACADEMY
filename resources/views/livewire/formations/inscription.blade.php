<div>
    <form wire:submit="filtrer">
        <div class="row mb-3">
            <div class="col-sm-4 d-flex align-items-center">
                <span>
                    <b>{{ $inscriptions->count() }}</b> Résultats sur {{ $total }}
                </span>
            </div>
            <div class="col-sm-12 mt-2">
                <div class="input-group">
                    <input type="text" wire:model.live="key" placeholder="Recherche par nom, prénom, numéro..." class="form-control">
                    
                    {{-- Nouveau filtre par type --}}
                    <select class="form-control" wire:model.live="type">
                        <option value="">Tous les types</option>
                        <option value="Formation">Formation</option>
                        <option value="Pack">Pack</option>
                    </select>

                    <select class="form-control" wire:model="statut2">
                        <option value="">Etat de confirmation</option>
                        <option value="">Tous</option>
                        <option value="confirmer">Confirmé</option>
                        <option value="non_confirmer">Non confirmé</option>
                    </select>
                    
                    <select class="form-control" wire:model="statut">
                        <option value="">Statut</option>
                        <option value="créé">Créé</option>
                        <option value="payée">Payée</option>
                        <option value="retournée">Retournée</option>
                    </select>

                    <input type="date" class="form-control" wire:model="date">

                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('components.alert')

    <div class="table-responsive-sm">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th></th>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Téléphone</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Mode</th>
                    <th>Date</th>
                    <th class="text-end">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="Chargement...">
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($inscriptions as $inscription)
                    <tr>
                        <td>
                            <input type="checkbox" wire:click="toggleCommandeSelection({{ $inscription->id }})">
                        </td>
                        <td>
                            <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#qr-code-{{ $inscription->id }}">
                                <i class="ri-qr-scan-2-line"></i>
                            </button>

                            <div class="modal fade" id="qr-code-{{ $inscription->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Commande #{{ $inscription->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center p-3">
                                            <h6 class="text-muted">Scanner pour imprimer le reçu d'inscription</h6>
                                            {{-- {!! QrCode::size(100)->generate(route('print_inscription', ['id' => $inscription->id])) !!} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $inscription->id }}</td>
                        <td>
                            {{ $inscription->nom }} {{ $inscription->prenom }}
                            @if ($inscription->note)
                                <i class="ri-message-2-fill text-warning" title="Une note a été ajoutée"></i>
                            @endif
                        </td>
                        <td>
                            @if($inscription->type === 'Pack')
                                <span class="badge bg-info">Pack</span>
                            @else
                                <span class="badge bg-primary">Formation</span>
                            @endif
                        </td>
                        <td>{{ $inscription->telephone }}</td>
                        <td>{{ $inscription->contenus->first()->prix ?? 0 }} <x-devise></x-devise></td>
                        <td>
                            @can('order_edit')
                                @if ($inscription->statut === 'payée')
                                    <b class="text-success">
                                        <i class="ri-check-double-fill"></i> Payée
                                    </b>
                                @elseif($inscription->statut == 'retournée')
                                    <b class="text-danger">
                                        @if ($inscription->etat == 'confirmé')
                                            <i class="ri-text-wrap"></i> Retournée
                                        @else
                                            <i class="ri-close-circle-line"></i> Annulé
                                        @endif
                                    </b>
                                @else
                                    @if ($inscription->etat == 'confirmé')
                                        <select class="form-control-sm" wire:change="updateStatus({{ $inscription->id }}, $event.target.value)">
                                            <option value="créé" {{ $inscription->statut === 'créé' ? 'selected' : '' }}>Créé</option>
                                            <option value="traitement" {{ $inscription->statut === 'traitement' ? 'selected' : '' }}>Traitement</option>
                                            <option value="payée" {{ $inscription->statut === 'payée' ? 'selected' : '' }}>Payée</option>
                                            <option value="retournée" {{ $inscription->statut === 'retournée' ? 'selected' : '' }}>Retournée</option>
                                        </select>
                                    @elseif($inscription->etat == 'attente')
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-primary" wire:click="confirmer({{ $inscription->id }})">
                                                <i class="ri-checkbox-circle-line"></i> Valider
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" wire:click="annuler({{ $inscription->id }})">
                                                <i class="ri-close-line"></i> Annuler
                                            </button>
                                        </div>
                                    @else
                                        <i class="ri-close-circle-line"></i> Annulé
                                    @endif
                                @endif
                            @endcan
                        </td>
                        <td><span class="text-capitalize">{{ $inscription->mode }}</span></td>
                        <td>{{ $inscription->created_at ? $inscription->created_at->format('d/m/Y H:i') : '' }}</td>
                        <td class="text-end">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#details-{{ $inscription->id }}">
                                    Voir détails
                                </button>

                                @can('order_delete')
                                    <button class="btn btn-sm btn-danger" onclick="toggle_confirmation({{ $inscription->id }})">
                                        Delete
                                    </button>
                                    <button class="btn btn-sm btn-success d-none" type="button" id="confirmBtn{{ $inscription->id }}" wire:click="delete({{ $inscription->id }})">
                                        Confirmer
                                    </button>
                                @endcan
                            </div>

                            <div class="modal fade" id="details-{{ $inscription->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content text-start">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Détails Inscription #{{ $inscription->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Nom & Prénom</th>
                                                    <td>{{ $inscription->nom }} {{ $inscription->prenom }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td><b>{{ $inscription->type }}</b></td>
                                                </tr>
                                                
                                                {{-- Dynamic row depending on Type (Pack or Formation) --}}
                                                @if($inscription->type === 'Pack')
                                                    <tr>
                                                        <th>Pack d'offres</th>
                                                        <td>{{ $inscription->pack->nom ?? $inscription->pack->titre ?? 'Non spécifié' }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <th>Formation</th>
                                                        <td>{{ $inscription->formation->titre ?? $inscription->formation->nom ?? 'Non spécifié' }}</td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <th>Téléphone</th>
                                                    <td>{{ $inscription->telephone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $inscription->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pays</th>
                                                    <td>{{ $inscription->country ? $inscription->country->name : 'Non défini' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Mode de paiement</th>
                                                    <td class="text-capitalize">{{ $inscription->mode }}</td>
                                                </tr>
                                                <tr>
                                                    <th>État</th>
                                                    <td>{{ $inscription->etat }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Note / Message</th>
                                                    <td>{{ $inscription->message ?? 'Aucune note' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date inscription</th>
                                                    <td>{{ $inscription->created_at ? $inscription->created_at->format('d/m/Y H:i') : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date de début souhaitée</th>
                                                    <td>{{ $inscription->date_debut }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center py-4">
                            <div>
                                <img src="/icons/icons8-ticket-100.png" height="100" width="100" alt="Vide">
                            </div>
                            <p class="mt-2 mb-0">Aucune inscription trouvée {{ $key ? '"' . $key . '"' : '' }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $inscriptions->links('pagination::bootstrap-4') }}
</div>