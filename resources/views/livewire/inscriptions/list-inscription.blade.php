<div>
    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-4">
                <span>
                    <b>{{ $inscriptions->count() }}</b> Résultats sur {{ $total }}
                </span>
            </div>
            <div class="col-sm-12">
                <div class="input-group mb-3">
                   
                    <input type="text" wire:model.live="key" placeholder="Recherche par nom,prenom, nnuméro"
                        class="form-control">
                    <select class="form-control" wire:model="statut2">
                        <option value="">Etat de confirmation</option>
                        <option value="">Tous</option>
                        <option value="confirmer">Confirmé</option>
                        <option value="non_confirmer">Non confirmé</option>
                    </select>
                   
                    <select class="form-control" wire:model="statut">
                        <option value="">Etat</option>
                        <option value="créé">Créé</option>
                        <option value="traitement">Traitement</option>
                    {{--     <option value="Livraison">Livraison</option> --}}
                        
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
                    <td></td>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Pays</th>
                   
                  
                    <th>Statut</th>
                    <th>Mode</th>
                    <th>Date</th>
                    <th class="text-end">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
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
                            <button class="btn btn-sm" data-bs-toggle="modal"
                                data-bs-target="#qr-code-{{ $inscription->id }}">
                                <i class="ri-qr-scan-2-line"></i>
                            </button>
                            <!-- Center modal content -->
                            <div class="modal fade" id="qr-code-{{ $inscription->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myCenterModalLabel">
                                                Commande #{{ $inscription->id }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="text-muted">
                                                Veuillez scanner ce code Qr pour impprimer le Reçu de inscription .
                                            </h6>
                                            <div class="text-center p-2">
                                              {{--   {!! QrCode::size(100)->generate(route('print_inscription', ['id' => $inscription->id])) !!} --}}
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                        <td>{{ $inscription->id }}</td>
                        <td>
                            {{ $inscription->nom }}
                            @if ($inscription->note)
                                <i class="ri-message-2-fill" title="Une note a été ajouté"></i>
                            @endif
                        </td>
                        <td>{{ $inscription->telephone }}</td>
                        
                          <td>{{ $inscription->country ? $inscription->country->name : 'Non défini' }}</td>
      
                                          

                        <td>
                            @can('order_edit')
                                @if ($inscription->statut === 'payée')
                                    <b class="text-success">
                                        <i class="ri-check-double-fill"></i>
                                        Payée
                                    </b>
                                @elseif($inscription->statut == 'retournée')
                                    <b class="text-danger">
                                        @if ($inscription->etat == 'confirmé')
                                            <i class="ri-text-wrap"></i>
                                            retournée
                                        @else
                                            <i class="ri-close-circle-line"></i>
                                            Annulé
                                        @endif
                                    </b>
                                @else
                                    @if ($inscription->etat == 'confirmé')
                                        <select class="form-control-sm"
                                            wire:change="updateStatus({{ $inscription->id }}, $event.target.value)">
                                            <option value="créé" {{ $inscription->statut === 'créé' ? 'selected' : '' }}>
                                                Créé
                                            </option>
                                            <option value="traitement"
                                                {{ $inscription->statut === 'traitement' ? 'selected' : '' }}>
                                                Traitement</option>
                                          
                                            
                                            <option value="payée" {{ $inscription->statut === 'payée' ? 'selected' : '' }}>
                                                Payée
                                            </option>
                                            
                                            <option value="retournée"
                                                {{ $inscription->statut === 'retournée' ? 'selected' : '' }}>
                                                Retournée
                                            </option>
                                        </select>
                                    @elseif($inscription->etat == 'attente')
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-primary"
                                                wire:click="confirmer({{ $inscription->id }})">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Valider
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                wire:click="annuler({{ $inscription->id }})">
                                                <i class="ri-close-line"></i>
                                                Annluer
                                            </button>
                                        </div>
                                    @else
                                        <i class="ri-close-circle-line"></i>
                                        Annulé
                                    @endif
                                @endif
                            @endcan

                        </td>
                        <td>
                            <span class="text-capitalize">
                                {{ $inscription->mode }}
                            </span>
                        </td>
                        <td>{{ $inscription->created_at }} </td>
                        <td style="text-align: right;">
                            <div class="btn-group">
                            
                               
                            
                              
                                @can('order_delete')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="toggle_confirmation({{ $inscription->id }})">
                                      {{--   <i class="ri-delete-bin-6-line"></i> --}}

                                      <i class="bi bi-check-circle"></i>
                                    </button>
                                @endcan
                                
                            </div>
                            @can('order_delete')
                                <button class="btn btn-sm btn-success d-none" type="button"
                                    id="confirmBtn{{ $inscription->id }}" wire:click="delete({{ $inscription->id }})">
                                    <span class="hide-tablete">
                                        Confirmer
                                    </span>
                                </button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">
                            <div class="text-center">
                                <div>
                                    <img src="/icons/icons8-ticket-100.png" height="100" width="100"
                                        alt="" srcset="">
                                </div>
                                Aucune inscription trouvé
                                @if ($key)
                                    <b> " {{ $key }} " </b>
                                @endif
                                .
                            </div>
                        </td>
                    </tr>
                @endforelse

            </tbody>


        </table>
    </div>

    {{ $inscriptions->links('pagination::bootstrap-4') }}




</div>
