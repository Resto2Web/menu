<div class="">
    <div class="card">
        <div class="card-header">
            <div class=" align-items-center justify-content-between d-flex">

                <h4 class="mb-0">
                    <i class="fa fal fa-address-card"></i>
                    <span>Contact client</span>
                </h4>
                @unless ($edit)
                    <button class="btn btn-primary" wire:click="toggleEdit"><i class="fa fa-edit"></i> Editer</button>
                @endunless
            </div>

        </div>
        <div class="card-body">
            @if ($edit)
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('first_name','Prénom') }}
                            {{ Form::text('first_name',null,['class'=> 'form-control','wire:model'=> 'first_name']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('last_name','Nom') }}
                            {{ Form::text('last_name',null,['class'=> 'form-control','wire:model'=> 'last_name']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('phone_number','Numéro de téléphone') }}
                            {{ Form::text('phone_number',null,['class'=> 'form-control','wire:model'=> 'phone_number']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('email','Email') }}
                            {{ Form::email('email',null,['class'=> 'form-control','wire:model'=> 'email']) }}
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-danger" wire:click="toggleEdit"><i class="fa fa-save"></i> Annuler
                        </button>
                        <button class="btn btn-primary" wire:click="save"><i class="fa fa-save"></i> Enregistrer
                        </button>
                    </div>
                </div>
            @else
                <ul class="list-unstyled mb-0">
                    <li>
                        {{ $order->fullName }}
                    </li>
                    <li>
                        <a href="mailto:{{$order->email}}"> {{$order->email}}</a>
                    </li>
                    <li>
                        <a href="tel:{{$order->phone_number}}"> {{$order->phone_number}}</a>
                    </li>
                </ul>

            @endif

        </div>
    </div>
</div>
