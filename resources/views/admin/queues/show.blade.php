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
                            <form action="{{route('admin.queues.store',$service)}}" method="POST">
                                @csrf
                                <input value="{{$service->id}}" type="hidden" name="id">
                                <input value="{{$service->default_number}}" type="hidden" name="default_number">
                            <button class="btn btn-queue btn-info mb-2 ml-1" type="submit">{{$service->name}}</a>
                            </form>
                            @endif
                            @endforeach
            
                        </div>  
                </div>
        </div>

</div>

@endsection
