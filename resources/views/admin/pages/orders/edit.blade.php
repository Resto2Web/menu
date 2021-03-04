@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')

    <li class="breadcrumb-item">
        <a href="{{ route('admin.orders.index') }}">Commandes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.orders.show', $order->id) }}">{{$order->number}}</a>
    </li>

    <li class="breadcrumb-item active">
        Editer une commande
    </li>
@endsection

@section("content")
    @include("resto2web-admin::layout.alerts")
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-clipboard-list"></i> Contenu de la commande
                </div>
                <div class="card-body">
                    @if ($order->comment)
                        <div class="alert alert-info">
                            {{ $order->comment }}
                        </div>
                    @endif
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>
                                Qté
                            </th>
                            <th>
                                Nom
                            </th>
                            <th>
                                Prix
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->order_items as $item)
                            <tr>
                                <td>
                                    <input type="number" value="{{$item->quantity}}" class="form-control">
                                </td>
                                <td>
                                    {{$item->name}}
                                    @if ($item->options)
                                        <br>
                                        @foreach ($item->options as $option)
                                            + {{ $option }} <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    {{formatPrice($item->price * $item->quantity)}}
                                </td>
                            </tr>
                        @endforeach
                        {{--                        @if($order->order_gifts->count())--}}
                        {{--                            @foreach($order->order_gifts as $gift)--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>{{$gift->quantity}}</td>--}}
                        {{--                                    <td><i class="fal fa-gift"></i> {{$gift->name}}</td>--}}
                        {{--                                    <td>Récompense</td>--}}
                        {{--                                </tr>--}}
                        {{--                            @endforeach--}}
                        {{--                        @endif--}}
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>Livraison</th>
                            <th>{{ formatPrice($order->delivery)}}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Total</th>
                            <th>{{formatPrice($order->total)}}</th>
                        </tr>
                        </tfoot>
                    </table>
                    {{--                    <a href="{{ route('admin.orders.pdf',$order) }}" target="_blank" class="btn btn-primary"><i--}}
                    {{--                            class="fa fa-download"></i> Télécharger le pdf</a>--}}
                    {{--                    <button onclick="printJS('{{ route('admin.orders.pdf',$order) }}')" class="btn btn-primary"><i--}}
                    {{--                            class="fa fa-print"></i> Imprimer le pdf--}}
                    {{--                    </button>--}}
                    {{--                    <button onclick="printJS('{{ route('admin.orders.ticket',$order) }}')" class="btn btn-primary"><i--}}
                    {{--                            class="fa fa-ticket"></i> Imprimer le ticket--}}
                    {{--                    </button>--}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md">
                @livewire('admin.orders.components.edit-order-customer-info',['order'=> $order])
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-map-marker-alt"></i> Détails
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                @if ($order->type == 'delivery')
                                    <p class="h3">A livrer</p>
                                    <ul class="list-unstyled">
                                        <li>
                                            {{ $order->address }}
                                        </li>
                                        <li>
                                            {{ $order->postal_code }}
                                        </li>
                                    </ul>
                                @elseif ($order->type == 'takeaway')
                                    <p class="h5">A emporter</p>
                                @endif
                            </div>
                            <div class="col-md">
                                <p> le {{$order->date->format('d/m/Y')}}<br>
                                    <span class="h3"><span>{{ $order->dateText }}</span></span>
                                    à <span class="h3">{{$order->time->format('H:i')}}</span>
                                </p>
                                <p class="mb-0">
                                    Paiement {{ strtolower($order->paiement_method_text) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
