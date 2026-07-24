<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('category', 'user')->orderBy('order')->get();
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.lessons.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:lessons,slug',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['user_id'] = auth()->id();

        Lesson::create($validated);
        return redirect()->route('admin.lessons.index')->with('success', 'Lesson created successfully.');
    }

    public function edit(Lesson $lesson)
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.lessons.edit', compact('lesson', 'categories'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:lessons,slug,' . $lesson->id,
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $lesson->update($validated);
        return redirect()->route('admin.lessons.index')->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
