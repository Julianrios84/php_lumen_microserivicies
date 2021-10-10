<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Responser;   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return users list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::all();
        return $this->validResponse($records);
    }

    /**
     * Create an instance of user
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);
        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);
        $record = User::create($fields);
        return $this->successResponse($record, Response::HTTP_CREATED);
    }

    /**
     * Return an specific user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = User::findOrFail($id);
        return $this->successResponse($record);
    }

    /**
     * Update the information of an existing user
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,'.$id,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);
        $record = User::findOrFail($id);
        $record->fill($request->all());

        if($request->has('password')) {
            $record->password = Hash::make($request->password);
        }

        if($record->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $record->save();
        return $this->successResponse($record);
    }

    /**
     * Removes an existing user
     * @return Illuminate\Http\Response
     */
    public function destory($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        return $this->successResponse($record);
    }


    /**
     * Identifies the curren user
     * @return Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }

    //
}
