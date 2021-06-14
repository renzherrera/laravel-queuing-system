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
                        <form action="{{route('admin.users.store')}}" method="POST">
                        @csrf
                        <div class="card-header">{{ __('Register a new User')}}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input  class="form-control" name="name" type="text" placeholder="{{__('Name')}}">
                                </div> 

                                <div class="form-group">
                                    <label for="email">{{__('Email Address')}}</label>
                                    <input class="form-control" name="email" type="email" placeholder="{{__('Email address')}}">
                                </div> 

                              

                                <div class="form-group">
                                    <label for="department">{{__('Assigned to')}}</label>
                                    <select class="form-control" name="counter_id" id="counter_id">
                                        @foreach ($counters as $counter )
                                            <option value="{{$counter->id}}">{{$counter->counter_name}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                              
                                <div class="form-group">
                                    <label for="password">{{__('Password')}}</label>
                                    <input  class="form-control" name="password" type="password" placeholder="{{__('Enter a default password')}}">
                                </div> 
                                <div class="form-group">
                                    <label for="password_confirm">{{__('Confirm Password')}}</label>
                                    <input  class="form-control" name="password_confirmation" type="password" placeholder="{{__('Confirm Password')}}">
                                </div> 

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit"> Create New Service</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{route('admin.users.index')}}"> Back</a>

                            </div>
                        </form>

                    </div>
            </div>
          


            </div>
        </div>
    </div>
</div>

@endsection
