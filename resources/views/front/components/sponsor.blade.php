

    <!-- Gallery Carousel Section Start -->
  <div class="gallery-carousel">
    <div class="gallery-track">

        @foreach ($sponsors as $banner)
            <div class="gallery-item">
                <img src="{{ Storage::url($banner->image) }}" alt="Sponsor">
            </div>
        @endforeach

        {{-- duplication pour l’infini --}}
        @foreach ($sponsors as $banner)
            <div class="gallery-item">
                <img src="{{ Storage::url($banner->image) }}" alt="Sponsor">
            </div>
        @endforeach

    </div>
</div>
<style>
    .gallery-carousel {
    width: 100%;
    overflow: hidden;
    position: relative;
    background: #fff;
}

.gallery-track {
    display: flex;
    width: max-content;
    animation: marquee 35s linear infinite;
}

.gallery-item {
    flex-shrink: 0;
    padding: 0 40px;
}

.gallery-item img {
    width: 200px;
    height: 200px;
    object-fit: contain;
}

/* Défilement complet */
@keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-50%);
    }
}
.gallery-carousel:hover .gallery-track {
    animation-play-state: paused;
}

</style>

