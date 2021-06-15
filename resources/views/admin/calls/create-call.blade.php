@extends('layouts.app')

@section('content')
<style>
    .call-header{
        font-size: 1.5rem;
        margin: 25px 0px 25px 0px;
    }
    .call-btn{
        padding:20px 25px 20px 25px;
        width: 75%;
        margin-top: 5%;
        margin-bottom: 10%;
        font-size: 19px;
    }
    .call-label{
        font-size: 1.8rem;
    }
    .call-number-label{
        font-size: 4.5rem;
    }
    .ticket-label{
        font-size: 3.5rem;
        letter-spacing: 10px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @livewire('call-controller')
        </div>
    </div>
</div>
@endsection
