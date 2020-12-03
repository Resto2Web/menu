@extends('resto2web::layout.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>
        <div class="bg-checkout w-100">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mt-5">
                            <!-- /head -->
                            <div class="card-body">
                                <h1 class="text-dark text-center">Valider ma commande</h1>
                                <ul class="nav nav-pills nav-fill">
                                    <li class="nav-item">
                                        <div class="nav-link active">Étape 1 <br> <small>Adresse de livraison</small></div>
                                    </li>
                                    <li class="nav-item d-none d-md-block">
                                        <div class="nav-link" >Étape 2 <br> <small>Heure & date de livraison</small></div>
                                    </li>
                                    <li class="nav-item d-none d-md-block">
                                        <div class="nav-link" >Étape 3 <br> <small>Finalisation</small></div>
                                    </li>
                                </ul>
                                <hr>
                                <form action="{{ route('checkout.step1.store') }}" method="post" id="checkoutForm" class="form-validate">
                                    <div class="row">
                                        <div class="col-md-6 py-3">
                                            @csrf
                                            //sélection à emporter ou à livrer
                                            <br>
                                            //adresse si livrer
                                            <br>
                                            // email / tel
                                            <p class="h5">Coordonnées de livraison </p>
                                            @if (Auth::user())
{{--                                                @include('pages.checkout._authDeliveryAddress')--}}
                                            @else
{{--                                                @include('pages.checkout._deliveryAddress')--}}
                                                Vous avez un compte ? <a href="{{ route('login',['back_to'=> route('checkout.step1.index')]) }}">Connectez-vous</a>
                                            @endif
                                        </div>
                                        <div class="col-md-6 py-3">
                                            @include('resto2web::pages.checkout.partials._cartContent')
                                            <button type="submit" class="btn btn-primary btn-block d-md-none mt-3"><i class="fa fa-chevron-right"></i> Heure et date de livraison
                                            </button>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <button type="submit" class="btn btn-primary btn-block d-none d-md-block"><i class="fa fa-chevron-right"></i> Heure et date de livraison
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /box_booking -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
