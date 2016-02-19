<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gallery; use App\Image as ImageModel;  //because of the same name image
use Validator;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as ImageFacade;  //because of the same name image using as

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //return view('gallery.gallery-bst');
        return view('gallery.gallery');
        //return view('gallery.gallery-jqry');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $output_dir = "gallery/photo";
        if(isset($_FILES["myfile"]))
        {
            $ret = array();
            
        //  This is for custom errors;  
        /*  $custom_error= array();
            $custom_error['jquery-upload-file-error']="File already exists";
            echo json_encode($custom_error);
            die();
        */
            $error =$_FILES["myfile"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if(!is_array($_FILES["myfile"]["name"])) //single file
            {
                $fileName = $_FILES["myfile"]["name"];
                move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
                $ret[]= $fileName;
            }
            else  //Multiple files, file[]
            {
              $fileCount = count($_FILES["myfile"]["name"]);
              for($i=0; $i < $fileCount; $i++)
              {
                $fileName = $_FILES["myfile"]["name"][$i];
                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
                $ret[]= $fileName;
              }
            
            }
            echo json_encode($ret);
         }

        /*$validator = Validator::make($request->all(),[
            'image' =>  'required',
            ]);

        if ($validator->fails()) {
            return redirect('galery')
                        ->withErrors($validator)
                        ->withInput();
        }

        $gallery_name =   $request->input('gallery_name');
        
        $files       =   $request->file('image');
        dd($files);
        
        $captions     =   $request->input('caption');  
       
        if(empty($gallery_name)){
            //if no gallery is named, then
            $gallery_name =  'Timeline Photos';
        }

        $gallery = new Gallery;
        $gallery->name = $gallery_name;
        $gallery->save();               //save gallery for once

        for($i=0; $i<count(array_filter($files)); $i++) {
            $filename = uniqid() . $files[$i]->getClientOriginalName();
            
            if(!file_exists('gallery/images')){     //create file
                mkdir('gallery/images',077,true);
            }
            $files[$i]->move('gallery/images', $filename); //upload image to folder
            
            $image   = new ImageModel;
            //$image->caption     =  $captions[$i];
            $image->file_name   =  $filename;
            $image->file_size   =  $files[$i]->getClientSize();
            $image->file_mime   =  $files[$i]->getClientMimeType();
            $image->file_path   =  'gallery/images/' . $filename;
            $gallery->image()->save($image);                  
        }        
            //saving images to image table with eloquent relationship
            //gallery id is passed automatically to image table
            
        //Session::flash('flash_message','Image succesfully Updated');
        //return redirect('/galery');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
