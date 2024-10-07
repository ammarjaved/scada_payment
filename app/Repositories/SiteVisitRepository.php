<?php

namespace App\Repositories;

use App\Models\SiteImage;
use Illuminate\Support\Facades\Log;

class SiteVisitRepository {


    public function addImages(array $request, $id, $status)
{
    try{
    if ($request) {
        $destinationPath = 'assets/images/';
        $uploadedImages = [];

        foreach ($request as $key => $file) {
            if (is_uploaded_file($file)) {
                $img_ext = $file->getClientOriginalExtension();
                $filename = $key . '-' . strtotime(now()) . '.' . $img_ext;
                $file->move($destinationPath, $filename);
                $uploadedImages[$key] = $destinationPath . $filename;
            }
        }


        $data = SiteImage::where('site_data_id', $id)->where('status', $status)->first();

        if ($data) {
    
 
            $data->update($uploadedImages);
        }else{
            $uploadedImages['status'] = $status;
            $uploadedImages['site_data_id'] = $id;
// dd($data);
            SiteImage::create($uploadedImages);
        }
    }
    }catch (\Exception $e) {

          Log::error($e->getMessage());
        return $e->getMessage();
    }

}



    public function removeImg(array $data)
    {
        $i = 0 ;
        foreach($data as $key => $path){
            if(file_exists(public_path($path))){
                $i++;
            }
        }
        dd($i);

    }



}
