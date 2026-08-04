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
                                                <a href="{{ route('produits') }}">Les categories</a>
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
                                                Liste des categories
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">


                                            @can('category_add')
                                              {{--   <button class="btn btn-primary btn-sm  px-5"
                                                    onclick="url('{{ route('category.add') }}')">
                                                    Ajouter une categorie
                                                </button> --}}
                                                   {{--     <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal" data-target="#myModal">Add new</a>
      --}} <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#add">
                                            <i class="ri-user-add-line"></i>
                                            Ajouter 
                                        </button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                <hr />
                              {{--   @livewire('Categories.ListCategory') --}}

                               <div class="card-body">
                    <table class="table table-striped table-bordered table-hover datatable">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $cat)
                             <tr>
                                 <td><?php echo $key+1 ?></td>
                                 <td><?php echo $cat['name'] ?></td>
                                 <td><input class="category_status" data-id="<?php echo $cat['id'] ?>" <?php if($cat['status']==1){ echo "checked";} ?> type="checkbox" name="status"></td>
                                 <th>
                                     <a href="{{ url('edit_category/'.$cat['id'])}}" class="btn btn-info">Edit</a>
                                     <a href="{{ url('delete_category/'.$cat['id'])}}" class="btn btn-danger">Delete</a>
                                 </th>
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
                       Add new category
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 
                    <div class="modal-body">
                        <form action="{{ url('add_new_category') }}" class="database_operation" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Enter category name</label>
                                        {{ csrf_field() }}
                                        <input type="text" required="required" name="name"
                                            placeholder="Enter category name" class="form-control">
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

@endsection
