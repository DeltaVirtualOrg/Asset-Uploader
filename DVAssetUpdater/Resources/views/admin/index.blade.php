@extends('admin.app')

@section('title', 'Asset Uploader')

@section('content')
<style>
  .dvau-shell {
    --dvau-accent: #2563eb;
    --dvau-accent-dark: #1d4ed8;
    --dvau-accent-soft: rgba(37, 99, 235, 0.08);
    --dvau-surface: #ffffff;
    --dvau-surface-soft: #f8fafc;
    --dvau-surface-soft-2: #f1f5f9;
    --dvau-surface-soft-3: #eaf2ff;
    --dvau-border: #d7e0ea;
    --dvau-border-strong: #b8c6d8;
    --dvau-text: #0f172a;
    --dvau-text-soft: #334155;
    --dvau-muted: #475569;
    --dvau-success-bg: #ecfdf3;
    --dvau-success-text: #166534;
    --dvau-warning-bg: #fff8e6;
    --dvau-warning-text: #8a5a00;
    --dvau-danger-bg: #fff1f2;
    --dvau-danger-text: #991b1b;
    --dvau-shadow: 0 16px 42px rgba(15, 23, 42, 0.06);
    color: var(--dvau-text);
    font-size: 17px;
  }

  .dvau-shell,
  .dvau-shell * {
    box-sizing: border-box;
  }

  .dvau-shell .alert {
    border-radius: 18px;
    padding: 1rem 1.1rem;
    font-size: 1rem;
  }

  .dvau-shell .dvau-panel,
  .dvau-shell .dvau-stat,
  .dvau-shell .dvau-target-card,
  .dvau-shell .dvau-upload-item,
  .dvau-shell .dvau-info-box,
  .dvau-shell .dvau-check-card,
  .dvau-shell .dvau-quick-card,
  .dvau-shell .dvau-file-box,
  .dvau-shell .dvau-summary-box {
    background: var(--dvau-surface);
    border: 1px solid var(--dvau-border);
    border-radius: 22px;
    box-shadow: var(--dvau-shadow);
  }

  .dvau-shell .dvau-hero {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #ffffff 0%, #f7fbff 48%, #eff6ff 100%);
    border: 1px solid var(--dvau-border);
    border-radius: 28px;
    padding: 2rem;
    margin-bottom: 1rem;
  }

  .dvau-shell .dvau-hero::after {
    content: '';
    position: absolute;
    top: -80px;
    right: -80px;
    width: 240px;
    height: 240px;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, rgba(37, 99, 235, 0) 70%);
    pointer-events: none;
  }

  .dvau-shell .dvau-kicker {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .72rem 1rem;
    border-radius: 999px;
    background: var(--dvau-accent-soft);
    color: var(--dvau-accent-dark);
    border: 1px solid rgba(37, 99, 235, 0.14);
    font-size: .96rem;
    font-weight: 900;
    letter-spacing: .04em;
    text-transform: uppercase;
  }

  .dvau-shell .dvau-hero-title {
    margin: 1rem 0 .65rem;
    font-size: clamp(2rem, 2.7vw, 2.75rem);
    line-height: 1.08;
    font-weight: 900;
    color: var(--dvau-text);
    max-width: 18ch;
  }

  .dvau-shell .dvau-hero-copy {
    margin: 0;
    font-size: 1.12rem;
    line-height: 1.8;
    color: var(--dvau-text-soft);
    max-width: 60rem;
  }

  .dvau-shell .dvau-hero-note {
    margin-top: 1rem;
    padding: .95rem 1rem;
    background: rgba(255, 255, 255, 0.72);
    border: 1px solid rgba(37, 99, 235, 0.12);
    border-radius: 18px;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-stat-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: .9rem;
  }

  .dvau-shell .dvau-stat {
    padding: 1.15rem 1.15rem 1.2rem;
    min-height: 132px;
  }

  .dvau-shell .dvau-stat-label {
    font-size: .92rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: var(--dvau-muted);
    margin-bottom: .55rem;
  }

  .dvau-shell .dvau-stat-value {
    font-size: 1.72rem;
    line-height: 1.1;
    font-weight: 900;
    color: var(--dvau-text);
    margin-bottom: .4rem;
  }

  .dvau-shell .dvau-stat-copy {
    font-size: .98rem;
    line-height: 1.6;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-panel {
    overflow: hidden;
    height: 100%;
  }

  .dvau-shell .dvau-panel-header {
    padding: 1.4rem 1.45rem;
    border-bottom: 1px solid var(--dvau-border);
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
  }

  .dvau-shell .dvau-panel-title {
    margin: 0;
    font-size: 1.38rem;
    font-weight: 900;
    color: var(--dvau-text);
    display: flex;
    align-items: center;
    gap: .7rem;
  }

  .dvau-shell .dvau-panel-subtitle {
    margin: .5rem 0 0;
    font-size: 1.02rem;
    line-height: 1.75;
    color: var(--dvau-text-soft);
    max-width: 58rem;
  }

  .dvau-shell .dvau-panel-body {
    padding: 1.45rem;
  }

  .dvau-shell .dvau-badge {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .66rem .95rem;
    border-radius: 999px;
    border: 1px solid var(--dvau-border);
    background: var(--dvau-surface-soft);
    color: var(--dvau-text);
    font-size: .94rem;
    font-weight: 900;
  }

  .dvau-shell .dvau-layout-gap {
    gap: 1rem;
  }

  .dvau-shell .dvau-section-label {
    display: block;
    margin-bottom: .65rem;
    font-size: 1.02rem;
    font-weight: 900;
    color: var(--dvau-text);
  }

  .dvau-shell .dvau-section-help {
    margin-top: .55rem;
    font-size: 1rem;
    line-height: 1.75;
    color: var(--dvau-muted);
  }

  .dvau-shell .form-control,
  .dvau-shell .form-select {
    min-height: 58px;
    border-radius: 16px;
    border: 1px solid var(--dvau-border-strong);
    background: #ffffff;
    color: var(--dvau-text);
    font-size: 1rem;
    line-height: 1.45;
    box-shadow: none;
    padding: .9rem 1rem;
  }

  .dvau-shell .form-control::placeholder {
    color: #64748b;
  }

  .dvau-shell .form-control::file-selector-button {
    margin-right: .95rem;
    border: 0;
    border-radius: 12px;
    background: var(--dvau-surface-soft-2);
    color: var(--dvau-text);
    padding: .82rem 1rem;
    font-weight: 900;
  }

  .dvau-shell .form-control:focus,
  .dvau-shell .form-select:focus {
    border-color: rgba(37, 99, 235, 0.75);
    box-shadow: 0 0 0 .24rem rgba(37, 99, 235, 0.12);
  }

  .dvau-shell .dvau-upload-zone {
    background: linear-gradient(180deg, rgba(37, 99, 235, 0.04) 0%, rgba(248, 250, 252, 0.96) 100%);
    border: 1px solid rgba(37, 99, 235, 0.14);
    border-radius: 20px;
    padding: 1.2rem;
  }

  .dvau-shell .dvau-zone-head {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: .8rem;
    margin-bottom: 1rem;
  }

  .dvau-shell .dvau-zone-title {
    font-size: 1.12rem;
    font-weight: 900;
    color: var(--dvau-text);
    margin: 0;
  }

  .dvau-shell .dvau-zone-copy {
    margin: .25rem 0 0;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-info-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
  }

  .dvau-shell .dvau-info-box,
  .dvau-shell .dvau-summary-box,
  .dvau-shell .dvau-file-box {
    padding: 1.15rem 1.15rem 1.2rem;
    min-height: 100%;
    background: var(--dvau-surface-soft);
  }

  .dvau-shell .dvau-info-box .label,
  .dvau-shell .dvau-summary-box .label,
  .dvau-shell .dvau-file-box .label {
    display: block;
    margin-bottom: .56rem;
    font-size: .92rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: var(--dvau-muted);
  }

  .dvau-shell .dvau-info-box .value,
  .dvau-shell .dvau-summary-box .value,
  .dvau-shell .dvau-file-box .value {
    font-size: 1.08rem;
    font-weight: 800;
    line-height: 1.72;
    color: var(--dvau-text);
    word-break: break-word;
  }

  .dvau-shell .dvau-summary-box {
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    border-color: rgba(37, 99, 235, 0.14);
  }

  .dvau-shell .dvau-summary-title {
    display: flex;
    align-items: center;
    gap: .6rem;
    font-size: 1.16rem;
    font-weight: 900;
    color: var(--dvau-text);
    margin-bottom: .8rem;
  }

  .dvau-shell .dvau-rule-list {
    display: flex;
    flex-wrap: wrap;
    gap: .6rem;
  }

  .dvau-shell .dvau-pill {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .6rem .92rem;
    border-radius: 999px;
    background: #ffffff;
    border: 1px solid var(--dvau-border);
    color: var(--dvau-text);
    font-size: .95rem;
    font-weight: 900;
    line-height: 1.3;
  }

  .dvau-shell .dvau-pill.is-success {
    background: var(--dvau-success-bg);
    border-color: rgba(22, 101, 52, 0.12);
    color: var(--dvau-success-text);
  }

  .dvau-shell .dvau-pill.is-warning {
    background: var(--dvau-warning-bg);
    border-color: rgba(138, 90, 0, 0.12);
    color: var(--dvau-warning-text);
  }

  .dvau-shell .dvau-path {
    display: inline-flex;
    align-items: center;
    max-width: 100%;
    padding: .65rem .85rem;
    border-radius: 14px;
    background: #ffffff;
    border: 1px solid var(--dvau-border);
    color: #0b3b8f;
    font-weight: 900;
    font-size: 1rem;
    line-height: 1.55;
    word-break: break-word;
  }

  .dvau-shell .dvau-divider {
    height: 1px;
    margin: .2rem 0;
    background: linear-gradient(90deg, transparent 0%, var(--dvau-border) 12%, var(--dvau-border) 88%, transparent 100%);
  }

  .dvau-shell .dvau-check-card {
    padding: 1rem 1rem 1.05rem;
    background: var(--dvau-surface-soft);
  }

  .dvau-shell .dvau-check-card .form-check {
    display: flex;
    align-items: flex-start;
    gap: .8rem;
    min-height: auto;
  }

  .dvau-shell .dvau-check-card .form-check-label {
    font-size: 1rem;
    line-height: 1.65;
    color: var(--dvau-text);
    font-weight: 800;
    cursor: pointer;
  }

  .dvau-shell .dvau-check-card .form-check-input {
    width: 1.15rem;
    height: 1.15rem;
    margin-top: .2rem;
    border-color: var(--dvau-border-strong);
  }

  .dvau-shell .dvau-check-card .form-check-input:checked {
    background-color: var(--dvau-accent);
    border-color: var(--dvau-accent);
  }

  .dvau-shell .btn {
    min-height: 50px;
    border-radius: 14px;
    font-size: 1rem;
    font-weight: 900;
    padding: .8rem 1.2rem;
  }

  .dvau-shell .btn-primary {
    background: linear-gradient(180deg, #2d6cf4 0%, #1d4ed8 100%);
    border-color: #1d4ed8;
    box-shadow: 0 10px 24px rgba(29, 78, 216, 0.16);
  }

  .dvau-shell .btn-primary:hover,
  .dvau-shell .btn-primary:focus {
    background: linear-gradient(180deg, #255fe1 0%, #1e40af 100%);
    border-color: #1e40af;
  }

  .dvau-shell .btn-outline-secondary {
    border-width: 1px;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-target-card {
    padding: 1.2rem;
    height: 100%;
  }

  .dvau-shell .dvau-target-name {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--dvau-text);
  }

  .dvau-shell .dvau-target-key {
    margin-top: .4rem;
    font-size: .96rem;
    color: var(--dvau-muted);
  }

  .dvau-shell .dvau-target-copy {
    font-size: 1rem;
    line-height: 1.75;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-target-meta-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: .8rem;
    margin-top: .9rem;
  }

  .dvau-shell .dvau-mini {
    padding: .85rem .9rem;
    border-radius: 16px;
    border: 1px solid var(--dvau-border);
    background: var(--dvau-surface-soft);
  }

  .dvau-shell .dvau-mini .mini-label {
    display: block;
    font-size: .83rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: var(--dvau-muted);
    margin-bottom: .35rem;
  }

  .dvau-shell .dvau-mini .mini-value {
    font-size: .98rem;
    line-height: 1.6;
    font-weight: 800;
    color: var(--dvau-text);
    word-break: break-word;
  }

  .dvau-shell .dvau-upload-list {
    display: grid;
    gap: .9rem;
  }

  .dvau-shell .dvau-upload-item {
    padding: 1.15rem;
  }

  .dvau-shell .dvau-upload-top {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: .6rem 1rem;
    margin-bottom: .8rem;
  }

  .dvau-shell .dvau-upload-file {
    font-size: 1.08rem;
    line-height: 1.45;
    font-weight: 900;
    color: var(--dvau-text);
    word-break: break-word;
  }

  .dvau-shell .dvau-upload-time {
    font-size: .95rem;
    font-weight: 800;
    color: var(--dvau-muted);
  }

  .dvau-shell .dvau-upload-copy,
  .dvau-shell .dvau-empty {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-upload-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: .8rem;
    margin: .9rem 0;
  }

  .dvau-shell .dvau-quick-card {
    padding: 1.15rem;
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
  }

  .dvau-shell .dvau-quick-title {
    margin: 0 0 .7rem;
    font-size: 1.06rem;
    font-weight: 900;
    color: var(--dvau-text);
  }

  .dvau-shell .dvau-checklist {
    display: grid;
    gap: .65rem;
  }

  .dvau-shell .dvau-check-row {
    display: flex;
    align-items: flex-start;
    gap: .7rem;
    font-size: 1rem;
    line-height: 1.7;
    color: var(--dvau-text-soft);
  }

  .dvau-shell .dvau-check-row i {
    margin-top: .2rem;
    color: var(--dvau-accent-dark);
  }

  .dvau-shell .dvau-muted-note {
    font-size: .96rem;
    line-height: 1.7;
    color: var(--dvau-muted);
  }

  .dvau-shell .dvau-sticky {
    position: sticky;
    top: 1rem;
  }

  @media (max-width: 1399.98px) {
    .dvau-shell .dvau-sticky {
      position: static;
    }
  }

  @media (max-width: 991.98px) {
    .dvau-shell {
      font-size: 16px;
    }

    .dvau-shell .dvau-info-grid,
    .dvau-shell .dvau-upload-grid,
    .dvau-shell .dvau-target-meta-grid,
    .dvau-shell .dvau-stat-grid {
      grid-template-columns: 1fr;
    }

    .dvau-shell .dvau-hero {
      padding: 1.35rem;
    }

    .dvau-shell .dvau-panel-body,
    .dvau-shell .dvau-panel-header {
      padding: 1.2rem;
    }
  }
</style>

@php
  $targetCount = is_countable($targets ?? null) ? count($targets) : 0;
  $recentCount = isset($uploads) && is_countable($uploads) ? count($uploads) : 0;
  $loggingEnabled = isset($hasTable) && $hasTable;
  $targetPayload = [];

  foreach (($targets ?? []) as $key => $t) {
      $path = '/' . trim(($t['path'] ?? ''), '/');
      $targetPayload[$key] = [
          'label' => $t['label'] ?? $key,
          'path' => $path === '/' ? '/' : $path,
          'types' => implode(', ', $t['allowed_extensions'] ?? []),
          'max' => number_format((($t['max_size_kb'] ?? 0) / 1024), 1) . ' MB',
          'naming' => ucfirst($t['naming'] ?? 'original'),
          'overwrite' => !empty($t['overwrite']) ? 'Allowed' : 'Off',
          'hint' => $t['hint'] ?? '',
      ];
  }
@endphp

<div class="container-fluid dvau-shell">

  @if(!$loggingEnabled)
    <div class="alert alert-warning mb-3">
      <div class="d-flex align-items-start gap-2">
        <i class="ph-fill ph-warning fs-5 mt-1"></i>
        <div>
          <strong>DVAssetUpdater database table is missing.</strong><br>
          Visit <code>/update</code> or run <code>php artisan migrate --path=modules/DVAssetUpdater/Database/migrations</code>.
          Uploading can still work, but recent upload logging is disabled until the migration runs.
        </div>
      </div>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success mb-3">
      <div class="d-flex align-items-start gap-2">
        <i class="ph-fill ph-check-circle fs-5 mt-1"></i>
        <div>{{ session('success') }}</div>
      </div>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger mb-3">
      <div class="d-flex align-items-start gap-2">
        <i class="ph-fill ph-x-circle fs-5 mt-1"></i>
        <div>
          <strong>Upload error</strong>
          <ul class="mb-0 mt-1 ps-3">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif

  <div class="dvau-hero">
    <div class="row g-3 align-items-center">
      <div class="col-xxl-7 col-xl-7">
        <span class="dvau-kicker"><i class="ph-fill ph-layout"></i> DVAssetUpdater Admin</span>
        <h2 class="dvau-hero-title">A cleaner, easier upload page that explains itself.</h2>
        <p class="dvau-hero-copy">
          Review the destination, confirm the file rules, preview the final filename, and upload with less guesswork.
          This version focuses on stronger readability, clearer structure, and a more useful control-panel feel.
        </p>
        <div class="dvau-hero-note">
          The live target panel updates as soon as you change the destination, and the filename preview updates when you pick a file or type a custom name.
        </div>
      </div>
      <div class="col-xxl-5 col-xl-5">
        <div class="dvau-stat-grid">
          <div class="dvau-stat">
            <div class="dvau-stat-label">Configured Targets</div>
            <div class="dvau-stat-value">{{ $targetCount }}</div>
            <div class="dvau-stat-copy">Available upload destinations from your module config.</div>
          </div>
          <div class="dvau-stat">
            <div class="dvau-stat-label">Recent Logs</div>
            <div class="dvau-stat-value">{{ $recentCount }}</div>
            <div class="dvau-stat-copy">Latest upload records currently shown on this page.</div>
          </div>
          <div class="dvau-stat">
            <div class="dvau-stat-label">Logging Status</div>
            <div class="dvau-stat-value">{{ $loggingEnabled ? 'Enabled' : 'Limited' }}</div>
            <div class="dvau-stat-copy">Database-backed recent uploads are {{ $loggingEnabled ? 'active' : 'not active yet' }}.</div>
          </div>
          <div class="dvau-stat">
            <div class="dvau-stat-label">Naming Behavior</div>
            <div class="dvau-stat-value">Live Preview</div>
            <div class="dvau-stat-copy">See the final stored filename before you upload.</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row dvau-layout-gap">
    <div class="col-xxl-8 col-xl-7">
      <div class="dvau-panel">
        <div class="dvau-panel-header d-flex flex-wrap justify-content-between gap-3 align-items-start">
          <div>
            <h4 class="dvau-panel-title"><i class="ph-fill ph-cloud-arrow-up"></i> Upload Workspace</h4>
            <p class="dvau-panel-subtitle">
              Start with the target, then choose the file, review the storage rules, and optionally set a cleaner filename.
              All of the metadata boxes below stay in sync with your selection.
            </p>
          </div>
          <span class="dvau-badge"><i class="ph-fill ph-shield-check"></i> Admin Only</span>
        </div>

        <div class="dvau-panel-body">
          <form method="POST" action="{{ route('admin.assetuploader.store') }}" enctype="multipart/form-data" class="vstack gap-3">
            @csrf

            <div class="dvau-upload-zone">
              <div class="dvau-zone-head">
                <div>
                  <h5 class="dvau-zone-title">Select where the upload should go</h5>
                  <p class="dvau-zone-copy">The target controls the destination path, allowed file types, file size limit, naming mode, and overwrite support.</p>
                </div>
                <span class="dvau-badge"><i class="ph-fill ph-info"></i> Live target details</span>
              </div>

              <div class="row g-3">
                <div class="col-lg-7">
                  <label class="dvau-section-label" for="dvau-target">Upload Target</label>
                  <select name="target" id="dvau-target" class="form-select" required>
                    <option value="" disabled {{ old('target') ? '' : 'selected' }}>Select a destination…</option>
                    @foreach($targets as $key => $t)
                      <option value="{{ $key }}" @selected(old('target') === $key)>
                        {{ $t['label'] ?? $key }} — /{{ trim(($t['path'] ?? ''), '/') }}
                      </option>
                    @endforeach
                  </select>
                  <div class="dvau-section-help">
                    Targets are loaded from <code>modules/DVAssetUpdater/Config/config.php</code>.
                    As soon as you pick one, the detail panels below update automatically.
                  </div>
                </div>

                <div class="col-lg-5">
                  <label class="dvau-section-label" for="dvau-file">Choose File</label>
                  <input type="file" name="file" id="dvau-file" class="form-control" required>
                  <div class="dvau-section-help">
                    Make sure the destination folder is writable by the server before uploading.
                  </div>
                </div>
              </div>
            </div>

            <div class="dvau-info-grid">
              <div class="dvau-summary-box">
                <span class="label">Selected Target</span>
                <div class="dvau-summary-title"><i class="ph-fill ph-folder-open"></i> <span id="dvau-meta-label">Waiting for selection…</span></div>
                <div class="value"><span class="dvau-path" id="dvau-meta-path">—</span></div>
              </div>
              <div class="dvau-summary-box">
                <span class="label">Allowed File Types</span>
                <div class="value" id="dvau-meta-types">—</div>
                <div class="dvau-section-help mb-0">Only matching extensions will pass validation for the selected target.</div>
              </div>
              <div class="dvau-info-box">
                <span class="label">Target Rules</span>
                <div class="value">
                  <div class="dvau-rule-list">
                    <span class="dvau-pill" id="dvau-meta-max">Max: —</span>
                    <span class="dvau-pill" id="dvau-meta-naming">Naming: —</span>
                    <span class="dvau-pill" id="dvau-meta-overwrite">Overwrite: —</span>
                  </div>
                </div>
              </div>
              <div class="dvau-info-box">
                <span class="label">Target Notes</span>
                <div class="value" id="dvau-meta-hint">No special notes for this target yet.</div>
              </div>
            </div>

            <div class="dvau-divider"></div>

            <div class="row g-3">
              <div class="col-lg-8">
                <label class="dvau-section-label" for="dvau-filename">Optional Custom Filename</label>
                <input
                  type="text"
                  name="filename"
                  id="dvau-filename"
                  class="form-control"
                  value="{{ old('filename') }}"
                  placeholder="e.g. hero-banner, event-award-2026, homepage-card"
                >
                <div class="dvau-section-help">
                  Use letters, numbers, dots, underscores, and dashes only.
                  The module keeps the uploaded file’s real extension automatically.
                </div>
              </div>

              <div class="col-lg-4 d-flex align-items-end">
                <div class="dvau-check-card w-100">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" name="overwrite" value="1" id="overwrite" @checked(old('overwrite'))>
                    <label class="form-check-label" for="overwrite">
                      Overwrite if allowed for this target
                    </label>
                  </div>
                  <div class="dvau-section-help mb-0">
                    This only works when the selected target has <code>overwrite => true</code> in the config.
                  </div>
                </div>
              </div>
            </div>

            <div class="dvau-upload-grid">
              <div class="dvau-file-box">
                <span class="label">Final Filename Preview</span>
                <div class="value" id="dvau-filename-preview">No file selected yet.</div>
              </div>
              <div class="dvau-file-box">
                <span class="label">Selected File Details</span>
                <div class="value" id="dvau-file-details">No file selected yet.</div>
              </div>
            </div>

            <div class="d-flex flex-wrap gap-2 pt-1">
              <button class="btn btn-primary px-4">
                <i class="ph-fill ph-cloud-arrow-up me-1"></i> Upload File
              </button>
              <a class="btn btn-outline-secondary px-4" href="{{ route('admin.assetuploader.index') }}">
                <i class="ph-fill ph-arrow-clockwise me-1"></i> Reset Form
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-xxl-4 col-xl-5">
      <div class="dvau-sticky">
        <div class="dvau-quick-card mb-3">
          <h5 class="dvau-quick-title"><i class="ph-fill ph-list-checks me-1"></i> Quick Upload Checklist</h5>
          <div class="dvau-checklist">
            <div class="dvau-check-row"><i class="ph-fill ph-check-circle"></i><span>Pick the correct target first so the right rules load below.</span></div>
            <div class="dvau-check-row"><i class="ph-fill ph-check-circle"></i><span>Confirm the destination path and allowed file types before uploading.</span></div>
            <div class="dvau-check-row"><i class="ph-fill ph-check-circle"></i><span>Use a custom filename only when you want a cleaner saved name.</span></div>
            <div class="dvau-check-row"><i class="ph-fill ph-check-circle"></i><span>Only enable overwrite when that target explicitly allows it.</span></div>
          </div>
        </div>

        <div class="dvau-panel mb-3">
          <div class="dvau-panel-header d-flex flex-wrap justify-content-between gap-3 align-items-start">
            <div>
              <h4 class="dvau-panel-title"><i class="ph-fill ph-folders"></i> Upload Targets</h4>
              <p class="dvau-panel-subtitle">
                Every configured target in one place, including the path, file types, size limit, overwrite support, and naming mode.
              </p>
            </div>
            <span class="dvau-badge">{{ $targetCount }} configured</span>
          </div>
          <div class="dvau-panel-body">
            <div class="row g-3">
              @forelse($targets as $key => $t)
                <div class="col-12">
                  <div class="dvau-target-card">
                    <div class="d-flex flex-wrap justify-content-between gap-2 mb-2 align-items-start">
                      <div>
                        <h6 class="dvau-target-name">{{ $t['label'] ?? $key }}</h6>
                        <div class="dvau-target-key"><code>{{ $key }}</code></div>
                      </div>
                      <span class="dvau-badge">{{ number_format((($t['max_size_kb'] ?? 0) / 1024), 1) }} MB</span>
                    </div>

                    <div class="mb-3">
                      <span class="dvau-path">/{{ trim(($t['path'] ?? ''), '/') }}</span>
                    </div>

                    <div class="dvau-rule-list mb-3">
                      @foreach(($t['allowed_extensions'] ?? []) as $ext)
                        <span class="dvau-pill">.{{ $ext }}</span>
                      @endforeach
                    </div>

                    <div class="dvau-target-meta-grid">
                      <div class="dvau-mini">
                        <span class="mini-label">Overwrite</span>
                        <div class="mini-value">{{ !empty($t['overwrite']) ? 'Allowed' : 'Off' }}</div>
                      </div>
                      <div class="dvau-mini">
                        <span class="mini-label">Naming</span>
                        <div class="mini-value">{{ ucfirst($t['naming'] ?? 'original') }}</div>
                      </div>
                    </div>

                    <div class="dvau-target-copy mt-3">
                      {{ $t['hint'] ?? 'No special notes configured for this target.' }}
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <div class="dvau-target-card">
                    <div class="dvau-empty">No targets configured.</div>
                  </div>
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-1">
    <div class="col-12">
      <div class="dvau-panel">
        <div class="dvau-panel-header d-flex flex-wrap justify-content-between gap-3 align-items-start">
          <div>
            <h4 class="dvau-panel-title"><i class="ph-fill ph-clock-counter-clockwise"></i> Recent Uploads</h4>
            <p class="dvau-panel-subtitle">
              The latest files logged through this module, including the stored name, original name, target, file type, size, and saved path.
            </p>
          </div>
          <span class="dvau-badge">{{ $loggingEnabled ? 'DB logging enabled' : 'Logging limited' }}</span>
        </div>
        <div class="dvau-panel-body">
          <div class="dvau-upload-list">
            @forelse($uploads as $u)
              <div class="dvau-upload-item">
                <div class="dvau-upload-top">
                  <div>
                    <div class="dvau-upload-file">{{ $u->stored_name }}</div>
                    @if(!empty($u->original_name) && $u->original_name !== $u->stored_name)
                      <div class="dvau-upload-copy mt-1">Original file: {{ $u->original_name }}</div>
                    @endif
                  </div>
                  <div class="dvau-upload-time">{{ $u->created_at?->diffForHumans() }}</div>
                </div>

                <div class="dvau-upload-grid">
                  <div class="dvau-mini">
                    <span class="mini-label">Target</span>
                    <div class="mini-value">{{ $u->target_key }}</div>
                  </div>
                  <div class="dvau-mini">
                    <span class="mini-label">File Size</span>
                    <div class="mini-value">{{ !empty($u->size) ? number_format($u->size / 1024, 1).' KB' : 'Unknown' }}</div>
                  </div>
                  <div class="dvau-mini">
                    <span class="mini-label">MIME Type</span>
                    <div class="mini-value">{{ $u->mime ?: 'Unknown' }}</div>
                  </div>
                  <div class="dvau-mini">
                    <span class="mini-label">Saved Path</span>
                    <div class="mini-value">/{{ $u->relative_path }}</div>
                  </div>
                </div>
              </div>
            @empty
              <div class="dvau-target-card">
                <div class="dvau-empty">No uploads recorded yet.</div>
              </div>
            @endforelse
          </div>

          <div class="dvau-muted-note mt-3">
            @if($loggingEnabled)
              This list is stored in the <code>asset_uploads</code> table.
            @else
              Logging is disabled until migrations run.
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  const targetMap = @json($targetPayload);
  const targetSelect = document.getElementById('dvau-target');
  const fileInput = document.getElementById('dvau-file');
  const filenameInput = document.getElementById('dvau-filename');

  const metaLabel = document.getElementById('dvau-meta-label');
  const metaPath = document.getElementById('dvau-meta-path');
  const metaTypes = document.getElementById('dvau-meta-types');
  const metaMax = document.getElementById('dvau-meta-max');
  const metaNaming = document.getElementById('dvau-meta-naming');
  const metaOverwrite = document.getElementById('dvau-meta-overwrite');
  const metaHint = document.getElementById('dvau-meta-hint');
  const filenamePreview = document.getElementById('dvau-filename-preview');
  const fileDetails = document.getElementById('dvau-file-details');

  function formatFileSize(bytes) {
    if (!bytes && bytes !== 0) return 'Unknown size';
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
  }

  function applyOverwriteClass(value) {
    if (!metaOverwrite) return;
    metaOverwrite.classList.remove('is-success', 'is-warning');
    metaOverwrite.classList.add(value === 'Allowed' ? 'is-success' : 'is-warning');
  }

  function updateTargetMeta() {
    if (!targetSelect) return;

    const key = targetSelect.value || '';
    const target = key && targetMap[key] ? targetMap[key] : null;

    if (!target) {
      if (metaLabel) metaLabel.textContent = 'Waiting for selection…';
      if (metaPath) metaPath.textContent = '—';
      if (metaTypes) metaTypes.textContent = '—';
      if (metaMax) metaMax.textContent = 'Max: —';
      if (metaNaming) metaNaming.textContent = 'Naming: —';
      if (metaOverwrite) metaOverwrite.textContent = 'Overwrite: —';
      if (metaHint) metaHint.textContent = 'No special notes for this target yet.';
      applyOverwriteClass('Off');
      return;
    }

    if (metaLabel) metaLabel.textContent = target.label || key;
    if (metaPath) metaPath.textContent = target.path || '—';
    if (metaTypes) metaTypes.textContent = target.types || '—';
    if (metaMax) metaMax.textContent = 'Max: ' + (target.max || '—');
    if (metaNaming) metaNaming.textContent = 'Naming: ' + (target.naming || 'Original');
    if (metaOverwrite) metaOverwrite.textContent = 'Overwrite: ' + (target.overwrite || 'Off');
    if (metaHint) metaHint.textContent = (target.hint && target.hint.trim().length) ? target.hint : 'No special notes for this target yet.';
    applyOverwriteClass(target.overwrite || 'Off');
  }

  function getUploadedExtension() {
    if (!fileInput || !fileInput.files || !fileInput.files.length) return '';
    const fileName = fileInput.files[0].name || '';
    const parts = fileName.split('.');
    return parts.length > 1 ? parts.pop() : '';
  }

  function updateFilenamePreview() {
    if (!filenamePreview) return;

    const ext = getUploadedExtension();
    const typedName = filenameInput ? filenameInput.value.trim() : '';

    if (typedName.length > 0) {
      const cleaned = typedName.replace(/\.[^.]+$/, '');
      filenamePreview.textContent = ext ? (cleaned + '.' + ext) : cleaned;
      return;
    }

    if (fileInput && fileInput.files && fileInput.files.length) {
      filenamePreview.textContent = fileInput.files[0].name;
      return;
    }

    filenamePreview.textContent = 'No file selected yet.';
  }

  function updateFileDetails() {
    if (!fileDetails) return;

    if (!fileInput || !fileInput.files || !fileInput.files.length) {
      fileDetails.textContent = 'No file selected yet.';
      return;
    }

    const file = fileInput.files[0];
    const type = file.type && file.type.length ? file.type : 'Unknown type';
    fileDetails.textContent = file.name + ' • ' + formatFileSize(file.size) + ' • ' + type;
  }

  if (targetSelect) {
    targetSelect.addEventListener('change', updateTargetMeta);
  }

  if (fileInput) {
    fileInput.addEventListener('change', function () {
      updateFilenamePreview();
      updateFileDetails();
    });
  }

  if (filenameInput) {
    filenameInput.addEventListener('input', updateFilenamePreview);
  }

  updateTargetMeta();
  updateFilenamePreview();
  updateFileDetails();
})();
</script>
@endsection
