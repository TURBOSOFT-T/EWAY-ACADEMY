<div class="teacher-evaluation-section mt-5">
    <!-- Messages d'alerte -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Résumé des Notes -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-4 text-center border-end">
                    <h1 class="display-3 fw-bold text-warning mb-0">{{ number_format($noteMoyenne, 1) }}</h1>
                    <div class="text-warning mb-1 fs-5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= round($noteMoyenne) ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-muted small mb-0">Basé sur {{ $totalAvis }} avis</p>
                </div>
                <div class="col-md-8 ps-md-4 mt-3 mt-md-0">
                    <h4 class="fw-bold mb-2">Évaluations des étudiants</h4>
                    <p class="text-muted small mb-0">
                        Partagez votre expérience avec cet enseignant pour aider les autres membres de la communauté.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire d'Avis (Uniquement si connecté) -->
    @auth
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Laisser une évaluation</h5>
                <form wire:submit.prevent="submitEvaluation">
                    
                    <!-- Choix des étoiles -->
                    <div class="mb-3">
                        <label class="form-label d-block fw-semibold">Votre Note :</label>
                        <div class="star-rating fs-3 text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $rating ? 'solid' : 'regular' }} fa-star" 
                                   style="cursor: pointer;" 
                                   wire:click="$set('rating', {{ $i }})"></i>
                            @endfor
                        </div>
                        @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Commentaire -->
                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">Votre Avis (optionnel) :</label>
                        <textarea id="comment" wire:model="comment" class="form-control" rows="3" placeholder="Qu'avez-vous pensé des cours de cet enseignant ?"></textarea>
                        @error('comment') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Option Anonyme -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_anonymous" wire:model="is_anonymous">
                        <label class="form-check-label text-muted small" for="is_anonymous">
                            Publier cet avis de manière anonyme
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-paper-plane me-1"></i> Soumettre l'évaluation
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-light border text-center py-3 mb-5">
            <span class="text-muted">Vous devez être </span>
            <a href="{{ route('login') }}" class="fw-bold text-decoration-none">connecté</a>
            <span class="text-muted"> pour évaluer cet enseignant.</span>
        </div>
    @endauth

    <!-- Liste des Avis -->
    <div class="reviews-list">
        <h5 class="fw-bold mb-4">Avis des étudiants ({{ $totalAvis }})</h5>

        @forelse($evaluations as $evaluation)
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 40px; height: 40px;">
                                {{ $evaluation->is_anonymous ? 'A' : strtoupper(substr($evaluation->student->nom ?? 'E', 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">
                                    {{ $evaluation->is_anonymous ? 'Étudiant Anonyme' : ($evaluation->student->nom . ' ' . ($evaluation->student->prenom ?? '')) }}
                                </h6>
                                <small class="text-muted fs-7">{{ $evaluation->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $evaluation->rating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>

                    @if($evaluation->comment)
                        <p class="text-secondary mb-0 mt-2 small">
                            {{ $evaluation->comment }}
                        </p>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-4 text-muted">
                <i class="fa-regular fa-comment-dots fs-2 mb-2 d-block"></i>
                Aucun avis n'a encore été laissé pour cet enseignant.
            </div>
        @endforelse
    </div>
</div>
