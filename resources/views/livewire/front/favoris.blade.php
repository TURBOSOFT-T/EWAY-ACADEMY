
<div id="content">
   
    <style>
        #favoris {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #favoris td, #favoris th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #favoris tr:nth-child(even){background-color: #f2f2f2;}
        
        #favoris tr:hover {background-color: #ddd;}
        
        #favoris th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #04AA6D;
          color: white;
        }
        </style>

    <div class="wishlist">
        <div class="container">
            <div class="wishlist__table">
                <div class="wishlist__table__wrapper">
                    <table class="favoris">
                        <colgroup>
                            <col style="width: 30%" />
                            <col style="width: 30%" />

                            <col style="width: 10%" />
                            <col style="width: 20%" />
                            <col style="width: 30%" />
                        </colgroup>
                        <thead  style=" background-color: #b2e21522;">
                            <tr>
                                <th style="width: 80px;">Image produit</th>
                                <th class="product-thumbnail">Date d'ajout</th>

                                <th class="cart-product-name">Prix</th>
                                <th class="product-quantity">Statut</th>
                                <th class="product-remove">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($favoris as $key => $favo)
                            <tr>
                                <td>
                                    <div class="wishlist-product">
                                        <div class="wishlist-product__image"> <img
                                                src="{{ Storage::url($favo->produit->photo) }}"
                                                alt=" {{ $favo->produit->nom }}" srcset=""></div>
                                        <div class="wishlist-product__content">
                                            <a 
                                                href="{{ route('details-produits', ['id' => $favo->produit->id, 'slug'=>Str::slug(Str::limit($favo->produit->nom, 10))]) , }}"> {{
                                                $favo->produit->nom }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-primary">
                                    {{ $favo->created_at }}
                                </td>

                                <td>
                                    {{ $favo->produit->getPrice() }} DT
                                </td>
                                <td>
                                    @if ($favo->produit->stock > 0)
                                                <label class="badge bg-success"> Disponible</label>
                                            @else
                                                <label class="badge bg-danger"> Indisponible</label>
                                            @endif
        
                                    {{-- {{ $favo->produit->statut }} --}}
                                </td>
                                <td>
                                    <button type="button" class=" btn-dark"
                                        onclick="AddToCart( {{ $favo->produit->id }} )"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" style=" background-color: #b2e21522;"
                                            height="15" fill="currentColor">
                                            <path
                                                d="M4.00488 16V4H2.00488V2H5.00488C5.55717 2 6.00488 2.44772 6.00488 3V15H18.4433L20.4433 7H8.00488V5H21.7241C22.2764 5 22.7241 5.44772 22.7241 6C22.7241 6.08176 22.7141 6.16322 22.6942 6.24254L20.1942 16.2425C20.083 16.6877 19.683 17 19.2241 17H5.00488C4.4526 17 4.00488 16.5523 4.00488 16ZM6.00488 23C4.90031 23 4.00488 22.1046 4.00488 21C4.00488 19.8954 4.90031 19 6.00488 19C7.10945 19 8.00488 19.8954 8.00488 21C8.00488 22.1046 7.10945 23 6.00488 23ZM18.0049 23C16.9003 23 16.0049 22.1046 16.0049 21C16.0049 19.8954 16.9003 19 18.0049 19C19.1095 19 20.0049 19.8954 20.0049 21C20.0049 22.1046 19.1095 23 18.0049 23Z">
                                            </path>
                                        </svg>
                                    </button>

                                    &nbsp;
                                    &nbsp;

                                    <button class=" remove-from-cart" wire:click="delete({{  $favo->id }})">
                                   
                                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15"   style="background-color: #b2e21522; fill:#f80a0a;"
                                            height="15" fill="currentColor">
                                            <path
                                                d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM13.4142 11L15.8891 8.52513L14.4749 7.11091L12 9.58579L9.52513 7.11091L8.11091 8.52513L10.5858 11L8.11091 13.4749L9.52513 14.8891L12 12.4142L14.4749 14.8891L15.8891 13.4749L13.4142 11Z">
                                            </path>
                                        </svg> 
                                           </button>




                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6 ">
                                    <div class="text-center p-5"><svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" width="120" height="120" fill="currentColor">
                                            <path
                                                d="M12.001 4.52853C14.35 2.42 17.98 2.49 20.2426 4.75736C22.5053 7.02472 22.583 10.637 20.4786 12.993L11.9999 21.485L3.52138 12.993C1.41705 10.637 1.49571 7.01901 3.75736 4.75736C6.02157 2.49315 9.64519 2.41687 12.001 4.52853ZM18.827 6.1701C17.3279 4.66794 14.9076 4.60701 13.337 6.01687L12.0019 7.21524L10.6661 6.01781C9.09098 4.60597 6.67506 4.66808 5.17157 6.17157C3.68183 7.66131 3.60704 10.0473 4.97993 11.6232L11.9999 18.6543L19.0201 11.6232C20.3935 10.0467 20.319 7.66525 18.827 6.1701Z">
                                            </path>
                                        </svg> <br>
                                        <h5>
                                            Vous n'avez de favoris pas pour l'instant.
                                        </h5>
                                    </div>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>