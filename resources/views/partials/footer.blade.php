<footer class="footer-dark py-5 mt-5">
  <div class="container">
    <div class="row align-items-center gy-3">
      <div class="col-md-4">
        <h5 class="fw-bold">ATLAS Study</h5>
        <p class="text-muted-custom">{{ __('app.footer.tagline') }}</p>
      </div>
      <div class="col-md-4 text-md-center">
        <small class="text-muted-custom">&copy; {{ date('Y') }} ATLAS Study. {{ __('app.footer.rights_reserved') }}</small>
      </div>
      <div class="col-md-4 text-md-end">
        <a class="text-muted-custom me-3" href="{{ route('home') }}">{{ __('app.footer.home') }}</a>
        <a class="text-muted-custom me-3" href="{{ route('lessons.index') }}">{{ __('app.footer.lessons') }}</a>
        <a class="text-muted-custom" href="{{ route('categories.index') }}">{{ __('app.footer.categories') }}</a>
      </div>
    </div>
  </div>
</footer>
