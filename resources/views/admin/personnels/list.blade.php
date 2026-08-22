@section('titre', 'Liste des personnels')
@extends('admin.fixe')

@section('body')




<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">










        <div class="content-wrapper">



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
                                        <a href="{{ route('personnels') }}">personnels</a>
                                    </li>
                                    <li class="breadcrumb-item active">Liste</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-title">
                                <h5 class="mb-0 my-auto">
                                    Liste des personnels
                                </h5>
                            </div>
                            <div>
                                {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#import">
                                        <i class="ri-user-add-line"></i>
                                        Importer fiche exel
                                    </button> --}}


                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#add">
                                    <i class="ri-user-add-line"></i>
                                    Ajouter un personnel
                                </button>
                            </div>
                        </div>
                        <hr />
                        @include('components.alert')

                        <div class="table-responsive-sm">
                            <table id="basic-datatable" class="datatables-users table" {{-- class="table table-striped dt-responsive nowrap w-100" --}}>
                                <thead class="table-dark cusor">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Rôle</th>
                                        <th>création</th>
                                        <th style="text-align: right;">
                                            <span wire:loading>
                                                <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20"
                                                    class="rounded shadow" alt="">
                                            </span>
                                        </th>
                                    </tr>

                                </thead>


                                <tbody>
                                    @forelse ($personnels as $personnel)
                                    <tr>
                                        <td>
                                            <img src="{{ $personnel->avatar() }}" width="40 " height="40 "
                                                class="rounded " alt="">
                                        </td>
                                        <td>
                                            {{ $personnel->nom }}
                                        </td>
                                        <td>
                                            {{ $personnel->prenom }}
                                        </td>
                                        <td>{{ $personnel->email }} </td>
                                        <td>{{ $personnel->phone }}</td>

                                        <td>


                                            @if($personnel->role)
                                            <span class="badge bg-info text-dark px-2 py-1">
                                                {{ ucfirst($personnel->role) }}
                                            </span>
                                            @else
                                            <span class="badge bg-secondary px-2 py-1">Aucun</span>
                                            @endif

                                        </td>
                                        <td>{{ $personnel->created_at }} </td>
                                        <td style="text-align: right;">
                                            <div class="btn-group">

                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $personnel->id }}" title="Modifier">
                                                    <i class="ri-edit-line"></i>
                                                </button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#roleModal{{ $personnel->id }}">
                                                    Modifier Rôle
                                                </button>

                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#personnel-{{ $personnel->id }}">
                                                    <i class="ri-settings-5-line"></i> Permissions
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="toggle_confirmation({{ $personnel->id }})">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </button>
                                            </div>
                                            <button class="btn btn-sm btn-success d-none" type="button"
                                                id="confirmBtn{{ $personnel->id }}" onclick="url('/admin/personnel/delete/{{ $personnel->id }}')">
                                                <i class="bi bi-check-circle"></i>
                                                <span class="hide-tablete">
                                                    Confirmer
                                                </span>
                                            </button>


                                            @include('admin.personnels.modal-edit', ['personnel' => $personnel])
                                            @include('admin.personnels.modal-permissions', ['personnel' => $personnel])
                                            @include('admin.personnels.modal-roles')
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucun personnel trouvé</td>
                                    </tr>
                                    @endforelse

                                </tbody>


                            </table>
                        </div>
                        @role('admin')
                        <div class="text-end p-2">
                            <a href="{{ route('corbeilles') }}" class="text-danger">
                                <i class="ri-delete-bin-line"></i> Corbeille ( {{ $total_supprimers }} )
                            </a>
                        </div>
                        @endrole

                    </div>
                </div>





            </div>

        </div>

        <!-- Center modal content -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="myCenterModalLabel">
                            Ajouter un personnel.
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @livewire('AddPersonnels')
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



        <!-- Center modal content -->
        <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="myCenterModalLabel">
                            Importer fichier exel.
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group">
                            <input type="file" name="import_file" class="form-control" />
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>

                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->




    </div>
</div>

@endsection