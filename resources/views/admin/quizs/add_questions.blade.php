@section('title', 'Add Questions')
@extends('admin.fixe')
@section('body')

    <!-- /.content-header -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add questions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Title</h3>

                                    <div class="card-tools">
                                        <a class="btn btn-info btn-sm" href="javascript:;" data-bs-toggle="modal"
                                            data-bs-target="#myModal">Add new</a>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <table class="table table-striped table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Question</th>
                                                <th>ans</th>
                                                <th>Point</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($questions as $key => $question)
                                                <tr>
                                                    <td>{{ $question['id'] }}</td>
                                                    <td>{{ $question['questions'] }}</td>
                                                    <td>{{ $question['ans'] }}</td>
                                                     <td>{{ $question['points'] }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input class="question_status" data-id="{{ $question['id'] }}"
                                                                <?php if ($question['status'] == 1) {
                                                                    echo 'checked';
                                                                } ?> type="checkbox" name="status">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('update_question/' . $question['id']) }}"
                                                            class="btn btn-primary btn-sm">Update</a>
                                                        <a href="{{ url('delete_question/' . $question['id']) }}"
                                                            class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>ans</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $questions->links() }}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-header -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add new Question</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        @if (session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Succès',
                                    text: '{{ session('success') }}',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            </script>
                        @endif

                        @if (session('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: '{{ session('error') }}'
                                });
                            </script>
                        @endif

                        <form action="{{ url('add_new_question') }}" class="database_operation" method="POST">
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                            {{ csrf_field() }}
                            <div class="row">



                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Enter Question</label>

                                        <input type="text" required="required" name="question"
                                            placeholder="Enter Question" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Enter Option 1</label>
                                        <input type="text" required="required" name="option_1"
                                            placeholder="Enter Question" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Enter Option 2</label>
                                        <input type="text" required="required" name="option_2"
                                            placeholder="Enter Option 2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Enter Option 3</label>
                                        <input type="text" required="required" name="option_3"
                                            placeholder="Enter  Option 3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Enter Option 4</label>
                                        <input type="text" required="required" name="option_4"
                                            placeholder="Enter  Option 4" class="form-control">
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter correct ans</label>
                            <input type="text" required="required" name="ans" placeholder="Enter  correct ans" class="form-control">
                        </div>
                    </div> --}}
                                <div class="form-group">
                                    <label for="">Select correct option</label>
                                    <select class="form-control" required="required" name="ans">
                                        <option value="">Select</option>

                                        <option value="option_1">option 1</option>
                                        <option value="option_2">option 2</option>
                                        <option value="option_3">option 3</option>
                                        <option value="option_4">option 4</option>

                                    </select>
                                </div>

                                    <!-- Points -->
        <div class="col-sm-12">
            <div class="form-group">
                <label>Points</label>
                <input type="number" name="points" class="form-control" value="1" min="1" required>
            </div>
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


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <script>
                $(document).ready(function() {
                    $('.question_status').change(function() {
                        let questionId = $(this).data('id');
                        let checkbox = $(this);

                        $.ajax({
                            url: '/question_status/' + questionId,
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
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Erreur',
                                        text: response.message,
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



        @endsection
