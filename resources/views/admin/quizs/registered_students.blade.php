@extends('admin.fixe')
@section('title','Manage Portal')
@section('body')

    <!-- /.content-header -->
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Exam</li>
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
               
                <div class="card-body">
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
                                  <td>{{ $std['nom']}}</td>
                                  {{-- <td>{{ $std['dob']}}</td> --}}
                                  <td>{{ $std['ex_name']}}</td>
                                  <td>{{ $std['exam_date']}}</td>
                                  <td>
                                    <?php 
                                    if($std['exam_joined']==1){
                                    ?>
                                          <a href="{{url('admin_view_result/'.$std['id'])}}" class="btn btn-info btn-sm">View result</a>
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
                                      <a href="{{url('delete_students/'.$std['id'])}}" class="btn btn-danger btn-sm">Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
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

 
@endsection
