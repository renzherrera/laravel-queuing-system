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
                        <form action="{{route('admin.departments.update',$department)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">{{ __('Edit Department') }}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input value="{{$department->department_name}}" class="form-control" name="department_name" type="text">
                                </div> 
                                <div class="form-group">
                                    <label for="status">{{__('Status')}}</label>
                                    <select class="form-control" name="is_active" id="is_active">
                                        <option value="0" @php if (!$department->is_active) {
                                            echo 'selected';
                                        } @endphp>Inactive</option>
                                        <option value="1" @php if ($department->is_active) {
                                            echo 'selected';
                                        } @endphp>Active</option>
                                        </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary pr-5 pl-5" type="submit"> Save</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{ URL::previous() }}"> Back</a>

                            </div>
                        </form>
                       

                    </div>
                   
            </div>
        </div>
    </div>
</div>

@endsection
