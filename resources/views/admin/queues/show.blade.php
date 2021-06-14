@extends('layouts.display')

@section('content')
<style>
    .btn-queue{
        padding: 50px;
        font-size: 25px;
        width: 25%;
    }
   
    .btn-title{
        text-align: center
    }
   </style>

        <div class="card">
            <div class="card-header text-center"><h1>{{ __('Choose service') }}</h1></div>
                <div class="card-body">
                  
                        <div class="container text-center">
                            @foreach ($services as $service)
                            @if ($service->is_active)
                            <a class="btn btn-queue btn-info mb-2 ml-1" href="{{route('admin.queues.create')}}">{{$service->name}}</a>
                            @endif
                            @endforeach
            
                        </div>  
                </div>
        </div>

</div>

@endsection
