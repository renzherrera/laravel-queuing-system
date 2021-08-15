<div>


<style>
    .container {
        margin: 0 auto;
        font-size: 0;
    }
    .grid-item{
        width:250px;
        height: 70px;
        margin:4px;
    }  

  
</style>


    <div class="fade-in">
        <div class="wrapper d-flex align-items-center" style="height: 100vh;">
            <div class="m-5 p-5 " style="width:100%">
                    <div class="col-md-12">
                        <h2>  Select Department</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis est necessitatibus, pariatur sed earum expedita?</p>
                    </div>
                <div class="container mt-5 p-4" >
                <div class="col-md-12 ">
                    {{-- <a class="grid-item btn btn-lg btn-pill btn-primary"  href="{{route('admin.displays.services',$department->id)}}">{{$department->department_name}}</a> --}}
                        @foreach ($departments as $department)
                        @if ($department->is_active)
                        <a  href="{{route('kiosk.departments.services',$department)}}">
                            <button class="grid-item btn btn-lg btn-pill btn-primary" type="button">{{$department->department_name}}</button>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
