<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BookController extends Controller
{
    use Responser;

    /**
     * The service to consume the book service
     * @var BookService
     */

    public $bookService;

    /**
     * The service to consume the author service
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Retrieve and show all the books
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create an instance of book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtain and sow an instance of book
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->bookService->obtainBook($id));
    }

    /**
     * Updated an instance of book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $id));
    }

    /**
     * Removes an instance of book
     * @return Illuminate\Http\Response
     */
    public function destory($id)
    {
        return $this->successResponse($this->bookService->deleteBook($id));
    }

    //
}
