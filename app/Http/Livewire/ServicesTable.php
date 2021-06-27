<?php

namespace App\Http\Livewire;

use App\Models\Counter;
use App\Models\Department;
use App\Models\Service;
use App\Models\Settings;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;


class ServicesTable extends Component
{
    use WithPagination;

    public $departmentId,$status ="x";

    public function render()
    {

        $departmentId = $this->departmentId;
        $status = $this->status;
        $departments = Department::select('id','department_name')->get();

        $services = Service::join('departments','services.department_id','=','departments.id')
        ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active');

       
        if($status && $status !="x"){
            $services = $services->where('services.is_active',$status);
        }elseif(!$status){
            $services = $services->where('services.is_active',false);

        }
        if($departmentId && $departmentId !="x"){
            $services = $services->where('department_id','=',$departmentId);
        }
        $services = $services->orderBy('departments.department_name','asc')->paginate(5);

        return view('livewire.services-table', compact('services','departments'));
    }

    public function servicesPDF(Request $request){
        $departmentId = $request->departmentId;
        $status = $request->status;
        $settings = Settings::first();

        $services = Service::join('departments','services.department_id','=','departments.id')
        ->select('services.id', 'services.name', 'departments.department_name','services.prefix','services.default_number','services.is_active');

       
        if($status && $status !="x"){
            $services = $services->where('services.is_active',$status);
        }elseif(!$status){
            $services = $services->where('services.is_active',false);

        }
        if($departmentId && $departmentId !="x"){
            $services = $services->where('department_id','=',$departmentId);
        }
        $services = $services->orderBy('departments.department_name','asc')->get();

        
       $results = $services->chunk(15);
       // $projects = Project::join('project_images','projects.id','=','project_images.project_id');
       view()->share('results',$results);
       $pdf = PDF::setOptions([ 'isRemoteEnabled' => true])->loadView('admin.services.services-pdf',compact('results','settings'));

       return $pdf->stream();
    }
}
