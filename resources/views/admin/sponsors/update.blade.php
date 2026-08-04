@section('titre', 'Mise  à jour')
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
                                            <a href="{{ route('sponsors') }}">Sponsors</a>
                                        </li>
                                        <li class="breadcrumb-item active">Liste</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Sponsors List Table -->

                        <div class="card radius-15">
                            <div class="card-body">
                            <hr />
                            <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-sm-8">
                                        
                                           <img src="{{ Storage::url($sponsor->image) }}" class="w-100" width="400 " height="500 "
                                           class="rounded shadow" alt="">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="">Nouvelle photo</label>
                                                <input type="file" name="image"    class="form-control">
                                                @error('photo')
                                                    <span class="small text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Nom</label>
                                                <input type="text" class="form-control" value=" {{ $sponsor->titre }}"  name="titre">
                                                @error('titre')
                                                    <span class="small text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    Adresse E-mail *
                                                </label>
                                                <input type="email" id="email" name="email" value="{{ $sponsor->email }}" class="form-control">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    Numéro de téléphone
                                                </label>
                                                <input type="text" id="telephone" name="telephone" value="{{ $sponsor->telephone }}" class="form-control">
                                                @error('telephone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="adresse">Adresse</label>
                                                <input type="text" id="adresse" value="{{ $sponsor->adresse }}" name="adresse" class="form-control">
                                                @error('adresse')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                            
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea rows="5" id="description" value={{ $sponsor->description }} name="description" class="form-control">{{ old('description', $sponsor->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                            
                            
                            
                                            @include('components.alert')
                            
                                            <div class="modal-footer">
                                                <button class="btn btn-primary btn-sm px-5" type="submit" wire:loading.attr="disabled">
                                                    {{-- <span wire:loading>
                                                        <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
                                                    </span> --}}
                                                Mettre à jour
                                                </button>
                                                &nbsp; &nbsp;
                                              {{--   <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button> --}}
                                                <a class="btn btn-sm btn-secondary"  href="{{ route('sponsors') }}">Renourner à la liste</a>
                                                
                                            </div>
                                           
                            
                                        </div>
                                    </div>
                                </form>



                            </div>
                        </div>


                    </div>



                </div>

            </div>




        </div>
    </div>


@endsection
