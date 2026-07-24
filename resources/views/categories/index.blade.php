@extends('layouts.app')

@section('title', __('app.categories.title') . ' - ATLAS Study')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="section-title mb-1">{{ __('app.categories.title') }}</h2>
      <p class="text-muted-custom">{{ __('app.categories.subtitle') }}</p>
    </div>
    <a class="btn btn-outline-white" href="{{ route('ai.analyzer') }}">{{ __('app.nav.ai_analyzer') }}</a>
  </div>

  <div class="row gy-4">
    @foreach($categories as $category)
      <div class="col-12">
        <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
          <div class="section-card rounded-xl p-4 d-flex align-items-center gap-4">
            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(255,255,255,.05);">
              <span class="text-muted-custom fs-4">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
            </div>
            <div class="flex-grow-1">
              <h4 class="mb-1">{{ $category->name }}</h4>
              <p class="text-muted-custom mb-2">{{ $category->description }}</p>
              <span class="badge-category">{{ $category->lessons()->count() }} {{ __('app.home.lesson_count') }}</span>
            </div>
            <div class="text-muted-custom small">{{ __('app.categories.explore') }}</div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  @if($categories->isEmpty())
    <p class="text-muted-custom">{{ __('app.categories.no_categories') }}</p>
  @endif
@endsection
