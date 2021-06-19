
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
             <div class="col-md-12">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> New Service added.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                
                @endif
            <a  class="btn btn-xl btn-info mb-2 ml-1" href="{{route('admin.services.create')}}">Create New Service</a>
            @include('sweetalert::alert')
            @if ($message = Session::get('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>HoYyYyYy!</strong> Service and the Counter successfully deleted.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>{{__('List of Services')}}</div>
                    <div class="card-body">
                            @livewire('services-table')
                    
                    </div>
                </div>
             </div>
        </div>
    </div>
    <script>

        Swal.fire({
    
        title: 'Printing',
        html: '<h1 class="bg-success">Ticket # </h1> <br> <h2>Time created: {{now()->format('g:i:s a')}}</h2>',    
        imageUrl: '{{ asset('storage/images/printing.gif')}}',
        imageAlt: 'Printer GIF',
        showConfirmButton: false,
        allowOutsideClick: false,
    })
    
    
    </script>
@endsection
