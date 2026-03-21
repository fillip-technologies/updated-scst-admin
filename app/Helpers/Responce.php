<?php

if (! function_exists('SuccessResponse')) {
    function SuccessResponse($code, $message, $data)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);

    }
}

if (! function_exists('ErrorResponse')) {

    function ErrorResponse($code, $message, $error = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $error,
        ], $code);
    }

}
