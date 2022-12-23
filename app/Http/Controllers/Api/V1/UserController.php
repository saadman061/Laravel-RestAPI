<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json("You are not authorize to perform this action");
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

       $input = $request->validated();
       $resMessage = [];
        try {
            User::create([
                'id' => $input['user_id'],
                'name' => $input['name'],
                'email' => $input['email'],
                'contact' => $input['contact'],
            ]);
            $resMessage = ['code' => 200 ,'status' => 'success' , 'message' => 'User created successfully.'];
        } catch (QueryException $e) {
            $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not created successfully.', 'error_details' => $e->getMessage()];
        } catch (\Exception $e) {
            $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not created successfully.', 'error_details' => $e->getMessage()];
        }

       return response()->json($resMessage,$resMessage['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json("You are not authorize to perform this action");
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,$id)
    {
        $user = User::find($id); 
        if ($user) {
            $input = $request->validated();
            $resMessage = [];
            try {  
                $user->update($input);
                $resMessage = ['code' => 200 ,'status' => 'success' , 'message' => 'User updated successfully.'];
            } catch (QueryException $e) {
                $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not updated successfully.', 'error_details' => $e->getMessage()];
            } catch (\Exception $e) {
                $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not updated successfully.', 'error_details' => $e->getMessage()];
            }
            return response()->json($resMessage ,$resMessage['code']);
        } else {
            return response()->json(['code' => 404 ,'status' => 'error','message' => 'User not found'], 404);
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
        $user = User::find($id); 
        if ($user) {
            $resMessage = [];
            try {  
                $user->delete();
                $resMessage = ['code' => 200 ,'status' => 'success' , 'message' => 'User deleted successfully.'];
            } catch (QueryException $e) {
                $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not deleted successfully.', 'error_details' => $e->getMessage()];
            } catch (\Exception $e) {
                $resMessage = ['code' => 400 ,'status' => 'error' , 'message' => 'User not deleted successfully.', 'error_details' => $e->getMessage()];
            }
            
        } else {
            return response()->json(['code' => 404 ,'status' => 'error','message' => 'User not found'], 404);
        }
       
    }
}
