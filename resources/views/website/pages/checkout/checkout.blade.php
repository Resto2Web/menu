@extends('resto2web::layout.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>
        <div class="bg-checkout w-100">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @livewire('website.components.checkout')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
