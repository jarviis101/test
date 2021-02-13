<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DrugResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Drug;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel Api Test",
 *      description="Laravel Api Test",
 *      @OA\Contact(
 *          email="jarviis101@gmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 * @OA\Tag(
 *     name="Drugs",
 *     description="API Endpoints of Drugs"
 * )
 */
class DrugApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/drugs",
     *      operationId="getDrugsList",
     *      tags={"Drugs"},
     *      summary="Get list of drugs",
     *      description="Returns list of drugs",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DrugResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        return new DrugResource(Drug::all());
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/drugs/{id}",
     *      operationId="getDrugById",
     *      tags={"Drugs"},
     *      summary="Get drug info by ID",
     *      description="Returns drug data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Drug id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Drug")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        $drug = Drug::find($id);
        if(isset($drug)){
            return new DrugResource($drug);
        }

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
