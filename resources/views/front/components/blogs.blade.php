  <div class="our-blog  pt-4 pb-4">
            <div class="container">
                <div class="row section-row align-items-center">
                    <div class="col-lg-9">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp" style="color: #003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText('Actualités') }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque"><span style="color: #003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText('Restez informer') }}</span>
                            </h2>
                        </div>
                        <!-- Section Title End -->
                    </div>

                    <div class="col-lg-3">
                        <!-- Section Button Start -->
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                            {{-- <a href="#" class="btn-default"  style="color: #f3f3f6;"> {{ \App\Helpers\TranslationHelper::TranslateText('Voir tout') }}</a>
                            --}}
                        </div>
                        <!-- Section Button End -->
                    </div>
                </div>

                <div class="row">
                    @foreach ($blogs as $blog )
                    <div class="col-lg-4 col-md-6">
                        <!-- Blog Item Start -->
                        <div class="blog-item wow fadeInUp">
                            <!-- Post Featured Image Start-->
                            <div class="post-featured-image" data-cursor-text="View">
                                <figure>
                                    <a a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}" class="image-anime">
                                        <img src="{{ Storage::url($blog->image) }}" alt="">
                                    </a>
                                </figure>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- post Item Content Start -->
                            <div class="post-item-content">
                                <!-- post Item Body Start -->
                                <div class="post-item-body">
                                    <h2><a a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}"> {{ \App\Helpers\TranslationHelper::TranslateText($blog->title) }}</a></h2>
                                </div>
                                <!-- Post Item Body End-->

                                <!-- Post Item Footer Start-->
                                <div class="post-item-footer">
                                    {{-- <a  href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}" class="readmore-btn">

                                    {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                    </a> --}}
                                    <a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) }}" class="readmore-btn" style="color: black;">
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