<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class SettingsUploadController extends Controller
{
    public function store(Request $request) {
        // STORE IMAGE TO TEMPORARY FILES
    if($request->hasFile('logo')){
        $file = $request->file('logo');
        $filename = $file->getClientOriginalName();
        $folder = uniqid(). '-' . now()->timestamp;
        $file->storeAs('public/logo/tmp/' . $folder, $filename);
        TemporaryFile::create([
            'folder' => $folder,
            'filename' => $filename,
        ]);

        return $folder;

        // Image::make(storage_path('app/public/logo/'. $settings->id . '/' .$filename))
        // ->fit(50,50)
        // ->save(storage_path('app/public/logo/' . $settings->id . '/thumb-' . $filename));

        // $settings->save([
        //     'logo' => $filename,
        // ])
        }

        if($request->hasFile('video')){
            $file = $request->file('video');
            $filename = $file->getClientOriginalName();
            $folder = uniqid(). '-' . now()->timestamp;
            $file->storeAs('public/video/tmp/' . $folder, $filename);
    
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);


            return $folder;
    
            // Image::make(storage_path('app/public/logo/'. $settings->id . '/' .$filename))
            // ->fit(50,50)
            // ->save(storage_path('app/public/logo/' . $settings->id . '/thumb-' . $filename));
    
            // $settings->save([
            //     'logo' => $filename,
            // ])
            }
            return '';




        }


        
}
