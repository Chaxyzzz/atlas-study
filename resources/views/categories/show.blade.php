@extends('layouts.app')

@section('title', $category->name . ' - ATLAS Study')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="section-title mb-1">{{ $category->name }}</h2>
      <p class="text-muted-custom">{{ $category->description }}</p>
    </div>
    <a class="btn btn-outline-white" href="{{ route('categories.index') }}">Semua Kategori</a>
  </div>

  @if($category->children->isEmpty())
    <p class="text-muted-custom">Belum ada sub-kategori untuk topik ini.</p>
  @else
    <div class="row gy-4">
      @foreach($category->children as $child)
        <div class="col-md-6">
          <div class="section-card rounded-xl p-4 d-flex gap-3 align-items-start">
            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(255,255,255,.05);">
              <span class="text-muted-custom fs-4">{{ strtoupper(substr($child->name, 0, 1)) }}</span>
            </div>
            <div>
              <h5 class="mb-1">{{ $child->name }}</h5>
              <p class="text-muted-custom small mb-0">{{ $child->description }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endsection
