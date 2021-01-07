<div class="card mt-5">
    <!-- /head -->
    <div class="card-body">
        <h1 class="text-dark text-center">Valider ma commande</h1>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <div class="nav-link  {{ $currentStep == 1 ? 'active' : '' }}">Étape 1 <br> <small>Adresse de livraison</small></div>
            </li>
            <li class="nav-item d-none d-md-block">
                <div class="nav-link {{ $currentStep == 2 ? 'active' : '' }}">Étape 2 <br> <small>Heure & date de livraison</small></div>
            </li>
            <li class="nav-item d-none d-md-block">
                <div class="nav-link {{ $currentStep == 3 ? 'active' : '' }}">Étape 3 <br> <small>Finalisation</small></div>
            </li>
        </ul>
        <hr>
        @if ($currentStep == 1)
            <div class="row">
                <div class="col-md-6 py-3">
                    @include('resto2web::layout.alerts')
                        <div class="form-group">
                            {{ Form::label('name','Nom') }}
                            {{ Form::text('name',null,['class'=> 'form-control','wire:model'=> 'name']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email','Adresse email') }}
                            {{ Form::email('email',null,['class'=> 'form-control','wire:model'=> 'email']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_number','Numéro de téléphone') }}
                            {{ Form::text('phone_number',null,['class'=> 'form-control','wire:model'=> 'phone_number']) }}
                        </div>
                    @guest()

                    Vous avez un compte ? <a
                            href="{{ route('login',['back_to'=> route('checkout.index')]) }}">Connectez-vous</a>
                    @endguest
                    @if (\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::isDelivery())
                        <p class="h5">Coordonnées de livraison </p>
                        @if (Auth::user())
                            Adresses enregistrées
{{--                            @include('pages.checkout._authDeliveryAddress')--}}
                        @else
                            {{--                                                @include('pages.checkout._deliveryAddress')--}}
                            Vous avez un compte ? <a
                                href="{{ route('login',['back_to'=> route('checkout.step1.index')]) }}">Connectez-vous</a>
                        @endif
                    @endif

                </div>
                <div class="col-md-6 py-3">
                    @include('resto2web::pages.checkout.partials._cartContent')
                    <button type="submit" class="btn btn-primary btn-block d-md-none mt-3"><i
                            class="fa fa-chevron-right"></i> Heure et date de livraison
                    </button>
                </div>
                <div class="col-12 pt-3">
                    <button wire:click='continue' class="btn btn-primary btn-block d-none d-md-block"><i
                            class="fa fa-chevron-right"></i> Heure et date de livraison
                    </button>
                </div>
            </div>
        @endif
        @if ($currentStep == 2)
            <div class="row">
                <div class="col-12 pt-3">
                    <button wire:click='continue' class="btn btn-primary btn-block d-none d-md-block"><i
                            class="fa fa-chevron-right"></i> Heure et date de livraison
                    </button>
                </div>
            </div>
        @endif
        @if ($currentStep == 3)
            <div class="row">
                Step 3
            </div>
        @endif
    </div>
</div>
