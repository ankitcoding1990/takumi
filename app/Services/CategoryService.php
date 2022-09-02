<?php
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService{

    protected $categoryRepo;
    function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    function store($request){
        $data =  $request->only('name', 'slug', 'status');
        return $this->categoryRepo->store($data);
    }
    function update($request, $id){
        $data =  $request->only('name', 'slug', 'status');
        return $this->categoryRepo->update($data, $id);
    }
    function delete($id){
        return $this->categoryRepo->delete($id);
    }
}
?>
