<div class="mb-2">
    @if ($cartItem)
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
                    <strong>{{ formatPrice($cartItem->price * $cartItem->qty) }}</strong>
                </div>
            @else
                <div class="align-self-center">
                    {{ $cartItem->qty }} x {{ $cartItem->model->name }}
                    - <strong>{{ formatPrice($cartItem->price * $cartItem->qty) }}</strong>
                </div>
            @endif

            <div style="min-width: 100px" class="text-right align-self-center">
                <button wire:loading.class="disabled" type="button" wire:click="addOne" style="font-size: 120%" class="btn text-success btn-link p-0">
                    <i class="far fa-plus-circle"></i></button>
                <button wire:loading.class="disabled" type="button" wire:click="removeOne" style="font-size: 120%" class="btn btn-link p-0"><i
                        class="far fa-minus-circle"></i></button>
                <button wire:loading.class="disabled" type="button" wire:click="removeFromCart" style="font-size: 120%" class="btn btn-link pl-2 p-0">
                    <i
                        class="fa fa-times-circle"></i></button>
            </div>
        </div>
    @endif
</div>
