<?php

namespace App\Traits;

use App\Models\File;

trait Genericos
{

    public function validateReq($req){

        $req->validate([
        	'programa'	=> ["required" , "max:12", "in:Juego,Encriptacion"]  
        ]);

        $req->validate([
        	'file' => 'required|mimes:txt|max:2048'
        ]);

    }

   public function saveFile($upFile){

        $fileModel = new File;
        if($upFile->file()) {
            $fileName = time().'_'.$upFile->file->getClientOriginalName();
            $filePath = $upFile->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time().'_'.$upFile->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
        }

   }

}

?>