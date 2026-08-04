@section('titre', 'Ajouter une actualité')
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
                                <li class="breadcrumb-item active">Ajouter une actualité</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="header-title">
                                Formulaire d'ajout actualité
                            </h5>
                        </div>
                        <div class="card-body">
                           @livewire('Blogs.AddBlogs', ['blog'=> null] )  
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container -->
    </div>
        </div>
    </div>
</div>

@endsection