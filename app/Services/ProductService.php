<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService{

    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function store($request)
    {
        $data = $request->only('sku', 'name', 'category_id', 'price', 'discount');
        return $this->productRepo->store($data);
    }
    public function update($request, $id)
    {
        $data = $request->only('sku', 'name', 'category_id', 'price', 'discount');
        return $this->productRepo->update($data, $id);
    }
    public function delete($id){
        return $this->productRepo->delete($id);
    }

}
