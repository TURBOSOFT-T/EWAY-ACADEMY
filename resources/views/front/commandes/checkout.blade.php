@extends('front.fixe')
@section('titre', 'Paiement')
@section('body')
<main>

    {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
 {{--    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> --}}
    <div class="breadcrumb">
        <div class="container">
            <h2>Confirmation commande</h2>
          
        </div>
    </div>
    <section class="tp-checkout-area pb-150 pt-150">

        <div class="container">


            <div id="content">
               
                <form action="{{ route('order.confirm') }}" method="post">
                    @if ($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                    @csrf
                    <div class="shop">
                        <div class="container">
                            <div class="checkout">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-lg-8">

                                            <div class="checkout__form">

                                                <div class="checkout__form__shipping">
                                                    <h5 class="checkout-title"> Les addresses de transport</h5>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-validator">
                                                                <label>Vore nom <span>*</span>
                                                                    <input type="text" name="nom"    @if (Auth::user()) value="{{ Auth::user()->nom }}" @endif required/>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-validator">
                                                                <label>Votre prénom<span>*</span>
                                                                    <input type="text" name="prenom"    @if (Auth::user()) value="{{ Auth::user()->prenom }}" @endif required/>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-validator">
                                                                <label>Email<span>*</span>
                                                                    <input type="text" name="email"     @if (Auth::user()) value="{{ Auth::user()->email }}" @endif required/>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <div class="input-validator">
                                                                <label>Addresse <span>*</span>
                                                                    <input type="text" name="addresse" required />
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="input-validator">
                                                                <label>Téléphone <span>*</span>
                                                                    <input class="form-control" type="text"
                                                                        name="phone"  required/>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 p-3">
                                                            <div class="input-validator">
                                                                <label>Gouvernorat <span>*</span>
                                                                    <div class="form-grp">
                                                                        <style>
                                                                            .form-control-ps {
                                                                                display: block !important;
                                                                                padding: 25px;
                                                                                height: 10;
                                                                               
                                                                            }
                                                                        </style>
                                                                        <select
                                                                            class="form-control form-control-ps  p-2 w-100"
                                                                             name="gouvernorat"  style="font-size: 17px; font-weight: bold;">
                                                                            <option value="">Gouvernorat</option>
                                                                            @foreach ($gouvernorats as $gouvernorat)
                                                                            <option value="{{ $gouvernorat }}">
                                                                                {{ $gouvernorat }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-12 ml-auto">
                                                    <div class="checkout__total">

                                                        <div class="checkout__total__price">
                                                            <h5>Votre commande</h5>
                                                            <table>
                                                                <colgroup>
                                                                    <col style="width: 70%" />
                                                                    <col style="width: 30%" />
                                                                </colgroup>
                                                                <tbody>
                                                                    @foreach ($paniers as $id => $details)
                                                                    <tr>
                                                                        <td><span> {{ $details['quantite'] }} x </span>
                                                                            <b>{{ $details['nom'] }}</b>
                                                                        </td>
                                                                        <td>{{ $details['total'] }} DT</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <div class="checkout__total__price__total-count">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <b>Sous total</b>
                                                                            </td>
                                                                            <td><span>{{ $total }} DT</span></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="checkout__total__price__total-count">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><b>Frais de livraison</b></td>
                                                                            <td><span>
                                                                                    <span>{{ $configs->frais ?? 0 }}
                                                                                        DT</span>
                                                                                </span></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                           





                                                            <div class="checkout__total__price__total-count">
                                                                <table>
                                                                    <tbody>
                                                                       
                                                                        <tr>
                                                                            <td>Total</td>
                                                                            <td>{{ $total + $configs->frais ?? 0 }} DT</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <button class="btn -red">Confirmation
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
               
            </div>

    </section>




</main>
<style>
    .nice-select {
        display: none !important;
    }
</style>
@endsection