@extends('layouts.main')

@section('content')
    @livewire('product.checkout', ['product' => $product])
@endsection