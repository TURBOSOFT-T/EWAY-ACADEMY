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

                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                {{-- <th>DOB</th> --}}
                                <th>Exam</th>
                                <th>Exam Date</th>
                                <th>Result</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $key=>$std)
                              <tr>
                                  <td>{{ $key+1}}</td>
                                  <td>{{ $std['name']}}</td>
                                  {{-- <td>{{ $std['dob']}}</td> --}}
                                  <td>{{ $std['ex_name']}}</td>
                                  <td>{{ $std['exam_date']}}</td>
                                  <td>
                                    <?php 
                                    if($std['exam_joined']==1){
                                    ?>
                                          <a href="{{url('admin/admin_view_result/'.$std['id'])}}" class="btn btn-info btn-sm">View result</a>
                                    <?php    
                                    }
                                    ?>


                                  </td>
                                  <td>
                                    <label class="switch">
                                    <input type="checkbox" class="student_status" data-id="{{ $std['id']}}" <?php if($std['std_status']==1){ echo "checked";} ?> name="status">
                               <span class="slider round"></span>
    </label>
                                </td>
                                  <td>
                                      {{-- <a href="{{url('admin/edit_students/'.$std['id'])}}" class="btn btn-primary">Edit</a> --}}
                                     {{--  <a href="{{url('admin/delete_students/'.$std['id'])}}" class="btn btn-danger btn-sm">Delete</a>
                               --}}   
                            <a href="javascript:void(0)" 
   class="btn btn-danger btn-sm delete-btn" 
   data-url="{{ url('admin/delete_students/' . $std['id']) }}">
   Delete
</a>

                            
                            </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
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
          <form action="{{ url('add_new_exam')}}" class="database_operation" method="POST">  
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter title</label>
                            {{ csrf_field()}}
                            <input type="text" required="required" name="title" placeholder="Enter title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter Date</label>
                            <input type="date" required="required" name="exam_date"  class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                          <label for="">Enter duration (in minutes)</label>
                          <input type="text" required="required" name="exam_duration"  class="form-control">
                      </div>
                  </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Select category</label>
                            <select class="form-control" required="required" name="exam_category">
                                <option value="">Select</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat['id']}}">{{ $cat['name']}}</option>
                                @endforeach
                            </select>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <script>
        <script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            let url = this.getAttribute('data-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; 
                }
            });
        });
    });
});
</script>

    </script>

@endsection
