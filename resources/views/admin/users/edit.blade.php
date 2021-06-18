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
                        <form action="{{route('admin.users.update',$user)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">{{ __('Edit Users') }}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input value="{{$user->name}}" class="form-control" name="name" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{__('Email Address')}}</label>
                                    <input value="{{$user->email}}" class="form-control" name="email" type="emaiil">
                                </div>
                                <div class="form-group">
                                    <label for="department">{{__('Assign to Counter')}}</label>
                                    <select class="form-control" name="counter_id" id="counter_id">
                                        @foreach ($counters as $counter )
                                            @if ($counter->is_active)
                                               
                                            <option value="{{$counter->id}}" {{ ( $counter->id == $user->counter_id) ? 'selected' : '' }}>{{$counter->counter_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> 
                               
                                <div class="form-group">
                                    <label for="is_admin">{{__('Role')}}</label>
                                    <select class="form-control" name="is_admin" id="is_admin">
                                        <option value="0" @php if (!$user->is_admin) {
                                            echo 'selected';
                                        } @endphp>Staff</option>
                                        <option value="1" @php if ($user->is_admin) {
                                            echo 'selected';
                                        } @endphp>Administrator</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">{{__('Status')}}</label>
                                    <select class="form-control" name="is_active" id="is_active">
                                        <option value="0" @php if (!$user->is_active) {
                                            echo 'selected';
                                        } @endphp>Inactive</option>
                                        <option value="1" @php if ($user->is_active) {
                                            echo 'selected';
                                        } @endphp>Active</option>
                                        </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary pr-5 pl-5" type="submit"> Save</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{route('admin.users.index')}}"> Back</a>
                            </div>
                        </form>
                       

                    </div>
                   
            </div>
        </div>
    </div>
</div>

@endsection
