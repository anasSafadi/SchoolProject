<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;

class downloadfilesController extends Controller
{
    public function download_files_for_teacher($id){


        $file=File::where("url","=","$id")->first();
        if (isset($file->client_name)){
        return response()->download(storage_path("app/files/$id"),$file->client_name);}

        else return response()->download(storage_path("app/files/$id"));


              }
//    public function zip_file(){
//
//        $zip = new ZipArchive;
//
//        $fileName = 'zipFileName.zip';
//
//        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
//        {
//            // Folder files to zip and download
//            // files folder must be existing to your public folder
//            $files = \Illuminate\Support\Facades\File::files(public_path('my_files'));
//
//            // loop the files result
//            foreach ($files as $key => $value) {
//                $relativeNameInZipFile = basename($value);
//                $zip->addFile($value, $relativeNameInZipFile);
//            }
//
//            $zip->close();
//        }
//
//        // Download the generated zip
//        return response()->download(public_path($fileName));
//    }



}
