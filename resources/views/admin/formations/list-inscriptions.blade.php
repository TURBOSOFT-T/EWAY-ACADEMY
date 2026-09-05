@section('titre', 'Liste des inscriptions')
@extends('admin.fixe')

@section('body')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Fil d'ariane -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0);">{{ config('app.name') }}</a>
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

            <!-- Carte Principale -->
            <div class="card radius-15">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 my-auto">Liste des inscriptions</h5>
                        </div>
                    </div>
                    <hr />

                    @include('components.alert')

                    <!-- Composant Livewire -->
                    @livewire('Formations.Inscription')

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Détails -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Détails de l'inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Type :</strong> <span id="modal-type" class="badge bg-secondary"></span></p>
                <p><strong>Élément :</strong> <span id="modal-element" class="fw-bold"></span></p>
                <hr>
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

<!-- Scripts JavaScript (Événements jQuery délégués pour la compatibilité Livewire) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Remplissage du Modal (Délégation d'événements pour supporter le rafraîchissement Livewire)
        $(document).on('click', '.show-details', function() {
            $('#modal-type').text($(this).data('type'));
            $('#modal-element').text($(this).data('element'));
            $('#modal-nom').text($(this).data('nom'));
            $('#modal-prenom').text($(this).data('prenom'));
            $('#modal-email').text($(this).data('email'));
            $('#modal-telephone').text($(this).data('telephone'));
            $('#modal-ville').text($(this).data('ville'));
            $('#modal-addresse').text($(this).data('addresse'));
            $('#modal-date').text($(this).data('date'));
            $('#modal-message').text($(this).data('message') || 'Aucun message');
        });

        // Suppression AJAX avec SweetAlert2 (Délégation d'événements)
        $(document).on('click', '.delete-inscription', function() {
            var inscriptionId = $(this).data('id');
            var row = $(this).closest('tr');
            
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Cette action est irréversible !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, supprimer !",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/delete_inscriptions/" + inscriptionId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire("Supprimé !", "L'inscription a été supprimée.", "success");
                            row.fadeOut(400, function() { $(this).remove(); });
                        },
                        error: function() {
                            Swal.fire("Erreur !", "Une erreur est survenue lors de la suppression.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection