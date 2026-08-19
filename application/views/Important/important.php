<?php
// These values come from Important.php -> Document_model -> MySQL.
$starred_files = isset($starred_files) ? (int) $starred_files : 0;
$identity_docs = isset($identity_docs) ? (int) $identity_docs : 0;
$encrypted_percent = isset($encrypted_percent) ? (int) $encrypted_percent : 0;
$last_starred = isset($last_starred) ? $last_starred : null;
$important_category_counts = isset($important_category_counts) ? $important_category_counts : array();

// Only starred documents should be used for these filter numbers.
$identity_starred = isset($important_category_counts['identity']) ? (int) $important_category_counts['identity'] : 0;
$education_starred = isset($important_category_counts['education']) ? (int) $important_category_counts['education'] : 0;
$personal_starred = isset($important_category_counts['personal']) ? (int) $important_category_counts['personal'] : 0;
$financial_starred = isset($important_category_counts['financial']) ? (int) $important_category_counts['financial'] : 0;

// Convert the real starred_at timestamp into a friendly label.
$last_starred_label = 'No starred files';

if ($last_starred && !empty($last_starred->starred_at)) {
    $last_starred_time = strtotime($last_starred->starred_at);
    $seconds_ago = max(0, time() - $last_starred_time);

    if ($seconds_ago < 3600) {
        $minutes = max(1, floor($seconds_ago / 60));
        $last_starred_label = $minutes . ' min' . ($minutes === 1 ? '' : 's') . ' ago';
    } elseif ($seconds_ago < 86400) {
        $hours = floor($seconds_ago / 3600);
        $last_starred_label = $hours . ' hr' . ($hours === 1 ? '' : 's') . ' ago';
    } elseif ($seconds_ago < 604800) {
        $days = floor($seconds_ago / 86400);
        $last_starred_label = $days . ' day' . ($days === 1 ? '' : 's') . ' ago';
    } else {
        $last_starred_label = date('d M Y', $last_starred_time);
    }
}
?>

<main class="documents-container important-page-container">

  <div class="documents-header">
    <div class="doc-title-area">
      <h1 class="doc-title">
        <i class="bi bi-star-fill text-warning me-2"></i>Important Documents
      </h1>
      <p class="doc-subtitle">Quick access to your starred, pinned, and high-priority vault records.</p>
    </div>

    <div class="doc-action-area">
      <a href="<?= site_url('Upload/upload'); ?>" class="btn-upload-file">
        <i class="bi bi-upload"></i>
        <span>Upload File</span>
      </a>
    </div>
  </div>

  <!-- Every number below is calculated from the logged-in user's database records. -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-warning-subtle text-warning"><i class="bi bi-star-fill"></i></div>
          <div>
            <span class="imp-stat-label">Starred Files</span>
            <h3 class="imp-stat-val mb-0"><?= $starred_files; ?></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-info-subtle text-info"><i class="bi bi-person-vcard"></i></div>
          <div>
            <span class="imp-stat-label">Identity Docs</span>
            <h3 class="imp-stat-val mb-0"><?= $identity_docs; ?></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-success-subtle text-success"><i class="bi bi-shield-check"></i></div>
          <div>
            <span class="imp-stat-label">Encrypted</span>
            <h3 class="imp-stat-val mb-0"><?= $encrypted_percent; ?>%</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-primary-subtle text-primary"><i class="bi bi-clock-history"></i></div>
          <div>
            <span class="imp-stat-label">Last Starred</span>
            <h3 class="imp-stat-val mb-0"><?= html_escape($last_starred_label); ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- These counts are counts of STARRED files, not all uploaded files. -->
  <div class="filter-toolbar">
    <div class="filter-pills-group" id="importantPillsGroup">
      <button class="filter-pill active" data-category="All">All Starred (<?= $starred_files; ?>)</button>
      <button class="filter-pill" data-category="Identity">Identity (<?= $identity_starred; ?>)</button>
      <button class="filter-pill" data-category="Education">Education (<?= $education_starred; ?>)</button>
      <button class="filter-pill" data-category="Personal">Personal (<?= $personal_starred; ?>)</button>
      <button class="filter-pill" data-category="Financial">Financial (<?= $financial_starred; ?>)</button>
    </div>

    <div class="controls-group">
      <div class="sort-dropdown-wrap">
        <select class="sort-select" id="impSortSelect">
          <option value="newest">Newest first</option>
          <option value="name_asc">Name (A-Z)</option>
          <option value="name_desc">Name (Z-A)</option>
        </select>
        <i class="bi bi-chevron-down sort-chevron"></i>
      </div>
    </div>
  </div>

  <div class="upload-card shadow-sm">
    <div class="table-responsive">
      <table class="table vault-table align-middle">
        <thead>
          <tr>
            <th>DOCUMENT NAME</th>
            <th>CATEGORY</th>
            <th>STARRED DATE</th>
            <th>SIZE</th>
            <th>PINNED</th>
            <th class="text-end">ACTIONS</th>
          </tr>
        </thead>
        <tbody id="importantTableBody">
          <?php if (!empty($documents)): ?>
            <?php foreach ($documents as $document): ?>
              <?php
              $document_category = ucfirst(strtolower($document->category));
              $document_size = $document->file_size >= 1048576
                  ? round($document->file_size / 1048576, 2) . ' MB'
                  : round($document->file_size / 1024, 1) . ' KB';
              $starred_timestamp = !empty($document->starred_at) ? $document->starred_at : $document->uploaded_at;
              ?>
              <tr data-category="<?= html_escape($document_category); ?>">
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge-file-type badge-type-pdf">FILE</span>
                    <div>
                      <strong class="doc-table-name d-block"><?= html_escape($document->title); ?></strong>
                      <span class="text-muted-sub text-xs"><?= html_escape($document->file_name); ?></span>
                    </div>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-identity"><?= html_escape($document_category); ?></span></td>
                <td class="text-muted-sub"><?= date('d M Y, h:i A', strtotime($starred_timestamp)); ?></td>
                <td><strong><?= $document_size; ?></strong></td>
                <td>
                  <a class="star-btn starred" title="Remove star" href="<?= site_url('Documents/toggleImportant/' . (int) $document->id); ?>">
                    <i class="bi bi-star-fill text-warning"></i>
                  </a>
                </td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-secondary" href="<?= site_url('Documents/download/' . (int) $document->id); ?>">Download</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="6" class="text-center text-muted py-4">No important documents yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('#importantPillsGroup .filter-pill');
    const tableBody = document.getElementById('importantTableBody');
    const sortSelect = document.getElementById('impSortSelect');

    function applyFilter(category) {
        tableBody.querySelectorAll('tr[data-category]').forEach(function (row) {
            const rowCategory = row.dataset.category.toLowerCase();
            row.style.display = category === 'all' || rowCategory === category ? '' : 'none';
        });
    }

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            buttons.forEach(function (item) { item.classList.remove('active'); });
            button.classList.add('active');
            applyFilter(button.dataset.category.toLowerCase());
        });
    });

    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            const rows = Array.from(tableBody.querySelectorAll('tr[data-category]'));

            if (this.value === 'name_asc' || this.value === 'name_desc') {
                rows.sort(function (a, b) {
                    const aName = a.querySelector('.doc-table-name').textContent.trim().toLowerCase();
                    const bName = b.querySelector('.doc-table-name').textContent.trim().toLowerCase();
                    const result = aName.localeCompare(bName);
                    return this.value === 'name_asc' ? result : -result;
                }.bind(this));

                rows.forEach(function (row) { tableBody.appendChild(row); });
            }
        });
    }
});
</script>