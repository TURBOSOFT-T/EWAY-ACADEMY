@section('titre', 'Liste des inscriptions')
@extends('admin.fixe')

@section('body')




    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="container-xxl flex-grow-1 container-p-y">

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Inscriptions</a>
                                    </li>
                                    <li class="breadcrumb-item active">Liste</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sponsors List Table -->

                <div class="card radius-15">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-title">
                                <h5 class="mb-0 my-auto">
                                    Liste des inscriptions
                                </h5>
                            </div>
                            <div>


                            </div>
                        </div>
                        <hr />
                        @include('components.alert')
    @livewire('Formations.Inscription') 

{{-- 
                        <div class="table-responsive-sm">
                            <table id="basic-datatable" class="datatables-users table">
                                <thead class="table-dark cusor">
                                    <tr>
                                        <th>Image</th>
                                        <th>Formation</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Pays</th>
                                       


                                        <th> Date inscription</th>
                                        <th scope="col" width="15%">Actions</th>


                                        <th style="text-align: right;">
                                            <span wire:loading>
                                                <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20"
                                                    class="rounded shadow" alt="">
                                            </span>
                                        </th>
                                    </tr>

                                </thead>


                                <tbody>
                                    @forelse ($inscriptions as $formation)
                                    
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($formation->formation->image ?? '') }}" width="40 "
                                                    height="40 " class="rounded shadow" alt="">
                                            </td>
                                            <td>
                                                {{ $formation->formation->titre  ?? '' }}
                                            </td>
                                            <td>
                                                {{ $formation->nom }}
                                            </td>
                                            <td>
                                                {{ $formation->prenom }}
                                            </td>
                                            <td>
                                                {{ $formation->email }}
                                            </td>

                                            <td>
                                                {{ $formation->telephone }}
                                            </td>

                                          
                                           <td>{{ $formation->country ? $formation->country->name : 'Non défini' }}</td>
      
                                          



                                            <td>{{ $formation->created_at }} </td>

                                            <td>

                                                <div class="row">
                                                    <div class="col">
                                                        <!-- Bouton pour ouvrir le modal -->
                                                        <button class="btn btn-primary btn-sm show-details" data-bs-toggle="modal"
                                                            data-bs-target="#detailsModal" 
                                                            data-nom="{{ $formation->nom }}"
                                                            data-prenom="{{ $formation->prenom }}"
                                                            data-email="{{ $formation->email }}"
                                                            data-telephone="{{ $formation->telephone }}"
                                                            data-ville="{{ $formation->ville }}"
                                                            data-addresse="{{ $formation->addresse }}"
                                                            data-date="{{ $formation->created_at }}"
                                                            data-message="{{ $formation->message }}">
                                                           
                                                            Détails
                                                        </button>
                                                    </div>
                                               
                                                
                                              
                                                    <div class="col">
                                                        <form action=" {{ route('deleteinscription.destroy',$formation->id) }}" method="POST">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                                                                title='Delete'><svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 24 24" width="20"
                                                                style="background-color: #e0610d22; fill:#dbd7d7;"
                                                                height="22" fill="currentColor">
                                                                <path
                                                                    d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM13.4142 11L15.8891 8.52513L14.4749 7.11091L12 9.58579L9.52513 7.11091L8.11091 8.52513L10.5858 11L8.11091 13.4749L9.52513 14.8891L12 12.4142L14.4749 14.8891L15.8891 13.4749L13.4142 11Z">
                                                                </path>
                                                            </svg></button>
                                        
                                                            </form>

                                                    </div>
                                                  
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Aucune inscription trouvée</td>
                                        </tr>
                                    @endforelse

                                </tbody>


                            </table>
                        </div>
 --}}

                    </div>
                </div>


            </div>



        </div>

    </div>

<!-- Modal Détails -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Détails de l'inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> <span id="modal-nom"></span></p>
                <p><strong>Prénom :</strong> <span id="modal-prenom"></span></p>
                <p><strong>Email :</strong> <span id="modal-email"></span></p>
                <p><strong>Téléphone :</strong> <span id="modal-telephone"></span></p>
                <p><strong>Ville :</strong> <span id="modal-ville"></span></p>
                <p><strong>Adresse :</strong> <span id="modal-addresse"></span></p>
                <p><strong>Date d'inscription :</strong> <span id="modal-date"></span></p>
                <p><strong>Message :</strong> <span id="modal-message"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>



    </div>



    <script src="../../assets/js/app-user-list.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.delete-inscription').click(function() {
            var inscriptionId = $(this).data('id');
            
            Swal.fire({
                title: "Êtes-vous sûr?",
                text: "Cette action est irréversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, supprimer!",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/delete_inscriptions/" + inscriptionId, // Lien de suppression
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}" // Protection CSRF
                        },
                        success: function(response) {
                            Swal.fire("Supprimé!", "L'inscription a été supprimée.", "success");
                            location.reload(); // Recharge la page
                        },
                        error: function() {
                            Swal.fire("Erreur!", "Une erreur est survenue.", "error");
                        }
                    });
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('.show-details').click(function() {
            $('#modal-nom').text($(this).data('nom'));
            $('#modal-prenom').text($(this).data('prenom'));
            $('#modal-email').text($(this).data('email'));
            $('#modal-telephone').text($(this).data('telephone'));
            $('#modal-ville').text($(this).data('ville'));  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here as well.  // Add your other fields here
            $('#modal-addresse').text($(this).data('addresse'));
            $('#modal-date').text($(this).data('date'));
            $('#modal-message').text($(this).data('message'));
        });
    });
</script>


@endsection
