<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // Show all products on the home page
        $products = Product::orderBy('created_at','DESC')->get();
        return view('frontend.index')
            ->with('products', $products)
            ->with('categories', $categories);
    }

     public function list()
    {
        $categories = Category::all();
                $products = Product::orderBy('created_at','DESC')->paginate(12);
      return view('frontend.list')->with('products',$products)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categories = Category::all();
        return view('frontend.show')->with('product', Product::find($id))->with('categories',$categories);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getBySearch(Request $request)
    {
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "";
        if ($keyword != "") {
            return view('frontend.search')
                ->with('products', Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(12))
                ->with('keyword', $keyword);
        } else {
            return view('frontend.search')
                ->with('products', Product::paginate(12))
                ->with('keyword', $keyword);
        }
    }

    public function navbarSearch(Request $request)
    {
        $keyword = trim((string) $request->input('keyword', $request->input('title', '')));
        if (mb_strlen($keyword) < 2) {
            return response()->json([]);
        }

        return response()->json(
            Product::where('name', 'like', '%' . $keyword . '%')
                ->orderBy('name')
                ->limit(8)
                ->get(['id', 'name', 'price'])
                ->map(fn ($product) => [
                    'id' => $product->id,
                    'title' => $product->name,
                    'price' => number_format((float) $product->price, 2),
                    'url' => url('/show/' . $product->id),
                ])
                ->values()
        );
    }

    public function categories()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at','DESC')->paginate(12);

        return view('frontend.category')
            ->with('categories', $categories)
            ->with('products', $products)
            ->with('selectedCategory', null);
    }

    public function getByCategory($id)
    {
        $categories = Category::all();
        $selectedCategory = Category::find($id);
        $products = collect();

        if ($selectedCategory) {
            $products = Product::where('category_id', $id)->paginate(12);
        }

        return view('frontend.category')
            ->with('products', $products)
            ->with('categories', $categories)
            ->with('selectedCategory', $selectedCategory);
    }
}
  
