<div class="">
    <div class="card">
        <div class="card-header">
            <div class=" align-items-center justify-content-between d-flex">

                <h4 class="mb-0">
                    <i class="fa fal fa-address-card"></i>
                    <span>Infos de livraison</span>
                </h4>
                @unless ($edit)
                    <button class="btn btn-primary" wire:click="toggleEdit"><i class="fa fa-edit"></i> Editer</button>
                @endunless
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                @if ($edit)
                    <div class="col-md">
                        <div class="row form-row mb-4">
                            <div class="col-md-6">
                                <button class="btn btn-block  btn-{{ $type == 'delivery' ? '' : 'outline-' }}primary"
                                        wire:click="$set('type','delivery')">
                                    Livraison
                                </button>
                            </div>
                            <div class="col-md-6">

                                <button class="btn btn-block btn-{{ $type == 'delivery' ? 'outline-' : '' }}primary"
                                        wire:click="$set('type','takeaway')">
                                    A emporter
                                </button>
                            </div>
                            @if ($hasFreeDeliveryMinimum && !\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery())
                                <span class="font-sm text-muted">
                                    livraison offerte à partir de {{ formatPrice($freeDeliveryMinimum) }}
                                </span>
                            @endif
                        </div>
                        <div class="">
                            @if ($type == 'delivery')
                                <div class="d-flex justify-content-between">
                                    <div>Livraison</div>
                                    <div>
                                        {{ \Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery() ? 'gratuite' : formatPrice($deliveryPrice) }}
                                    </div>
                                </div>
                                <div class="d-flex ">
                                    <div class="row">
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
                                    </div>
                                </div>


                                @if ($hasFreeDeliveryMinimum && !\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery())
                                    <span class="font-sm text-muted">
                                    livraison offerte à partir de {{ formatPrice($freeDeliveryMinimum) }}
                                </span>
                                @endif
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-md">
                        @if ($order->type == 'delivery')
                            <p class="h3">A livrer</p>
                            <ul class="list-unstyled">
                                <li>
                                    {{ $order->address }}
                                </li>
                                <li>
                                    {{ $order->postal_code }}
                                </li>
                            </ul>
                        @elseif ($order->type == 'takeaway')
                            <p class="h5">A emporter</p>
                        @endif
                    </div>
                    <div class="col-md">
                        <p> le {{$order->date->format('d/m/Y')}}<br>
                            <span class="h3"><span>{{ $order->dateText }}</span></span>
                            à <span class="h3">{{$order->time->format('H:i')}}</span>
                        </p>
                        <p class="mb-0">
                            Paiement {{ strtolower($order->paiement_method_text) }}
                        </p>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
