<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use View;
use Redirect;
use Validator;
use Input;
use Session;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Open list of ingredients');
        $ingredients = Ingredient::orderBy('created_at', 'DESC')->get();
        return View::make('ingredients.index')
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
            'name'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of creation a new ingredient');
            return Redirect::to('/ingredients')
                ->withErrors($validator);
        } else {
            $ingredient = new Ingredient;
            $ingredient->name = Input::get('name');

            Log::info('Successfully created');
            $ingredient->save();

            return Redirect::to('/ingredients');
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
        Log::info('Open info page of ingredient by id: '.$id);
        return View::make('ingredients.show')
            ->with('ingredient', Ingredient::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('Open edit page of ingredient by id: '.$id);
        return View::make('ingredients.edit')
            ->with('ingredient', Ingredient::find($id));
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
            'name'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('Error validation of update ingredient by id: '.$id);
            return Redirect::to('/ingredients/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            $ingredient = Ingredient::find($id);
            $ingredient->name = Input::get('name');

            Log::info('Successfully updated ingredient by id: '.$id);
            $ingredient->save();

            return Redirect::to('/ingredients');
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
        $ingredient = Ingredient::find($id);
        if (!empty($ingredient)) {
            Log::info('Delete ingredient by id: '.$id);
            $ingredient->delete();
        }
        return Redirect::to('/ingredients');
    }
}
