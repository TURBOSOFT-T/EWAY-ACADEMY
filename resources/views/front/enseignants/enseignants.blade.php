
@extends('front.fixe')
@section('titre', 'Enseignants')
@section('body')
@php
$config = DB::table('configs')->first();

@endphp

   <!-- Page Header Start -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime-style-2" data-cursor="-opaque">
                             {!! \App\Helpers\TranslationHelper::TranslateText('Enseignants') !!}
                        </h1>
						<nav class="wow fadeInUp">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="./">
                                     {!! \App\Helpers\TranslationHelper::TranslateText('Accueil') !!}
                                </a></li>
								<li class="breadcrumb-item active" aria-current="page">
                                     {!! \App\Helpers\TranslationHelper::TranslateText( 'Nos enseignants ') !!}
                                </li>
							</ol>
						</nav>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

    <!-- Page Team Start -->
    <div class="page-team">
        <div class="container">
            <div class="row">
                  @forelse ($enseignant as $index => $enseignant)
                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <figure class="image-anime">
                                @php
                                    $photoPath = $enseignant->avatar ?? $enseignant->photo;
                                @endphp
                                <img src="{{ $photoPath ? asset('storage/' . $photoPath) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}"
                                     class="img-fluid w-100 object-fit-cover"
                                     style="height: 280px;">
                            </figure>

                                 @if(isset($enseignant->note_moyenne) && $enseignant->note_moyenne > 0)
                                <div class="teacher-rating position-absolute top-0 end-0 m-2 bg-warning text-dark px-2 py-1 rounded fw-bold fs-7 shadow-sm">
                                    <i class="fa-solid fa-star me-1"></i>{{ number_format($enseignant->note_moyenne, 1) }}
                                </div>
                            @endif
                
                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>

                                 @if(optional($enseignant)->linkedin)
                                        <li><a href="{{ $enseignant->linkedin }}" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    @endif
                                    @if(optional($enseignant)->facebook)
                                        <li><a href="{{ $enseignant->facebook }}" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    @endif
                                    @if(optional($enseignant)->youtube)
                                        <li><a href="{{ $enseignant->youtube }}" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a></li>
                                    @endif
                                    @if(optional($enseignant)->twitter)
                                        <li><a href="{{ $enseignant->twitter }}" class="social-icon" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    @endif
                                       </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->
                
                        <!-- Team Content Start -->
                        <div class="team-content">
                           <h3 class="text-capitalize fs-5 mb-1">
                                <a  href="{{ route('details-enseignants', ['id' => $enseignant->id, 'slug'=>Str::slug(Str::limit($enseignant->nom, 10))]) , }}" class="text-decoration-none text-dark">
                                    {{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}
                                </a>
                            </h3>
                            <p class="text-capitalize text-muted mb-2 small">{{ $enseignant->specialite ?? 'Enseignant' }}</p>

                            <!-- Badges / Diplômes (Optionnel) -->
                            @if(optional($enseignant)->badge)
                                <span class="badge bg-primary text-white text-capitalize fw-normal">{{ $enseignant->badge->nom }}</span>
                            @endif
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>
                @empty
                <p>
                     {!! \App\Helpers\TranslationHelper::TranslateText('Aucun enseignant trouvé. ') !!}
                </p>
                @endforelse

            

              
            </div>
        </div>
    </div> 

    @endsection
