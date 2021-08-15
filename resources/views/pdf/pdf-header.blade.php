<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />

    </head>
    <style>
        h6{
            font-size: 14px;
        }
        h2{
            font-size:17px;
        }
    </style>
<body>
    <div class="form-row page_break" style="height: 100px;">
        <div class="header-text  bg-info">
            <div class="">
                <div>
                    <img  style="width: 150px; float:left;position:fixed; " src="{{ asset("storage/logo/" . settings('logo'))}}"/>

                </div>
                <div class="text-center ">
                    <h2 >{{settings('system_name')}}</h2>
                    <h3 >{{settings('sub_name')}} </h3>
                </div>
                
            </div>
          
        </div>
     </div>
</body>
</html>