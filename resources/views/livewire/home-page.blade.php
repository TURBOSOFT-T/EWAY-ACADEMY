<div class="container py-5">

    <!-- Flash Messages (Succès) -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm rounded-3" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2 class="text-center fw-bold mb-4">
        {!! \App\Helpers\TranslationHelper::TranslateText('Nos Packs de Formation') !!}
    </h2>

    <!-- Grille des Packs -->
    <div class="row g-4 mb-5">
        @foreach($packs as $pack)
        <div class="col-lg-4 col-md-6" wire:key="pack-{{ $pack->id }}">
            <div class="card h-100 shadow-sm border-0">
                @if(isset($pack->image))
                <img src="{{ Storage::url($pack->image) }}" class="card-img-top" alt="{{ $pack->titre }}" style="height: 180px; object-fit: cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary mb-2 align-self-start">
                        {!! \App\Helpers\TranslationHelper::TranslateText('PACK COMPLET') !!}
                    </span>
                    <h4 class="card-title fw-bold text-dark">{{ $pack->titre }}</h4>
                    <p class="text-muted small flex-grow-1">{{ Str::limit($pack->meta_description, 110) }}</p>

                    <h5 class="fw-bold text-success mb-3">{{ number_format($pack->prix, 0, ',', ' ') }} FCFA</h5>

                    <div class="border-top pt-3 mb-3">
                        <h6 class="small fw-bold text-secondary mb-2">
                            {!! \App\Helpers\TranslationHelper::TranslateText('Formations incluses dans ce pack :') !!}
                        </h6>
                        <ul class="list-group list-group-flush">
                            @foreach($pack->formations as $formation)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0 py-1" wire:key="formation-{{ $formation->id }}">
                                <span class="small">
                                    <i class="fa-solid fa-check text-success me-1"></i> {{ $formation->titre }}
                                </span>
                                <!-- Inscription individuelle à une formation du pack -->
                                <!-- <button type="button" 
                                                class="btn btn-sm btn-link text-decoration-none py-0 text-primary fw-semibold" 
                                                wire:click.stop="selectItem({{ $formation->id }}, 'Formation')">
                                            {!! \App\Helpers\TranslationHelper::TranslateText('S\'inscrire') !!}
                                        </button> -->

                                @auth
                                @if($this->estDejaInscrit($formation->id, 'Formation'))
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Vous êtes déjà inscrit(e) à cette formation.">
                                    <button class="btn btn-secondary" disabled style="pointer-events: none;">
                                        Déjà inscrit
                                    </button>
                                </span>
                                @else
                                <button wire:click="selectItem({{ $formation->id }}, 'Formation')" class="btn btn-primary">
                                    S'inscrire
                                </button>
                                @endif
                                @else
                                <button wire:click="selectItem({{ $formation->id }}, 'Formation')" class="btn btn-outline-primary">
                                    S'inscrire
                                </button>
                                @endauth
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Inscription au pack entier -->
                    @auth
                    @if($this->estDejaInscrit($pack->id, 'Pack'))
                    <span class="d-inline-block w-100 mt-auto" tabindex="0" data-bs-toggle="tooltip" title="{!! \App\Helpers\TranslationHelper::TranslateText('Vous êtes déjà inscrit(e) à ce pack.') !!}">
                        <button type="button" class="btn btn-secondary w-100 shadow-sm" disabled style="pointer-events: none;">
                            <i class="fa-solid fa-circle-check me-1"></i>
                            {!! \App\Helpers\TranslationHelper::TranslateText('Déjà inscrit au Pack') !!}
                        </button>
                    </span>
                    @else
                    <button type="button"
                        class="btn btn-primary w-100 mt-auto shadow-sm"
                        wire:click="selectItem({{ $pack->id }}, 'Pack')">
                        <i class="fa-solid fa-cart-shopping me-1"></i>
                        {!! \App\Helpers\TranslationHelper::TranslateText('S\'inscrire au Pack complet') !!}
                    </button>
                    @endif
                    @else
                    <button type="button"
                        class="btn btn-outline-primary w-100 mt-auto shadow-sm"
                        wire:click="selectItem({{ $pack->id }}, 'Pack')">
                        <i class="fa-solid fa-cart-shopping me-1"></i>
                        {!! \App\Helpers\TranslationHelper::TranslateText('S\'inscrire au Pack complet') !!}
                    </button>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Flash Messages (Avertissement Connexion Requis) -->
    @if (session('warning'))
    <div id="authWarningAlert" class="alert alert-warning alert-dismissible fade show mb-4 shadow-sm rounded-3 border-warning" role="alert">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <i class="fa-solid fa-circle-exclamation me-2 fs-5 text-warning"></i>
                <span>{!! \App\Helpers\TranslationHelper::TranslateText(session('warning')) !!}</span>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark fw-semibold">
                    <i class="fa-solid fa-right-to-bracket me-1"></i>
                    {!! \App\Helpers\TranslationHelper::TranslateText('Se connecter') !!}
                </a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-primary fw-semibold">
                    <i class="fa-solid fa-user-plus me-1"></i>
                    {!! \App\Helpers\TranslationHelper::TranslateText('Créer un compte') !!}
                </a>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('InscriptionWarning'))
    <div id="InscriptionWarningAlert" class="alert alert-warning alert-dismissible fade show mb-4 shadow-sm rounded-3 border-warning" role="alert">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <i class="fa-solid fa-circle-exclamation me-2 fs-5 text-warning"></i>
                <span>{!! \App\Helpers\TranslationHelper::TranslateText(session('InscriptionWarning')) !!}</span>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Modal Formulaire d'Inscription -->
    <div class="modal fade" id="modalInscription" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">
                        {!! \App\Helpers\TranslationHelper::TranslateText('Demande d\'inscription') !!} :
                        <span class="text-primary">{{ $selectedItem?->titre ?? '' }}</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent="SInscrire">
                    <div class="modal-body p-4">

                        <!-- Résumé de l'élément sélectionné -->
                        @if($selectedItem)
                        <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <span class="badge bg-dark mb-1">{{ strtoupper($selectedType) }}</span>
                                <h6 class="fw-bold mb-0">{{ $selectedItem->titre }}</h6>
                            </div>
                            <span class="fs-5 fw-bold text-success">{{ number_format($selectedItem->prix, 0, ',', ' ') }} FCFA</span>
                        </div>
                        @endif

                        <div class="row g-3">
                            <!-- Nom -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Nom') !!} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" wire:model.blur="nom" placeholder="Votre nom">
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Prénom -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Prénom') !!} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" wire:model.blur="prenom" placeholder="Votre prénom">
                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Email') !!} <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.blur="email" placeholder="nom@exemple.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Téléphone') !!} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('telephone') is-invalid @enderror" wire:model.blur="telephone" placeholder="Ex: 6XXXXXXXX">
                                @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- WhatsApp -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Numéro WhatsApp') !!}
                                </label>
                                <input type="text" class="form-control" wire:model.blur="whatsapp" placeholder="Ex: 6XXXXXXXX">
                            </div>

                            <!-- Ville -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Ville de résidence') !!}
                                </label>
                                <input type="text" class="form-control" wire:model.blur="ville" placeholder="Ex: Douala, Yaoundé...">
                            </div>

                            <!-- Mode de Paiement -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Mode de paiement souhaité') !!} <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('mode') is-invalid @enderror" wire:model="mode">
                                    <option value="">{!! \App\Helpers\TranslationHelper::TranslateText('Sélectionnez un mode') !!}</option>
                                    <option value="espèce">{!! \App\Helpers\TranslationHelper::TranslateText('Espèce (Sur place)') !!}</option>
                                    <option value="paypal">{!! \App\Helpers\TranslationHelper::TranslateText('PayPal') !!}</option>
                                    <option value="carte de credit">{!! \App\Helpers\TranslationHelper::TranslateText('Carte de crédit') !!}</option>
                                </select>
                                @error('mode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Message / Note -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
                                    {!! \App\Helpers\TranslationHelper::TranslateText('Message / Note particulière') !!}
                                </label>
                                <textarea class="form-control" wire:model="message" rows="2" placeholder="Des précisions sur votre demande..."></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                            {!! \App\Helpers\TranslationHelper::TranslateText('Annuler') !!}
                        </button>
                        <button type="submit" class="btn btn-success px-4" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fa-solid fa-paper-plane me-1"></i>
                                {!! \App\Helpers\TranslationHelper::TranslateText('Valider mon inscription') !!}
                            </span>
                            <span wire:loading>
                                <i class="fa-solid fa-spinner fa-spin me-1"></i>
                                {!! \App\Helpers\TranslationHelper::TranslateText('Traitement...') !!}
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Script Bootstrap Modal Trigger & Auth Handlers -->
<script>
    document.addEventListener('livewire:initialized', () => {
        const modalElement = document.getElementById('modalInscription');
        const bsModal = new bootstrap.Modal(modalElement);

        Livewire.on('open-subscribe-modal', () => {
            bsModal.show();
        });

        Livewire.on('close-subscribe-modal', () => {
            bsModal.hide();
        });

        Livewire.on('show-auth-warning', () => {
            const alertElem = document.getElementById('authWarningAlert');
            if (alertElem) {
                alertElem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });

        Livewire.on('show-InscriptionWarning', () => {
            const alertElem = document.getElementById('InscriptionWarningAlert');
            if (alertElem) {
                alertElem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    });
</script>