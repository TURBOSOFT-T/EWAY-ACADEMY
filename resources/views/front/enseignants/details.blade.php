@extends('front.fixe')
@section('titre', $enseignant->nom)
@section('body')
@php
$config = DB::table('configs')->first();

@endphp

<head>
    @section('formations')
    <meta name="author" content="eway-academy.com">
    <meta property="og:title" content="{{ $enseignant->nom }}">
  
    <meta name="robots" content="index, follow">
    @endsection
    <link rel="stylesheet" href="path/to/zoom.css">
    <script src="path/to/zoom.js"></script>
</head>
<main>

  <!-- Page Header Start -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime-style-2" data-cursor="-opaque"> {{$enseignant->prenom}} {{$enseignant->nom}}</h1>
						<nav class="wow fadeInUp">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="./">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Accueil') !!} 
                                </a></li>
                                <!-- <li class="breadcrumb-item"><a href="./">our therapists

                                </a></li>
								<li class="breadcrumb-item active" aria-current="page">dr. emily brown</li> -->
							</ol>
						</nav>
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

    <!-- Team Details Section Start -->
    <div class="page-team-single">
        <div class="container">
            <div class="row no-gutters">
				<div class="col-lg-5">
                    <!-- team member image start -->
                    <div class="team-member-image">
                        <figure class="image-anime">
                              @php
                                    $photoPath = $enseignant->avatar ?? $enseignant->photo;
                                @endphp
                                <img src="{{ $photoPath ? asset('storage/' . $photoPath) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}"
                                   >
                        </figure>
                    </div>
                    <!-- team member image end -->
                </div>
                <div class="col-lg-7">
                    <!-- team member details start -->
                    <div class="team-member-details">
                        <div class="member-detail-header">
                            <h2 class="text-anime-style-2">{{ $enseignant->prenom }} {{ $enseignant->nom }}</h2>
                            <p class="wow fadeInUp">

  {!! \App\Helpers\TranslationHelper::TranslateText($enseignant->specialite ?? 'Enseignant') !!} 
                            </p>
                        </div>
                        <div class="member-detail-content">
                            <p class="wow fadeInUp" data-wow-delay="0.25s">
                                
                                {!! \App\Helpers\TranslationHelper::TranslateText($enseignant->profile->bio ?? 'Aucune biographie disponible pour cet enseignant.') !!}
                            </p>                            
                        </div>

                        <div class="member-detail-body wow fadeInUp" data-wow-delay="0.5s">
                            <ul>
                                <li><span>
                                       {!! \App\Helpers\TranslationHelper::TranslateText('Grade') !!}
                                </span>
                                    {!! \App\Helpers\TranslationHelper::TranslateText($enseignant->profile->grade ?? 'N/A') !!}
                                </li>
                                <li><span>
                                       {!! \App\Helpers\TranslationHelper::TranslateText('Années d\'expérience') !!}
                                </span>
                                    {!! \App\Helpers\TranslationHelper::TranslateText($enseignant->profile->experience_years ?? 'N/A') !!}
                                </li>
                                <li><span>
                                       {!! \App\Helpers\TranslationHelper::TranslateText('Email') !!}
                                </span>
                                    {!! \App\Helpers\TranslationHelper::TranslateText($enseignant->email ?? 'N/A') !!}
                                </li>
                            </ul>
                        </div>

                        @if(!empty($enseignant->profile?->social_links))
    <div class="member-social-list">
        <ul class="wow fadeInUp" data-wow-delay="0.75s">
            
            {{-- Facebook --}}
            @if(!empty($enseignant->profile->social_links['facebook']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['facebook'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
            @endif

            {{-- YouTube --}}
            @if(!empty($enseignant->profile->social_links['youtube']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['youtube'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            @endif

            {{-- Instagram --}}
            @if(!empty($enseignant->profile->social_links['instagram']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['instagram'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
            @endif

            {{-- Twitter / X --}}
            @if(!empty($enseignant->profile->social_links['twitter']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['twitter'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </li>
            @endif

            {{-- LinkedIn --}}
            @if(!empty($enseignant->profile->social_links['linkedin']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['linkedin'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
            @endif

            {{-- Site Web / Portfolio --}}
            @if(!empty($enseignant->profile->social_links['website']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['website'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-globe"></i>
                    </a>
                </li>
            @endif

        </ul>
    </div>
@endif
                    </div>
                    <!-- team member details end -->
                </div>                
            </div>
        </div>
    </div>
    <!--Team Details Section End -->

    <!-- About Member Details Start -->
    <div class="about-member-details">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>


</main>
@endsection