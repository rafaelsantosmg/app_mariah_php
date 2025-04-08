<?php

namespace App\Helpers;

class HttpStatus
{
  // Success
  public const OK              = 200;
  public const CREATED         = 201;
  public const NO_CONTENT      = 204;
  public const RESET_CONTENT   = 205;
  public const PARTIAL_CONTENT = 206;

  // Redirection
  public const MOVED_PERMANENTLY  = 301;
  public const FOUND              = 302;
  public const SEE_OTHER          = 303;
  public const NOT_MODIFIED       = 304;
  public const USE_PROXY          = 305;
  public const TEMPORARY_REDIRECT = 307;

  // Client Errors
  public const BAD_REQUEST                   = 400;
  public const UNAUTHORIZED                  = 401;
  public const PAYMENT_REQUIRED              = 402;
  public const FORBIDDEN                     = 403;
  public const NOT_FOUND                     = 404;
  public const METHOD_NOT_ALLOWED            = 405;
  public const NOT_ACCEPTABLE                = 406;
  public const PROXY_AUTHENTICATION_REQUIRED = 407;
  public const REQUEST_TIMEOUT               = 408;
  public const CONFLICT                      = 409;
  public const UNPROCESSABLE_ENTITY          = 422;

  // 5xx Server Errors
  public const INTERNAL_SERVER_ERROR = 500;
  public const BAD_GATEWAY           = 502;
}
