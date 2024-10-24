@extends('layouts.main')

@section('content')
    @livewire('product.detail', ['product' => $product])
@endsection