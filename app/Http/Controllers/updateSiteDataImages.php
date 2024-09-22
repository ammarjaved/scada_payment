<?php

namespace App\Http\Controllers;

use App\Http\Controllers\web\siteDateCollection;
use App\Models\SiteDataCollection;
use App\Models\SiteImage;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\SiteVisitRepository;

class updateSiteDataImages extends Controller
{

    private $siteRepository;


    public function __construct(SiteVisitRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return redirect()->route('site-data-collection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = SiteImage::with('siteData')->where('site_data_id',$request->id)->where('status',$request->status)->first();


        if($data){
            return view('siteDataCollections.uploadImages.edit', ['data' => $data , 'status'=>$request->status]);


        }else{
            $data = SiteDataCollection::find($request->id);

            return view('siteDataCollections.uploadImages.create', ['data' => $data , 'status'=>$request->status]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $status)
    {
        //r
        return "SDfsdfsdf";
        $data = SiteDataCollection::find($id);
        return view('siteDataCollections.uploadImages.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $img_id = '';
        if($request->has('site_data_id')){
            $img_id = $request->site_data_id;

        }else{
            $img_id = $id;
        }
        // return $request->status;
        // $id = SiteDataCollection::find($id);
        // $destinationPath = 'assets/images/';
        try {
            if($request->image){
         $test =   $this->siteRepository->addImages($request->image , $img_id , $request->status);
            }
        //  return $test;
        //     if ($request->has('image')) {
        //         foreach ($request->image as $key => $file) {
        //             if ($request->hasFile('image.' . $key)) {
        //                 $file = $request->file('image.' . $key);
        //                 $img_exc = $file->getClientOriginalExtension();
        //                 $filename = $key . '-' . strtotime(now()) . '.' . $img_exc;
        //                 $file->move($destinationPath, $filename);
        //                 $request[$key] = $destinationPath . $filename;
        //             }
        //         }
        //     }
        //     $id->update($request->all());
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Form Submitted');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
