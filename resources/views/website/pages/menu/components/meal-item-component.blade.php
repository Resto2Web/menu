<li>
    <div class="row no-gutters px-0">
        <div class="col ml-3">
            <div class="d-flex align-items-center">
                @if ($meal->image)
                    <a href="{{Storage::url($meal->image)}}"
                       data-lightbox="img">
                        <img
                            src="{{Storage::url($meal->thumbnail)}}"
                            class="img-fluid mx-2  d-none d-md-block"
                            style="max-width: 100px"
                            data-was-processed="true">
                    </a>
                @endif
                <div class="flex-md-column">
                    <p class="h4 d-none d-md-block">{{$meal->name}}</p>
{{--                    <p class="h5 d-md-none">{{$meal->name}}</p>--}}
                    <p class="mb-0">
                        {{$meal->description}}
                    </p>
                    @if ($meal->ingredients)
                        <p class="text-muted small">
                            {{$meal->ingredients}}</p>
                    @endif
                    <button class="btn btn-primary btn-sm d-md-none"
                            data-toggle="modal"
                            data-target="#mealModal{{$meal->id}}">En savoir plus
                    </button>
                    <div class="h6  d-inline mb-0">
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
                            <i
                                class="fa fa-plus-circle fa-2x "></i>
                        </button>
                        <div class="modal fade" id="optionsModal{{$meal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                @livewire('website.components.menu.meal-options-modal',['meal'=> $meal],key($meal->id))
                            </div>
                        </div>
                    @else
                        <button type="button" wire:click="addToCart" class="btn btn-link">
                            <i
                                class="fa fa-plus-circle fa-2x "></i>
                        </button>
                    @endif

                @else
                    <div class="text-sm align-self-center">
                        Épuisé <br>
                        <small>On se revoit <br> demain ? <i
                                class="fa fa-grin-wink"></i></small>
                    </div>
                @endif
            </div>
        </div>

    </div>
</li>
