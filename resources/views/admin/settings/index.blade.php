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
                        <div class="card-header">{{ __('General Settings')}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="prefix">{{__('Logo')}}</label>
                                        <input  type="file" id="logo" >
                                    </div> 
                                  
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">{{__('Municipal Name')}}</label>
                                        <input value="" class="form-control" name="name" type="text" placeholder="{{__('Municipal Name')}}">
                                    </div> 
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="prefix">{{__('Sub Name')}}</label>
                                        <input class="form-control" name="prefix" type="text" placeholder="{{__('Sub Name')}}">
                                    </div> 
                                </div>
                                
                                <hr style="opacity: 0.5; width:99%;">

                               
                                <div class="form-group mt-3 mb-4">
                                    <label for="prefix ">{{__('Sub Name')}}</label>
                                    <input class="form-control col-md-4" name="prefix" type="text" placeholder="{{__('Sub Name')}}">
                                </div> 
                                <hr style="opacity: 0.5; width:99%;">

                                <div class="form-group col-md-5 mt-3">
                                    <label for="prefix">{{__('Video for Display Queues Monitor')}}</label>
                                    <input class="form-control " type="file" id="video" >

                                </div> 
                               
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit">Save Settings</button>
                                <a class="btn btn-md btn-warning pr-5 pl-5" href="{{route('admin.services.index')}}"> Back</a>

                            </div>
                        </form>

                    </div>
            </div>
          


            </div>
        </div>
    </div>
 <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
 <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script>
  FilePond.registerPlugin(FilePondPluginImagePreview);
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);
    </script>
</div>

@endsection
