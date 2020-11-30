<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Traits\Genericos;
use App\Traits\Juego;
use App\Traits\Encriptacion;

class FileUpload extends Controller
{

	use Genericos,Juego,Encriptacion;

 	public function createForm()
 	{
		return view('file-upload');
	}

  	public function fileUpload(Request $req)
  	{

		$this->validateReq($req);
		$this->saveFile($req);

		$calcula= 'calcula'.$req->programa;
  		$txt = $this->$calcula($req->file);

		$response = new StreamedResponse();
        $response->setCallBack(function () use($txt) {
            echo $txt;
        });

        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Respuesta_'.$req->programa.'.txt');
        $response->headers->set('Content-Disposition', $disposition);

        return $response;

   }

}