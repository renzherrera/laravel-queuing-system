<!DOCTYPE html>
<html>
<head>
    <style>
        div.page_break + div.page_break{
        page-break-before: always;
    }

table {
  border-collapse: collapse;
  width: 100%;
  font-family: Arial, Helvetica, sans-serif;
  margin-top: -120px;
}
thead{
    height: 219px;
    border: 0.1em solid #ccc;
}
th, td {
  text-align: left;
  padding: 10px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

.logo {
    margin-bottom: 25px;
    margin-left: 0;
    position: relative;
}
h3{
    font-size: 16px !important;
    position: relative;
    top: -15% !important;
   left: 33% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
   color: rgb(102, 102, 102);
   opacity: 0.6;
}
h2{
    font-size: 24px !important;
    position: relative;
    top: -13% !important;
   left: 23% !important;

}
h4{
    font-size: 18px !important;
    position: relative;
    top: -13% !important;
   left: 36% !important;
   font-weight: 100;
   font-family: Arial, Helvetica, sans-serif;
}
</style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" />
    <title>QMS | Departments</title>
</head>
<body>

    @foreach ($results as $departments)
    <div class="header-container page_break">
            <div class="logo ">
                <img style="width: 150px;   margin-left: -10px;" src="{{ asset("storage/images/sf-logo.png")}}"/>
            </div>
            <div class="header-text ">
                <h2 >Municipality of San Fernando, Pampanga</h2>
                <h3 >Queueing Management System </h3>
                <h4 class="title" >List of Departments</h4>
            </div>
    </div>
    <table >
        <tbody>
            <thead>
                <tr >
                <th >Id</th>
                <th>Name of Department</th>
                <th>Status</th>
                </tr>
                </thead>
      
            @foreach ($departments as $department)

            <tr style="line-height:28px;">
                <td>{{$department->id}}</td>
                <td>{{$department->department_name}}</td>
             
               @if($department->is_active)
                <td>Active</td>
                @else
                <td style="color: red;">Inactive</td>
                @endif
            </tr>
        </tbody>
      
        @endforeach
     

        

      </table>
      @endforeach

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js" ></script>
  
</body>
</html>