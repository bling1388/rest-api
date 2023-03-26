<?php

namespace App\Http\Controllers\API;

use App\Models\Rest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RestController extends Controller
{
    public function index()
    {
        $rest = Rest::all();

        if($rest->count() > 0){
            return response()->json([
                'status' => 200,
                'rest' => $rest
            ],200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No data found',
            ],404);
        }
       
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',

        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);

        }else{
            $rest = Rest::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,

            ],200);

            if($rest){

                return response()->json([
                    'status' => 200,
                    'message' => 'Rest created successfully',
                ]);

            }else{

                return response()-json([

                    'status' => 500,
                    'message' => 'There was a problem 9874',
                ],500);

            }

        }

    }


    public function edit(Request $request, $id)
    {

        $rest = Rest::find($id);

        if($rest){

            return response()->json([
                'status' => 200,
                'massage' => $rest,
                
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Rest api not found',
               
            ],404);

        }
       
    }


    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',

        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);

        }else{

            $rest = Rest::find($id);

        if($rest){

            $rest->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone

            ]);

            

                return response()->json([
                    'status' => 200,
                    'message' => 'Rest updated successfully',
                ],200);

        }else{

                return response()-json([

                    'status' => 404,
                    'message' => 'No rest found 5841',
                ],404);

            }

        }

    }

    public function delete(Request $request,$id)
    {
        $rest = Rest::find($id);

        if($rest){
            $rest->delete([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response()->json([

            'status' => 200,
            'message' => 'Rest deleted successfully',

        ],200);
        }else{
            return response()->json([

                'status' => 404,
                'message' => 'Rest not found',
    
            ],404);

        }
        
    }
}
