@extends('layouts.app')

@section('title','ATLAS Study - Home')

@section('content')
  @php
    $heroImage = 'https://images.pexels.com/photos/7934552/pexels-photo-7934552.jpeg?auto=compress&cs=tinysrgb&w=1600';
    $lessonImages = [
      'https://images.pexels.com/photos/6891485/pexels-photo-6891485.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/6949012/pexels-photo-6949012.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/16355819/pexels-photo-16355819.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/821653/pexels-photo-821653.jpeg?auto=compress&cs=tinysrgb&w=1400'
    ];
    $popularImages = [
      'https://images.pexels.com/photos/976870/pexels-photo-976870.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/16230973/pexels-photo-16230973.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/1983042/pexels-photo-1983042.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/33376523/pexels-photo-33376523.jpeg?auto=compress&cs=tinysrgb&w=1400'
    ];
    $categoryImages = [
      'https://images.pexels.com/photos/33082593/pexels-photo-33082593.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/6058188/pexels-photo-6058188.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/11484700/pexels-photo-11484700.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/33356339/pexels-photo-33356339.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/821651/pexels-photo-821651.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/27454584/pexels-photo-27454584.jpeg?auto=compress&cs=tinysrgb&w=1400'
    ];
  @endphp

  <section class="hero-panel section-card p-5 mb-5">
    <div class="row align-items-center gap-4">
      <div class="col-lg-6">
        <h1 class="hero-title">{{ __('app.home.hero_badge') }}</h1>
        <p class="hero-copy">{{ __('app.home.hero_copy') }}</p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="{{ route('lessons.index') }}" class="btn btn-accent btn-lg">{{ __('app.home.start_learning') }}</a>
          <a href="{{ route('ai.analyzer') }}" class="btn btn-outline-white btn-lg">{{ __('app.nav.ai_analyzer') }}</a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="section-card rounded-xl overflow-hidden" style="min-height: 360px; display:flex; align-items:center; justify-content:center;">
          <img src="{{ $heroImage }}" alt="Camera body and lens setup" class="img-fluid w-100" style="height: 360px; object-fit: cover;" loading="lazy">
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="section-title mb-1">{{ __('app.home.latest_lessons') }}</h2>
        <p class="text-muted-custom">{{ __('app.lessons.subtitle') }}</p>
      </div>
      <a class="text-muted-custom" href="{{ route('lessons.index') }}">{{ __('app.home.view_all') }}</a>
    </div>
    <div class="row">
      @foreach($latestLessons as $lesson)
        <div class="col-md-6 col-lg-4 mb-4">
          <article class="section-card rounded-xl overflow-hidden h-100 p-0">
            <img src="{{ $lessonImages[$loop->index % count($lessonImages)] }}" class="img-fluid w-100" style="height:180px; object-fit:cover;" loading="lazy" alt="Camera equipment preview for {{ $lesson->title }}">
            <div class="p-4">
              <span class="badge-category">{{ $lesson->category->name ?? 'Uncategorized' }}</span>
              <h3 class="mt-3 mb-2"> <a href="{{ route('lessons.show', $lesson->slug) }}">{{ $lesson->title }}</a></h3>
              <div class="text-muted-custom small mb-3">{{ $lesson->user->name ?? 'Author' }} • {{ $lesson->created_at->format('M d, Y') }} • {{ $lesson->views ?? 0 }} {{ __('app.home.views') }}</div>
              <p class="text-muted-custom small">{{ \Illuminate\Support\Str::limit(strip_tags($lesson->content), 110) }}</p>
              <a href="{{ route('lessons.show', $lesson->slug) }}" class="btn btn-outline-white btn-sm mt-3">{{ __('app.lessons.continue_learning') }}</a>
            </div>
          </article>
        </div>
      @endforeach
    </div>
  </section>

  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="section-title mb-1">{{ __('app.home.popular_lessons') }}</h2>
        <p class="text-muted-custom">{{ __('app.lessons.subtitle') }}</p>
      </div>
      <a class="text-muted-custom" href="{{ route('lessons.index') }}?sort=most_viewed">{{ __('app.home.view_all') }}</a>
    </div>
    <div class="row">
      @foreach($popularLessons as $lesson)
        <div class="col-md-6 col-lg-4 mb-4">
          <article class="section-card rounded-xl overflow-hidden h-100 p-0">
            <img src="{{ $popularImages[$loop->index % count($popularImages)] }}" class="img-fluid w-100" style="height:180px; object-fit:cover;" loading="lazy" alt="Camera equipment preview for {{ $lesson->title }}">
            <div class="p-4">
              <span class="badge-category">{{ $lesson->category->name ?? 'Uncategorized' }}</span>
              <h3 class="mt-3 mb-2"> <a href="{{ route('lessons.show', $lesson->slug) }}">{{ $lesson->title }}</a></h3>
              <div class="text-muted-custom small mb-3">{{ $lesson->user->name ?? 'Author' }} • {{ $lesson->views ?? 0 }} {{ __('app.home.views') }}</div>
              <p class="text-muted-custom small">{{ \Illuminate\Support\Str::limit(strip_tags($lesson->content), 110) }}</p>
              <a href="{{ route('lessons.show', $lesson->slug) }}" class="btn btn-outline-white btn-sm mt-3">{{ __('app.lessons.continue_learning') }}</a>
            </div>
          </article>
        </div>
      @endforeach
    </div>
  </section>

  <section class="mb-5">
    <h2 class="section-title mb-3">{{ __('app.home.explore_categories') }}</h2>
    <div class="row gx-4 gy-4">
      @foreach($categories as $category)
        <div class="col-md-6">
          <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
            <div class="section-card rounded-xl overflow-hidden p-0">
              <img src="{{ $categoryImages[$loop->index % count($categoryImages)] }}" class="img-fluid w-100" style="height: 180px; object-fit: cover;" loading="lazy" alt="Camera gear preview for {{ $category->name }}">
              <div class="p-4 d-flex align-items-start gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(255,255,255,.05);">
                  <span class="text-muted-custom fs-4">{{ strtoupper(substr($category->name,0,1)) }}</span>
                </div>
                <div>
                  <h4 class="mb-1">{{ $category->name }}</h4>
                  <p class="text-muted-custom mb-2">{{ $category->description }}</p>
                  <span class="badge-category">{{ $category->lessons_count ?? $category->lessons()->count() }} {{ __('app.home.lesson_count') }}</span>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </section>
@endsection
