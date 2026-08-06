@extends('layouts.formation')
@php
    $title = \App\Helpers\TranslationHelper::TranslateText('Formations');
    $subtitle = \App\Helpers\TranslationHelper::TranslateText('Formations');
@endphp
@php
    $config = DB::table('configs')->first();

           
           
        

@endphp
@section('title', \App\Helpers\TranslationHelper::TranslateText('Formations'))
@section('body')

<x-strickyHeader/>
<x-sidebar/>

        <!--Blog Page Start-->
        <section class="blog-page">
            <div class="container">
                <div class="row">
                    <!--Blog One Single Start-->
                    @foreach ($formations as $formation )
                    <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                        <div class="blog-one__single">
                            <div class="blog-one__img">
                                <img src="{{ Storage::url($formation->image) }}" style="width: 400px; height: 300px; object-fit: cover;" alt="">
                                <div class="blog-one__hover">
                                    <a  href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}">
                                        <div class="blog-one__hover-icon-1">
                                            <span class="blog-one__hover-icon-2"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="blog-one__content">
                                <ul class="blog-one__meta list-unstyled">
                                    <li>
                                        <a href="#"><span class="icon-user"></span>By admin</a>
                                    </li>
                                    <li>
                                        <a href="#"><span class="icon-calendar"></span>{{ $formation->created_at }}</a>
                                    </li>
                                </ul>
                                <h3 class="blog-one__title"><a   href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}"> {{ \App\Helpers\TranslationHelper::TranslateText($formation->titre) }}</a></h3>
                                <div class="blog-one__btn-box-two">
                                    <a  href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}" class="blog-one__btn-2 thm-btn">
                                         {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                        <span
                                            class="icon-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--Blog One Single End-->
                 
                 
            </div>
        </section>
        <!--Blog Page End-->



        <!--CTA One Start-->
            <section class="cta-one">
            <div class="container">
                   <div class="cta-one__inner">
                <h3 class="cta-one__title">
                    {{ \App\Helpers\TranslationHelper::TranslateText('Vous souhaitez bénéficier d\'offres spéciales') }}
                    <br>
                    
                {{ \App\Helpers\TranslationHelper::TranslateText(' et mises à jour des formations?') }}
                </h3>
                <form  id="newsletter-form" class="cta-one__form mc-form"  action="{{ route('newsletter.subscribe') }}" method="POST" >
                    <div class="cta-one__form-input-box">
                        <input type="email" id="newsletter-email" placeholder="{{ \App\Helpers\TranslationHelper::TranslateText('Entrez votre email') }}" name="email">
                        <button type="submit" id="submit-btn" class="cta-one__btn"><span class="icon-paper-plan"></span></button>
                    </div>
                </form>
            </div>
            </div>
        </section>
        <!--CTA One End-->

<x-footer2 />
<x-mobileMenu/>
<x-searchPopup/>
<x-scroll-to-top/>
@endsection