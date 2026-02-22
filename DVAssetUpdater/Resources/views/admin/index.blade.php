@extends('admin.app')

@section('title', 'Asset Uploader')

@section('content')
<div class="container-fluid">

  @if(isset($hasTable) && !$hasTable)
    <div class="alert alert-warning rounded-3 shadow-sm">
      <i class="ph-fill ph-warning me-1"></i>
      <strong>AssetUploader database table is missing.</strong>
      Visit <code>/update</code> or run <code>php artisan migrate --path=modules/AssetUploader/Database/migrations</code>.
      Uploading can still work, but “Recent Uploads” logging will be disabled until the migration runs.
    </div>
  @endif


  @if(session('success'))
    <div class="alert alert-success rounded-3 shadow-sm">
      <i class="ph-fill ph-check-circle me-1"></i> {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger rounded-3 shadow-sm">
      <strong>Upload error</strong>
      <ul class="mb-0">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row g-3">
    <div class="col-xl-6">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h4 class="mb-0">
              <i class="ph-fill ph-upload-simple me-1"></i> Upload a File
            </h4>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
              Admin Tools
            </span>
          </div>

          <p class="text-muted mb-3">
            Pick a target, choose a file, and optionally set the filename.
            File types & size limits are enforced per target.
          </p>

          <form method="POST" action="{{ route('admin.dvassetupdater.store') }}" enctype="multipart/form-data" class="vstack gap-3">
            @csrf

            <div>
              <label class="form-label">Target</label>
              <select name="target" class="form-select" required>
                  <option value="" disabled selected>Select a destination…</option>
                @foreach($targets as $key => $t)
                  <option value="{{ $key }}"
                          data-hint="{{ $t['hint'] ?? '' }}"
                          @selected(old('target')===$key)>
                    {{ $t['label'] ?? $key }} — /{{ trim(($t['path'] ?? ''), '/') }}
                  </option>
                @endforeach
              </select>
              <div class="form-text">These come from <code>modules/AssetUploader/Config/config.php</code>.</div>
              <div id="targetHint" class="alert alert-info py-2 px-3 mt-2 mb-0 d-none rounded-3">
                <i class="ph-fill ph-info me-1"></i> <span class="hint-text"></span>
              </div>
            </div>

            <div>
              <label class="form-label">File</label>
              <input type="file" name="file" class="form-control" required>
              <div class="form-text">Your server must allow writing to the target folder.</div>
            </div>

            <div class="row g-2">
              <div class="col-md-8">
                <label class="form-label">Optional Filename (no extension)</label>
                <input type="text" name="filename" class="form-control" value="{{ old('filename') }}" placeholder="e.g. hero, tour-01, badge-2026">
                <div class="form-text">Only letters/numbers/dots/underscores/dashes. Extension is taken from the upload.</div>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="overwrite" value="1" id="overwrite" @checked(old('overwrite'))>
                  <label class="form-check-label" for="overwrite">
                    Overwrite (if allowed)
                  </label>
                  <div class="form-text">Only works if the target sets <code>overwrite => true</code>.</div>
                </div>
              </div>
            </div>

            <div class="d-flex gap-2">
              <button class="btn btn-primary">
                <i class="ph-fill ph-cloud-arrow-up me-1"></i> Upload
              </button>
              <a class="btn btn-outline-secondary" href="{{ route('admin.dvassetupdater.index') }}">
                <i class="ph-fill ph-arrow-clockwise me-1"></i> Reset
              </a>
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
          <h4 class="mb-2"><i class="ph-fill ph-target me-1"></i> Targets</h4>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Key</th>
                  <th>Path</th>
                  <th>Types</th>
                  <th>Requirements</th>
                  <th class="text-end">Max</th>
                </tr>
              </thead>
              <tbody>
                @forelse($targets as $key => $t)
                  <tr>
                    <td><code>{{ $key }}</code></td>
                    <td><code>/{{ trim(($t['path'] ?? ''), '/') }}</code></td>
                    <td class="text-muted">{{ implode(', ', $t['allowed_extensions'] ?? []) }}</td>
                    <td class="text-muted">{{ $t['hint'] ?? '—' }}</td>
                    <td class="text-end text-muted">{{ ($t['max_size_kb'] ?? 0) }} KB</td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-muted">No targets configured.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4 mt-3">
        <div class="card-body">
          <h4 class="mb-2"><i class="ph-fill ph-clock-counter-clockwise me-1"></i> Recent Uploads</h4>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>When</th>
                  <th>Target</th>
                  <th>File</th>
                  <th>Path</th>
                </tr>
              </thead>
              <tbody>
                @forelse($uploads as $u)
                  <tr>
                    <td class="text-muted">{{ $u->created_at?->diffForHumans() }}</td>
                    <td><code>{{ $u->target_key }}</code></td>
                    <td class="text-muted">{{ $u->stored_name }}</td>
                    <td><code>/{{ $u->relative_path }}</code></td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-muted">No uploads recorded yet.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="form-text mt-2">
            @if(isset($hasTable) && $hasTable)
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const sel = document.querySelector('select[name="target"]');
  const box = document.getElementById('targetHint');
  const text = box ? box.querySelector('.hint-text') : null;

  function updateTargetHint() {
    if (!sel || !box || !text) return;
    const opt = sel.options[sel.selectedIndex];
    const hint = opt ? (opt.getAttribute('data-hint') || '') : '';
    if (hint.trim().length > 0) {
      text.textContent = hint;
      box.classList.remove('d-none');
    } else {
      text.textContent = '';
      box.classList.add('d-none');
    }
  }

  if (sel) {
    sel.addEventListener('change', updateTargetHint);
    updateTargetHint();
  }
});
</script>
@endpush

@endsection
