<div class="row" id="main-content">
    <div class="col-lg-8">
        <div class="card">
            <!-- /head -->
            <div class="card-body">
                <h1 class="text-dark text-center">Valider ma commande</h1>
                {{--        <ul class="nav nav-pills nav-fill">--}}
                {{--            <li class="nav-item">--}}
                {{--                <div class="nav-link  {{ $currentStep == 1 ? 'active' : '' }}">Étape 1 <br> <small>Adresse de--}}
                {{--                        livraison</small></div>--}}
                {{--            </li>--}}
                {{--            <li class="nav-item d-none d-md-block">--}}
                {{--                <div class="nav-link {{ $currentStep == 2 ? 'active' : '' }}">Étape 2 <br> <small>Heure & date de--}}
                {{--                        livraison</small></div>--}}
                {{--            </li>--}}
                {{--            <li class="nav-item d-none d-md-block">--}}
                {{--                <div class="nav-link {{ $currentStep == 3 ? 'active' : '' }}">Étape 3 <br> <small>Finalisation</small>--}}
                {{--                </div>--}}
                {{--            </li>--}}
                {{--        </ul>--}}
                <hr>
                @if ($currentStep == 1)
                    <div class="row">
                        <div class="col-12">
                            @include('resto2web::layout.alerts')
                            @guest()
                                <div class="alert alert-primary">
                                    Vous avez un compte ? <a
                                        href="{{ route('login',['back_to'=> route('checkout.index')]) }}">Connectez-vous</a>
                                </div>
                            @endguest
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('firstName','Prénom') }}
                                {{ Form::text('firstName',null,['class'=> 'form-control','wire:model'=> 'firstName']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Nom') }}
                                {{ Form::text('lastName',null,['class'=> 'form-control','wire:model'=> 'lastName']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('email','Adresse email') }}
                                {{ Form::email('email',null,['class'=> 'form-control','wire:model'=> 'email']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone_number','Numéro de téléphone') }}
                                {{ Form::text('phone_number',null,['class'=> 'form-control','wire:model'=> 'phone_number']) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @if (\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::isDelivery())
                            <div class="col-12"><p class="h5">Coordonnées de livraison </p></div>
                            @if (Auth::user())
                                <div class="col-12">
                                    //TODO adresses enregistées
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('address','Adresse') }}
                                        {{ Form::text('address',null,['class'=> 'form-control','wire:model'=> 'address']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('city','Ville') }}
                                        {{ Form::text('city',null,['class'=> 'form-control','wire:model'=> 'city']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('postal_code','Code postal') }}
                                        {{ Form::text('postal_code',null,['class'=> 'form-control','wire:model'=> 'postal_code']) }}
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="form-group">
                                        {{ Form::label('address','Adresse') }}
                                        {{ Form::text('address',null,['class'=> 'form-control','wire:model'=> 'address']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('city','Ville') }}
                                        {{ Form::text('city',null,['class'=> 'form-control','wire:model'=> 'city']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('postal_code','Code postal') }}
                                        {{ Form::text('postal_code',null,['class'=> 'form-control','wire:model'=> 'postal_code']) }}
                                    </div>
                                </div>
                            @endif

                        @endif
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-row mb-4">
                                <div class="col-md-6">
                                    <button class="btn btn-block  btn-{{ $schedule ? 'outline-' : '' }}primary"
                                            wire:click="$set('schedule',false)">
                                        Dès que possible
                                    </button>
                                </div>
                                <div class="col-md-6">

                                    <button class="btn btn-block btn-{{ $schedule ? '' : 'outline-' }}primary"
                                            wire:click="$set('schedule',true)">
                                        Prévoir ma commande pour plus tard
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if ($schedule)
                            <div class="col-md-12">
                                Sélectionner une date & une heure
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div id="sidebar" class="col-lg-4 sidebar p-0">
        <div class="" id="sidebar__inner">
            <div class="card">
                <div class="card-body">
                    @livewire('website.components.cart-sidebar',['checkout'=> true])
                </div>
            </div>
        </div>
    </div>
</div>


