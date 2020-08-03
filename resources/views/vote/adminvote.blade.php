@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <admin-vote-component counter='{{$id}}'></admin-vote-component>
        </div>
    </div>
</div>
@endsection
