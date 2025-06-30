<?php

namespace App\Http\Controllers;

use App\Models\productmodel;
use App\Models\categorymodel;
use Illuminate\Http\Request;
use Exception;

class productcontroller extends Controller
{
    // Mostrar listado de productos
    public function index()
    {
        try {
            $products = productmodel::orderBy('name', 'desc')->paginate(10);
            return view('products.index', compact('products'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Error al cargar productos: ' . $e->getMessage());
        }
    }

    // Mostrar formulario de creación
    public function create()
    {
        try {
            $categories = categorymodel::all();
            return view('products.create', compact('categories'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Error al cargar formulario: ' . $e->getMessage());
        }
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
            ]);

            productmodel::create($validated);

            return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('products.createForm')->with('error', 'Error al crear producto: ' . $e->getMessage());
        }
    }

    // Mostrar detalle de producto
    public function show($id)
    {
        try {
            $products = productmodel::with('category')->findOrFail($id);
            return view('products.show', compact('products'));
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Error al mostrar producto: ' . $e->getMessage());
        }
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        try {
            $products = productmodel::findOrFail($id);
            $categories = categorymodel::all();
            return view('products.edit', compact('products', 'categories'));
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Error al cargar edición: ' . $e->getMessage());
        }
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
            ]);

            $products = productmodel::findOrFail($id);
            $products->update($validated);

            return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('products.edit', $id)->with('error', 'Error al actualizar producto: ' . $e->getMessage());
        }
    }

    // Eliminar producto
    public function destroy($id)
    {
        try {
            $products = productmodel::findOrFail($id);
            $products->delete();

            return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Error al eliminar producto: ' . $e->getMessage());
        }
    }
}
