<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{

  use ConsumesExternalService;

  /**
   * The base uri to be used to consume the authors service
   * @var string
   */

  public $baseUri;

  /**
   * The secret to be used to consume the authors service
   * @var string
   */

  public $secret;

  public function __construct()
  {
    $this->baseUri = config('services.books.base_uri');
    $this->secret = config("services.books.secret");
  }

  /**
   * Get the full list of books from the books service
   * @return string
   */
  public function obtainBooks()
  {
    return $this->performRequest("GET", "/books");
  }

  /**
   * Create an instance of book using the books serivice
   * @return string
   */
  public function createBook($data)
  {
    return $this->performRequest("POST", "/books", $data);
  }

  /**
   * Get a single book from the books service
   * @return string
   */
  public function obtainBook($id)
  {
    return $this->performRequest("GET", "/books/{$id}");
  }

  /**
   * Edit a single book from the books service
   * @return string
   */
  public function editBook($data, $id)
  {
    return $this->performRequest("PUT", "/books/{$id}", $data);
  }


  /**
   * Remove a single book from the books service
   * @return string
   */
  public function deleteBook($id)
  {
    return $this->performRequest("DELETE", "/books/{$id}");
  }
}
