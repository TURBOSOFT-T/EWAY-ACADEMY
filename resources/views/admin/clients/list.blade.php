@section('titre', 'Liste des étudiants')
@extends('admin.fixe')

@section('body')



    
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
         <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('clients') }}">Etudiants</a>
                                        </li>
                                        <li class="breadcrumb-item active">Liste</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card radius-15">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 my-auto">
                                        Liste des étudiants
                                    </h5>
                                     <button class="btn btn-sm btn-primary" onclick="url('{{ route('export_clients') }}')">
                                        <i class="ri-file-excel-2-line"></i> Exporter la liste
                                    </button> 
                                </div>
                            </div>
                            <hr />
                            @livewire('ListClients')
                        </div>
                    </div>

                </div>

            </div>
    </div>
</div>
  

@endsection
