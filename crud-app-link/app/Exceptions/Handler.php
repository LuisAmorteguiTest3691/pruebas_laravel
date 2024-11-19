<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Una lista de las excepciones que no se deben reportar.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * Una lista de los campos que no deben incluirse en las excepciones de validación.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Registra las devoluciones de llamada para el manejo de excepciones.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Renderiza las excepciones como respuestas HTTP.
     */
    public function render($request, Throwable $exception)
    {
        // Manejo de errores de recursos no encontrados (404)
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'El recurso solicitado no fue encontrado',
            ], 404);
        }

        // Manejo de errores de validación (422)
        if ($exception instanceof ValidationException) {
            return response()->json([
                'message' => 'La validación falló',
                'errors' => $exception->errors(),
            ], 422);
        }

        // Manejo de errores HTTP genéricos
        if ($exception instanceof HttpResponseException) {
            return $exception->getResponse();
        }

        // Manejo genérico para otros errores (500)
        return response()->json([
            'error' => 'Ha ocurrido un error inesperado, por favor intenta más tarde',
        ], 500);
    }
}