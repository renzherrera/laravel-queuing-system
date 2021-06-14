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
                        <form action="{{route('admin.departments.store')}}" method="POST">
                        @csrf
                        <div class="card-header">{{ __('New Department')}}</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{__('Name')}}</label>
                                    <input value="" class="form-control" name="department_name" type="text" placeholder="{{__('Deparment Name')}}">
                                </div> 
                                
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit"> Create Department</button>
                            </div>
                        </form>

                     
                    </div>


                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i>{{__('List of Departments')}}</div>
                        <div class="card-body">
                                @livewire('departments-table')
                        
                        </div>
                    </div>
                   



             
            </div>
          


            </div>
        </div>
    </div>
</div>

@endsection
