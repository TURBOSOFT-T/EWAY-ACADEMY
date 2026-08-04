@extends('admin.fixe')
@section('title','Result')
@section('body')

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Résultat de l'examen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Examen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <!-- Student Information Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Informations sur l'étudiant</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nom</th>
                                    <td>{{ $student_info->name }}</td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td>{{ $student_info->email }}</td>
                                </tr>
                                <tr>
                                    <th>Nom de l'examen</th>
                                    <td>{{ $exam_info->title }}</td>
                                </tr>
                                <tr>
                                    <th>Date de l'examen</th>
                                    <td>{{ $exam_info->exam_date }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Result Information Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title">Résultats de l'examen</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Réponses correctes</th>
                                    <td>{{ $result_info->yes_ans }}</td>
                                </tr>
                                <tr>
                                    <th>Réponses incorrectes</th>
                                    <td>{{ $result_info->no_ans }}</td>
                                </tr>
                                {{-- <tr>
                                    <th>Total de questions</th>
                                    <td>{{ $result_info->yes_ans + $result_info->no_ans }}</td>
                                </tr> --}}
                               {{--  <tr>
                                    <th>Points obtenus</th>
                                    <td>{{ $total }} / {{ $exam_info->total_points }}</td>
                                </tr> --}}
                                <tr>
                                    <th>Pourcentage</th>
                                    <td>
                                        <span class="badge 
                                            @if(round(($total / $exam_info->total_points) * 100, 2) >= 50) 
                                                bg-success 
                                            @else 
                                                bg-danger 
                                            @endif">
                                            {{ round(($total / $exam_info->total_points) * 100, 2) }}%
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <a href="{{ url('registered_students') }}" class="btn btn-primary btn-lg">
                            Retour à la liste 
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@endsection
