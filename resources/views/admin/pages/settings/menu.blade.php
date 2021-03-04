@extends('resto2web-admin::layout.layout')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.settings.index') }}">Paramètres</a>
    </li>
    <li class="breadcrumb-item active">
        Paramètres de menu
    </li>
@endsection

@section('content')
    @include('resto2web-admin::pages.settings.partials.topMenu')

    <form action="{{ route('admin.settings.menu') }}" method="post" class="form-validate">
        @method("PATCH")
        @csrf
        @include('resto2web-admin::layout.alerts')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Paramètres de commande</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('minimumOrder','Montant minimal de commande') !!}
                            {!! Form::number('minimumOrder',$settings->minimumOrder, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="delivery"
                                       id="delivery" {{ old('delivery', $settings->delivery ? 'checked' : '') }}>
                                <label class="custom-control-label" for="delivery">Livraison à domicile</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="takeaway"
                                       id="takeaway" {{ old('takeaway', $settings->takeaway ? 'checked' : '') }}>
                                <label class="custom-control-label" for="takeaway">A emporter</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('deliveryPrice','Prix de la livraison') !!}
                            {!! Form::number('deliveryPrice',$settings->deliveryPrice, ['class'=> 'form-control']) !!}
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="hasFreeDeliveryMinimum"
                                   id="hasFreeDeliveryMinimum" {{ old('hasFreeDeliveryMinimum', $settings->hasFreeDeliveryMinimum ? 'checked' : '') }}>
                            <label class="custom-control-label" for="hasFreeDeliveryMinimum">Livraison gratuite à partir d'un certain montant</label>
                        </div>
                        <div class="form-group">
                            {!! Form::label('freeDeliveryMinimum','Montant pour livraison gratuite') !!}
                            {!! Form::number('freeDeliveryMinimum',$settings->freeDeliveryMinimum, ['class'=> 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Modes de paiements possibles</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="cashOnDelivery"
                                       id="cashOnDelivery" {{ old('cashOnDelivery', $paymentsSettings->cashOnDelivery ? 'checked' : '') }}>
                                <label class="custom-control-label" for="cashOnDelivery">En liquide à la réception de la commande</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="cardOnDelivery"
                                       id="cardOnDelivery" {{ old('cardOnDelivery', $paymentsSettings->cardOnDelivery ? 'checked' : '') }}>
                                <label class="custom-control-label" for="cardOnDelivery">Par carte à la réception de la commande</label>
                            </div>
                            <div class="pl-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="acceptsBancontact"
                                           id="acceptsBancontact" {{ old('acceptsBancontact', $paymentsSettings->acceptsBancontact ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="acceptsBancontact">Accepte Banconctact</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="acceptsVisa"
                                           id="acceptsVisa" {{ old('acceptsVisa', $paymentsSettings->acceptsVisa ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="acceptsVisa">Accepte Visa</label>
                                </div>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="online"
                                       id="online" {{ old('online', $paymentsSettings->online ? 'checked' : '') }}>
                                <label class="custom-control-label" for="online">En ligne</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">

                <div class="text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregister les modifications</button>
                </div>
            </div>
        </div>
    </form>
@endsection
