@foreach (Cart::content() as $content)
    {{--                                        @if ($content->associatedModel == \App\Domain\Gifts\Models\Gift::class)--}}
    {{--                                            @include('pages.menu.partials.cartContent._giftCartItem')--}}
    {{--                                        @endif--}}
    @if ($content->associatedModel == \Resto2web\Menu\Domain\Menu\Models\Meal::class)
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
    {{--                                        @if ($content->associatedModel == \App\Domain\Menus\Models\Menu::class)--}}
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
        TOTAL - {{ formatPrice($totalWithDelivery) }}
    </div>
</div>
