<div>
    <div class="">
        @switch($order->status)
            @case('pending')
            <div class="alert alert-warning">
                <i class="fa fa-info-circle"></i> Cette commande est en attente de confirmation
            </div>
            @break
            @case('refused')
            <div class="alert alert-danger">
                <i class="fa fa-times-circle"></i> Cette commande a été refusée
            </div>
            @break
            @case('confirmed')
            <div class="alert alert-primary">
                <i class="fa fa-check-circle"></i> Cette commande a été acceptée
            </div>
            @break
            @case('shipped')
            <div class="alert alert-success">
                <i class="fa fa-shipping-fast"></i> Cette commande a été envoyée
            </div>
            @break
        @endswitch
    </div>
    @unless($order->status == 'shipped')
        <div class="card">
            <div class="card-header">
                <i class="fa fa-reply"></i> Actions
            </div>
            <div class="card-body">
                @switch($order->status)
                    @case('pending')
                    {{ Form::textarea('message',null,['class'=> 'form-control','wire:model'=> "message",'lines'=> 3]) }}
                    <button class="btn btn-success" wire:click="confirmOrder"><i class="fa fa-check"></i>
                        Confirmer la commande
                    </button>
                    <button class="btn btn-danger" wire:click="refuseOrder"><i class="fa fa-times"></i> Refuser la
                        commande
                    </button>
                    @break

                    @case('confirmed')
                    <button type="button" wire:click="sendOrder" class="btn btn-primary"><i
                            class="fa fa-shipping-fast"></i>
                        Marquer la
                        commande comme envoyée
                    </button>
                    @break

                    @default

                @endswitch

            </div>
        </div>
    @endif
</div>
