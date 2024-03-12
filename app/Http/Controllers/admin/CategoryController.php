<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index categories', ['only' => ['index']]);
        $this->middleware('permission:show categories', ['only' => ['show']]);
        $this->middleware('permission:create categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete categories', ['only' => ['delete', 'destroy']]);
    }

    public function index(): View
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'success' => true,
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
