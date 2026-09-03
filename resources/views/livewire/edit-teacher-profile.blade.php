<div>
    <form wire:submit.prevent="saveProfile">
        <!-- Champs existants (Grade, Diplôme, Expérience...) -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Grade</label>
                <input type="text" wire:model="grade" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Diplôme le plus élevé</label>
                <input type="text" wire:model="highest_degree" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Années d'expérience</label>
                <input type="number" wire:model="experience_years" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Spécialité</label>
                <input type="text" wire:model="speciality" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Certifications</label>
            <input type="text" wire:model="certifications" class="form-control" placeholder="Séparez les certifications par des virgules">
        </div>
         <div class="mb-3">
                    <label class="form-label" for="Email">Bio</label>
                    
                    <textarea wire:model="bio" class="form-control" rows="3"></textarea>
                    @error('bio')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
        

        <!-- Section Fichier CV PDF -->
        <div class="mb-3">
            <label for="cv" class="form-label fw-bold">Curriculum Vitae (PDF uniquement)</label>
            
            <!-- Affichage du CV existant -->
            @if ($oldCvPath)
                <div class="alert alert-light border d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <i class="ri-file-pdf-fill text-danger fs-4 me-2"></i>
                        <span>CV actuel enregistré</span>
                    </div>
                    <a href="{{ asset('storage/' . $oldCvPath) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="ri-external-link-line"></i> Voir / Télécharger
                    </a>
                </div>
            @endif

            <!-- Champ d'importation -->
            <input type="file" id="cv" wire:model="cv" accept=".pdf" class="form-control @error('cv') is-invalid @enderror">

            <!-- Indicateur de chargement Livewire -->
            <div wire:loading wire:target="cv" class="text-primary mt-1 small">
                <span class="spinner-border spinner-border-sm" role="status"></span> Chargement du fichier PDF...
            </div>

            @error('cv')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Réseaux sociaux & Liens</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- LinkedIn -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profil LinkedIn</label>
            <input type="url" wire:model.defer="social_links.linkedin" placeholder="https://linkedin.com/in/nom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.linkedin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Facebook -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profil Facebook</label>
            <input type="url" wire:model.defer="social_links.facebook" placeholder="https://facebook.com/pseudonyme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.facebook') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- YouTube -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profil YouTube</label>
            <input type="url" wire:model.defer="social_links.youtube" placeholder="https://youtube.com/c/pseudonyme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.youtube') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
          <!-- TikTok -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Profil TikTok</label>
            <input type="url" wire:model.defer="social_links.tiktok" placeholder="https://tiktok.com/@pseudonyme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.tiktok') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
          </div>

        <!-- Twitter / X -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profil Twitter / X</label>
            <input type="url" wire:model.defer="social_links.twitter" placeholder="https://x.com/pseudonyme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.twitter') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- GitHub -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Profil GitHub</label>
            <input type="url" wire:model.defer="social_links.github" placeholder="https://github.com/pseudonyme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.github') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
       

        <!-- Site Web -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Site Web personnel / Portfolio</label>
            <input type="url" wire:model.defer="social_links.website" placeholder="https://mon-site.com" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('social_links.website') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>
</div>



        <button type="submit" class="btn btn-primary">
            <i class="ri-save-line"></i> Enregistrer le profil
        </button>
    </form>
</div>