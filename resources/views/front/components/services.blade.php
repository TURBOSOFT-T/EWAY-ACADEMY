  <div class="our-service  pt-4 pb-4">
      <div class="container">
          <div class="row align-items-center section-row">
              <div class="col-lg-7">
                  <!-- Section Title Start -->
                  <div class="section-title">
                      {{-- <h3 class="wow fadeInUp">theraphist team</h3> --}}
                      <h2 class="text-anime-style-2" data-cursor="-opaque">

                          {{ \App\Helpers\TranslationHelper::TranslateText('Services') }}
                      </h2>
                  </div>
                  <!-- Section Title End -->
              </div>

              <div class="col-lg-5">

              </div>
          </div>

          <div class="row">

              @foreach ($services as $service)
              <div class="col-lg-6 col-md-6">

              <!-- Header & Titre de l'image -->
                       
                  <!-- Service Item Start -->
                  <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                     
                      <!-- Icon Box Start -->
                      <div class="icon-box">
                          <img src="{{ Storage::url($service->image) }}" {{-- width="200" height="200" --}} alt="">
                      </div>
                      <!-- Icon Box End -->
<div class="service-image-header mb-3 text-center">
                            <h3 style="color:#003DA5; font-size: 22px; font-weight: 700;" class="mb-2">
                                {{ \App\Helpers\TranslationHelper::TranslateText($service->nom ?? '') }}
                            </h3>
                        </div>
                      <!-- Service Body Start -->
                      <div class="service-body">
                          <p style="color:#003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText($service->titre ?? ' ')  }}</p>
                          <p style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">

                              {!! \App\Helpers\TranslationHelper::TranslateText( Str::limit($service->meta_description ?? ' ', 250)) !!}
                          </p>
                      </div>
                      <!-- Service Body End -->

                      <!-- Service Footer Start -->
                      <div class="service-footer">
                          <a href="{{ route('details-services', ['id' => $service->id, 'slug' => Str::slug($service->titre) ?: 'service']) }}" class="service-btn"><img src="images/arrow-white.svg" alt="">
                          </a>
                      </div>
                      <!-- Service Footer End -->
                  </div>
                  <!-- Service Item End -->
              </div>

              @endforeach






          </div>
      </div>
  </div>