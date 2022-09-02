<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::orderBy('name', 'asc');
        if(request()->get('category')){
            $query = $query->whereHas('category', function($subQuery){
                return $subQuery->where('name', 'like', "%".request()->get('category')."%");
            });
        }
        if(request()->get('category_id')){
            $query = $query->where('category_id', request()->get('category_id'));
        }
        if(request()->get('price')){
            $query = $query->where('price', request()->get('price'));
        }
        if(request()->get('sku')){
            $query = $query->where('sku', request()->get('sku'));
        }

        $products = $query->get();
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $res =  $this->productService->store($request);
        return response()->json($res, $res['code'] ?? 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $res = $this->productService->update($request, $id);
        return response()->json($res, $res['code'] ?? 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->productService->delete($id);
        return response()->json($res, $res['code'] ?? 400);
    }
}
