<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::roots()->active()->with(['children'])->withCount('lessons')->orderBy('order')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('children');
        return view('categories.show', compact('category'));
    }
}
