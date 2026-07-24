<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Unauthenticated guests visiting '/' see the Opening Experience unless previewing
        if (!Auth::check() && !$request->has('explore')) {
            return view('opening');
        }

        $hero = Lesson::published()->with('category','user')->latest()->first();

        $latestLessons = Lesson::published()->with('category','user')->latest()->take(6)->get();

        $popularLessons = Lesson::published()->with('category','user')->orderByDesc('views')->take(6)->get();

        $categories = Category::active()->withCount('lessons')->orderBy('order')->get();

        return view('home', compact('hero', 'latestLessons', 'popularLessons', 'categories'));
    }
}
