@section('titre', 'Ajouter un document')
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
                                                <a href="{{ route('documents') }}">documents</a>
                                            </li>
                                            <li class="breadcrumb-item active">Ajouter un document</li>
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
                                            Ajouter un document
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                          

                                            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="topic">Titre</label>
                                                    <input type="text" name="titre" class="form-control" required>
                                                </div>
<div class="mb-3">
                                                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
@error('file')
    <small class="text-danger">{{ $message }}</small>
@enderror
</div>

                                                {{--  <div class="mb-3">
                                                    <label for="topic">Le document</label>
                                                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx" required>
                                                </div> --}}
   <div class="mb-3">
                                                    <label for="topic">Description</label>
                                                    <input type="text" name="description" class="form-control" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="type">Type</label>
                                                    <select name="type" class="form-control" required>
                                                        <option value="">-- Choisir --</option>
                                                        <option value="formation">Formation</option>
                                                        <option value="certification">Certification</option>
                                                         <option value="event">Evènement</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3" id="formationSelect" style="display: none;">
                                                    <label for="formation_id">Formation</label>
                                                    <select name="formation_id" class="form-control">
                                                        <option value="">-- Choisir --</option>
                                                        @foreach ($formations as $formation)
                                                            <option value="{{ $formation->id }}">{{ $formation->titre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3" id="eventSelect" style="display: none;">
                                                    <label for="event_id">Événement</label>
                                                    <select name="event_id" class="form-control">
                                                        <option value="">-- Choisir --</option>
                                                        @foreach ($events as $event)
                                                            <option value="{{ $event->id }}">{{ $event->titre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                  <div class="mb-3" id="certificationSelect" style="display: none;">
                                                    <label for="certification_id">Certification</label>
                                                    <select name="certification_id" class="form-control">
                                                        <option value="">-- Choisir --</option>
                                                        @foreach ($certifications as $event)
                                                            <option value="{{ $event->id }}">{{ $event->titre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                               
                                               
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                            </form>
                                        </div>

                                        <script>
    const typeSelect = document.querySelector('select[name="type"]');
    const formationSelect = document.getElementById('formationSelect');
    const eventSelect = document.getElementById('eventSelect');
    const certificationSelect = document.getElementById('certificationSelect'); // 👈 ajout

    typeSelect.addEventListener('change', function () {
        const value = this.value;

        // Masquer tous les selects
        formationSelect.style.display = 'none';
        eventSelect.style.display = 'none';
        certificationSelect.style.display = 'none';

        // Afficher le bon selon le type choisi
        if (value === 'formation') {
            formationSelect.style.display = 'block';
        } else if (value === 'event') {
            eventSelect.style.display = 'block';
        } else if (value === 'certification') {
            certificationSelect.style.display = 'block';
        }
    });

    // Déclencher au chargement de la page (au cas où un type est déjà sélectionné)
    window.addEventListener('DOMContentLoaded', function () {
        typeSelect.dispatchEvent(new Event('change'));
    });
</script>


                                       {{--  <script>
                                            const typeSelect = document.querySelector('select[name="type"]');
                                            const formationSelect = document.getElementById('formationSelect');
                                            const eventSelect = document.getElementById('eventSelect');

                                            typeSelect.addEventListener('change', function() {
                                                if (this.value === 'formation') {
                                                    formationSelect.style.display = 'block';
                                                    eventSelect.style.display = 'none';
                                                } else if (this.value === 'event') {
                                                    formationSelect.style.display = 'none';
                                                    eventSelect.style.display = 'block';
                                                } else {
                                                    formationSelect.style.display = 'none';
                                                    eventSelect.style.display = 'none';
                                                }
                                            });
                                        </script> --}}
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
