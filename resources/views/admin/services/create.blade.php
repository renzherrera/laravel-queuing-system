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
                        <form action="{{route('admin.services.store')}}" method="POST">
                        @csrf
                        <div class="card-header">{{ __('New Services')}}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input value="" class="form-control" name="name" type="text" placeholder="{{__('Service Name')}}">
                                </div> 
                                <div class="form-group">
                                    <label for="department">{{__('Department')}}</label>
                                    <select class="form-control" name="department_id" id="department_id">
                                        @foreach ($departments as $department )
                                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="form-group">
                                    <label for="prefix">{{__('Prefix')}}</label>
                                    <input class="form-control" name="prefix" type="text" placeholder="{{__('Prefix')}}">
                                </div> 
                                <div class="form-group">
                                    <label for="prefix">{{__('Default Number')}}</label>
                                    <input value="{{$serviceCount+1 ."00"}}" class="form-control" name="default_number" type="text" placeholder="{{__('Enter a Default Number')}}" readonly>
                                </div> 
                                
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit"> Create New Service</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{route('admin.services.index')}}"> Back</a>

                            </div>
                        </form>

                    </div>
            </div>
          


            </div>
        </div>
    </div>
</div>

@endsection
