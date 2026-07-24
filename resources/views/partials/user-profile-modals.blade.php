@auth
<!-- Glassmorphism Profile & User Modals -->
<div class="modal fade" id="modalMyProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-white">{{ __('app.profile.title') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4 text-center">
                <div class="avatar-large-wrapper mb-3">
                    <img src="{{ Auth::user()->avatar_url }}" 
                         alt="{{ Auth::user()->name }}" 
                         class="rounded-circle border border-secondary p-1" style="width: 96px; height: 96px; object-fit: cover;">
                </div>
                <h4 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted-custom small mb-4">{{ Auth::user()->email ?: Auth::user()->phone }}</p>

                <div class="p-3 bg-secondary-custom rounded-xl text-start mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-custom small">{{ __('app.profile.status') }}</span>
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 rounded-pill px-3">{{ __('app.profile.pro_member') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-custom small">{{ __('app.profile.email') }}</span>
                        <span class="text-white small fw-medium">{{ Auth::user()->email ?: __('app.profile.not_set') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-custom small">{{ __('app.profile.phone') }}</span>
                        <span class="text-white small fw-medium">{{ Auth::user()->phone ?: __('app.profile.not_set') }}</span>
                    </div>
                    
                    <!-- Language Selection inside My Profile Modal -->
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top border-secondary border-opacity-25 mt-2">
                        <span class="text-muted-custom small">{{ __('app.nav.language') }}</span>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('lang.switch', 'id') }}" class="btn btn-outline-light {{ App::getLocale() == 'id' ? 'active' : '' }}">🇮🇩 ID</a>
                            <a href="{{ route('lang.switch', 'en') }}" class="btn btn-outline-light {{ App::getLocale() == 'en' ? 'active' : '' }}">🇺🇸 EN</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-white w-100 py-2" data-bs-dismiss="modal">{{ __('app.profile.close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- My Learning Modal -->
<div class="modal fade" id="modalMyLearning" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-white">{{ __('app.nav.my_learning') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#71737A" stroke-width="1.5">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <h6 class="text-white fw-bold">{{ __('app.profile.learning_journey') }}</h6>
                <p class="text-muted-custom small">{{ __('app.profile.learning_sub') }}</p>
                <a href="{{ route('lessons.index') }}" class="btn btn-accent rounded-pill px-4 py-2 mt-2">{{ __('app.profile.explore_catalog') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Bookmarks Modal -->
<div class="modal fade" id="modalBookmarks" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-white">{{ __('app.nav.bookmarks') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#71737A" stroke-width="1.5">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h6 class="text-white fw-bold">{{ __('app.profile.saved_material') }}</h6>
                <p class="text-muted-custom small">{{ __('app.profile.no_bookmarks') }}</p>
                <a href="{{ route('lessons.index') }}" class="btn btn-outline-white rounded-pill px-4 py-2 mt-2" data-bs-dismiss="modal">{{ __('app.profile.find_material') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Settings Modal -->
<div class="modal fade" id="modalSettings" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-white">{{ __('app.nav.settings') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-secondary-custom rounded-xl mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-0 fw-semibold">{{ __('app.profile.active_theme') }}</h6>
                            <small class="text-muted-custom">{{ __('app.profile.theme_sub') }}</small>
                        </div>
                        <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 rounded-pill px-3">{{ __('app.profile.active') }}</span>
                    </div>
                </div>

                <div class="p-3 bg-secondary-custom rounded-xl">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white mb-0 fw-semibold">{{ __('app.nav.language') }}</h6>
                            <small class="text-muted-custom">{{ App::getLocale() == 'en' ? 'English (US)' : 'Bahasa Indonesia' }}</small>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('lang.switch', 'id') }}" class="btn btn-outline-light {{ App::getLocale() == 'id' ? 'active' : '' }}">🇮🇩 ID</a>
                            <a href="{{ route('lang.switch', 'en') }}" class="btn btn-outline-light {{ App::getLocale() == 'en' ? 'active' : '' }}">🇺🇸 EN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-content-dark {
        background: rgba(17, 17, 17, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        box-shadow: 0 24px 80px rgba(0, 0, 0, 0.85);
    }
</style>
@endauth
