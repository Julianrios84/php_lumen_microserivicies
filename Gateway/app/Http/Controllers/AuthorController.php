<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\Responser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use Responser;

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
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Retrieve and show all the authors
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create an instance of Author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obtain and sow an instance of author
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse($this->authorService->obtainAuthor($id));
    }

    /**
     * Updated an instance of author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $id));
    }

    /**
     * Removes an instance of author
     * @return Illuminate\Http\Response
     */
    public function destory($id)
    {
        return $this->successResponse($this->authorService->deleteAuthor($id));
    }

    //
}
