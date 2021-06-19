<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.services.show');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all(['id', 'department_name']);
        $services = Service::all();

        $serviceCount = $services->count();

        return view('admin.services.create', compact('departments','serviceCount'));;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());

        return redirect()->route('admin.services.index')->with('success','Item created successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {

        $departments = Department::get();
        return view('admin.services.edit',compact('service','departments'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return redirect()->route('admin.services.index');  


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        $counter = Counter::where('service_id','=',$service->id)->first();
        // if(!$counter) {
        //     $service->delete();

        // }
        try{
            $service->delete();
            return redirect()->route('admin.services.index')->with('deleteSuccess','Deleted Successfully.');  

        }catch(Exception $ex){

        }


    }
}
