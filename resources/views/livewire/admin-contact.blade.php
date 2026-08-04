<div>
    @include('components.alert')


    <div class="card mb-8">
        <h5 class="card-header">Les configurations</h5>
        <form class="card-body" wire:submit="update_form" enctype="multipart/form-data">
            @csrf
           
            <div class="text-center bg-primary card my-auto p-1 mb-3">
                <h6 class="text-white">
                    Logo et images
                </h6>
            </div>
            <div class="row g-6">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Logo</label>
                    
                        <input type="file" wire:model="logo" accept="image/*" placeholder="votre logo" class="form-control">
                        @error('logo')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Icone</label>
                    
                        <input type="file" wire:model="icon" accept="image/*" placeholder="votre icone" class="form-control">
                        @error('icon')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page contact(636*644)</label>
                    
                        <input type="file" wire:model="imagecontact" accept="image/*" placeholder="votre image" class="form-control">
                        @error('imagecontact')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>


              {{--   <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page formation(1920*495)</label>
                    
                        <input type="file" wire:model="imageformation" accept="image/*" placeholder="votre image" class="form-control">
                        @error('imageformation')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}

               {{--  <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page Actualité(1920*495)</label>
                    
                        <input type="file" wire:model="imageblog" accept="image/*" placeholder="votre image" class="form-control">
                        @error('imageblog')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}

               


           {{--      <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page Evènement(1920*495)</label>
                    
                        <input type="file" wire:model="imageevent" accept="image/*" placeholder="votre image" class="form-control">
                        @error('imageevent')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}
                

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Description</label>
                    
                        <textarea type="text" wire:model="description"  placeholder="description" rows="3" class="form-control"> </textarea>
                        @error('description')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>
               
            </div>

            <hr class="my-6 mx-n4" />
            <div class="text-center bg-primary card my-auto p-1 mb-3">
                <h6 class="text-white">
                    A propos de nous
                </h6>
            </div>
            <div class="row g-6">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Titre A propos de nous</label>
                    
                        <input type="text" wire:model="titre_apropos"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('titre_apropos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Description à propos de nous</label>
                    
                        <textarea type="text" wire:model="des_apropos"  placeholder="La description" rows="3" class="form-control"> </textarea>
                        @error('des_apropos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>
 <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page A Propos (600*666)</label>
                    
                        <input type="file" wire:model="imageenteteabout" accept="image/*" placeholder="votre image" class="form-control">
                        @error('imageenteteabout')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>


                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Titre (Mission)</label>
                    
                        <input type="text" wire:model="titre_apropos1"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('titre_apropos1')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Description Mission</label>
                    
                        <textarea type="text" wire:model="des_apropos1"  placeholder="La description" rows="3" class="form-control"> </textarea>
                        @error('des_apropos1')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>


                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Titre (Vision)</label>
                    
                        <input type="text" wire:model="titre_apropos2"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('titre_apropos2')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Description vision</label>
                    
                        <textarea type="text" wire:model="des_apropos2"  placeholder="La description" rows="3" class="form-control"> </textarea>
                        @error('des_apropos2')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>



                 <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Titre (Objectif)</label>
                    
                        <input type="text" wire:model="titre_apropos3"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('titre_apropos3')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Description Objectif</label>
                    
                        <textarea type="text" wire:model="des_apropos3"  placeholder="La description" rows="3" class="form-control"> </textarea>
                        @error('des_apropos3')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>


               

             {{--    <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Message slogan 1 </label>
                    
                        <input type="text" wire:model="slogan_apropos"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('slogan_apropos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}

            {{--     <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Message slogan 2 </label>
                    
                        <input type="text" wire:model="slogan1_apropos"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('slogan1_apropos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}


              {{--   <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page A Propos section 1 (1170*356)</label>
                    
                        <input type="file" wire:model="image_apropos1" accept="image/*" placeholder="votre image" class="form-control">
                        @error('image_apropos1')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}

              {{--   <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image page A Propos section 2 (570*340)</label>
                    
                        <input type="file" wire:model="image_apropos2" accept="image/*" placeholder="votre image" class="form-control">
                        @error('image_apropos2')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}
                {{--  <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Les images de galleries(140*85) </label>
                    
                        <input type="file" wire:model="photos"  multiple name="photos" accept="image/*" placeholder="Cargez les images" class="form-control">
                        @error('photos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> 
 --}}
             
             {{--    <div wire:ignore class="col-md-12">
                    <label class="form-label" for="multicol-username">Biographie</label>
                    
                        <textarea type="text"   id="biographie" wire:model="biographie"  placeholder="La biographie" rows="3" class="form-control"> {!! $biographie !!} </textarea>
                        @error('biographie')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}
                
               
            </div>


            <hr class="my-6 mx-n4" />
            <div class="text-center bg-primary card my-auto p-1 mb-3">
                <h6 class="text-white">
                    Le home page  A propos 
                </h6>
            </div>

            <div class="row g-6">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Titre </label>
                    
                        <input type="text" wire:model="titre_home"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('titre_home')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-username">Sous titre</label>
                    
                        <input type="text" wire:model="sous_titre_home"  placeholder="Le titre " rows="3" class="form-control"> 
                        @error('sous_titre_home')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

              <div wire:ignore class="col-md-12">
                    <label class="form-label" for="multicol-username">Description</label>
                    
                        <textarea type="text"  wire:model="des_home"  placeholder="La description" rows="3" class="form-control"> </textarea>
                        @error('des_home')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image1 home section 1 (600*666)</label>
                    
                        <input type="file" wire:model="image1_home" accept="image/*" placeholder="votre image" class="form-control">
                        @error('image1_home')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div>

                 <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Les images de galleries(316*365) </label>
                    
                        <input type="file" wire:model="photos"  multiple name="photos" accept="image/*" placeholder="Cargez les images" class="form-control">
                        @error('photos')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> 

                 
                {{-- <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Image2 home section 1 (310*402)</label>
                    
                        <input type="file" wire:model="image2_home" accept="image/*" placeholder="votre image" class="form-control">
                        @error('image2_home')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                </div> --}}
                 
            </div>
            <hr class="my-6 mx-n4" />
            <div class="text-center bg-primary card my-auto p-1 mb-3">
                <h6 class="text-white">
                    Les Addresses et réseaux sociaux
                </h6>
            </div>
            <div class="row g-6">
                <div class="col-md-12">
                    <label class="form-label" for="multicol-first-name">Addresse</label>
                    <input type="text"wire:model="addresse" id="multicol-first-name" class="form-control"
                        placeholder="Addresse" />
                        @error('addresse')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="multicol-first-name">Localisation(Map)</label>
                    <input type="text"wire:model="localisation" id="multicol-first-name" class="form-control"
                        placeholder="Localisation" />
                        @error('localisation')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-last-name">Téléphone</label>
                  {{--   <input type="text"wire:model="telephone" id="multicol-last-name" class="form-control"
                        placeholder="Doe" /> --}}

                        <input type="text" wire:model="telephone" id="multicol-last-name" class="form-control"
    placeholder="+33612345678" />

                        @error('telephone')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-last-name">Fax</label>
                    <input type="number"wire:model="fax" id="multicol-last-name" class="form-control"
                        placeholder="Votre fax" />
                        @error('fax')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="multicol-country">Email</label>
                    <input type="email"wire:model="email" id="multicol-last-name" class="form-control"
                        placeholder="Email" />
                    @error('email')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Facebook</label>
                    <input type="text"wire:model="facebook" id="multicol-last-name" class="form-control"
                        placeholder="Facebook" />
                    @error('facebook')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Instagram</label>
                    <input type="text" wire:model="instagram" id="multicol-last-name" class="form-control"
                        placeholder="Instagram" />
                    @error('instagram')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">TikTok</label>
                    <input type="text"wire:model="tiktok" id="multicol-last-name" class="form-control"
                        placeholder="TikTok" />
                    @error('tiktok')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                  <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Linkedin</label>
                    <input type="text"wire:model="linkedin" id="multicol-last-name" class="form-control"
                        placeholder="Linkedin" />
                    @error('linkedin')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="multicol-country">Youtube</label>
                    <input type="text"wire:model="youtube" id="multicol-last-name" class="form-control"
                        placeholder="Youtube" />
                    @error('youtube')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
               
               
               
            </div>


            <hr class="my-6 mx-n4" />
            <div class="text-center bg-primary card my-auto p-1 mb-3">
                <h6 class="text-white">
                    Les statistiques globales
                </h6>
            </div>
            <div class="row g-6">
                <div class="col-md-3">
                    <label class="form-label" for="multicol-first-name">Clients</label>
                    <input type="text"wire:model="adherent" id="multicol-last-name" class="form-control"
                        placeholder="Adherents" />
                    @error('adherent')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
               
                
               
                <div class="col-md-3">
                    <label class="form-label" for="multicol-first-name">Nombre de  formateurs</label>
                    <input type="text"wire:model="coach" id="multicol-last-name" class="form-control"
                        placeholder="Formateurs" />
                    @error('coach')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="multicol-first-name">Formations</label>
                    <input type="text"wire:model="tounoir" id="multicol-last-name" class="form-control"
                        placeholder="Formations" />
                    @error('tounoir')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="multicol-first-name">Certification</label>
                    <input type="text"wire:model="seance" id="multicol-last-name" class="form-control"
                        placeholder="Evènements" />
                    @error('seance')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>

                 <div class="col-md-3">
                    <label class="form-label" for="multicol-first-name">Canditats formés</label>
                    <input type="text"wire:model="annees_experience" id="multicol-last-name" class="form-control"
                        placeholder="Années d'expérience" />
                    @error('annees_experience')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="pt-6">
                <span wire:loading>
                    <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
                </span>
                <i class="ri-save-line me-1 fs-16 lh-1"></i>
                <button type="submit" class="btn btn-primary me-4">Enregistrer les changements</button>
                
            </div>
        </form>
    </div>

</div>
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
        const editor = CKEDITOR.replace('biographie');
        editor.on('change', function(event){
            console.log(event.editor.getData())
            @this.set('biographie', event.editor.getData());
        })
</script>


<script>
    document.addEventListener('livewire:load', function () {
        let editor = CKEDITOR.replace('biographie');

        editor.on('change', function () {
            @this.set('biographie', editor.getData());
        });

        Livewire.hook('message.processed', () => {
            if (!editor.document) {
                editor = CKEDITOR.replace('biographie');
                editor.setData(@this.get('biographie')); // Remet la valeur après update Livewire
            }
        });
    });
</script>

