<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
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
     * Return authors list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $records = Author::all();
        return $this->successResponse($records);
    }

    /**
     * Create an instance of Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ];

        $this->validate($request, $rules);
        $record = Author::create($request->all());
        return $this->successResponse($record, Response::HTTP_CREATED);
    }

    /**
     * Return an specific author
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Author::findOrFail($id);
        return $this->successResponse($record);
    }

    /**
     * Update the information of an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255'
        ];

        $this->validate($request, $rules);

        $record = Author::findOrFail($id);

        $record->fill($request->all());

        if($record->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $record->save();
        return $this->successResponse($record);
    }

    /**
     * Removes an existing author
     * @return Illuminate\Http\Response
     */
    public function destory($id)
    {
        $record = Author::findOrFail($id);
        $record->delete();
        return $this->successResponse($record);
    }
    

    //
}
