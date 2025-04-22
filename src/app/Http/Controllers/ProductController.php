<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if($request->filled('keyword'))
        {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $sort = $request->sort;
        if ($sort === 'high')
        {
            $query->orderBy('price', 'desc');
        }
        elseif ($sort === 'low')
        {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('products.index', compact('products', 'sort'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $selectedSeasons = $product->season ? explode(',', $product->season) : [];
        return view('products.show', compact('product', 'selectedSeasons'));
    }

    public function create()
    {
        return view('products.register');
    }

    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'season' => implode(',', $request->season),
            'description' => $request->description,
            'image' => $path
        ]);
        return redirect()->route('products.index');
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->season = implode(', ', $request->season);
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', '商品を更新しました');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像も削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

    public function edit($id)
    {
        $product= Product::findOrFail($id);
        $selectedSeasons = $product->season ? explode(',', $product->season) : [];

        return view('products.update', compact('product', 'selectedSeasons'));
    }
    public function deleteConfirm($id)
    {
        $product = Product::findOrFail($id);
        return view('products.delete', compact('product'));
    }

    public function search(Request $request)
{
    $query = Product::query();

    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->sort === 'high') {
        $query->orderBy('price', 'desc');
    } elseif ($request->sort === 'low') {
        $query->orderBy('price', 'asc');
    }

    $products = $query->paginate(6)->withQueryString();

    return view('products.search', compact('products'));
}
}
