<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Settings;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class DepartmentsTable extends Component
{
    use WithPagination;

    public $department, $status="3";
    public function mount(Request $request) {
    }
    public function render()
    {
        $status =$this->status;
        if($status !="3"){
            $departments = Department::where('is_active','=', $status)
            ->paginate(5);
        }else {
            $departments = Department::paginate(5);
        }
         
       
        return view('livewire.departments-table', compact('departments'));
    }

    public function getProjectPDF() {
        $departmentPdf = Department::all();
        return view('admin.departments.departments-pdf',compact('departmentPdf'));


    }
    public function updatingStatus(): void
    {
        $this->gotoPage(1);
    }

    public function createPDF(Request $request)
    {
        $settings = Settings::first();

        $status = $request->status;
        if($status == "1"){
            $departmentPdf = Department::where('is_active',true)->get();
        }elseif($status == "0"){
            $departmentPdf = Department::where('is_active',false)->get();

        }else {
            $departmentPdf = Department::get();

        }
       $results = $departmentPdf->chunk(15);
        // $projects = Project::join('project_images','projects.id','=','project_images.project_id');
        view()->share('results',$results);
        $pdf = PDF::setOptions([ 'isRemoteEnabled' => true])->loadView('admin.departments.departments-pdf', compact('results','settings'));

        return $pdf->stream();
    }

}
