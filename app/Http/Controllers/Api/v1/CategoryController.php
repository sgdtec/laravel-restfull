<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryFormRequest;

class CategoryController extends Controller
{
    private $category;
    private $totalPage = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    //List Category
    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return response()->json($categories);
    }

    //Create Category
    public function store(StoreUpdateCategoryFormRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);

    }

    //Update Category
    public function update(StoreUpdateCategoryFormRequest $request, $id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Não Encontrado'], 404);
        }

        $category->update($request->all());

        return response()->json($category);
    }

    //Show Category
    public function show($id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Não Encontrado'], 404);
        }

        return response()->json($category);
    }

    //Destroy Category
    public function destroy($id)
    {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Não Encontrado'], 404);
        }

        $category->delete();

        return response()->json(['success', true], 204);
    }

    //Recupera todos os Products
    public function products($id) {
        if(!$category = $this->category->find($id)) {
            return response()->json(['error' => 'Não Encontrado'], 404);
        }
        
        $products = $category->products()->paginate($this->totalPage);
    

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }
}
