<div>
    @if (Cart::count() > 0)
        @if (Cart::subtotal() < $minimumOrder)
            <div class="alert alert-danger">
                Il y a un minimum de {{ formatPrice($minimumOrder) }} de commande (hors frais de
                livraison)
            </div>
        @endif
        @foreach (Cart::content() as $content)
            {{--                                        @if ($content->associatedModel == \App\Domain\Gifts\Models\Gift::class)--}}
            {{--                                            @include('pages.menu.partials.cartContent._giftCartItem')--}}
            {{--                                        @endif--}}
            @if ($content->associatedModel == \Resto2web\Menu\Domain\Meals\Models\Meal::class)
                @livewire('website.components.cart.meal-item',compact('content'))
            @endif
            {{--                                        @if ($content->associatedModel == \App\Domain\Menus\Models\Meals::class)--}}
            {{--                                            @include('pages.menu.partials.cartContent._menuCartItem')--}}
            {{--                                        @endif--}}
        @endforeach

        @if ($onlyDelivery)
            <div>
                <div class="">
                    Livré chez moi ({{ \Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery() ? 'gratuite' : formatPrice($deliveryPrice) }})
                    @if ($hasFreeDeliveryMinimum && !\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery())
                        <span class="font-sm text-muted">
                                    livraison offerte à partir de {{ formatPrice($freeDeliveryMinimum) }}
                                </span>
                    @endif
                </div>

            </div>
        @elseif ($onlyTakeaway)
            A emporter
        @else
            <div>
                <div class="">
                    <button class="btn btn-block btn-{{ $type == 'delivery' ? '' : 'outline-' }}primary" wire:click="$set('type','delivery')">
                        Livré chez moi ({{ \Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery() ? 'gratuite' : formatPrice($deliveryPrice) }})
                    </button>
                    <button class="btn btn-block btn-{{ $type == 'delivery' ? 'outline-' : '' }}primary" wire:click="$set('type','takeaway')">
                        A emporter
                    </button>
                    @if ($hasFreeDeliveryMinimum && !\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::hasFreeDelivery())
                        <span class="font-sm text-muted">
                                    livraison offerte à partir de {{ formatPrice($freeDeliveryMinimum) }}
                                </span>
                    @endif
                </div>

            </div>
        @endif



        <div class="d-flex justify-content-between mt-2">
            <div>
                TOTAL - {{ formatPrice($this->totalWithDelivery) }}
            </div>
        </div>
    @else
        <p>Votre panier est actuellement vide</p>
    @endif
    @if ($this->canCheckout)
                <a href="{{ route('checkout.index') }}"
                   class="btn btn-block btn-primary"> Finaliser ma commande</a>
    @else
        <a href="#" class="btn disabled btn-block btn-primary">
            Finaliser ma commande</a>
    @endif
</div>
