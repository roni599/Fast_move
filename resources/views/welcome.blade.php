@extends('client.layouts.masterlayout')
@section('content')
    @include('client.components.pricing-calculator')
    {{-- @include('client.components.slider') --}}
    {{-- @include('client.components.track') --}}
    @include('client.components.about')
    @include('client.components.services')
@endsection
