@extends('layouts.app')

@section('title', 'About ATLAS Study')

@section('content')
  <section class="hero-panel section-card p-5 p-lg-6 mb-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-12">
        <h1 class="hero-title mb-3">{{ __('app.about.title') }}</h1>
        <p class="hero-copy mb-4">
          {{ __('app.about.subtitle') }}
        </p>
        <a href="{{ route('lessons.index') }}" class="btn btn-accent btn-lg">{{ __('app.home.start_learning') }}</a>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="section-card rounded-xl p-5 h-100">
          <span class="badge-category mb-3">{{ __('app.about.vision_title') }}</span>
          <p class="text-muted-custom mb-0">{{ __('app.about.vision_body') }}</p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="section-card rounded-xl p-5 h-100">
          <span class="badge-category mb-3">{{ __('app.about.features_title') }}</span>
          <p class="text-muted-custom mb-0">{{ __('app.footer.tagline') }}</p>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="section-card rounded-xl p-5">
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
          <h2 class="section-title mb-1">Contact & Social Media</h2>
          <p class="text-muted-custom mb-0">Connect with ATLAS Studio across the platforms that matter.</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-xl-3">
          <a href="https://wa.me/6285123852023" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
            <div class="section-card rounded-xl p-4 h-100 card-hover">
              <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width:48px;height:48px;background:rgba(34,197,94,.12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                  <path d="M8.5 18.5c-2.4-2.4-3.2-5.1-2.1-7.9l1.2-3.1 2.7 1.3-1 2.4 1.6 1.6 2.4-1 1.3 2.7-3.1 1.2c2.8 1.1 5.5.3 7.9-2.1l1.9 1.9c-3 3-7.1 4.2-11.1 2.7Z"></path>
                </svg>
              </div>
              <h4 class="mb-2">WhatsApp</h4>
              <p class="text-muted-custom mb-0">+62 851 2385 2023</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-xl-3">
          <a href="https://www.instagram.com/atlas_studio_project?igsh=MWFwZ3RoeWlubmE3YQ==" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
            <div class="section-card rounded-xl p-4 h-100 card-hover">
              <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width:48px;height:48px;background:rgba(236,72,153,.12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                  <rect x="3.5" y="3.5" width="17" height="17" rx="4"></rect>
                  <circle cx="12" cy="12" r="4"></circle>
                  <circle cx="17.5" cy="6.5" r="1"></circle>
                </svg>
              </div>
              <h4 class="mb-2">Instagram</h4>
              <p class="text-muted-custom mb-0">atlas_studio_project</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-xl-3">
          <a href="https://youtube.com/@atlas_studio_project?si=3i_OHVQrsC0bseiP" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
            <div class="section-card rounded-xl p-4 h-100 card-hover">
              <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width:48px;height:48px;background:rgba(239,68,68,.12);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                  <path d="M22 8.5a3 3 0 0 0-2.1-2.1C18.2 5.8 12 5.8 12 5.8s-6.2 0-7.9.6A3 3 0 0 0 2 8.5c-.3 1.5-.3 4.5 0 6 0 1.2.8 2.2 2.1 2.5 1.7.6 7.9.6 7.9.6s6.2 0 7.9-.6A3 3 0 0 0 22 14.5c.3-1.5.3-4.5 0-6Z"></path>
                  <path d="m10 9.5 5 2.5-5 2.5v-5Z"></path>
                </svg>
              </div>
              <h4 class="mb-2">YouTube</h4>
              <p class="text-muted-custom mb-0">ATLAS Studio</p>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-xl-3">
          <a href="https://www.tiktok.com/@atlas_studio_project?_r=1&_t=ZS-97wHLgTPfKH" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
            <div class="section-card rounded-xl p-4 h-100 card-hover">
              <div class="d-flex align-items-center justify-content-center rounded-circle mb-3" style="width:48px;height:48px;background:rgba(255,255,255,.08);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                  <path d="M13 3h2a4 4 0 0 0 4 4v3a7.5 7.5 0 0 1-7.5 7.5A7.5 7.5 0 0 1 4 10.5V8.5a4 4 0 0 0 4-4h2"></path>
                  <path d="M8 3h4v8.5a2.5 2.5 0 0 1-5 0V3Z"></path>
                </svg>
              </div>
              <h4 class="mb-2">TikTok</h4>
              <p class="text-muted-custom mb-0">ATLAS Studio</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="section-title mb-1">Why Choose ATLAS Study</h2>
        <p class="text-muted-custom">A premium learning environment built for creative growth.</p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-xl-3">
        <div class="section-card rounded-xl p-4 h-100">
          <h4 class="mb-2">Photography</h4>
          <p class="text-muted-custom mb-0">Professional photography learning materials.</p>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="section-card rounded-xl p-4 h-100">
          <h4 class="mb-2">Videography</h4>
          <p class="text-muted-custom mb-0">Modern filmmaking and camera techniques.</p>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="section-card rounded-xl p-4 h-100">
          <h4 class="mb-2">Editing</h4>
          <p class="text-muted-custom mb-0">Professional editing workflows.</p>
        </div>
      </div>
      <div class="col-md-6 col-xl-3">
        <div class="section-card rounded-xl p-4 h-100">
          <h4 class="mb-2">Artificial Intelligence</h4>
          <p class="text-muted-custom mb-0">AI-powered learning and creative analysis.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="text-center py-4">
    <div class="section-card rounded-xl p-5">
      <blockquote class="hero-title mb-3" style="font-size: clamp(1.4rem, 2.3vw, 2rem);">“Creativity grows when knowledge is shared.”</blockquote>
      <p class="text-muted-custom mb-0">Developed by ATLAS Studio.</p>
    </div>
  </section>
@endsection
