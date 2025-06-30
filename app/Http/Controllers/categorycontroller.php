<?php

namespace App\Http\Controllers;

use App\Models\categorymodel;
use Illuminate\Http\Request;
use App\Models\productmodel;

class categorycontroller extends Controller
{
    public function index()
    {
        try {
            $categories = categorymodel::orderBy('name')->paginate(10);
            return view('categories.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al obtener categorías: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('categories.create');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error creating category: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            categorymodel::create($request->only('name', 'description'));
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories.create')->with('error', 'Error creating category: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $categories = categorymodel::with('products')->findOrFail($id);
            return view('categories.show', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error mostrando categoría: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $categories = categorymodel::findOrFail($id);
            return view('categories.edit', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error editando categoría: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $categories = categorymodel::findOrFail($id);
            $categories->update($request->all());
            return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.edit', $id)->with('error', 'Error actualizando categoría: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $categories = categorymodel::findOrFail($id);
            $categories->delete();
            return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error eliminando categoría: ' . $e->getMessage());
        }
    }
}
