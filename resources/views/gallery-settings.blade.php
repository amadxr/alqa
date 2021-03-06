@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Wallpaper Settings</div>
                <div class="card-body">
                    <div class="max-w-sm mx-auto py-8">
                        <wallpaper-form-component/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
