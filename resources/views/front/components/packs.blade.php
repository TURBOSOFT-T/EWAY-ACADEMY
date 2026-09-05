<!-- Page Header Start -->

<!-- Page Header End -->

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="bg-primary text-white text-center py-5 mb-5">
            <h1 class="display-4 fw-bold">
                {!! \App\Helpers\TranslationHelper::TranslateText('Boostez vos compétences dès aujourd\'hui') !!}
            </h1>
            <p class="lead">
                {!! \App\Helpers\TranslationHelper::TranslateText('Découvrez nos formations  de qualité pour atteindre vos objectifs professionnels') !!}

            </p>
        </div>
        <div class="row align-items-center section-row">


            <div class="col-lg-5">

            </div>
        </div>
        <div class="row">
            @foreach ($packs as $pack )
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="/pack_formation/{{ $pack->id }}" class="image-anime">

                                <img src="{{ Storage::url($pack->image) }}" {{-- width="200" height="200" --}} alt="">

                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Content Start -->
                    <div class="post-item-content">
                        <!-- post Item Body Start -->
                        <div class="post-item-body">
                            <h2><a href="/pack_formation/{{ $pack->id }}">
                                    {{ \App\Helpers\TranslationHelper::TranslateText($pack->titre) }}
                                </a></h2>
                        </div>
                        <!-- Post Item Body End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-footer">
                            <a href="/pack_formation/{{ $pack->id }}" class="readmore-btn">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
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


<!-- Scrolling Ticker Section End -->