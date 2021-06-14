
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
             <div class="col-md-12">
            <a  class="btn btn-xl btn-info mb-2 ml-1" href="{{route('admin.counters.create')}}">Create New Counter</a>

                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i>{{__('List of Counters')}}</div>
                        <div class="card-body">
                                @livewire('counters-table')
                        
                        </div>
                    </div>
             </div>
             @endsection
