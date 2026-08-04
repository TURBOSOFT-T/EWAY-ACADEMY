@extends('front.fixe')
@section('titre',  $blog->nom)
@section('body')
    <main>
        @php
            $config = DB::table('configs')->first();
            $service = DB::table('services')->get();
            $produit = DB::table('produits')->get();
        @endphp

        
 <head>
    @section('blogs')
        <meta name="author" content="eway-academy.com">
        <meta property="og:title" content="{{ $blog->nom }}">
        <meta property="og:description" content="{{ $blog->description ?? '' }}">
        <meta property="og:image" content="{{ $blog->photo }}">

         <meta property="og:description" content="{{ $formation->description ?? '' }}">
         <meta property="og:meta_description" content="{{ $blog->meta_description ?? '' }}">
      
        <meta property="og:image" content="{{ $blog->image }}">

        
        <meta property="og:availability" content="{{ $blog->statut }}">

        <meta property="blog:availability" content="{{ $blog->statut }}">
        <meta name="robots" content="index, follow">
    @endsection
    <link rel="stylesheet" href="path/to/zoom.css">
<script src="path/to/zoom.js"></script>
</head>
<body>

 
    <!-- Page Header Start -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- Page Header Box Start -->
					<div class="page-header-box">
						<h1 class="text-anime-style-3" data-cursor="-opaque">{!! 
                                   \App\Helpers\TranslationHelper::TranslateText($blog->title) 
                                !!}</h1>
						<div class="post-single-meta wow fadeInUp">
							<ol class="breadcrumb">
                               {{--  <li class="breadcrumb-item"><i class="fa-regular fa-user"></i> admin</li> --}}
							{{-- 	<li class="breadcrumb-item"><i class="fa-regular fa-clock"></i> {{ $blog->created_at->diffForHumans() }}</li>
                       --}}      </ol>
						</div>		
					</div>
					<!-- Page Header Box End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Page Header End -->

    <!-- Page Single Post Start -->
	<div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Post Featured Image Start -->
                    <div class="post-image">
                        <figure class="image-anime reveal">
                            <img src="{{ Storage::url($blog->image) }}" alt="">
                        </figure>
                    </div>
                    <!-- Post Featured Image Start -->

                    <!-- Post Single Content Start -->
                    <div class="post-content">
                        <!-- Post Entry Start -->
                        <div class="post-entry">
                                <blockquote class="wow fadeInUp" data-wow-delay="0.4s">
                                <p     style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">
                                {!! 
                                   \App\Helpers\TranslationHelper::TranslateText($blog->meta_description) 
                                !!}     
                                </p>
                            </blockquote>
                            <p class="wow fadeInUp"   style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">
                               
                            {!! 
                                   \App\Helpers\TranslationHelper::TranslateText($blog->description) 
                                !!} 
                            </p>

                           
                        

                          
                                     </div>
                        <!-- Post Entry End -->

                        <!-- Post Tag Links Start -->
                        <div class="post-tag-links">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <!-- Post Tags Start -->
                                    {{-- <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                        <span class="tag-links">
                                            Tags:
                                            <a href="#">physiocare</a>
                                            <a href="#">painmanage</a>
                                            <a href="#">backpain</a>
                                            <a href="#">wellness</a>
                                        </span>
                                    </div> --}}
                                    <!-- Post Tags End -->
                                </div>

                                <div class="col-lg-4">
                                    <!-- Post Social Links Start -->
                                    <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                        <ul style="list-style: none; display: flex; gap: 10px; padding: 0;">
                                @if ($config->facebook)
                                    <li><a href="{{ $config->facebook }}" target="_blank"><i
                                                class="fa-brands fa-facebook-f"></i></a></li>
                                @endif

                                @if ($config->instagram)
                                    <li><a href="{{ $config->instagram }}" target="_blank"><i
                                                class="fa-brands fa-instagram"></i></a></li>
                                @endif

                                @if ($config->tiktok)
                                    <li><a href="{{ $config->tiktok }}" target="_blank"><i
                                                class="fa-brands fa-tiktok"></i></a></li>
                                @endif
                                @if ($config->youtube)
                                    <li><a href="{{ $config->youtube }}" target="_blank"><i
                                                class="fa-brands fa-youtube"></i></a></li>
                                @endif

                            </ul>
                                    </div>
                                    <!-- Post Social Links End -->
                                </div>
                            </div>
                        </div>
                        <!-- Post Tag Links End -->
                    </div>
                    <!-- Post Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Single Post End -->  

    <!-- Our Scrolling Ticker Section Start -->
{{--     <div class="our-scrolling-ticker">
       
        <div class="scrolling-ticker-box">
            <div class="scrolling-content">
                <span><img src="images/icon-sparkles.svg" alt="">Emergency No. : (+01) 789 856 258</span>
                <span><img src="images/icon-sparkles.svg" alt="">For any additional inqueries : info@domainname.com</span>
                <span><img src="images/icon-sparkles.svg" alt="">Book Appointment: (+01) 879 526 789</span>
                <span><img src="images/icon-sparkles.svg" alt="">Working Hourse : Mon to Fri : 10:00 To 6:00 </span>
            </div>

            <div class="scrolling-content">
                <span><img src="images/icon-sparkles.svg" alt="">Emergency No. : (+01) 789 856 258</span>
                <span><img src="images/icon-sparkles.svg" alt="">For any additional inqueries : info@domainname.com</span>
                <span><img src="images/icon-sparkles.svg" alt="">Book Appointment: (+01) 879 526 789</span>
                <span><img src="images/icon-sparkles.svg" alt="">Working Hourse : Mon to Fri : 10:00 To 6:00 </span>
            </div>
        </div>
    </div> --}}
	<!-- Scrolling Ticker Section End -->  

</body>
</html>


    </main>






@endsection