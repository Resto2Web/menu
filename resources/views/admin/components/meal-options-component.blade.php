<div class="row">

    @foreach ($meal->optionsGroups as $optionGroup)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header position-relative">
                    <div class="pr-3">
                        <input type="text" class="form-control" wire:model="names.{{$optionGroup->id}}" placeholder="Titre ">
                    </div>
                    <button wire:click="deleteOptionGroup('{{ $optionGroup->id }}')" type="button" class="close position-absolute" style="position:absolute;top: 10px;right: 15px;" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">

                    <div class="mb-2">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <select name="" class="form-control" id=""
                                        wire:model="mealOptionGroups.{{ $optionGroup->id }}.type">
                                    <option value="or">Le client peut choisir 1 parmi plusieurs</option>
                                    <option value="and">Le client peut sélectionner plusieurs possibilités</option>
                                </select>
                            </div>
                            @if ($mealOptionGroups[$optionGroup->id]['type'] == 'or')
                                <div class="col-md-6">
                                    <select name="option_group_required" class="form-control" id="option_group_required"
                                            wire:model="mealOptionGroups.{{ $optionGroup->id }}.required">
                                        <option value="1">Obligatoire</option>
                                        <option value="0">Facultatif</option>
                                    </select>
                                </div>
                            @endif

                        </div>
                        <br>
                        <div class="row no-gutters">
                            @foreach ($optionGroup->mealOptions as $mealOption)
                                <div class="col-7">
                                    <input type="text" class="form-control " wire:model="mealOptions.{{ $mealOption->id }}.name">
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" wire:model="mealOptions.{{ $mealOption->id }}.price">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">€</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-danger" type="button" wire:click="deleteOption('{{ $mealOption->id }}')"><i class="fa fa-times"></i></button>
                                </div>
                            @endforeach
                                <p class="mb-0 text-small text-muted">Le prix est un surcout, il est ajouté au prix initial de votre plat</p>
                                <div class="col-md-12">
                                <button class="btn btn-primary" type="button" wire:click="addOption('{{ $optionGroup->id }}')"><i class="fa fa-plus"></i>
                                    Ajouter une possibilité
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ajouter un groupe d'options
                </div>
                <div class="card-body">
                    @include('resto2web-admin::layout.alerts')
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="option_group_name" placeholder="Titre ">
                        <p class="mb-0 text-small text-muted">Indiquez le titre du type de choix par exemple : Sauce,
                            Suppléments ou Entrée, Plats, Dessert </p>
                        <p class="mb-0 text-small text-muted">Les différentes possibilités seront ajoutées par après</p>
                    </div>
                    <div class="row no-gutters form-group">
                        <div class="col-md-6">
                            <select name="option_group_type" class="form-control" id="option_group_type"
                                    wire:model="option_group_type">
                                <option value="or">Le client peut choisir 1 parmi plusieurs</option>
                                <option value="and">Le client peut sélectionner plusieurs possibilités</option>
                            </select>
                        </div>
                        @if ($option_group_type == 'or')
                            <div class="col-md-6">
                                <select name="option_group_required" class="form-control" id="option_group_required"
                                        wire:model="option_group_required">
                                    <option value="true">Le choix est obligatoire</option>
                                    <option value="false">Le choix est facultatif</option>
                                </select>
                            </div>
                        @endif

                    </div>
                    <button class="btn btn-primary" type="button" wire:click="addOptionGroup"><i class="fa fa-plus"></i>
                        Ajouter un nouveau groupe d'options
                    </button>
                </div>
            </div>
        </div>
</div>
