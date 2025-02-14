<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //consulta fija
        //$allCategories = Category::all();
        //queryScope
        $allCategories = Category::include()
            ->filter()
            ->get();
        return $allCategories;
        // return response()->json([$allCategories], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // Validación de los datos de entrada
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|unique:categories|max:255',
            ]);

            // Crear la nueva categoría
            $category = Category::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Categoría creada exitosamente.',
                'data' => $category,
            ], 201); // Código de estado 201: recurso creado
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación y devolver respuestas claras
            return response()->json([
                'success' => false,
                'message' => 'Error de validación.',
                'errors' => $e->errors(), // Retorna los errores específicos en formato JSON
            ], 422); // Código de estado 422: error de validación
        } catch (\Exception $e) {
            // Manejo genérico de errores inesperados
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al intentar crear la categoría.',
                'error' => $e->getMessage(),
            ], 500); // Código de estado 500: error interno del servidor
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


        try {
            // relacion fija
            //$category = Category::with(['posts.user'])->findOrFail($id);
            //queryScope
            //vuelve y ejecuta el ->findOrFail($id);
            $category = Category::included()->findOrFail($id);

            return response()->json(['success' => true, 'data' => $category, 'message' => 'categoria encontrada'], 200);


        } catch (Exception $e) {
            return response()->json(['success' => false,
                'message' => 'Ocurrió un error al intentar mostrar la categoría.',
                'error' => $e->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $category = Category::findOrFail($id);

            $rules = [
                'name' => ['required', 'string', 'max:255'],
            ];
            if ($request->slug !== $category->slug) {
                $rules['slug'] = ['required', 'max:255', 'unique:categories,slug,' . $category->id];
            };
            // Valida los datos entrantes
            $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|max:255|unique:categories,slug,' . $category->id,
            ]);

            // Actualiza los datos de la categoría
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();

            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Categoría actualizada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al intentar modificar la categoría.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {

            $category = Category::findOrFail($id);
            $category->delete();
            return $category;


            //return response()->json(['success'=>true,'message'=>'categoria eliminada'],200);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'categoria no eliminada ' . $e->getMessage()], 500);

        }


    }
}
