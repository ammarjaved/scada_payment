<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\EstimationWork as ModelsEstimationWork;
use App\Models\SiteDataCollection;
use Exception;
use Illuminate\Http\Request;

class estimationWork extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = ModelsEstimationWork::with('siteData')->get();
        return view('estimationWork.index', ['datas' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estimationWork.create', ['siteDatas' => SiteDataCollection::all(['id', 'nama_pe'])]);
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
        try {
            ModelsEstimationWork::create($request->all());

            return redirect()
                ->route('estimation-work.index')
                ->with('success', 'Form Submitted');
        } catch (Exception $e) {
            return redirect()
                ->route('estimation-work.index')
                ->with('failed', 'Request failed');
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
        $data = ModelsEstimationWork::with('siteData')->find($id);

        return $data ? view('estimationWork.show', ['data' => $data]) : abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = ModelsEstimationWork::with('siteData')->find($id);

        return $data ? view('estimationWork.edit', ['data' => $data]) : abort(404);
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
            ModelsEstimationWork::find($id)->update($request->all());

            return redirect()
                ->route('estimation-work.index')
                ->with('success', 'Form Updated');
        } catch (Exception $e) {
            return redirect()
                ->route('estimation-work.index')
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
            ModelsEstimationWork::find($id)->delete();

            return redirect()
                ->route('estimation-work.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('estimation-work.index')
                ->with('failed', 'Request failed');
        }
    }
}
