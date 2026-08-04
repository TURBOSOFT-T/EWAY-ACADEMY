<div id="content">

    <div class="shop">
        <div class="container">
            <div class="cart">
                <div class="container">
                    <div class="cart__table">
                        <div class="cart__table__wrapper">
                            <table>
                                <colgroup>
                                    <col style="width: 20%" />
                                    <col style="width: 17%" />
                                    <col style="width: 17%" />
                                    <col style="width: 5%" />
                                    <col style="width: 9%" />
                                    <col style="width: 5%" />
                                </colgroup>
                                <thead style=" background-color: #b2e21522;">
                                    <tr>
                                        <th>Image</th>
                                        <th>Produit</th>
                                        <th>Prix U.</th>
                                        <th>Qté</th>
                                        <th>Total</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($paniers ?? [] as $id => $details)
                                        <tr data-id="{{ $id }}">

                                            <td class="cart-product">
                                                <div class="cart-product__image">
                                                    <a
                                                       
                                                       href="{{ route('details-produits', ['id' => $details['id_produit'], 'slug'=>Str::slug(Str::limit($details['nom'], 10))]) , }}">
                                                        <img src="{{ Storage::url($details['photo']) }}" height="40"
                                                            width="40" alt="Image du  produit">
                                                    </a>
                                                </div>
                                            </td>
                                            <style>
                                                h4 {
                                                    text-align: left;
                                                }
                                            </style>
                                            <td data-th="Product text-center" style="text-align:center">
                                                <div class="row">
                                                    <div class="col-sm-1 text-center">
                                                        <h4 style="text-align:center">
                                                          
                                                                {{ $details['nom'] }}
                                                            
                                                        </h4>
                                                    </div>
                                                </div>

                                            </td>
                                            <td> {{ $details['prix'] }} DT</td>
                                            <td>
                                                <style>
                                                    input {

                                                        left: 10px;
                                                        top: 10px;
                                                        width: 50px;
                                                        height: 20px;

                                                        padding: 2px;
                                                        font-size: 12pt;
                                                        border: solid 0px #f7f4f4;
                                                        z-index: 1;
                                                        text-align: center;
                                                    }
                                                </style>
                                                <div class="quantity-controller ">
                                                    <div class="quantity-controller__btn -descrease"
                                                        wire:click="update({{ $details['id_produit'] }},{{ $details['quantite'] - 1 }})">
                                                        -</div>
                                                    <div class="quantity-controller__number">
                                                        
                                                        <input type="number" value="{{ $details['quantite'] }}">
                                                    </div>
                                                    <div class="quantity-controller__btn -increase"
                                                        wire:click="update({{ $details['id_produit'] }},{{ $details['quantite'] + 1 }})">
                                                        +</div>
                                                </div>
                                            </td>
                                            <td data-th="Subtotal" class="text-center">
                                                {{ $details['prix'] * $details['quantite'] }}
                                                DT
                                            </td>
                                            <style>

                                            </style>
                                            <td class="actions" data-th="">
                                                <button class=" remove-from-cart  .btn-danger"
                                                    wire:click="delete({{ $details['id_produit'] }})">
                                                  
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="15" style=" fill:#f80a0a;" height="15"
                                                        fill="currentColor">
                                                        <path
                                                            d="M6.45455 19L2 22.5V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V18C22 18.5523 21.5523 19 21 19H6.45455ZM13.4142 11L15.8891 8.52513L14.4749 7.11091L12 9.58579L9.52513 7.11091L8.11091 8.52513L10.5858 11L8.11091 13.4749L9.52513 14.8891L12 12.4142L14.4749 14.8891L15.8891 13.4749L13.4142 11Z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center p-5">
                                                    <img width="64" height="64"
                                                        src="https://img.icons8.com/pastel-glyph/64/578b07/shopping-cart--v2.png"
                                                        alt="shopping-cart--v2" /><br>

                                                    <h6>
                                                        Vous n'avez pas de produits dans le panier.
                                                    </h6>
                                                    <br>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="cart__table__footer"><a href="{{ url('shop') }}"><i
                                    class="fal fa-long-arrow-left"></i>Continuer les achats</a>
                            
                        </div>
                    </div>
                    <div class="cart__total">
                        <div class="row">
                            <div class="col-12 col-md-8">

                            </div>
                            <div class="col-12 col-md-4">
                                <div class="cart__total__content">
                                    <h3>Panier</h3>
                                    <table>
                                        @if ($total > 0)
                                            <tbody>


                                                <tr>
                                                    <th>Total:</th>
                                                    <td class="final-price">{{ $total }} DT</td>
                                                </tr>
                                            </tbody>
                                           
                                          

                                        @endif

                                    </table>
                                    @if ($total > 0)
                                     <a class="btn -dark" href="{{ url('/commander') }}">Commander</a> 
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
