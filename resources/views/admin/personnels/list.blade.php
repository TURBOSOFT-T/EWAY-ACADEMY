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
                                        <a href="javascript:void(0);">{{ config('app.name') }}</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('personnels') }}">Personnels</a>
                                    </li>
                                    <li class="breadcrumb-item active">Liste</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card radius-15">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title mb-0">
                                <h5 class="mb-0">Liste des personnels</h5>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                    <i class="ri-user-add-line"></i> Ajouter un personnel
                                </button>
                            </div>
                        </div>
                        <hr />
                        
                        @include('components.alert')

                        <div class="table-responsive-sm">
                            <table id="basic-datatable" class="datatables-users table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Rôle</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($personnels as $personnel)
                                        <tr>
                                            <td>
                                                <img src="{{ $personnel->avatar ? asset('storage/' . $personnel->avatar) : asset('images/default-avatar.png') }}" 
                                                     width="40" height="40" class="rounded-circle object-fit-cover" alt="Avatar">
                                            </td>
                                            <td class="fw-bold">{{ $personnel->nom }}</td>
                                            <td>{{ $personnel->prenom }}</td>
                                            <td>{{ $personnel->email }}</td>
                                            <td>{{ $personnel->phone }}</td>
                                            <td>
                                                @if($personnel->role)
                                                    <span class="badge bg-info text-dark px-2 py-1 text-capitalize">
                                                        {{ $personnel->role }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary px-2 py-1">Aucun</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $personnel->id }}" title="Modifier">
                                                        <i class="ri-edit-line"></i> Modifier
                                                    </button>

                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#personnel-{{ $personnel->id }}" title="Permissions">
                                                        <i class="ri-settings-5-line"></i> Permissions
                                                    </button>

                                                    <button class="btn btn-danger btn-sm" onclick="toggle_confirmation({{ $personnel->id }})" title="Supprimer">
                                                        <i class="ri-delete-bin-line"></i> Supprimer
                                                    </button>
                                                </div>

                                                <button class="btn btn-sm btn-success d-none ms-1" type="button"
                                                        id="confirmBtn{{ $personnel->id }}" onclick="url('/admin/personnel/delete/{{ $personnel->id }}')">
                                                    <i class="bi bi-check-circle"></i> Confirmer
                                                </button>

                                                @include('admin.personnels.modal-edit', ['personnel' => $personnel])
                                                @include('admin.personnels.modal-permissions', ['personnel' => $personnel])
                                                @include('admin.personnels.modal-roles')
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                Aucun personnel trouvé.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @role('admin')
                            <div class="text-end p-2 mt-2">
                                <a href="{{ route('corbeilles') }}" class="text-danger fw-bold text-decoration-none">
                                    <i class="ri-delete-bin-line"></i> Corbeille ( {{ $total_supprimers ?? 0 }} )
                                </a>
                            </div>
                        @endrole

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Ajouter un personnel</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @livewire('AddPersonnels')
                </div>
            </div>
        </div>

        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Importer un fichier Excel</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data" class="p-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="import_file" class="form-control" required />
                            <button type="submit" class="btn btn-primary">Importer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection