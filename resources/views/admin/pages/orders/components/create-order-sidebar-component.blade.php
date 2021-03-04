<div>
    @if (Cart::count() > 0)
        @if (Cart::subtotal() < $minimumOrder)
            <div class="alert alert-danger">
                En dessous du minimum de commande {{ formatPrice($minimumOrder) }}
            </div>
        @endif
        @foreach (Cart::content() as $content)
            {{--                                        @if ($content->associatedModel == \App\Domain\Gifts\Models\Gift::class)--}}
            {{--                                            @include('pages.menu.partials.cartContent._giftCartItem')--}}
            {{--                                        @endif--}}
            @if ($content->associatedModel == \Resto2web\Menu\Domain\Meals\Models\Meal::class)
                @livewire('website.components.cart.meal-item',compact('content'),key($content->id))
            @endif
            {{--                                        @if ($content->associatedModel == \App\Domain\Menus\Models\Meals::class)--}}
            {{--                                            @include('pages.menu.partials.cartContent._menuCartItem')--}}
            {{--                                        @endif--}}
        @endforeach
        <hr>
            <div class="d-flex ">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('first_name','Prénom') }}
                            {{ Form::text('first_name',null,['class'=> 'form-control','wire:model'=> 'first_name']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('last_name','Nom') }}
                            {{ Form::text('last_name',null,['class'=> 'form-control','wire:model'=> 'last_name']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('phone_number','Numéro de téléphone') }}
                            {{ Form::text('phone_number',null,['class'=> 'form-control','wire:model'=> 'phone_number']) }}
                        </div>
                    </div>
                </div>
            </div>
        @if ($onlyDelivery)
            <div>
                <div class="">
                    Livré
                    ({{ \Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery() ? 'gratuite' : formatPrice($deliveryPrice) }}
                    )
                    @if ($hasFreeDeliveryMinimum && !\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery())
                        <span class="font-sm text-muted">
                                    livraison offerte à partir de {{ formatPrice($freeDeliveryMinimum) }}
                                </span>
                    @endif
                </div>

            </div>
            <hr>
        @elseif ($onlyTakeaway)
            A emporter
        @else

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

            @if (\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::isDelivery())
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
        @endif


        <div class="d-flex justify-content-between mt-2">
            <p>
                TOTAL
            </p>
            <p>{{ formatPrice($this->totalWithDelivery) }}</p>
        </div>
    @else
        <p>La commande est actuellement vide</p>
    @endif
    @if ($this->canCheckout)
        <a wire:click="checkout" href="#"
           class="btn btn-block btn-primary"> Finaliser la commande</a>
    @else
        <a href="#" class="btn disabled btn-block btn-primary">
            Enregistrer la commande</a>
    @endif
</div>
