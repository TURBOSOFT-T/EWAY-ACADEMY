    <section class="latest-newsletter__area pt-80 pb-80 overflow-hidden latest-newsletter-bg">
            <div class="container p-relative">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="latest-newsletter__content text-center">
                            <h2 class="title wow fadeInLeft animated" data-wow-delay=".4s">Newsletter</h2>
                            <p class="title wow fadeInLeft animated" data-wow-delay=".1s">
                                {!! \App\Helpers\TranslationHelper::TranslateText('Vous souhaitez bénéficier d\'offres spéciales') !!}<br>
                                {!! \App\Helpers\TranslationHelper::TranslateText('et mises à jour ?') !!}
                            </p>

                            <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <div class="search custom-search d-flex wow fadeInRight animated" data-wow-delay=".4s">
                                    <input type="email" name="email" class="form-control" id="newsletter-email" placeholder="Email">
                                    <button type="submit" id="submit-btn" class="btn-default">S'inscrire maintenant</button>
                                </div>
                            </form>

                            <!-- Zone des messages -->
                            <p id="newsletter-message" class="mt-3 fw-bold"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>