<?php

namespace App\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'El producto solicitado no existe.',
        ], 404);
    }
}
