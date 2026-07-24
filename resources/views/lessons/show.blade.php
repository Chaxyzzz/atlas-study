@extends('layouts.app')

@section('title', $lesson->title . ' - ATLAS Study')

@section('content')
  @php
    $showImage = 'https://images.pexels.com/photos/1840/photography-vintage-analog-camera-canon.jpg?auto=compress&cs=tinysrgb&w=1600';
    $relatedImages = [
      'https://images.pexels.com/photos/1983042/pexels-photo-1983042.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/33376523/pexels-photo-33376523.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/33082593/pexels-photo-33082593.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/6058188/pexels-photo-6058188.jpeg?auto=compress&cs=tinysrgb&w=1400'
    ];
  @endphp

  <div class="row gx-5">
    <div class="col-lg-8">
      <div class="section-card rounded-xl p-5 mb-5">
        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
          <span class="badge-category">{{ $lesson->category->name ?? 'Uncategorized' }}</span>
          <span class="text-muted-custom small">{{ $lesson->created_at->format('M d, Y') }}</span>
          <span class="text-muted-custom small">{{ $lesson->views ?? 0 }} views</span>
        </div>
        <h1 class="hero-title mb-4">{{ $lesson->title }}</h1>
        <div class="text-muted-custom mb-3">By {{ $lesson->user->name ?? 'Author' }}</div>

        <img src="{{ $showImage }}" class="img-fluid rounded-xl mb-5" style="width:100%; object-fit:cover;" loading="lazy" alt="Camera body and lens featured image">

        <div class="article-content">{!! nl2br(e($lesson->content)) !!}</div>

        <div class="d-flex flex-wrap gap-3 mt-5">
          <span class="badge-category">Views: {{ $lesson->views ?? 0 }}</span>
          <a class="btn btn-outline-white" href="#" onclick="navigator.share && navigator.share({title: '{{ addslashes($lesson->title) }}', url: window.location.href})">Share</a>
        </div>
      </div>

      <div class="mb-4">
        <h2 class="section-title">Related Lessons</h2>
        <div class="row g-4">
          @foreach($related as $r)
            <div class="col-md-6">
              <a href="{{ route('lessons.show', $r->slug) }}" class="text-decoration-none">
                <article class="section-card rounded-xl overflow-hidden p-0 h-100">
                  <img src="{{ $relatedImages[$loop->index % count($relatedImages)] }}" class="img-fluid w-100" style="height:150px; object-fit:cover;" loading="lazy" alt="Camera equipment preview for {{ $r->title }}">
                  <div class="p-4">
                    <h5 class="mb-2">{{ $r->title }}</h5>
                    <div class="text-muted-custom small">{{ $r->user->name ?? 'Author' }}</div>
                  </div>
                </article>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <aside class="col-lg-4">
      <div class="section-card rounded-xl p-4 mb-4">
        <h5 class="mb-3">About Author</h5>
        <div class="text-muted-custom">{{ $lesson->user->name ?? 'Author' }}</div>
      </div>
      <div class="section-card rounded-xl p-4">
        <h5 class="mb-3">Category</h5>
        <a class="badge-category" href="{{ route('categories.show', $lesson->category->slug ?? '#') }}">{{ $lesson->category->name ?? 'Uncategorized' }}</a>
      </div>
    </aside>
  </div>
@endsection
