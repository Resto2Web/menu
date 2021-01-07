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
                <div class="mb-2">
                    <div class="d-flex justify-content-between">

                        <div>
                            {{ $content->qty }} x {{ $content->model->name }}
                            - {{ formatPrice($content->price * $content->qty) }}
                        </div>
                        {{--                    @include('pages.menu.partials.cartContent.__cartItemActions')--}}
                    </div>
                </div>
            @endif
            {{--                                        @if ($content->associatedModel == \App\Domain\Menus\Models\Meals::class)--}}
            {{--                                            @include('pages.menu.partials.cartContent._menuCartItem')--}}
            {{--                                        @endif--}}
        @endforeach

        <div class="mb-2">
            Livraison -
            {{--                                        @if(delivery($restaurant)==0)--}}
            {{--                                            gratuite--}}
            {{--                                        @else--}}
            {{--                                            {{ formatPrice($restaurant->delivery_price) }} <br>--}}
            {{--                                            @if ($restaurant->free_delivery_min > 0)--}}
            {{--                                                <span class="font-sm text-muted">--}}
            {{--                                    (offerte à partir de {{ formatPrice($restaurant->free_delivery_min) }})--}}
            {{--                                </span>--}}
            {{--                                            @endif--}}
            {{--                                        @endif--}}
        </div>
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
