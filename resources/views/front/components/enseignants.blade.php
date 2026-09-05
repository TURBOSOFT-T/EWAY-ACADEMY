<!-- Our Team / Enseignants Start -->
<div class="our-team">
    <div class="container">
        <div class="row align-items-center section-row">
            <div class="col-lg-9">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp text-capitalize">
                        {!! \App\Helpers\TranslationHelper::TranslateText('Corps Enseignant') !!}
                    </h3>
                    <h2 class="text-anime-style-2" data-cursor="-opaque">
                        <span>
                            {!! \App\Helpers\TranslationHelper::TranslateText(' Nos Enseignants') !!}
                        </span>
                        {!! \App\Helpers\TranslationHelper::TranslateText('Qualifiés & Expérimentés ') !!}
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-3">
                <!-- Section Button Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                    <a href="{{ route('enseignants') }}" class="btn-default text-capitalize">
                        {!! \App\Helpers\TranslationHelper::TranslateText(' Tous les enseignants') !!}
                    </a>
                </div>
                <!-- Section Button End -->
            </div>
        </div>

        <div class="row">
            @forelse ($enseignants as $index => $enseignant)
            @php
            $photoPath = $enseignant->profile->avatar ?? $enseignant->avatar ?? $enseignant->photo;
            $rating = $enseignant->note_moyenne ?? $enseignant->rating ?? $enseignant->evaluations_avg_rating ?? 0;
            $reviewsCount = $enseignant->nombre_avis ?? $enseignant->evaluations_count ?? 0;
            $studentsCount = $enseignant->inscrits_count ?? $enseignant->students_count ?? 0;
            $socials = $enseignant->profile->social_links ?? [];
            @endphp

            <div class="col-lg-3 col-md-6 mb-4">
                <!-- Team Member Item Start -->
                <div class="team-member-item wow fadeInUp" data-wow-delay="{{ 0.15 * ($index + 1) }}s">
                    <!-- Team Image Start -->
                    <div class="team-image position-relative overflow-hidden">
                        <figure class="image-anime mb-0">
                            <img src="{{ $photoPath ? asset('storage/' . $photoPath) : asset('images/default-avatar.png') }}"
                                alt="{{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}"
                                class="img-fluid w-100 object-fit-cover"
                                style="height: 280px;">
                        </figure>

                        <!-- Badge de Note / Évaluation -->
                        @if($rating > 0)
                        <div class="teacher-rating position-absolute top-0 end-0 m-2 bg-warning text-dark px-2 py-1 rounded-pill fw-bold fs-7 shadow-sm d-flex align-items-center">
                            <i class="fa-solid fa-star me-1 text-white"></i>
                            <span>{{ number_format($rating, 1) }}</span>
                            @if($reviewsCount > 0)
                            <span class="ms-1 text-dark opacity-75 fw-normal">({{ $reviewsCount }})</span>
                            @endif
                        </div>
                        @endif

                        <!-- Team Social Icon Start -->
                        <div class="team-social-icon">
                            <div class="teacher-stats border-top pt-3 mt-2 bg-light rounded-3 p-2">
                                <div class="row g-0 text-center">
                                    <!-- Note & Nombre d'avis -->
                                    <div class="col-6 border-end px-1">
                                        <div class="d-flex align-items-center justify-content-center gap-1 text-warning mb-1">
                                            <i class="fa-solid fa-star fs-6"></i>
                                            <span class="fw-bold text-dark fs-6">{{ number_format($rating, 1) }}</span>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 0.75rem;">
                                            {{ $reviewsCount }} {!! \App\Helpers\TranslationHelper::TranslateText($reviewsCount > 1 ? 'avis' : 'avis') !!}
                                        </span>
                                    </div>
                                 
                                    <!-- Nombre d'inscriptions aux formations -->
                                    <div class="col-6 px-1">
                                        <div class="d-flex align-items-center justify-content-center gap-1 text-primary mb-1">
                                            <i class="fa-solid fa-graduation-cap fs-6"></i>
                                            <span class="fw-bold text-dark fs-6">{{ $studentsCount }}</span>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 0.75rem;">
                                            {!! \App\Helpers\TranslationHelper::TranslateText($studentsCount > 1 ? 'inscriptions' : 'inscription') !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Team Social Icon End -->
                    </div>
                    <!-- Team Image End -->

                    <!-- Team Content Start -->
                    <div class="team-content p-3 text-center">
                        <h3 class="text-capitalize fs-5 mb-1">
                            <a href="{{ route('details-enseignants', ['id' => $enseignant->id, 'slug' => Str::slug($enseignant->nom . ' ' . $enseignant->prenom)]) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}
                            </a>
                        </h3>

                        <p class="text-capitalize text-muted mb-2 small">
                            {{ $enseignant->profile->specialite ?? $enseignant->specialite ?? 'Enseignant / Formateur' }}
                        </p>

                        <!-- Badge de l'enseignant et nombre d'inscrits -->
                        <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap mt-2">
                            @if(optional($enseignant)->badge)
                            <span class="badge bg-primary text-white text-capitalize fw-normal">
                                <i class="fa-solid fa-award me-1"></i>{{ $enseignant->badge->nom }}
                            </span>
                            @endif

                            <span class="badge bg-light text-dark border fw-normal">
                                <i class="fa-solid fa-users text-primary me-1"></i>{{ $studentsCount }}
                                {!! \App\Helpers\TranslationHelper::TranslateText($studentsCount > 1 ? 'inscriptions' : 'inscription') !!}
                            </span>
                        </div>
                    </div>
                    <!-- Team Content End -->
                </div>
                <!-- Team Member Item End -->
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-6">{!! \App\Helpers\TranslationHelper::TranslateText('Aucun enseignant disponible pour le moment.') !!}</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Our Team / Enseignants End -->