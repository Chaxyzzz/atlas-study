@extends('layouts.app')

@section('title','Lessons - ATLAS Study')

@section('content')
  @php
    $lessonCardImages = [
      'https://images.pexels.com/photos/11484700/pexels-photo-11484700.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/33356339/pexels-photo-33356339.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/821651/pexels-photo-821651.jpeg?auto=compress&cs=tinysrgb&w=1400',
      'https://images.pexels.com/photos/27454584/pexels-photo-27454584.jpeg?auto=compress&cs=tinysrgb&w=1400'
    ];
  @endphp

  <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3 mb-5">
    <div>
      <h2 class="section-title mb-2">{{ __('app.lessons.title') }}</h2>
      <p class="text-muted-custom">{{ __('app.lessons.subtitle') }}</p>
    </div>
    <form class="row gx-2 gy-2" method="get" action="{{ route('lessons.index') }}">
      <div class="col-12 col-md-auto">
        <input class="form-control form-control-dark" name="search" placeholder="{{ __('app.nav.search_placeholder') }}" value="{{ request('search') }}">
      </div>
      <div class="col-12 col-md-auto">
        <select name="sort" class="form-select form-control-dark">
          <option value="">Sort</option>
          <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Newest</option>
          <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Oldest</option>
          <option value="most_viewed" {{ request('sort')=='most_viewed'?'selected':'' }}>Most Viewed</option>
        </select>
      </div>
      <div class="col-12 col-md-auto">
        <select name="category" class="form-select form-control-dark">
          <option value="">{{ __('app.categories.title') }}</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->slug }}" {{ request('category')==$cat->slug?'selected':'' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-12 col-md-auto">
        <button class="btn btn-outline-white" type="submit">{{ __('app.nav.search') }}</button>
      </div>
    </form>
  </div>

  <div class="row g-4">
    @foreach($lessons as $lesson)
      <div class="col-md-6 col-lg-4">
        <article class="section-card rounded-xl overflow-hidden h-100">
          <img src="{{ $lessonCardImages[$loop->index % count($lessonCardImages)] }}" class="img-fluid w-100" style="height:190px; object-fit:cover;" loading="lazy" alt="Camera equipment preview for {{ $lesson->title }}">
          <div class="p-4">
            <span class="badge-category">{{ $lesson->category->name ?? 'Uncategorized' }}</span>
            <h3 class="mt-3 mb-2"><a href="{{ route('lessons.show', $lesson->slug) }}">{{ $lesson->title }}</a></h3>
            <div class="text-muted-custom small mb-3">{{ $lesson->user->name ?? 'Author' }} • {{ $lesson->created_at->format('M d, Y') }} • {{ $lesson->views ?? 0 }} {{ __('app.home.views') }}</div>
            <p class="text-muted-custom small">{{ \Illuminate\Support\Str::limit(strip_tags($lesson->content), 120) }}</p>
            <a href="{{ route('lessons.show', $lesson->slug) }}" class="btn btn-outline-white btn-sm mt-3">{{ __('app.lessons.continue_learning') }}</a>
          </div>
        </article>
      </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-center mt-5">{{ $lessons->links() }}</div>
@endsection
