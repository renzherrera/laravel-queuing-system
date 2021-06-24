
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
             <div class="col-md-12">
            @if ($message = Session::get('storeSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>  New Counter added.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif($message = Session::get('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>  Counter details has been updated successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
          
            @endif
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i><h4>{{__('List of Queues')}}</h4></div>
                        <div class="card-body">
                                @livewire('queues-table')
                        
                        </div>
                    </div>
             </div>
@endsection
