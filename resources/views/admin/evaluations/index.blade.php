@section('titre', 'Liste des documents')
@extends('admin.fixe')

@section('body')


<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <div class="content-wrapper">


            <div class="container-xxl flex-grow-1 container-p-y">



                <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- start page title -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('documents') }}">Les documents</a>
                                        </li>
                                        <li class="breadcrumb-item active">Liste</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid py-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="h3 text-gray-800 mb-0">Gestion & Modération des Avis</h1>
                        </div>

                        {{-- Message de succès --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- Onglets de filtrage par statut --}}
                        <ul class="nav nav-pills mb-4">
                            <li class="nav-item">
                                <a class="nav-link {{ $status === 'pending' ? 'active' : '' }}" href="{{ route('admin.evaluations.index', ['status' => 'pending']) }}">
                                    En attente <span class="badge bg-danger ms-1">{{ $counts['pending'] }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status === 'approved' ? 'active' : '' }}" href="{{ route('admin.evaluations.index', ['status' => 'approved']) }}">
                                    Approuvés <span class="badge bg-success ms-1">{{ $counts['approved'] }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status === 'all' ? 'active' : '' }}" href="{{ route('admin.evaluations.index', ['status' => 'all']) }}">
                                    Tous les avis <span class="badge bg-secondary ms-1">{{ $counts['all'] }}</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Table des avis -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Étudiant</th>
                                                <th>Enseignant</th>
                                                <th>Note</th>
                                                <th>Avis / Commentaire</th>
                                                <th>Statut</th>
                                                <th>Date</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($evaluations as $evaluation)
                                            <tr>
                                                <!-- Étudiant -->
                                                <td>
                                                    <div class="fw-bold">
                                                        {{ $evaluation->is_anonymous ? ' (Anonyme)' : ($evaluation->student->nom ?? 'Inconnu') }}
                                                    </div>
                                                    <small class="text-muted">{{ $evaluation->student->email ?? '' }}</small>
                                                </td>

                                                <!-- Enseignant -->
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $evaluation->teacher->nom ?? 'Inconnu' }} {{ $evaluation->teacher->prenom ?? '' }}
                                                    </span>
                                                </td>

                                                <!-- Note -->
                                                <td>
                                                    <div class="text-warning">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa-{{ $i <= $evaluation->rating ? 'solid' : 'regular' }} fa-star"></i>
                                                            @endfor
                                                            <span class="text-dark small ms-1">({{ $evaluation->rating }}/5)</span>
                                                    </div>
                                                </td>

                                                <!-- Commentaire -->
                                                <td style="max-width: 300px;">
                                                    @if($evaluation->comment)
                                                    <p class="mb-0 text-truncate small" title="{{ $evaluation->comment }}">
                                                        "{{ $evaluation->comment }}"
                                                    </p>
                                                    @else
                                                    <span class="text-muted fst-italic small">Aucun commentaire</span>
                                                    @endif
                                                </td>

                                                <!-- Statut -->
                                                <td>
                                                    @if($evaluation->is_approved)
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Approuvé</span>
                                                    @else
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill">En attente</span>
                                                    @endif
                                                </td>

                                                <!-- Date -->
                                                <td class="small text-muted">
                                                    {{ $evaluation->created_at->format('d/m/Y H:i') }}
                                                </td>

                                                <!-- Actions -->
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        @if(!$evaluation->is_approved)
                                                        <!-- Bouton Approuver -->
                                                        <form action="{{ route('admin.evaluations.approve', $evaluation->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-success" title="Approuver">
                                                                <i class="fa-solid fa-check"></i>
                                                            </button>
                                                        </form>
                                                        @else
                                                        <!-- Bouton Rejeter -->
                                                        <form action="{{ route('admin.evaluations.reject', $evaluation->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-warning" title="Masquer / Rejeter">
                                                                <i class="fa-solid fa-eye-slash"></i>
                                                            </button>
                                                        </form>
                                                        @endif

                                                        <!-- Bouton Supprimer -->
                                                        <form action="{{ route('admin.evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet avis ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    Aucun avis correspondant aux critères sélectionnés.
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Pagination -->
                            @if($evaluations->hasPages())
                            <div class="card-footer bg-white py-3">
                                {{ $evaluations->appends(request()->query())->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection