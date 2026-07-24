<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Category;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::published()->with('category','user');

        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhereHas('category', function($c) use ($search) {
                      $c->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($category = $request->query('category')) {
            $query->whereHas('category', function($c) use ($category) {
                $c->where('slug', $category);
            });
        }

        switch($request->query('sort')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'most_viewed':
                $query->orderByDesc('views');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $lessons = $query->paginate(9)->withQueryString();

        $categories = Category::active()->orderBy('order')->get();

        return view('lessons.index', compact('lessons','categories'));
    }

    public function show($slug)
    {
        $lesson = Lesson::published()->with('category','user')->where('slug', $slug)->firstOrFail();

        $lesson->increment('views');

        $related = Lesson::published()
            ->where('category_id', $lesson->category_id)
            ->where('id', '<>', $lesson->id)
            ->latest()
            ->take(4)
            ->get();

        return view('lessons.show', compact('lesson','related'));
    }
}
