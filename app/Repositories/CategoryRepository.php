<?php
namespace App\Repositories;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryRepository{

    protected $category;
    function __construct(Category $category){
        $this->category = $category;
    }
    function store($data){
        try {
            $category = $this->category->create($data);
            return ['status' => true, 'code' => 200, 'message' => 'Category Created', 'data' => new CategoryResource($category)];
        } catch (\Throwable $th) {
            return ['status' => false, 'code' => 400, 'message' => 'Opps! something went wrong...', 'error' => $th->getMessage()];
        }
    }
    function update($data, $id){
        try {
            $cateogry = $this->category->find($id);
            if($cateogry){
                $cateogry->update($data);
                return ['status' => true, 'code' => 200, 'message' => 'Category Updated', 'data' => new CategoryResource(Category::find($id))];
            }
            throw new \Exception("Category not found for update", 1);
        } catch (\Throwable $th) {
            return ['status' => false, 'code' => 400, 'message' => 'Opps! something went wrong...', 'error' => $th->getMessage()];
        }
    }
    function delete($id){
        try {
            $cateogry = $this->category->find($id);
            if($cateogry){
                $cateogry->delete();
                return ['status' => true, 'code' => 200, 'message' => 'Category deleted'];
            }
            throw new \Exception("Category not found for delete", 1);
        } catch (\Throwable $th) {
            return ['status' => false, 'code' => 400, 'message' => 'Opps! something went wrong...', 'error' => $th->getMessage()];
        }
    }
}
?>
