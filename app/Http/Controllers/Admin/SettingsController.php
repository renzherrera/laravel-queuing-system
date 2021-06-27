<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingsRequest;
use App\Models\Settings;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;


class SettingsController extends Controller
{
    public function index() {
        $settings = Settings::first();

        return view('admin.settings.index',compact('settings'));
    }
    public function store(StoreSettingsRequest $request) {
      


     
    
            // ensure the request has a file before we attempt anything else.
            if ($request->hasFile('logo') && $request->hasFile('video')) {


                // Save the file locally in the storage/public/ folder under a new folder named /product
                $request->logo->store('logo', 'public');
                $request->video->store('video', 'public');

                // Store the record, using the new file hashname which will be it's new filename identity.
                
                $settings = Settings::create([

                    'system_name' => $request->system_name,
                    'sub_name' => $request->sub_name,
                    'logo' => $request->logo->hashName(),
                    'video' => $request->video->hashName(),
                    'overtime' => $request->overtime,
                ]);
                $settings = new Settings([
                    
                    'system_name' => $request->system_name,
                    'sub_name' => $request->sub_name,
                    'logo' => $request->logo->hashName(),
                    'video' => $request->video->hashName(),
                    'overtime' => $request->overtime,
                ]);
                $settings->save(); // Finally, save the record.

            }else {
                echo'nothing';
            }


    } 
    public function update(StoreSettingsRequest $request) {
        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('logo') && $request->hasFile('video')) {


            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->logo->store('logo', 'public');
            $request->video->store('video', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $settings = Settings::first();
            $settings->system_name = $request->system_name;
            $settings->sub_name = $request->sub_name;
            $settings->logo = $request->logo->hashName();
            $settings->video = $request->video->hashName();
            $settings->overtime = $request->overtime;
            $settings->save(); // Finally, save the record.

        }else {
            echo'nothing';
        }
        return view('admin.settings.index',compact('settings'));
    }












       // $logoTemporaryFile = TemporaryFile::where('folder', $request->logo)->first();
        // $videoTemporaryFile = TemporaryFile::where('folder', $request->video)->first();

        // // if($logoTemporaryFile && $videoTemporaryFile) {

        // //     $settings->addMedia(storage_path('app/public/logo/tmp/' . $request->logo .'/' . $logoTemporaryFile->filename))
        // //     ->toMediaCollection('logo');
        // //     $settings->addMedia(storage_path('app/public/video/tmp/' . $request->video .'/' . $videoTemporaryFile->filename))
        // //     ->toMediaCollection('video');
        // //     rmdir(storage_path('app/public/video/tmp/'. $request->video));

        // //     rmdir(storage_path('app/public/logo/tmp/'. $request->logo));
        // //     $logoTemporaryFile->delete();
        // //     $videoTemporaryFile->delete();

        // // }

        // if($videoTemporaryFile) {

        //     $settings->addMedia(storage_path('app/public/video/tmp/' . $request->video .'/' . $videoTemporaryFile->filename))
        //     ->toMediaCollection('video');

        //     rmdir(storage_path('app/public/video/tmp/'. $request->video));
        //     $videoTemporaryFile->delete();
        // }
}
