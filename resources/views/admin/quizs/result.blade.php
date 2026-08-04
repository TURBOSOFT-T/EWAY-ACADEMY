@extends('admin.fixe')
@section('title','Result')
@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <!-- Header -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="display-4">Résultat de l'examen</h1>
                    <p class="lead">Détails de l'examen et performance de l'étudiant</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">

                    <!-- Student Info Card -->
                    <div class="card shadow mb-4 border-primary">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Informations de l'étudiant</h4>
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
                                {{-- <tr>
                                    <th>Date de naissance</th>
                                    <td>{{ $student_info->dob }}</td>
                                </tr> --}}
                                <tr>
                                    <th>Examen</th>
                                    <td>{{ $exam_info->title }}</td>
                                </tr>
                                <tr>
                                    <th>Date de l'examen</th>
                                    <td>{{ $exam_info->exam_date }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Result Info Card -->
                    <div class="card shadow border-success">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Résultat de l'examen</h4>
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
                                <tr>
                                    <th>Total de questions</th>
                                    <td>{{ $result_info->yes_ans + $result_info->no_ans }}</td>
                                </tr>
                                <tr>
                                    <th>Points obtenus</th>
                                    <td>{{ $result_info->yes_ans }} / {{ $exam_info->total_points }}</td>
                                </tr>
                                <tr>
                                    <th>Pourcentage</th>
                                    <td>{{ round(($result_info->yes_ans / $exam_info->total_points) * 100, 2) }}%</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ url('registered_students') }}" class="btn btn-primary btn-lg">Retour à la liste des examens</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
