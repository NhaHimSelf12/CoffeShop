# Multi-Language Support Documentation

## Overview

PosCoffe Management System now supports 4 languages:
- **English** (en) 🇬🇧
- **Khmer** (km) 🇰🇭
- **Japanese** (ja) 🇯🇵
- **Chinese** (zh-CN) 🇨🇳

## Features

### 1. Language Switcher
A language switcher component is available in the top navigation bar, allowing users to easily switch between languages.

### 2. Session-Based Language Preference
The selected language is stored in the user's session, so it persists across page views.

### 3. Translation Files
All translations are stored in the `/lang` directory:
```
lang/
├── en/           # English
│   ├── auth.php
│   └── main.php
├── km/           # Khmer
│   ├── auth.php
│   └── main.php
├── ja/           # Japanese
│   ├── auth.php
│   └── main.php
└── zh-CN/        # Chinese (Simplified)
    ├── auth.php
    └── main.php
```

## How to Use

### For Users

1. **Login** to the application
2. Click on the **language dropdown** in the top navigation bar (next to your profile picture)
3. Select your preferred language from the dropdown menu
4. The interface will immediately update to display text in your selected language

### For Developers

#### Adding Translations to Views

Use the `__()` helper function to display translated text:

```blade
<!-- Simple translation -->
<h1>{{ __('main.dashboard') }}</h1>

<!-- Nested translation -->
<p>{{ __('auth.features.real_time') }}</p>
```

#### Adding New Translation Keys

1. Open the appropriate translation file in `/lang/{locale}/`
2. Add your new key-value pair:
```php
return [
    'your_key' => 'Your Translation',
];
```

3. Add the translation to all language files (en, km, ja, zh-CN)

#### Example: Adding a New Button Label

**In `/lang/en/main.php`:**
```php
'export_csv' => 'Export as CSV',
```

**In `/lang/km/main.php`:**
```php
'export_csv' => 'នាំចេញជា CSV',
```

**In `/lang/ja/main.php`:**
```php
'export_csv' => 'CSV としてエクスポート',
```

**In `/lang/zh-CN/main.php`:**
```php
'export_csv' => '导出为 CSV',
```

**In your Blade view:**
```blade
<button>{{ __('main.export_csv') }}</button>
```

## Technical Implementation

### Middleware
The `SetLocale` middleware (`app/Http/Middleware/SetLocale.php`) handles language switching by:
1. Checking the session for a stored locale preference
2. Setting the application locale accordingly

### Controller
The `LanguageController` (`app/Http/Controllers/LanguageController.php`) manages language changes:
- Validates the requested locale
- Stores the preference in session
- Redirects back to the previous page

### Routes
The language change route is defined in `routes/web.php`:
```php
Route::post('/language/change', [LanguageController::class, 'change'])->name('language.change');
```

## Available Translation Keys

### Authentication (auth.php)
- login, register, logout
- email_address, password
- remember_me, forgot_password
- welcome_back, enter_credentials
- And more...

### Main (main.php)
- Navigation: dashboard, order, customers, products, etc.
- Actions: add_new, edit, delete, save, cancel, etc.
- Messages: success, error, no_products_found, etc.
- Dashboard: total_sales, total_orders, etc.
- And more...

## Best Practices

1. **Use translation keys consistently** - Always use `__('key')` instead of hardcoding text
2. **Keep keys descriptive** - Use meaningful names that describe the content
3. **Group related translations** - Keep related keys in the same file/section
4. **Test all languages** - Verify that translations display correctly in all languages
5. **Handle pluralization** - Use Laravel's pluralization features for countable items

## Future Enhancements

To add more languages:
1. Create a new folder in `/lang/` with the locale code (e.g., `fr` for French)
2. Copy the translation files from an existing language
3. Translate all keys to the new language
4. Update the language switcher component to include the new language
5. Add the locale to the supported locales list in `LanguageController`

## Support

For questions or issues with translations, please contact the development team.
