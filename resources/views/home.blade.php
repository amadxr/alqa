@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full h-screen">
    @include('_partials.navbar')
    <dashboard-component/>
</div>
@endsection
