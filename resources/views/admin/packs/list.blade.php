@section('titre', 'Liste des packs')
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
                                                <a href="{{ route('packs') }}">Les packs de formations</a>
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
                                
                                @livewire('Admin.ListPack')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
