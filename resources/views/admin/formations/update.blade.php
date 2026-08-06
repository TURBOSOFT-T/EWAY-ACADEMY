@section('titre', $formation->titre)
@extends('admin.fixe')


<head>
    <!-- Other head elements -->
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/ckeditor.js"></script>
</head>
@section('body')
<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">{{ config('app.name') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('formations') }}">Formations</a>
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

                <form action="{{ route('updateformation.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-8">

                            <img src="{{ Storage::url($formation->image) }}" class="w-100" width="400 " height="500 "
                                class="rounded shadow" alt="">
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="">Nouvelle photo</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                <span class="small text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" value=" {{ $formation->titre }}" name="titre">
                                @error('titre')
                                <span class="small text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="">Categorie </label>
                              
                                <select name='category_id' class="form-control @error('category_id') is-invalid @enderror">
                                    <option value=""></option>
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $formation->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nom }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <span class="text-danger small"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type">Type de formation</label>
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                    @foreach(['formation','traduction','etudes'] as $option)
                                    <option value="{{ $option }}" {{ old('type', $formation->type) === $option ? 'selected' : '' }}>
                                        {{ ucfirst($option) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            {{-- <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea rows="5" id="description" value={{ $formation->description }} name="description" class="form-control">{{ old('description', $formation->description) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea
                                rows="5"
                                id="description"
                                name="description"
                                class="form-control">{{ old('description', $formation->description) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        @include('components.alert')

                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm px-5" type="submit" wire:loading.attr="disabled">

                                Mettre à jour
                            </button>
                            &nbsp; &nbsp;
                            <a class="btn btn-sm btn-secondary" href="{{ route('formations') }}">Renourner à la liste</a>

                        </div>


                    </div>
            </div>
            </form>

            {{-- @livewire('Evenements.EditEvenement',['event'=> null]  ) --}}

        </div>
    </div>


</div>



</div>

</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection