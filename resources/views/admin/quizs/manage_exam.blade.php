@section('titre', 'Liste des categories')
@extends('admin.fixe')

@section('body')
    <!--page-content-wrapper-->


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
                                                <a href="{{ route('manage_exam') }}">Les examens</a>
                                            </li>
                                            <li class="breadcrumb-item active">Liste</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card-title">
                                            <h5 class="mb-0 my-auto">
                                                Liste des examens
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">


                                            {{-- 
                                                <button class="btn btn-primary btn-sm  px-5"
                                                    onclick="url('{{ route('category.add') }}')">
                                                    Ajouter un examen
                                                </button> --}}
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#add">
                                                <i class="ri-user-add-line"></i>
                                                Ajouter
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <hr />
                                {{--   @livewire('Categories.ListCategory') --}}

                                <div class="card-body">

                                    <table class="table table-striped table-bordered table-hover datatable">
                                        <thead>
                                            <tr>

                                                <th>Title</th>
                                                <th>Formation</th>
                                                <th>Exam Date</th>
                                                <th>Quota de question</th>
                                                <th>Total des points</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($examens as $key => $exam)
                                                <tr>

                                                    <td>{{ $exam['title'] }}</td>
                                                    <td>{{ $exam->formation->titre ?? '--' }}</td>
                                                    <td>{{ $exam['exam_date'] }}</td>
                                                    <td>{{ $exam['question_limit'] }}</td>
                                                    <td>{{$exam['total_points']  }}</td>


                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="exam_status"
                                                                data-id="{{ $exam->id }}" @checked($exam->status == 1)>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>




                                                    <td>
                                                        <a href="{{ url('edit_exam/' . $exam['id']) }}"
                                                            class="btn btn-info">Editer</a>

                                                        <a href="javascript:void(0)" class="btn btn-danger delete-exam"
                                                            data-id="{{ $exam['id'] }}">
                                                            Supprimer
                                                        </a>

                                                        <a href="{{ url('add_questions/' . $exam['id']) }}"
                                                            class="btn btn-primary">Ajouter Question</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!-- Pagination -->

                                        <tfoot>

                                        </tfoot>
                                    </table>

                                    <div class="d-flex justify-content-center mt-3">
                                        {{ $examens->links() }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="myCenterModalLabel">
                        Add new exan
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">

                        <div class="modal-body">
                            <form action="{{ url('add_new_exam') }}" class="database_operation" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="question_limit">Nombre de questions</label>
                                        <select name="question_limit" id="question_limit" class="form-control">
                                            <option value="20">20 questions</option>
                                            <option value="40">40 questions</option>
                                            <option value="49" selected>49 questions</option>
                                            <option value="60">60 questions</option>
                                            <option value="80">80 questions</option>
                                            <option value="100">100 questions</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-12">
    <div class="form-group">
        <label for="total_points">Total points</label>
        <select name="total_points" id="total_points" class="form-control">
            <option value="20">20 points</option>
            <option value="40">40 points</option>
            <option value="60">60 points</option>
            <option value="80">80 points</option>
            <option value="100" selected>100 points</option>
        </select>
    </div>
</div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Enter title</label>
                                            {{ csrf_field() }}
                                            <input type="text" required="required" name="title"
                                                placeholder="Enter title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Enter Date</label>
                                            <input type="date" required="required" name="exam_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Enter duration (in minutes)</label>
                                            <input type="text" required="required" name="exam_duration"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <label for="formation_id">Select Formation</label>
                                        <select class="form-control" required='required' name="formation_id">
                                            <option value="">Select</option>
                                            @foreach ($formation as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->titre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <style>
        /* Switch container */
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        /* Cache le vrai input */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Le slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 25px;
        }

        /* Bouton rond */
        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        /* Quand c'est activé */
        input:checked+.slider {
            background-color: #28a745;
            /* vert */
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }
    </style>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.exam_status').change(function() {
                let examId = $(this).data('id');
                let checkbox = $(this);

                $.ajax({
                    url: '/exam_status/' + examId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                text: response.message,
                                timer: 1000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Erreur lors de la mise à jour'
                            });
                            checkbox.prop('checked', !checkbox.prop(
                                'checked')); // revert toggle
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Erreur lors de la requête'
                        });
                        checkbox.prop('checked', !checkbox.prop('checked')); // revert toggle
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete-exam', function() {
            let examId = $(this).data('id');
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Cette action supprimera définitivement l'examen et ses questions associées.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Oui, supprimer",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/delete_exam/" + examId;
                }
            });
        });
    </script>


@endsection
