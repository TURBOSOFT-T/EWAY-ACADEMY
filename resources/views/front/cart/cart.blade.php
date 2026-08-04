@extends('front.fixe')
@section('titre', 'Mon panier')
@section('body')
    <main>
        <div class="breadcrumb">
            <div class="container">
                <h2>Mon panier</h2>

            </div>
        </div>
        <!-- Cart area start-->
        <section class="cart-area pt-150 pb-150">

            <div class="container">
                <div class="row ">
                    <div class="col-12 cart">

                        @livewire('Front.Panier')

                    </div>
                </div>
        </section>
    </main>
@endsection
