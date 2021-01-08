@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Commandes
    </li>
@endsection


@section("content")
    <div class="row ">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                    <table class="dataTable table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $order->number }}</td>
                                <td class="align-middle h5"><span class="badge bg-{{ $order->status->color() }}">{{ $order->status->displayName() }}</span></td>
                                <td class="align-middle h5"><span class="badge bg-{{ $order->type->color() }}">{{ $order->type->displayName() }}</span></td>
                                <td class="text-right align-middle">
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.show', $order) }}"><i
                                            class="fa fa-eye"></i> Voir la commande</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
