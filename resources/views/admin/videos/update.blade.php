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
                                            <a href="{{ route('videos') }}">Galleries</a>
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
                              
                                <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') 
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="current_video">Vidéo actuelle</label>
                                           {{--  <video id="current_video" class="w-100 rounded shadow" width="400" height="500" controls>
                                                <source src="{{ Storage::url($video->video) }}" type="video/mp4">
                                                Votre navigateur ne supporte pas la balise vidéo.
                                            </video> --}}

                                            <div class="p-2">
                                                <div class="cursor-pointer">
                                                  <video id="current_video"
                                                    class="w-100"
                                                    poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg"
                                                    id="plyr-video-player"
                                                    playsinline
                                                    controls>
                                                    <source src="{{ Storage::url($video->video) }}" type="video/mp4">
                                                  </video>
                                                </div>
                                              </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="">Nouveau lien video</label>
                                                <div class="mb-3">
                                                   
                                                    <input type="url" id="path" name="path" class="form-control">
                                                    @error('path')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Titre de la video</label>
                                                <input type="text" class="form-control" value=" {{ $video->titre }}"  name="titre">
                                                @error('titre')
                                                    <span class="small text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                          
                                         
                                            
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea rows="5" id="description" value={{ $video->description }} name="description" class="form-control">{{ old('description', $video->description) }}</textarea>
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
                                                <a class="btn btn-sm btn-secondary"  href="{{ route('videos') }}">Renourner à la liste</a>
                                                
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

  
    <script src="../../assets/js/app-academy-course-details.js"></script>

@endsection
