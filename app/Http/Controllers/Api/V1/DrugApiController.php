<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DrugResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

use App\Models\Drug;

/**
 * @OA\Tag(
 *     name="Drugs",
 *     description="API Endpoints"
 * )
 */
class DrugApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    /**
     * @OA\Get(
     *      path="/v1/drugs",
     *      security={{ "apiAuth": {} }},
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
     *     )
     */
    public function index()
    {
        Log::info('Get list of drugs');
        return new DrugResource(Drug::all());
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/v1/drugs/{id}",
     *      security={{ "apiAuth": {} }},
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
        Log::info('Get drug info by ID: '.$id);
        $drug = Drug::find($id);
        if (isset($drug)) {
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
