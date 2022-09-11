<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use DB;

class userController extends Controller
{
    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getUsersList",
     *      tags={"Users"},
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
        $users = Users::select('id','nome', 'cpf', DB::raw("date_format(data_nascimento,'%d/%m/%Y') as data_nascimento"), 'telefone')->get();
        return response()->json($users);
    }

    /**
     * @OA\Post(
     *      path="/users",
     *      operationId="storeUsers",
     *      tags={"Users"},
     *      summary="Store new users",
     *      description="Returns users data",
     *      @OA\RequestBody(
     *          required=true
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
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
    public function store(Request $request)
    {
        // return response()->json($request);
        $validator = Validator::make($request->all(), 
                      [ 
                      'nome' => 'required',
                      'cpf' => 'required',
                      'dateFormatted' => 'required',  
                      'telefone' => 'required',  
                     ]);  

         if ($validator->fails()) {  

               return response()->json(['error'=>$validator->errors()], 401); 

            }   

        $user = new Users();
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->data_nascimento = $request->dateFormatted;
        $user->telefone = $request->telefone;
        $user->save();


        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cpf)
    {
        $cpf = Users::select('cpf')->where('cpf', $cpf)->first();
        if($cpf){
            return response()->json([
                'exists' => true,
                'data' => $cpf
            ], Response::HTTP_OK);
        }
        return response()->json($cpf);
    }

    /**
     * @OA\Put(
     *      path="/users/{id}",
     *      operationId="updateUsers",
     *      tags={"Users"},
     *      summary="Update existing users",
     *      description="Returns updated users data",
     *      @OA\Parameter(
     *          name="id",
     *          description="users id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nome",
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
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
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Request $request, $id)
    {
        $update = new Users();
        $update->where('id', $id)->update(['nome' => $request->nome, 'cpf' => $request->cpf, 
            'data_nascimento'=> $request->dateFormatted, 'telefone' => $request->telefone]);

        return response()->json([
            'success' => true,
            'data' => $update
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *      path="/users/{id}",
     *      operationId="deleteUsers",
     *      tags={"Users"},
     *      summary="Delete existing users",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="users id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        $delete = new Users();
        $delete->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'data' => $delete
        ], Response::HTTP_OK);
    }
}
