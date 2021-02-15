<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use View;
use Redirect;
use Validator;
use Input;
use Session;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Open list of manufacturers');
        $manufacturers = Manufacturer::orderBy('created_at', 'DESC')->get();
        return View::make('manufacturers.index')
            ->with('manufacturers', $manufacturers);
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
        $rules = array(
            'name'       => 'required',
            'link'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of creation a new manufacturer');
            return Redirect::to('/manufacturers')
                ->withErrors($validator);
        } else {
            $manufacturer = new Manufacturer;
            $manufacturer->name = Input::get('name');
            $manufacturer->link = Input::get('link');

            Log::info('Successfully created');
            $manufacturer->save();

            return Redirect::to('/manufacturers');
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
        Log::info('Open info page of manufacturer by id: '.$id);
        return View::make('manufacturers.show')
            ->with('manufacturer', Manufacturer::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('Open edit page of manufacturer by id: '.$id);
        return View::make('manufacturers.edit')
            ->with('manufacturer', Manufacturer::find($id));
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
        $rules = array(
            'name'       => 'required',
            'link'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of update manufacturer by id: '.$id);
            return Redirect::to('/manufacturers/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            $manufacturer = Manufacturer::find($id);
            $manufacturer->name = Input::get('name');
            $manufacturer->link = Input::get('link');

            Log::info('Successfully updated manufacturer by id: '.$id);
            $manufacturer->save();

            return Redirect::to('/manufacturers');
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
        $manufacturer = Manufacturer::find($id);
        if (!empty($manufacturer)) {
            Log::info('Delete manufacturer by id: '.$id);
            $manufacturer->delete();
        }
        return Redirect::to('/manufacturers');
    }
}
