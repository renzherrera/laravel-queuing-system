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
                        <form action="{{route('admin.settings.update',$settings)}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-header">{{ __('General Settings')}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="logo">{{__('Logo')}}</label>
                                        <label for="logo" class="btn btn-info form-control"><span class="cil-image btn-icon mr-2"></span>{{__('Select / browse photo')}}</label>
                                        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="preview_image(event);" hidden>
                                    </div> 
                                
                                </div>
                                <label for="logo" class="form-group bg-light col-md-3" style="height:150px; cursor: pointer;" >
                                    <img src="{{ asset("storage/logo/" . $settings->logo)}}" style="display:block; text-align:center; position: relative;
                                    top: 50%; transform: translateY(-50%);   margin: auto;
                                    width: 200px; z-index: 999999999;" id="output_image" >
                                  <svg id="cid-image" viewBox="0 0 512 512" style="display:block; text-align:center; position: absolute;
                                  top: 50%; left:40%; transform: translateY(-50%); margin: auto; width: 75px; opacity:0.3;">
                                    <polygon fill="var(--ci-secondary-color, currentColor)" points="32 34 32 309.112 32.002 309.112 56 285.078 80 261.041 80 82 432 82 432 198.064 456 222.015 479.974 245.94 480 245.995 480 34 32 34" class="ci-secondary" opacity="var(--ci-secondary-opacity, 0.25)"></polygon><polygon fill="var(--ci-primary-color, currentColor)" points="456 222.099 432 198.148 369.643 135.917 304 201.56 432 329.56 432 380.423 196.263 144.686 80 261.125 56 285.162 32.002 309.196 32 309.196 32 311.078 32 480 480 480 480 258.654 480 246.079 479.974 246.024 456 222.099" class="ci-primary"></polygon>
                                  </svg>

                                </label>
                              
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">{{__('Municipal Name')}}</label>
                                        <input value="{{$settings->system_name}}" class="form-control" name="system_name" id="system_name" type="text"  ">
                                    </div> 
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="sub_name">{{__('Sub Name')}}</label>
                                        <input value="{{$settings->sub_name}}" class="form-control" name="sub_name" id="sub_name" type="text" placeholder="{{__('Sub Name')}}">
                                    </div> 
                                </div>
                                
                                <hr style="opacity: 0.5; width:99%;">

                               
                                <div class="form-group mt-3 mb-4">
                                    <label for="overtime ">{{__('Overtime')}} <small class="text-muted text-sm">(IN MINUTES)</small></label>
                                    <input value="{{$settings->overtime}}" class="form-control col-md-4" name="overtime" type="text" placeholder="{{__('Overtime')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </div> 
                                <hr style="opacity: 0.5; width:99%;">

                                <div class="form-group col-md-3 mt-3">
                                    <label for="video">{{__('Video for Display Queues Monitor')}}</label>
                                    <label for="video" class="btn btn-info form-control"><span class="cil-image btn-icon mr-2"></span>{{__('Select / browse video')}}</label>
                                    <input class="form-control" type="file" id="video" name="video" accept="video/*" hidden>

                                </div> 
                                <div class="form-group">
                                    <video width="200" src="{{ asset("storage/video/" . $settings->video)}}" controls >
                                          Your browser does not support HTML5 video.
                                      </video>
                                </div>
                               
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-md btn-primary" type="submit">Save Settings</button>

                            </div>
                        </form>

                    </div>
            </div>
          


            </div>
        </div>
    </div>
    <script>


    function preview_image(event) 
    {
    var reader = new FileReader();
    reader.onload = function()
    {
    var output = document.getElementById('output_image');
    output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
    }





        //VIDEO PREVIEW
    document.getElementById("video")
    .onchange = function(event) {
    let file = event.target.files[0];
    let blobURL = URL.createObjectURL(file);
    document.querySelector("video").src = blobURL;
    }
    </script>
 {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
 <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script>
  FilePond.registerPlugin(FilePondPluginImagePreview);
    // Get a reference to the file input element
    const inputElements = document.querySelectorAll('input.filepond');

 // loop over input elements
Array.from(inputElements).forEach(inputElement => {

// create a FilePond instance at the input element location
FilePond.create(inputElement);

})

FilePond.setOptions({

    server:{
        url: '/settings-upload',
        headers: {
            'X-CSRF-TOKEN' : '{{csrf_token()}}'
        }

    } 
});
    </script> --}}
</div>

@endsection
