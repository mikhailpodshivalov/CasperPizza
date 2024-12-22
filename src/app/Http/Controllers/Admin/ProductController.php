<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('sizes')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sizes.*.size' => 'required|string',
            'sizes.*.price' => 'required|numeric|min:0',
        ]);

        // Обработка изображения
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $product = Product::create($validated);

        // Сохранение размеров
        foreach ($validated['sizes'] as $size) {
            $product->sizes()->create($size);
        }

        return redirect()->route('products.index')->with('success', 'Продукт добавлен!');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'sizes.*.size' => 'required|string',
            'sizes.*.price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);

        // Обработка изображения
        if ($request->hasFile('image')) {
            // Удалить старое изображение
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($validated);

        // Обновление размеров
        foreach ($validated['sizes'] as $size) {
            $sizeModel = ProductSize::find($size['id']);
            $sizeModel->update($size);
        }

        return redirect()->route('products.index')->with('success', 'Продукт обновлён!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Продукт удалён!');
    }
}
