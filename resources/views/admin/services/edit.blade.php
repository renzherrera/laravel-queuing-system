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
                        <form action="{{route('admin.services.update',$service)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">{{ __('Edit Service') }}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Service Name')}}</label>
                                    <input value="{{$service->name}}" class="form-control" name="name" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="department">{{__('Department')}}</label>
                                    <select class="form-control" name="department_id" id="department_id">
                                        @foreach ($departments as $department )
                                            @if ($department->is_active)
                                               
                                            <option value="{{$department->id}}" {{ ( $department->id == $service->department_id) ? 'selected' : '' }}>{{$department->department_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                       
                                </div> 
                                <div class="form-group">
                                    <label for="prefix">{{__('Prefix')}}</label>
                                    <input value="{{$service->prefix}}" class="form-control" name="prefix" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="default_number">{{__('Default Number')}}</label>
                                    <input value="{{$service->default_number}}" class="form-control" name="default_number" type="text">
                                </div>  
                                <div class="form-group">
                                    <label for="status">{{__('Status')}}</label>
                                    <select class="form-control" name="is_active" id="is_active">
                                        <option value="0" @php if (!$service->is_active) {
                                            echo 'selected';
                                        } @endphp>Inactive</option>
                                        <option value="1" @php if ($service->is_active) {
                                            echo 'selected';
                                        } @endphp>Active</option>
                                        </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary pr-5 pl-5" type="submit"> Save</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{route('admin.services.index')}}"> Back</a>
                            </div>
                        </form>
                       

                    </div>
                   
            </div>
        </div>
    </div>
</div>

@endsection
