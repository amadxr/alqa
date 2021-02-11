@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full h-screen">
    @include('_partials.navbar')
    <artwork-form-component
        :id ="{{ $artworkId }}"
    ></artwork-form-component>
</div>
@endsection
