@extends('front.fixe')
@section('titre', 'Formations')
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
                        {{ \App\Helpers\TranslationHelper::TranslateText('Formations') }}

                    </h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Accueil') }}
                            </a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Formations') }}
                               
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

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="row">
            @foreach ($formations as $formation )
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}" class="image-anime">
                                <img src="{{ Storage::url($formation->image) }}" alt="">
                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Content Start -->
                    <div class="post-item-content">
                        <!-- post Item Body Start -->
                        <div class="post-item-body">
                            <h2><a href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}"> {{ \App\Helpers\TranslationHelper::TranslateText($formation->titre) }}</a></h2>
                        </div>
                        <!-- Post Item Body End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-footer">


                            <a class="readmore-btn" href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}" class="blog-one__btn-2 thm-btn">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                <span
                                    class="icon-arrow-right"></span>
                            </a>
                        </div>
                        <!-- Post Item Footer End-->
                    </div>
                    <!-- post Item Content End -->
                </div>
                <!-- Blog Item End -->
            </div>
            @endforeach




        </div>

    </div>
</div>
<!-- Page Blog End -->

<!-- Our Scrolling Ticker Section Start -->

<!-- Scrolling Ticker Section End -->
@endsection