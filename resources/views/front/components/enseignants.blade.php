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
                         
                          {!! \App\Helpers\TranslationHelper::TranslateText( 'Qualifiés & Expérimentés ') !!}
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-3">
                <!-- Section Button Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                    <a href="{{ route('enseignants') }}"class="btn-default text-capitalize">
                         {!! \App\Helpers\TranslationHelper::TranslateText(' Tous les enseignants') !!}
                    </a>
                </div>
                <!-- Section Button End -->
            </div>
        </div>

        <div class="row">
            @forelse ($enseignants as $index => $enseignant)
                <div class="col-lg-3 col-md-6 mb-4">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp" data-wow-delay="{{ 0.15 * ($index + 1) }}s">
                        <!-- Team Image Start -->
                        <div class="team-image position-relative overflow-hidden">
                            <figure class="image-anime mb-0">
                                @php
                                    $photoPath = $enseignant->avatar ?? $enseignant->photo;
                                @endphp
                                <img src="{{ $photoPath ? asset('storage/' . $photoPath) : asset('images/default-avatar.png') }}" 
                                     alt="{{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}"
                                     class="img-fluid w-100 object-fit-cover"
                                     style="height: 280px;">
                            </figure>

                            <!-- Badge de note/évaluation (Optionnel) -->
                            @if(isset($enseignant->note_moyenne) && $enseignant->note_moyenne > 0)
                                <div class="teacher-rating position-absolute top-0 end-0 m-2 bg-warning text-dark px-2 py-1 rounded fw-bold fs-7 shadow-sm">
                                    <i class="fa-solid fa-star me-1"></i>{{ number_format($enseignant->note_moyenne, 1) }}
                                </div>
                            @endif

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                     
            {{-- Facebook --}}
            @if(!empty($enseignant->profile->social_links['facebook']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['facebook'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
            @endif

            {{-- YouTube --}}
            @if(!empty($enseignant->profile->social_links['youtube']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['youtube'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            @endif

            {{-- Instagram --}}
            @if(!empty($enseignant->profile->social_links['instagram']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['instagram'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
            @endif

            {{-- Twitter / X --}}
            @if(!empty($enseignant->profile->social_links['twitter']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['twitter'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </li>
            @endif

            {{-- LinkedIn --}}
            @if(!empty($enseignant->profile->social_links['linkedin']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['linkedin'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
            @endif

            {{-- Site Web / Portfolio --}}
            @if(!empty($enseignant->profile->social_links['website']))
                <li>
                    <a href="{{ $enseignant->profile->social_links['website'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-solid fa-globe"></i>
                    </a>
                </li>
            @endif
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content p-3 text-center">
                            <h3 class="text-capitalize fs-5 mb-1">
                                <a  href="{{ route('details-enseignants', ['id' => $enseignant->id, 'slug'=>Str::slug(Str::limit($enseignant->nom, 10))]) , }}" class="text-decoration-none text-dark">
                                    {{ $enseignant->nom }} {{ $enseignant->prenom ?? '' }}
                                </a>
                            </h3>
                            <p class="text-capitalize text-muted mb-2 small">{{ $enseignant->specialite ?? 'Enseignant' }}</p>

                            <!-- Badges / Diplômes (Optionnel) -->
                            @if(optional($enseignant)->badge)
                                <span class="badge bg-primary text-white text-capitalize fw-normal">{{ $enseignant->badge->nom }}</span>
                            @endif
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-6">Aucun enseignant disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Our Team / Enseignants End -->