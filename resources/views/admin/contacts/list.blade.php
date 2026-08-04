@section('titre', 'Liste des images')
@extends('admin.fixe')

@section('body')





    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">










            <div class="content-wrapper">


                <div class="container-xxl flex-grow-1 container-p-y">



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
                                                <a href="{{ route('admin_contact_form') }}">Contacts</a>
                                            </li>
                                            <li class="breadcrumb-item active">Liste</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-6 mb-6">

                        </div>
                        <!-- Sponsors List Table -->

                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="card-title">
                                        <h5 class="mb-0 my-auto">
                                            Liste des contacts
                                        </h5>
                                    </div>
                                    
                                </div>
                                <hr />
                                @include('components.alert')

                                <div class="table-responsive-sm">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead class="table-dark cusor">
                                            <tr>
        
                                                <th>Nom </th>
                                             
                                                <th>E-Mail</th>
                                                <th>Sujet</th>
                                                <th> Date</th>
                                                <th style="text-align: right;">
                                                    <span wire:loading>
                                                        <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20"
                                                            class="rounded shadow" alt="">
                                                    </span>
                                                </th>
                                            </tr>
                                        </thead>
        
                                        <tbody>
                                            @forelse ($contacts as $cat)
                                                <tr>
                                                    <td>
                                                        {{ $cat->nom }}
                                                        @include('admin.contacts.Modal-message', ['cat' => $cat])
                                                    </td>
        
                                                  
                                                    <td>
                                                        {{ $cat->email }}
                                                    </td>
        
                                                    <td>
                                                        {{ $cat->sujet }}
                                                    </td>
                                                    <td>{{ $cat->created_at->format('d/m/Y') }} </td>
                                                    <td style="text-align: right;">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-dark"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#message-{{ $cat->id }}">
                                                                <i class='bx bx-message-dots'></i> Voir
                                                            </button>
                                                            @can('category_delete')
                                                                <a href="/admin/supprimer_messages/{{ $cat->id }}"
                                                                    class="btn btn-sm btn-danger">
                                                                    <i class='bx bx-comment-x' ></i>
                                                                    Supprimer
                                                                </a>
                                                            @endcan
                                                        </div>
        
                                                       
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="p-5 text-center">
                                                        <img width="100" height="100"
                                                            src="https://img.icons8.com/dotty/100/578b07/contact-card.png"
                                                            alt="contact-card" />
                                                        <br>
                                                        <h6>
                                                            Aucun contact trouvé.
                                                        </h6>
                                                    </td>
                                                </tr>
                                            @endforelse
        
                                        </tbody>
        
        
                                    </table>
                                </div>
                                {{ $contacts->links('pagination::bootstrap-4') }}
        
        

                            </div>
                        </div>


                    </div>



                </div>

            </div>




        </div>
    </div>
 
    <script>
        Livewire.on('sponsorUpdated', () => {
            $('#update').modal('hide');
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>


@endsection
