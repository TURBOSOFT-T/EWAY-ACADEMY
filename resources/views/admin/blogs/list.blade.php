@section('titre', 'Liste des actualités')
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
                                    <a href="{{ route('blogs') }}">Blogs</a>
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
                                    Liste des actualité
                                </h5>
                            </div>
                        </div>
                  

                        <div class="col-sm-6">
                     
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                                <a class="btn btn-success btn-sm" onclick="url('{{ route('blog.add') }}')"> <i class="fa fa-plus"></i> Ajouter une actualité</a>
                            </div>
                        </div>
                    </div>
                    <hr />
                   @livewire('Blogs.ListBlogs')
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>



    

@endsection
