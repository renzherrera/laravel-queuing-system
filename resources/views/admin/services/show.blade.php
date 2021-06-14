
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
             <div class="col-md-12">
            <a  class="btn btn-xl btn-info mb-2 ml-1" href="{{route('admin.services.create')}}">Create New Service</a>

                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>{{__('List of Services')}}</div>
                    <div class="card-body">
                            @livewire('services-table')
                    
                    </div>
                </div>
             </div>
        </div>
    </div>
@endsection
