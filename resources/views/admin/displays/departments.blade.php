
@extends('layouts.display')

@section('content')

                            <div class="card card-accent-info ">
                                <div class="card-header  text-center text-dark"><h1 class="p-4">{{ __('Please select a Department') }}</h1></div>
                                    <div class="card-body p-5">
                                      
                                            <div class="container text-center">
                                                @foreach ($departments as $department)
                                                @if ($department->is_active)
                                                <a class="btn btn-queue bg-info text-white mb-2 ml-1 text-uppercase" href="{{route('admin.displays.services',$department->id)}}">{{$department->department_name}}</a>
                                                @endif
                                                 @endforeach
                                
                                            </div>  
                                    </div>
                            </div>
                    
@endsection