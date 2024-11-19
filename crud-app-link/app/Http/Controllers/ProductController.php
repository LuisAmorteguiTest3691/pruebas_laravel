<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exceptions\ProductNotFoundException;

/**
 * @OA\Info(
 *     title="API de Productos",
 *     version="1.0.0",
 *     description="Gestión completa de productos"
 * )
 * @OA\Tag(
 *     name="Productos",
 *     description="Operaciones CRUD para productos"
 * )
 */
class ProductController extends Controller
{
    /**
     * Listar todos los productos.
     *
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Productos"},
     *     summary="Obtener todos los productos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de productos obtenida con éxito"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * Crear un nuevo producto.
     *
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Productos"},
     *     summary="Crear un nuevo producto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Producto A"),
     *             @OA\Property(property="description", type="string", example="Descripción del producto"),
     *             @OA\Property(property="price", type="number", example=100.5),
     *             @OA\Property(property="stock", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Producto creado con éxito"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    /**
     * Mostrar un producto específico.
     *
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Obtener un producto específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del producto"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto encontrado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            throw new ProductNotFoundException();
        }

        return response()->json($product, 200);
    }

    /**
     * Actualizar un producto existente.
     *
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Actualizar un producto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del producto"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Producto Actualizado"),
     *             @OA\Property(property="description", type="string", example="Nueva descripción"),
     *             @OA\Property(property="price", type="number", example=150.75),
     *             @OA\Property(property="stock", type="integer", example=30)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Producto actualizado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    /**
     * Eliminar un producto.
     *
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Productos"},
     *     summary="Eliminar un producto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del producto"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Producto eliminado con éxito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Producto no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}

