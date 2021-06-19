@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
             <div class="col-md-12">
               
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('admin.counters.store')}}" method="POST">
                        @csrf
                        <div class="card-header">{{ __('New Counter')}}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="counter_name">{{__('Name')}}</label>
                                    <input value="Counter {{  $counterCount+1}}" class="form-control" name="counter_name" type="text"  readonly>

                                </div> 
                                <div class="form-group">
                                    <label for="service_id">{{__('Assigned Service')}}</label>
                                    <select class="form-control" name="service_id" id="service_id">
                                        @foreach ($services as $service )
                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit"> Create New Counter</button>

                            </div>
                        </form>

                     
                    </div>


                



             
            </div>
          


            </div>
        </div>
    </div>
</div>

@endsection
