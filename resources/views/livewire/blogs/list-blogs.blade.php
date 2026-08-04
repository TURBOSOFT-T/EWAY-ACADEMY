<div>

    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-6">
                <span>
                    <b>{{ $blogs->count() }}</b> Résultats sur {{ $total }}.
                </span>
            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control btn-sm" wire:model="key"
                        placeholder="Titre,Description des articles">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @include('components.alert')

    <div class="table-responsive-sm">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead class="table-dark cusor">
                <tr>

                    <th>Photo</th>
                    <th>Nom</th>


                    <th>Vues</th>
                    {{--  <th>création</th> --}}
                    <th style="text-align: right;">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20" class="rounded shadow"
                                alt="">
                        </span>
                    </th>
                </tr>
            </thead>


            <tbody>
                @forelse ($blogs as $blog)
                    <tr>

                        <td>
                            <img src="{{ Storage::url($blog->image) }}" width="40 " height="40 "
                                class="rounded shadow" alt="">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline" data-bs-toggle="modal"
                                data-bs-target="#qr-code-{{ $blog->id }}">
                                <i class="ri-qr-code-line"></i>
                            </button>

                            {{ $blog->title }}
                        </td>






                        <td>
                            <i class="ri-bar-chart-box-line vert"></i>
                             {{ $blog->views }} 
                        </td>
                        {{--   <td>{{ $blog->created_at->format('d/m/Y') }} </td> --}}
                        <td style="text-align: right;">
                            <div class="btn-group">


                                <div>


                                </div>





                               {{--  <button class="btn btn-sm btn-dark"
                                    onclick="url(' {{ route('blogs.update', ['id' => $blog->id]) }} ')">
                                    <i class="ri-edit-box-line"></i>
                                </button> --}}

                                <div class="col">
                                    <a  href="{{ route('blog.update',['id'=>$blog->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" width="35" hight="38"
                                        fill="currentColor">
                                        <path
                                            d="M16.7574 2.99677L9.29145 10.4627L9.29886 14.7098L13.537 14.7024L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z">
                                        </path>
                                    </svg>
                                    </a>
                                   </div>
                           
                                @can('product_delete')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="toggle_confirmation({{ $blog->id }})">
                                        {{-- <i class="ri-delete-bin-6-line"></i> --}}

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24" width="20"
                                                                    style="background-color: #e0610d22; fill:#dbd7d7;"
                                                                    height="22" fill="currentColor">
                                                                    <path
                                                                        d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM13.4142 11L15.8891 8.52513L14.4749 7.11091L12 9.58579L9.52513 7.11091L8.11091 8.52513L10.5858 11L8.11091 13.4749L9.52513 14.8891L12 12.4142L14.4749 14.8891L15.8891 13.4749L13.4142 11Z">
                                                                    </path>
                                                                </svg>
                                    </button>
                                @endcan
                            </div>

                            <!-- Center modal content -->
                            <div class="modal fade" id="qr-code-{{ $blog->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="myCenterModalLabel">
                                                Accès rapide au blog
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table" style="text-align: left;">
                                               
                                                <tr>
                                                    <td>Réference :</td>
                                                    <td>
                                                        {{ $blog->title }}
                                                    </td>
                                                </tr>

                                            </table>
                                            <br>
                                            <div class="text-center p-2">
                                                {{-- {!! QrCode::size(100)->generate(route('blog2', ['id' => $blog->id])) !!} --}}
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <button class="btn btn-sm btn-success d-none" type="button"
                                id="confirmBtn{{ $blog->id }}" wire:click="delete({{ $blog->id }})">
                                <i class="bi bi-check-circle"></i>
                                <span class="hide-tablete">
                                    Confirmer
                                </span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <div>
                                <img src="/icons/icons8-ticket-100.png" height="100" width="100" alt=""
                                    srcset="">
                            </div>
                            Aucun blog trouvé
                        </td>
                    </tr>
                @endforelse

            </tbody>


        </table>
    </div>


    {{ $blogs->links('pagination::bootstrap-4') }}

   {{--  @role('admin')
        <div class="text-end p-2">
            <a href="{{ route('corbeille') }}" class="text-danger">
                <i class="ri-delete-bin-line"></i>
                Corbeile ( {{ $total_supprimers }} )
            </a>
        </div>
    @endrole --}}


    <style>
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .badge-success {
            background-color: green;
        }

        .badge-danger {
            background-color: red;
        }
    </style>





    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openModal', () => {
                var modal = new bootstrap.Modal(document.getElementById('add-stock-modal'));
                modal.show();
            });
        });
    </script>


    <script>
        let index = 1;
        document.getElementById('add-lecon').addEventListener('click', function() {
            const container = document.getElementById('lecon-container');
            const newItem = document.createElement('div');
            newItem.classList.add('lecon-item', 'mb-4');
            newItem.innerHTML = `
            <input type="text" name="lecons[${index}][titre]" placeholder="Titre" required class="form-control mb-2">
            <input type="text" name="lecons[${index}][sous_titre]" placeholder="Sous-titre" class="form-control mb-2">
            <textarea name="lecons[${index}][description]" placeholder="Description" class="form-control"></textarea>
        `;
            container.appendChild(newItem);
            index++;
        });
    </script>
</div>
