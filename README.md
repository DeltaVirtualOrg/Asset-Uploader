# AssetUploader (phpVMS v7)

Admin-only addon module for **phpVMS v7** that lets staff upload files into **pre-approved (whitelisted) folders** on your server (ex: SPTheme banners, awards, tours, events, downloads). Each destination (“target”) can enforce its own file types, max size, and helper rules.

> Built for Delta Virtual / SPTheme layouts, but configurable for any phpVMS v7 site.

---

## Features

- ✅ Upload to **specific approved folders** (targets) you define
- ✅ Per-target rules:
  - allowed file extensions
  - max file size
  - naming mode: original or unique
  - optional overwrite (if enabled)
  - optional UI hint (ex: image dimension requirements)
- ✅ Logs uploads to DB table `asset_uploads` (shows “Recent Uploads” list)
- ✅ Adds an Admin → Addons menu link (when enabled)
- ✅ Safe destination handling (prevents path traversal outside allowed roots)

---

## Screens / Where to find it

- Admin page:  
  `/admin/asset-uploader`

---

## Requirements

- phpVMS v7
- PHP 8.1+
- Laravel file upload limits configured appropriately (see below)

---

## Installation

1. Upload the module to:
   ```
   /modules/AssetUploader
   ```

2. Run the migrations:
   ```bash
   php artisan module:migrate AssetUploader
   ```
   > If your install uses standard migrations for modules, try:
   ```bash
   php artisan migrate
   ```

3. Clear caches (recommended):
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

4. Visit:
   ```
   /admin/asset-uploader
   ```

---

## Configuration

Edit:
```
/modules/AssetUploader/Config/config.php
```

### Middleware (important)
By default, the module routes are protected with:

```php
'middleware' => ['web', 'auth', 'role:admin'],
```

✅ `role:admin` is recommended for phpVMS admin addon routes.

> If you try using Laratrust `ability:*` middleware, note that Laratrust `ability`
> expects multiple parameters (roles + permissions) and `ability:admin` will throw an argument error.
> Use `role:admin` unless you *know* your Laratrust config and parameters.

---

## Upload Targets

Targets are defined in the config under `targets`.

Example:

```php
'targets' => [

  'sptheme_banners' => [
    'label' => 'SPTheme - Banner Images',
    'base'  => 'public',                 // public_path()
    'path'  => 'SPTheme/images/banner',  // relative to base
    'allowed_extensions' => ['jpg','jpeg','png','webp','gif'],
    'max_size_kb' => 8192,
    'naming' => 'unique',                // original|unique
    'overwrite' => false,                // if true, allows overwrite checkbox
  ],

  'sptheme_awards' => [
    'label' => 'SPTheme - Award Images',
    'hint'  => 'Awards MUST be 250px × 250px.',   // optional UI helper text
    'base'  => 'public',
    'path'  => 'SPTheme/images/awards',
    'allowed_extensions' => ['png','jpg','jpeg','webp'],
    'max_size_kb' => 8192,
    'naming' => 'unique',
    'overwrite' => false,
  ],

  'sptheme_tours' => [
    'label' => 'SPTheme - Tour Graphics',
    'hint'  => 'Tour images MUST be 1024px × 1024px.', // optional UI helper text
    'base'  => 'public',
    'path'  => 'SPTheme/images/tours',
    'allowed_extensions' => ['png','jpg','jpeg','webp'],
    'max_size_kb' => 12288,
    'naming' => 'unique',
    'overwrite' => false,
  ],

];
```

### `base` values
- `public` → uploads under `public_path()` (recommended for theme assets)
- `storage` → uploads under `storage_path()` (useful for non-public files)

---

## Database Logging

Uploads are recorded in:
- table: `asset_uploads`

If you see:
> `SQLSTATE[42S02]: Base table or view not found: 1146 Table ... asset_uploads doesn't exist`

Run:
```bash
php artisan module:migrate AssetUploader
```

Uploads can still work without logging (depending on your version), but “Recent Uploads” requires the table.

---

## Server / PHP Upload Limits

If uploads fail for larger files, check:

- `upload_max_filesize`
- `post_max_size`
- `max_execution_time`
- your web server limits (Nginx/Apache)

Also ensure the destination folders are writable by the web user.

---

## Security Notes

- Upload destinations are restricted to configured targets.
- Filename input is sanitized and validated.
- The module prevents saving outside the allowed base path.

---

## Development Notes

- Routes: `modules/AssetUploader/Routes/web.php`
- Controller: `modules/AssetUploader/Http/Controllers/Admin/AssetUploaderController.php`
- View: `modules/AssetUploader/Resources/views/admin/index.blade.php`
- Config: `modules/AssetUploader/Config/config.php`

---

## Roadmap (optional ideas)

- Enforce image dimensions (ex: hard-reject non-1024×1024 tours)
- Batch uploads (multi-file)
- Delete/replace assets from the UI (with extra safety)
- “Quick targets” buttons (Upload Banner / Upload Award)

---

## License

MIT
