<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Manufacturer;
use App\Models\Ingredient;
use View;
use Redirect;
use Validator;
use Input;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Open list of drugs');
        $drugs = Drug::orderBy('created_at', 'DESC')->get();
        foreach ($drugs as $drug) {
            $drug['ingredient'] = Ingredient::find($drug->ingredient_id)['name'];
            $drug['manufacturer'] = Manufacturer::find($drug->manufacturer_id)['name'];
        }
        $manufacturers = Manufacturer::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        return View::make('drugs.index')->with('drugs', $drugs)
            ->with('manufacturers', $manufacturers)
            ->with('ingredients', $ingredients);
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
            'price'      => 'required',
            'manufacturer_id' => 'required',
            'ingredient_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of creation a new drug');
            return Redirect::to('/drugs')
                ->withErrors($validator);
        } else {
            $drug = new Drug;
            $drug->name = Input::get('name');
            $drug->price = Input::get('price');
            $drug->ingredient_id = Input::get('ingredient_id');
            $drug->manufacturer_id = Input::get('manufacturer_id');

            Log::info('Successfully created');
            $drug->save();

            return Redirect::to('/drugs');
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
        Log::info('Open info page of drug by id: '.$id);
        $drug = Drug::find($id);
        $drug['ingredient'] = Ingredient::find($drug->ingredient_id)['name'];
        $drug['manufacturer'] = Manufacturer::find($drug->manufacturer_id)['name'];
        return View::make('drugs.show')->with('drug', $drug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('Open edit page of drug by id: '.$id);
        $manufacturers = Manufacturer::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        return View::make('drugs.edit')
            ->with('drug', Drug::find($id))
            ->with('manufacturers', $manufacturers)
            ->with('ingredients', $ingredients);
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
            'price'      => 'required',
            'manufacturer_id' => 'required',
            'ingredient_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of update drug by id: '.$id);
            return Redirect::to('/drugs/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            $drug = Drug::find($id);
            $drug->name = Input::get('name');
            $drug->price = Input::get('price');
            $drug->ingredient_id = Input::get('ingredient_id');
            $drug->manufacturer_id = Input::get('manufacturer_id');

            Log::info('Successfully updated drug by id: '.$id);
            $drug->save();

            return Redirect::to('/drugs');
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
        $drug = Drug::find($id);
        if (!empty($drug)) {
            Log::info('Delete drug by id: '.$id);
            $drug->delete();
        }
        return Redirect::to('drugs');
    }
}
