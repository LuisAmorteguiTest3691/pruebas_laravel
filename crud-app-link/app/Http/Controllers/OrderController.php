<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

/**
 * @OA\Info(title="API de Órdenes", version="1.0.0")
 */
class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/orders",
     *     summary="Obtener todas las órdenes",
     *     tags={"Órdenes"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de órdenes",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Order"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Crear una nueva orden",
     *     tags={"Órdenes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Orden creada",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     summary="Obtener una orden específica",
     *     tags={"Órdenes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la orden",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Orden no encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }
        return response()->json($order, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}",
     *     summary="Actualizar una orden",
     *     tags={"Órdenes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Orden actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Orden no encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }
        $order->update($request->all());
        return response()->json($order, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Eliminar una orden",
     *     tags={"Órdenes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Orden eliminada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Orden no encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }
        $order->delete();
        return response()->json(null, 204);
    }
}
