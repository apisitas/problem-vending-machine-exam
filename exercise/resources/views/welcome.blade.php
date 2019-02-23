@extends('layouts.app')

@section('content')
<div class="uk-card uk-card-default uk-card-body">
    <div align="center">
        <a class="uk-button uk-button-default" href="{{ route('coin.process', ['coin' => 2]) }}">2 Bath</a>
        <a class="uk-button uk-button-default" href="{{ route('coin.process', ['coin' => 5]) }}">5 Bath</a>
        <a class="uk-button uk-button-default" href="{{ route('coin.process', ['coin' => 10]) }}">10 Bath</a>
        <h4>Amount : {{ !empty(session('coin')) ? array_sum(session('coin')) : 0 }} Bath</h4>
        <h5>
            <a href="{{ route('coin.refund') }}">
                <button class="uk-button uk-button-default" 
                    @if( empty(session('coin')))
                        disabled
                        uk-tooltip="don't have enough money"
                    @endif
                >Refund Money
                </button>
            </a>
        </h5>
    </div>
    <hr>
    @if (session('status'))
        <div class="uk-alert-{{ session('alert') }}" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{{ session('status') }}</p>
        </div>
    @endif
    <table class="uk-table uk-table-responsive uk-table-divider">
        <thead>
            <tr>
                <th>product image</th>
                <th>product name</th>
                <th>product price</th>
                <th>product in stock</th>
                <th>Submit</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('obj')->data as $k => $v)
                <tr>
                    <td>
                        <img data-src="{{ $v->image }}" width="100px" height="100px" alt="" uk-img ></td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->price }} Bath</td>
                    <td>{!! $v->in_stock == true ? '<span uk-icon="check" style="color:green"></span>' : '<span uk-icon="close" style="color:red"></span>' !!}</td>
                    <td align="center">
                    <a href="{{ route('product.process', ['id' => $v->id]) }}" class>
                        <button class="uk-button uk-button-default" 
                        @if( empty(session('coin')))
                            disabled
                            uk-tooltip="don't have enough money"
                        @endif
                        ><span uk-icon="cart"></span> Add To Cart</button>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection