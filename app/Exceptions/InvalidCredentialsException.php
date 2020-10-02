<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponser;

class InvalidCredentialsException extends Exception
{
  use ApiResponser;

  /**
   * Report the exception.
   *
   * @return void
   */
  public function report()
  {
    //
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function render($request)
  {
    return $this->errorResponse('Invalid Credentials - Unauthorized', 401);
  }
}
