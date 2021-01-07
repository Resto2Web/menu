<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Personnalisez {{ $meal->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if ($displayWarning)
            <div class="alert alert-primary">
                Vous avez déjà commencé une commande dans un autre restaurant. En ajoutant cet item, votre panier sera remplacé.
                <br>
                <button type="button" class="btn btn-light" wire:click="addToCart">J'ai compris</button>
            </div>
        @endif
        @foreach ($meal->optionsGroups as $optionGroup)
            @if ($optionGroup->mealOptions->count())
                <h4>{{ $optionGroup->name }}</h4>
                <div class="form-group">
                    @if ($optionGroup->type == \Resto2web\Menu\Domain\Meals\Models\MealOptionGroup::OR)
                        <select name="selectedOptions.{{ $optionGroup->id }}" class="form-control" id="selectedOptions.{{ $optionGroup->id }}" wire:model="selectedOptions.{{ $optionGroup->id }}">
                            @if (!$optionGroup->required)
                                <option value="" >Aucun</option>
                            @endif
                            @foreach ($optionGroup->mealOptions as $mealOption)
                                <option value="{{ $mealOption->id }}">
                                    {{ $mealOption->name }} {{ $mealOption->price ? "(+ ".formatPrice($mealOption->price).")":  '' }}
                                </option>
                            @endforeach
                        </select>
                    @elseif ($optionGroup->type == \Resto2web\Menu\Domain\Meals\Models\MealOptionGroup::AND)
                        @foreach ($optionGroup->mealOptions as $mealOption)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" wire:model="selectedOptions.{{ $optionGroup->id }}.{{ $mealOption->id }}" name="selectedOptions.{{ $mealOption->id }}.{{ $mealOption->id }}" id="option{{ $mealOption->id }}">
                                <label class="custom-control-label"
                                       for="option{{ $mealOption->id }}">{{ $mealOption->name }} {{ $mealOption->price ? "(+ ".formatPrice($mealOption->price).")":  '' }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif

        @endforeach
            <strong class="h4 text-primary mb-0">{{ formatPrice($total) }}</strong>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" wire:click="addToCart">Ajouter</button>
    </div>
</div>
