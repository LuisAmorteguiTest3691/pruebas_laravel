<?php

namespace App\Exceptions;

use Exception;

class OrderNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'La orden solicitada no existe.',
        ], 404);
    }
}
