<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService {

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
    $this->baseUri = config("services.authors.base_uri");
    $this->secret = config("services.authors.secret");
  }

  /**
   * Get the full list of authors from the authors service
   * @return string
   */
  public function obtainAuthors() 
  {
    return $this->performRequest("GET", "/authors");
  }

  /**
   * Create an instance of author using the authors serivice
   * @return string
   */
  public function createAuthor($data)
  {
    return $this->performRequest("POST", "/authors", $data);
  }

  /**
   * Get a single author from the authors service
   * @return string
   */
  public function obtainAuthor($id)
  {
    return $this->performRequest("GET", "/authors/{$id}");
  }

  /**
   * Edit a single author from the authors service
   * @return string
   */
  public function editAuthor($data, $id)
  {
    return $this->performRequest("PUT", "/authors/{$id}", $data);
  }


  /**
   * Remove a single author from the authors service
   * @return string
   */
  public function deleteAuthor($id)
  {
    return $this->performRequest("DELETE", "/authors/{$id}");
  }
}