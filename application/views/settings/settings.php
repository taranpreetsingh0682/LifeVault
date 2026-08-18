<!-- Main Settings View Area -->
<main class="documents-container settings-page-container">

  <!-- Header Section -->
  <div class="documents-header mb-4">
    <div class="doc-title-area">
      <h1 class="doc-title">
        <i class="bi bi-gear-fill text-primary me-2"></i>Vault Settings
      </h1>
      <p class="doc-subtitle">Configure application options, encryption rules, and sync preferences.</p>
    </div>
  </div>

  <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success"><?= html_escape($this->session->flashdata('success')); ?></div><?php endif; ?>
  <form class="setting-card shadow-sm p-3 mb-4" method="post" action="<?= site_url('settings/save'); ?>">
    <div class="row g-3 align-items-end"><div class="col-md-4"><label class="form-label">Default view</label><select name="document_view" class="form-select"><option value="list" <?= $settings['document_view']==='list'?'selected':''; ?>>List</option><option value="grid" <?= $settings['document_view']==='grid'?'selected':''; ?>>Grid</option></select></div><div class="col-md-4"><label class="form-label">Auto-lock</label><select name="auto_lock" class="form-select"><?php foreach (array('5'=>'5 minutes','15'=>'15 minutes','30'=>'30 minutes','never'=>'Never') as $value=>$label): ?><option value="<?= $value; ?>" <?= $settings['auto_lock']===$value?'selected':''; ?>><?= $label; ?></option><?php endforeach; ?></select></div><div class="col-md-2 form-check ms-3"><input name="auto_category" value="1" class="form-check-input" type="checkbox" id="autoCategory" <?= $settings['auto_category']?'checked':''; ?>><label for="autoCategory" class="form-check-label">Auto-categorize</label></div><div class="col-md-1"><button class="btn btn-dark" type="submit">Save</button></div></div>
  </form>

  <div class="row g-4">
    
    <!-- Left Column: General & Security Settings -->
    <div class="col-12 col-lg-6">
      
      <!-- Card 1: General Preferences -->
      <div class="setting-card shadow-sm mb-4">
        <div class="setting-card-header d-flex align-items-center gap-2 mb-3">
          <i class="bi bi-sliders text-primary fs-5"></i>
          <h5 class="fw-bold mb-0">General Preferences</h5>
        </div>

        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Default Document View</span>
              <span class="text-muted text-xs">Choose how your files are displayed by default</span>
            </div>
            <select class="form-select form-select-sm setting-select" style="width: 140px;">
              <option value="list" selected>List View</option>
              <option value="grid">Grid View</option>
            </select>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Auto-Categorization</span>
              <span class="text-muted text-xs">Automatically sort files based on extension</span>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input custom-switch" type="checkbox" checked>
            </div>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Vault Language</span>
              <span class="text-muted text-xs">Primary language for application text</span>
            </div>
            <select class="form-select form-select-sm setting-select" style="width: 140px;">
              <option value="en" selected>English (US)</option>
              <option value="hi">Hindi (हिन्दी)</option>
              <option value="es">Spanish</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Card 2: Security & Encryption -->
      <div class="setting-card shadow-sm">
        <div class="setting-card-header d-flex align-items-center gap-2 mb-3">
          <i class="bi bi-shield-lock text-success fs-5"></i>
          <h5 class="fw-bold mb-0">Security & Encryption</h5>
        </div>

        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Vault Auto-Lock</span>
              <span class="text-muted text-xs">Automatically lock vault after inactivity</span>
            </div>
            <select class="form-select form-select-sm setting-select" style="width: 140px;">
              <option value="5">5 Minutes</option>
              <option value="15" selected>15 Minutes</option>
              <option value="30">30 Minutes</option>
              <option value="never">Never</option>
            </select>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">AES-256 Encryption</span>
              <span class="text-muted text-xs">End-to-end client-side encryption</span>
            </div>
            <span class="badge bg-success-subtle text-success fw-bold px-2 py-1">Active</span>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Export Encryption Key</span>
              <span class="text-muted text-xs">Download your emergency recovery key</span>
            </div>
            <button class="btn btn-outline-dark btn-sm rounded-pill px-3" type="button">Download</button>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column: Storage, Backup & Danger Zone -->
    <div class="col-12 col-lg-6">
      
      <!-- Card 3: Cloud Backup & Sync -->
      <div class="setting-card shadow-sm mb-4">
        <div class="setting-card-header d-flex align-items-center gap-2 mb-3">
          <i class="bi bi-cloud-check text-info fs-5"></i>
          <h5 class="fw-bold mb-0">Cloud Backup & Sync</h5>
        </div>

        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Google Drive Backup</span>
              <span class="text-muted text-xs">Sync vault backups to Google Drive</span>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input custom-switch" type="checkbox" checked>
            </div>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Dropbox Integration</span>
              <span class="text-muted text-xs">Auto-upload PDF copies to Dropbox</span>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input custom-switch" type="checkbox">
            </div>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">PDF Compression Level</span>
              <span class="text-muted text-xs">Compress documents before storing</span>
            </div>
            <select class="form-select form-select-sm setting-select" style="width: 140px;">
              <option value="high">High (Smaller)</option>
              <option value="balanced" selected>Balanced</option>
              <option value="off">Off (Original)</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Card 4: Danger Zone -->
      <div class="setting-card border-danger shadow-sm">
        <div class="setting-card-header d-flex align-items-center gap-2 mb-3 text-danger">
          <i class="bi bi-exclamation-triangle-fill fs-5"></i>
          <h5 class="fw-bold mb-0">Danger Zone</h5>
        </div>

        <div class="d-flex flex-column gap-3">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block">Export All Vault Data</span>
              <span class="text-muted text-xs">Download a ZIP archive of all your files</span>
            </div>
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="button">Export ZIP</button>
          </div>

          <hr class="my-1">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="fw-semibold text-dark d-block text-danger">Delete Entire Vault</span>
              <span class="text-muted text-xs">Permanently erase all files and account data</span>
            </div>
            <button class="btn btn-outline-danger btn-sm rounded-pill px-3" type="button">Delete Vault</button>
          </div>
        </div>
      </div>

    </div>

  </div>

</main>
