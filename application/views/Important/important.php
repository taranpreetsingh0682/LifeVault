<?php
// Dynamic statistics for the Important Documents page.
$starred_files = isset($starred_files) ? (int) $starred_files : 0;
$identity_docs = isset($identity_docs) ? (int) $identity_docs : 0;
$encrypted_percent = isset($encrypted_percent) ? (int) $encrypted_percent : 0;
$last_starred = isset($last_starred) ? $last_starred : null;

// Build category counts from the user's actual documents.
$category_count_map = array(
    'identity' => 0,
    'education' => 0,
    'personal' => 0,
    'financial' => 0,
    'certificates' => 0,
    'images' => 0,
    'records' => 0
);

if (!empty($category_counts)) {
    foreach ($category_counts as $category_count) {
        $key = strtolower(trim($category_count->category));

        if (array_key_exists($key, $category_count_map)) {
            $category_count_map[$key] = (int) $category_count->total;
        }
    }
}

// The current database stores uploaded_at but not a separate starred_at value.
$last_starred_label = 'No starred files';

if ($last_starred && !empty($last_starred->uploaded_at)) {
    $last_starred_time = strtotime($last_starred->uploaded_at);
    $seconds_ago = time() - $last_starred_time;

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

<!-- Main Important View Area -->
<main class="documents-container important-page-container">

  <!-- Header -->
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

  <!-- Dynamic summary cards -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-warning-subtle text-warning">
            <i class="bi bi-star-fill"></i>
          </div>
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
          <div class="imp-stat-icon bg-info-subtle text-info">
            <i class="bi bi-person-vcard"></i>
          </div>
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
          <div class="imp-stat-icon bg-success-subtle text-success">
            <i class="bi bi-shield-check"></i>
          </div>
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
          <div class="imp-stat-icon bg-primary-subtle text-primary">
            <i class="bi bi-clock-history"></i>
          </div>
          <div>
            <span class="imp-stat-label">Last Starred</span>
            <h3 class="imp-stat-val mb-0"><?= html_escape($last_starred_label); ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Dynamic category filters -->
  <div class="filter-toolbar">
    <div class="filter-pills-group" id="importantPillsGroup">
      <button class="filter-pill active" data-category="All">All Starred (<?= $starred_files; ?>)</button>
      <button class="filter-pill" data-category="Identity">Identity (<?= $category_count_map['identity']; ?>)</button>
      <button class="filter-pill" data-category="Education">Education (<?= $category_count_map['education']; ?>)</button>
      <button class="filter-pill" data-category="Personal">Personal (<?= $category_count_map['personal']; ?>)</button>
      <button class="filter-pill" data-category="Financial">Financial (<?= $category_count_map['financial']; ?>)</button>
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

  <!-- Dynamic starred document table -->
  <div class="upload-card shadow-sm">
    <div class="table-responsive">
      <table class="table vault-table align-middle">
        <thead>
          <tr>
            <th scope="col">DOCUMENT NAME</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">STARRED DATE</th>
            <th scope="col">SIZE</th>
            <th scope="col">PINNED</th>
            <th scope="col" class="text-end">ACTIONS</th>
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
              ?>
              <tr data-category="<?= html_escape($document_category); ?>">
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <span class="badge-file-type badge-type-pdf">FILE</span>
                    <div>
                      <strong class="doc-table-name d-block">
                        <?= html_escape($document->title); ?>
                      </strong>
                      <span class="text-muted-sub text-xs">
                        <?= html_escape($document->file_name); ?>
                      </span>
                    </div>
                  </div>
                </td>

                <td>
                  <span class="table-cat-badge badge-identity">
                    <?= html_escape($document_category); ?>
                  </span>
                </td>

                <td class="text-muted-sub">
                  <?= date('d M Y, h:i A', strtotime($document->uploaded_at)); ?>
                </td>

                <td><strong><?= $document_size; ?></strong></td>

                <td>
                  <a
                    class="star-btn starred"
                    title="Remove star"
                    href="<?= site_url('Documents/toggleImportant/' . (int) $document->id); ?>"
                  >
                    <i class="bi bi-star-fill text-warning"></i>
                  </a>
                </td>

                <td class="text-end">
                  <a
                    class="btn btn-sm btn-outline-secondary"
                    href="<?= site_url('Documents/download/' . (int) $document->id); ?>"
                  >
                    Download
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center text-muted py-4">
                No important documents yet.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('#importantPillsGroup .filter-pill');
    const rows = document.querySelectorAll('#importantTableBody tr[data-category]');
    const sortSelect = document.getElementById('impSortSelect');

    // Filter starred files by category without another database request.
    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            filterButtons.forEach(function (item) {
                item.classList.remove('active');
            });

            button.classList.add('active');

            const selectedCategory = button.dataset.category.toLowerCase();

            rows.forEach(function (row) {
                const rowCategory = row.dataset.category.toLowerCase();
                row.style.display = selectedCategory === 'all' || rowCategory === selectedCategory
                    ? ''
                    : 'none';
            });
        });
    });

    // Sort the visible starred documents by name.
    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            const tableBody = document.getElementById('importantTableBody');
            const sortableRows = Array.from(tableBody.querySelectorAll('tr[data-category]'));

            if (this.value === 'name_asc' || this.value === 'name_desc') {
                sortableRows.sort(function (a, b) {
                    const nameA = a.querySelector('.doc-table-name').textContent.trim().toLowerCase();
                    const nameB = b.querySelector('.doc-table-name').textContent.trim().toLowerCase();
                    const comparison = nameA.localeCompare(nameB);
                    return this.value === 'name_asc' ? comparison : -comparison;
                }.bind(this));

                sortableRows.forEach(function (row) {
                    tableBody.appendChild(row);
                });
            }
        });
    }
});
</script>