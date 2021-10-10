<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BookController extends Controller
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
     * Return books list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $records = Book::all();
        return $this->successResponse($records);
    }

    /**
     * Create an instance of book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);
        $record = Book::create($request->all());
        return $this->successResponse($record, Response::HTTP_CREATED);
    }

    /**
     * Return an specific book
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Book::findOrFail($id);
        return $this->successResponse($record);
    }

    /**
     * Update the information of an existing book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1'
        ];

        $this->validate($request, $rules);
        $record = Book::findOrFail($id);
        $record->fill($request->all());

        if($record->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $record->save();
        return $this->successResponse($record);
    }

    /**
     * Removes an existing book
     * @return Illuminate\Http\Response
     */
    public function destory($id)
    {
        $record = Book::findOrFail($id);
        $record->delete();
        return $this->successResponse($record);
    }

    //
}
