@foreach (Cart::content() as $cartItem)
    {{--                                        @if ($cartItem->associatedModel == \App\Domain\Gifts\Models\Gift::class)--}}
    {{--                                            @include('pages.menu.partials.cartContent._giftCartItem')--}}
    {{--                                        @endif--}}
    @if ($cartItem->associatedModel == \Resto2web\Menu\Domain\Meals\Models\Meal::class)
        <div class="mb-2">
            <div class="d-flex justify-content-between">
                @if (count($cartItem->options))
                    <div class="align-self-center">
                        {{ $cartItem->qty }} x {{ $cartItem->model->name }} <br>
                        @foreach ($cartItem->options as $key => $option)
                            @if (is_array($option))
                                @php($displayOptionGroup = \Resto2web\Menu\Domain\Meals\Models\MealOptionGroup::findOrFail($key))
                                @foreach ($option as $optionId => $value)
                                    @if ($value)
                                        @php($displayOption = \Resto2web\Menu\Domain\Meals\Models\MealOption::findOrFail($optionId))
                                        + {{ $displayOption->name }} <br>
                                    @endif
                                @endforeach
                            @else
                                @php($displayOption = \Resto2web\Menu\Domain\Meals\Models\MealOption::findOrFail($option))
                                <p class="mb-0">+ {{ $displayOption->name }}</p>
                            @endif
                        @endforeach
                    </div>
                    <div class="align-self-center"><strong>{{ formatPrice($cartItem->price * $cartItem->qty) }}</strong></div>

                @else
                    <div class="align-self-center">
                        {{ $cartItem->qty }} x {{ $cartItem->model->name }}
                    </div>
                    <div class="align-self-center"><strong>{{ formatPrice($cartItem->price * $cartItem->qty) }}</strong></div>
                @endif
            </div>
        </div>
    @endif
    {{--                                        @if ($cartItem->associatedModel == \App\Domain\Menus\Models\Meals::class)--}}
    {{--                                            @include('pages.menu.partials.cartContent._menuCartItem')--}}
    {{--                                        @endif--}}
@endforeach

<div class="mb-2">
    @if (\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::isDelivery())
        Livraison - {{ formatPrice(\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::getDeliveryPrice()) }}
    @endif
    @if (\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::isTakeaway())
        A emporter
    @endif
</div>
<div class="d-flex justify-content-between mt-2">
    <div>
        TOTAL - {{ formatPrice(\Resto2web\Menu\Domain\Utility\Helpers\CartOrderHelper::getTotal()) }}
    </div>
</div>
