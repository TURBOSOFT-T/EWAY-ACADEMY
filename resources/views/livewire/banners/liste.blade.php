<div>
    <div class="row">
        @forelse ($banners as $banner)
            <div class="col-sm-4 col-xl-3">
                <div class="list-banner-image card p-2">
                    <div class="image">
                        {{-- <button type="button" class="btn btn-sm btn-danger" wire:click="delete({{ $banner->id }})" wire:confirm="Supprimer ?">
                            <i class="ri-delete-bin-6-line"></i>
                        </button> --}}
                       {{--  <button type="button" class="btn btn-sm btn-danger confirm" wire:click="delete({{ $banner->id }})" wire:confirm="Supprimer">
                            <i class="ri-delete-bin-6-line"></i>
                        </button> --}}
                        <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->titre }}" class="w-100" srcset="">
                    </div>
                    <h6 class="mt-1 mb-2 titre">
                        <b> {{ Str::limit($banner->titre , 50) }} </b>
                    </h6>
                    <p class="sous_titre">
                        {{ $banner->sous_titre ?? "" }}
                    </p>
                    <div class="text-center">
                        <a href="{{ route('banner.update',['id'=>$banner->id]) }}">
                         {{--    <i class="ri-edit-2-line"></i> --}}
                         <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" width="45" hight="48"
                         fill="currentColor">
                         <path
                             d="M16.7574 2.99677L9.29145 10.4627L9.29886 14.7098L13.537 14.7024L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z">
                         </path>
                     </svg> 
                        </a>

                        <button type="button" style="font-size: 10px;" class="btn btn-sm btn-danger confirm" onclick="confirmDeletion({{ $banner->id }})" wire:click="delete({{ $banner->id }})" {{-- wire:confirm="Supprimer" --}}>
                            <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" width="20"
                            style="background-color: #e0610d22; fill:#dbd7d7;"
                            height="22" fill="currentColor">
                            <path
                                d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM13.4142 11L15.8891 8.52513L14.4749 7.11091L12 9.58579L9.52513 7.11091L8.11091 8.52513L10.5858 11L8.11091 13.4749L9.52513 14.8891L12 12.4142L14.4749 14.8891L15.8891 13.4749L13.4142 11Z">
                            </path>
                        </svg>     
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-6 mx-auto text-center">
                <div>
                    <img width="100" height="100" src="https://img.icons8.com/ios/100/00c100/image-not-avialable.png" alt="image-not-avialable"/>
                </div>
                <h6>
                    Aucune Image !
                </h6>
            </div>
        @endforelse
    </div>
</div>
{{-- <script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('confirm', id => {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous ne pourrez pas récupérer cet élément !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', id);
                }
            });
        });
    });
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   function confirmDeletion(id) {
    Swal.fire({
        title: '<span style="font-size:14px;">Êtes-vous sûr ?</span>',
        text: "Cette action est irréversible !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '<span style="font-size:12px;">Oui, supprimer !</span>',
        cancelButtonText: '<span style="font-size:12px;">Annuler</span>'
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emit('deleteBanner', id);
        }
    })
}

</script>