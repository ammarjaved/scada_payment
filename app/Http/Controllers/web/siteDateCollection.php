<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\EstimationWork;
use App\Models\SiteDataCollection;
use App\Models\SiteImage;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\SiteVisitRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\RmuBudgetTNBModel;
use App\Models\RmuAeroSpendModel;




class siteDateCollection extends Controller
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
     $project= Auth::user()->project;
        $datas = SiteDataCollection::where('project',$project)->get();

        // return $siteDataCollections;
         $rmus = RmuBudgetTNBModel::with('RmuSpends')->get();


         foreach ($datas as $data) {
            $matchingRmu = $rmus->firstWhere('pe_name', $data->nama_pe);
            if ($matchingRmu) {
                $data->budget = $matchingRmu->total;

                if ($matchingRmu->RmuSpends) {
                    $data->aero_spend = $matchingRmu->RmuSpends->total; // Adjust field name as necessary
                    $data->profit_percent=(($matchingRmu->total-$matchingRmu->RmuSpends->total)/$matchingRmu->total)*100;
                    $data->profit_total=$matchingRmu->total-$matchingRmu->RmuSpends->total;


                } else {
                    $data->aero_spend = null;
                    $data->profit_percent = null;
                }
            } else {
                $data->budget = 'Not Available'; // or any default value you prefer
                $data->aero_spend = 'Not Available';
                $data->profit_percent = 'Not Available';
            }
            }
        

       
        return view('siteDataCollections.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('siteDataCollections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

        
            $pe_check=SiteDataCollection::where('nama_pe',$request->nama_pe)->first();

            if($pe_check){
                return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request Failed PE Name already exist');
            }
            $data = SiteDataCollection::create($request->all());

            if ($request->image) {
                $this->siteRepository->addImages($request->image, $data->id, 'before');
            }
            DB::statement("UPDATE site_data_collections set geom = ST_GeomFromText('POINT($request->log $request->lat)',4326) where id = $data->id");
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Form Submitted');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request Failed');
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
        $data = SiteDataCollection::with('estWork')
            ->with('siteImg')
            ->find($id);
        // return $data;
        return $data ? view('siteDataCollections.show', ['data' => $data]) : abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SiteDataCollection::find($id);
        return view('siteDataCollections.edit', ['data' => $data]);
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
        try {
            SiteDataCollection::find($id)->update($request->all());
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Form Updated');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
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
        try {
            $siteData = SiteDataCollection::find($id);
            $name = $siteData->nama_pe;
            $gear = $siteData->switchgear;
            $siteData->delete();

            EstimationWork::where('site_data_id', $id)->delete();
            $img = SiteImage::where('site_data_id', $id)->delete();
            // if($img){
            //     $this->siteRepository->removeImg($img);
            // }
            // if ($gear == 'RMU') {
            //     $id = \App\Models\RmuBudgetTNBModel::where('pe_name', $name)->first();
            //     if ($id) {
            //         return redirect()->route('rmu-budget-tnb.destroy', $id->id);
            //     }
            // } elseif ($gear == 'VCB') {
            //     $id = \App\Models\VCBBudgetTNBModel::where('pe_name', $name)->first();
            //     if ($id) {
            //         return redirect()->route('vcb-budget-tnb.destroy', $id->id);
            //     }
            // } elseif ($gear == 'COMPACT') {
            //     $id = \App\Models\RmuBudgetTNBModel::where('pe_name', $name)->first();
            //     if ($id) {
            //         return redirect()->route('csu-budget-tnb.destroy', $id->id);
            //     }
            // }


            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
        }
    }
}
