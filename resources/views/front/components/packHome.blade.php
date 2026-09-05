<!-- Bannière / Hero Section de la page d'accueil -->

<!-- Page Blog Start -->
<div class="page-blog">
    <div class="container">
        <div class="bg-primary text-white text-center py-5 mb-5">
            <h1 class="display-4 fw-bold">
                {!! \App\Helpers\TranslationHelper::TranslateText('Boostez vos compétences dès aujourd\'hui') !!}
            </h1>
            <p class="lead">
                {!! \App\Helpers\TranslationHelper::TranslateText('Découvrez nos formations et packs de qualité pour atteindre vos objectifs professionnels') !!}

            </p>
        </div>
        <livewire:home-page />
    </div>
</div>

<!-- Appel du composant Livewire HomePage qui liste les Packs et Formations -->