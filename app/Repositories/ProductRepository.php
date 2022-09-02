<?php

namespace App\Repositories;

use Exception;
use App\Models\Product;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;

class ProductRepository{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function store(array $data)
    {
        try{
            $product = $this->product->create($data);
            if($product){
                return [
                    'status' => true,
                    'code' => 200,
                    'message' => 'Product Added',
                    'data' => new ProductResource($product)
                ];
            }
            throw new Exception('Product could not added');
        }catch(\Throwable $err){
            return [
                'status' => false,
                'code' => 400,
                'message' => 'Opps! something went wrong...',
                'error' => $err->getMessage()
            ];
        }
    }

    public function update(Array $data, $id){
        try{
            $product = $this->product->find($id);
            if($product){
                if($product->update($data)){
                    return [
                        'status' => true,
                        'code' => 200,
                        'message' => 'Product Updated',
                        'data' => new ProductResource(Product::find($id))
                    ];
                }
                throw new Exception('Product could not updated');
            }
            throw new Exception('Can\'t find the product to update');
        }catch(\Throwable $err){
            return [
                'status' => 'Failed',
                'statusBool' => false,
                'message' => 'Opps! something went wrong...',
                'error' => $err->getMessage()
            ];
        }
    }

    public function delete(Int $id)
    {
        try{
            $product = $this->product->find($id);
            if($product){
                if($product->delete()){
                    return [
                        'status' => true,
                        'code' => 200,
                        'message' => 'Product has been deleted',
                    ];
                }
                throw new Exception('Product could not delete');
            }
            throw new Exception('Can\'t find the product to delete');
        }catch(\Throwable $err){
            return [
                'status' => false,
                'code' => 400,
                'message' => 'Opps! something went wrong...',
                'error' => $err->getMessage()
            ];
        }
    }
}
