<!-- Page Header Start -->

<!-- Page Header End -->

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">

    <div class="row align-items-center section-row">
    <div class="col-lg-7">
        <!-- Section Title Start -->
        <div class="section-title">
            {{-- <h3 class="wow fadeInUp">theraphist team</h3> --}}
            <h2 class="text-anime-style-2" data-cursor="-opaque">

                {{ \App\Helpers\TranslationHelper::TranslateText('Formations') }}
            </h2>
        </div>
        <!-- Section Title End -->
    </div>

    <div class="col-lg-5">

    </div>
</div>
        <div class="row">
            @foreach ($formations as $formation )
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image" data-cursor-text="View">
                        <figure>
                            <a href="#" class="image-anime">
                               
                                     <img src="{{ Storage::url($formation->image) }}" {{-- width="200" height="200" --}} alt="">
                 
                            </a>
                        </figure>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- post Item Content Start -->
                    <div class="post-item-content">
                        <!-- post Item Body Start -->
                        <div class="post-item-body">
                            <h2><a href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) }}">
                                {{ \App\Helpers\TranslationHelper::TranslateText($formation->titre) }}
                            </a></h2>
                        </div>
                        <!-- Post Item Body End-->

                        <!-- Post Item Footer Start-->
                        <div class="post-item-footer">
                            <a href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) }}" class="readmore-btn">
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