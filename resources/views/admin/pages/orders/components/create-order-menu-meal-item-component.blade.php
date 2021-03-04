<li>
    <div class="row no-gutters px-0">
        <div class="col ml-3">
            <div class="d-flex align-items-center h-100">
                <div class="flex-md-column">
                    <p class="h4 d-none mb-0 d-md-block">{{$meal->name}}</p>
                    <div class="h6 d-inline mb-0">
                        <strong
                            class="badge badge-primary d-md-none">{{ $meal->formatted_price }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto d-none d-md-flex justify-content-center align-items-center" style="min-width: 90px">
            <strong class="h4 text-primary mb-0">{{ $meal->formatted_price }}</strong>
        </div>
        <div class="col-auto">
            <div class="d-flex h-100 justify-content-end">
            @if ($meal->available)
                @if ($meal->hasOptions)
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#optionsModal{{$meal->id}}">
                            <i class="fa fa-plus-circle fa-2x "></i>
                        </button>
                        <div class="modal fade" id="optionsModal{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                @livewire('website.components.menu.meal-options-modal',['meal'=> $meal],key($meal->id))
                            </div>
                        </div>
                    @else
                        <button type="button" wire:click="addToCart" class="btn btn-link">
                            <i class="fa fa-plus-circle fa-2x "></i>
                        </button>
                    @endif

                @else
                    <div class="text-sm align-self-center">
                        Épuisé
                    </div>
                @endif
            </div>
        </div>

    </div>
</li>
