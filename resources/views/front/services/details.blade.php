@extends('front.fixe')
@section('titre', $service->nom)
@section('body')
@php
$config = DB::table('configs')->first();

@endphp

<main>

    <head>
        @section('services')
        <meta name="author" content="eway-academy.com">
        <meta property="og:title" content="{{ $service->nom }}">
        <meta property="og:description" content="{{ $service->description ?? '' }}">
        <meta property="og:meta_description" content="{{ $service->meta_description ?? '' }}">
        <meta property="og:image" content="{{ $service->image }}">

        <meta name="robots" content="index, follow">
        @endsection

    </head>




    <!-- Page Header Start -->

    <!-- Page Header End -->

    <!-- Page Service Single Start -->
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Service Single Content Start -->
                    <div class="service-single-content">
                        <!-- Service Featured Image Start -->
                        <div class="service-featured-img">
                            <figure class="reveal image-anime">
                                <img src="{{ Storage::url($service->image) }}" alt="">
                            </figure>
                        </div>
                        <!-- Service Featured Image End -->

                        <!-- Service Entry Content Start -->
                        <div class="service-entry">
                            <h3 class="wow fadeInUp">{{ \App\Helpers\TranslationHelper::TranslateText($service->nom) }}</h3>

                            <p class="wow fadeInUp" data-wow-delay="0.2s">

                                {!! \App\Helpers\TranslationHelper::TranslateText($service->meta_description) !!}
                            </p>

                            <p class="wow fadeInUp" data-wow-delay="0.2s">

                                {!! \App\Helpers\TranslationHelper::TranslateText($service->description) !!}
                            </p>



                            <!-- Service Entry Image End -->
                        </div>
                        <!-- Service Entry Content End -->
                    </div>
                    <!-- Service Single Content End -->
                </div>
                <div class="col-lg-4">
                    <!-- Service Sidebar Start -->
                    <div class="service-sidebar">
                        <!-- Service Categories List Start -->
                        <div class="service-catagery-list wow fadeInUp">
                            <h3>{{ \App\Helpers\TranslationHelper::TranslateText(' Tous les services')  }}</h3>
                            <ul> @foreach ($services as $service)
                                <li><a href="{{ route('details-services', ['id' => $service->id, 'slug'=>Str::slug(Str::limit($service->nom, 10))]) , }}">{{ \App\Helpers\TranslationHelper::TranslateText($service->nom ?? ' ')  }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Service Categories List End -->

                        <!-- Opening Hour Section Start -->
                        <div class="opening-hour-section wow fadeInUp" data-wow-delay="0.25s">
                            <h3>opening hours</h3>
                            <ul>
                                <li>mon to fri : 10:00 to 6:00</li>
                                <li>sat : 10:00AM To 3:00PM</li>
                                <li>sun : closed</li>
                            </ul>
                        </div>
                        <!-- Opening Hour Section End -->

                        <!-- Sidebar Cta Box Start -->

                        <!-- Sidebar Cta Box End -->
                    </div>
                    <!-- Service Sidebar End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Service Single End -->

    <!-- Our Scrolling Ticker Section Start -->
    {{-- <div class="our-scrolling-ticker">
            
                <div class="scrolling-ticker-box">
                    <div class="scrolling-content">
                        <span><img src="images/icon-sparkles.svg" alt="">Emergency No. : {{ $config->telephone }}</span>
    <span><img src="images/icon-sparkles.svg" alt="">For any additional inqueries :
        {{ $config->email }}</span>
    <span><img src="images/icon-sparkles.svg" alt="">Book Appointment: {{ $config->telephone }}</span>
    <span><img src="images/icon-sparkles.svg" alt="">Working Hourse : Mon to Fri : 10:00 To
        6:00 </span>
    </div>


    </div>
    </div> --}}
    <!-- Scrolling Ticker Section End -->

</main>
@endsection