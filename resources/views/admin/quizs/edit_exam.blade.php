@extends('admin.fixe')

@section('title', 'Dashboard')
@section('body')


    <!-- /.content-header -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
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

                                <div class="card-body container">
                                    <form action="{{ url('edit_exam_sub') }}" class="database_operation container"
                                        method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label for="question_limit">Nombre de questions</label>
                                                    <select name="question_limit" id="question_limit" class="form-control">
                                                        <option value="20"
                                                            {{ $exam->question_limit == 20 ? 'selected' : '' }}>20 questions
                                                        </option>
                                                        <option value="40"
                                                            {{ $exam->question_limit == 40 ? 'selected' : '' }}>40 questions
                                                        </option>
                                                        <option value="40"
                                                            {{ $exam->question_limit == 49 ? 'selected' : '' }}>49 questions
                                                        </option>
                                                        <option value="60"
                                                            {{ $exam->question_limit == 60 ? 'selected' : '' }}>60 questions
                                                        </option>
                                                        <option value="80"
                                                            {{ $exam->question_limit == 80 ? 'selected' : '' }}>80 questions
                                                        </option>
                                                        <option value="100"
                                                            {{ $exam->question_limit == 100 ? 'selected' : '' }}>100
                                                            questions</option>
                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    <label for="question_limit">Nombre de questions</label>
                                                    <select name="total_points" id="question_limit" class="form-control">
                                                        <option value="20"
                                                            {{ $exam->total_points == 20 ? 'selected' : '' }}>20 points
                                                        </option>
                                                        <option value="40"
                                                            {{ $exam->total_points == 40 ? 'selected' : '' }}>40 points
                                                        </option>
                                                       
                                                        <option value="60"
                                                            {{ $exam->total_points == 60 ? 'selected' : '' }}>60 points
                                                        </option>
                                                        <option value="80"
                                                            {{ $exam->total_points == 80 ? 'selected' : '' }}>80 points
                                                        </option>
                                                        <option value="100"
                                                            {{ $exam->total_points == 100 ? 'selected' : '' }}>100
                                                            points</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Enter title</label>
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $exam->id }}">
                                                    <input type="text" required="required" value="{{ $exam->title }}"
                                                        name="title" placeholder="Enter title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Enter Date</label>
                                                    <input type="date" required="required"
                                                        value="{{ $exam->exam_date }}" name="exam_date"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Enter Time(in minutes)</label>
                                                    <input type="text" required="required"
                                                        value="{{ $exam->exam_duration }}" name="exam_duration"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <label for="formation_id">Select Formation</label>
                                                <select class="form-control" required name="formation_id">
                                                    <option value="">Select</option>
                                                    @foreach ($formation as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $exam->formation_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->titre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "{{ session('success') }}",
                    timer: 5000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{{ session('error') }}",
                    timer: 5000,
                    showConfirmButton: true
                });
            @endif
        </script>



    @endsection
