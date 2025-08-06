<?php

if (!function_exists('successResponse')) {
  /**
   * Return success JSON response
   */
  function successResponse($message = 'Success', $data = null, $code = 200)
  {
    $response = [
      'success' => true,
      'message' => $message,
      'code' => $code
    ];

    if ($data !== null) {
      $response['data'] = $data;
    }

    return response()->json($response, $code);
  }
}

if (!function_exists('errorResponse')) {
  /**
   * Return error JSON response
   */
  function errorResponse($message = 'Error', $code = 400, $errors = null)
  {
    $response = [
      'success' => false,
      'message' => $message,
      'code' => $code
    ];

    if ($errors !== null) {
      $response['errors'] = $errors;
    }

    return response()->json($response, $code);
  }
}

if (!function_exists('validationErrorResponse')) {
  /**
   * Return validation error JSON response
   */
  function validationErrorResponse($errors, $message = 'Validation failed')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'code' => 422,
      'errors' => $errors
    ], 422);
  }
}

if (!function_exists('notFoundResponse')) {
  /**
   * Return not found JSON response
   */
  function notFoundResponse($message = 'Data not found')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'code' => 404
    ], 404);
  }
}

if (!function_exists('unauthorizedResponse')) {
  /**
   * Return unauthorized JSON response
   */
  function unauthorizedResponse($message = 'Unauthorized')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'code' => 401
    ], 401);
  }
}

if (!function_exists('forbiddenResponse')) {
  /**
   * Return forbidden JSON response
   */
  function forbiddenResponse($message = 'Forbidden')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'code' => 403
    ], 403);
  }
}

if (!function_exists('serverErrorResponse')) {
  /**
   * Return server error JSON response
   */
  function serverErrorResponse($message = 'Internal server error')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'code' => 500
    ], 500);
  }
}

if (!function_exists('paginatedResponse')) {
  /**
   * Return paginated JSON response
   */
  function paginatedResponse($message = 'Success', $data, $code = 200)
  {
    return response()->json([
      'success' => true,
      'message' => $message,
      'code' => $code,
      'data' => $data->items(),
      'pagination' => [
        'current_page' => $data->currentPage(),
        'last_page' => $data->lastPage(),
        'per_page' => $data->perPage(),
        'total' => $data->total(),
        'from' => $data->firstItem(),
        'to' => $data->lastItem(),
        'has_more_pages' => $data->hasMorePages()
      ]
    ], $code);
  }
}
