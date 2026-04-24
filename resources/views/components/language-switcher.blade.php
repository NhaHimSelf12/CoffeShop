@php
    $currentLocale = app()->getLocale();
    $languages = [
        'en' => ['name' => 'English', 'flag' => '🇬🇧', 'label' => 'EN'],
        'km' => ['name' => 'ខ្មែរ', 'flag' => '🇰🇭', 'label' => 'KH'],
        'ja' => ['name' => '日本語', 'flag' => '🇯🇵', 'label' => 'JA'],
        'zh-CN' => ['name' => '中文', 'flag' => '🇨🇳', 'label' => 'CN'],
    ];
@endphp

<div class="language-dropdown" style="position: relative;">
    <button class="topbar-btn language-toggle" onclick="toggleLanguageDropdown()" style="cursor: pointer; display: flex; align-items: center; gap: 6px;">
        <span style="font-size: 16px;">{{ $languages[$currentLocale]['flag'] }}</span>
        <span style="font-size: 12px; font-weight: 600;">{{ $languages[$currentLocale]['label'] }}</span>
        <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor" style="opacity: 0.6;">
            <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
    
    <div class="language-menu" id="languageMenu" style="display: none; position: absolute; top: 100%; right: 0; margin-top: 8px; background: #fff; border: 1px solid var(--steam); border-radius: 12px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12); z-index: 1000; min-width: 160px; overflow: hidden;">
        @foreach($languages as $code => $lang)
            <form action="{{ route('language.change') }}" method="POST" style="margin: 0;">
                @csrf
                <input type="hidden" name="locale" value="{{ $code }}">
                <button type="submit" class="language-option {{ $currentLocale === $code ? 'active' : '' }}" style="width: 100%; padding: 10px 14px; border: none; background: {{ $currentLocale === $code ? '#fef3c7' : 'none' }}; cursor: pointer; display: flex; align-items: center; gap: 10px; text-align: left; font-size: 13px; color: {{ $currentLocale === $code ? '#92400e' : 'var(--text-muted)' }}; transition: background 0.15s;">
                    <span style="font-size: 16px;">{{ $lang['flag'] }}</span>
                    <span style="font-weight: {{ $currentLocale === $code ? '600' : '400' }};">{{ $lang['name'] }}</span>
                </button>
            </form>
        @endforeach
    </div>
</div>

<script>
    function toggleLanguageDropdown() {
        const menu = document.getElementById('languageMenu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.language-dropdown');
        const menu = document.getElementById('languageMenu');
        if (dropdown && !dropdown.contains(event.target)) {
            menu.style.display = 'none';
        }
    });
</script>

<style>
    .language-option:hover {
        background: #f9fafb !important;
    }
    
    .language-option.active {
        background: #fef3c7 !important;
        color: #92400e !important;
    }
    
    .language-toggle:hover {
        border-color: var(--caramel) !important;
        color: var(--caramel) !important;
    }
</style>
