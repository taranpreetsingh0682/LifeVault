<!-- LifeVault – Documents Page View -->
<!-- Main Documents View Area -->
<?php
$category_counts = isset($category_counts) ? $category_counts : array();
$category_count_map = array('identity' => 0, 'personal' => 0, 'education' => 0, 'certificates' => 0, 'images' => 0, 'records' => 0);
foreach ($category_counts as $category_count) {
  $category_key = strtolower($category_count->category);
  if (array_key_exists($category_key, $category_count_map)) {
    $category_count_map[$category_key] = (int) $category_count->total;
  }
}
$storage_used = isset($storage_used) ? (float) $storage_used : 0;
$storage_limit = 5 * 1024 * 1024 * 1024;
$storage_percent = $storage_limit > 0 ? min(100, round(($storage_used / $storage_limit) * 100, 1)) : 0;
$storage_used_label = $storage_used >= 1048576 ? round($storage_used / 1073741824, 2) . ' GB' : round($storage_used / 1048576, 2) . ' MB';
$storage_available_label = round(max(0, $storage_limit - $storage_used) / 1073741824, 2) . ' GB Available';
?>
<main class="documents-container">

  <!-- ── Page Header ────────────────────────────────────────────── -->
  <div class="documents-header">
    <div class="doc-title-area">
      <h1 class="doc-title">Documents</h1>
      <p class="doc-subtitle">All your files, organized, searchable and secure.</p>
    </div>
    <div class="doc-action-area">
      <button class="btn-upload-file" id="openUploadModalBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="bi bi-cloud-arrow-up-fill"></i>
        <span>Upload file</span>
      </button>
    </div>
  </div>

  <!-- ── Content Layout: Left Panel + Right Panel ───────────────── -->
  <div class="doc-body-grid">

    <!-- ── Left Column ────────────────────────────────────────────── -->
    <div class="doc-left-col">

      <!-- Categories Card -->
      <div class="side-categories-card">
        <h5 class="side-card-title">Categories</h5>
        <div class="categories-vertical-list">

          <div class="cat-row-item" data-category="identity">
            <div class="cat-icon-badge cat-icon-identity">
              <i class="bi bi-person-vcard-fill"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Identity</span>
              <span class="cat-row-count"><?= $category_count_map['identity']; ?> files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="personal">
            <div class="cat-icon-badge cat-icon-personal">
              <i class="bi bi-person-fill"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Personal</span>
              <span class="cat-row-count"><?= $category_count_map['personal']; ?> files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="education">
            <div class="cat-icon-badge cat-icon-education">
              <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Education</span>
              <span class="cat-row-count"><?= $category_count_map['education']; ?> files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="certificates">
            <div class="cat-icon-badge cat-icon-certificates">
              <i class="bi bi-award-fill"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Certificates</span>
              <span class="cat-row-count"><?= $category_count_map['certificates']; ?> files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="images">
            <div class="cat-icon-badge cat-icon-images">
              <i class="bi bi-image-fill"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Images</span>
              <span class="cat-row-count"><?= $category_count_map['images']; ?> files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="records">
            <div class="cat-icon-badge cat-icon-records">
              <i class="bi bi-folder2-open"></i>
            </div>
            <div class="cat-row-meta">
              <span class="cat-row-name">Records</span>
              <span class="cat-row-count"><?= $category_count_map['records']; ?> files</span>
            </div>
          </div>

        </div>
      </div>

      <!-- Storage Card -->
      <div class="side-storage-card">
        <div class="side-storage-header">
          <span class="side-storage-title">Storage</span>
          <a href="#" class="upgrade-link">Upgrade</a>
        </div>
        <p class="side-storage-meta"><strong><?= $storage_used_label; ?></strong> of 5 GB Used</p>
        <div class="side-storage-bar-wrap">
          <div class="side-storage-bar-fill" style="width: <?= $storage_percent; ?>%;"></div>
        </div>
        <div class="side-storage-footer">
          <span><?= $storage_available_label; ?></span>
          <strong><?= $storage_percent; ?>%</strong>
        </div>
      </div>

    </div><!-- /doc-left-col -->

    <!-- ── Right Column ───────────────────────────────────────────── -->
    <div class="doc-right-col">

      <!-- Filter Pills & Controls Toolbar -->
      <div class="filter-toolbar">
        <div class="filter-pills-group" id="filterPillsGroup">
          <button class="filter-pill active" data-filter="all">All</button>
          <button class="filter-pill" data-filter="identity">Identity</button>
          <button class="filter-pill" data-filter="personal">Personal</button>
          <button class="filter-pill" data-filter="education">Education</button>
          <button class="filter-pill" data-filter="certificates">Certificates</button>
          <button class="filter-pill" data-filter="images">Images</button>
          <button class="filter-pill" data-filter="records">Records</button>
        </div>

        <div class="controls-group">
          <div class="sort-dropdown-wrap">
            <select class="sort-select" id="sortSelect">
              <option value="newest">Newest first</option>
              <option value="oldest">Oldest first</option>
              <option value="name_asc">Name (A–Z)</option>
              <option value="size_desc">Largest first</option>
            </select>
            <i class="bi bi-chevron-down sort-chevron"></i>
          </div>

          <div class="view-switcher">
            <button class="view-btn active" id="listViewBtn" title="List View">
              <i class="bi bi-list-ul"></i>
            </button>
            <button class="view-btn" id="gridViewBtn" title="Grid View">
              <i class="bi bi-grid-fill"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Documents Card -->
      <div class="main-documents-card">

        <!-- TABLE VIEW -->
        <div id="tableViewWrap">
          <div class="table-responsive">
            <table class="vault-table" id="documentsTable">
              <thead>
                <tr>
                  <th>DOCUMENT NAME</th>
                  <th>CATEGORY</th>
                  <th>UPDATED ON</th>
                  <th>SIZE</th>
                  <th>STARRED</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="documentsTableBody">
                <!-- Rows injected by JS -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- GRID VIEW -->
        <div id="gridViewWrap" class="d-none">
          <div class="documents-grid" id="documentsGrid">
            <!-- Cards injected by JS -->
          </div>
        </div>

        <!-- Footer / Pagination -->
        <div class="table-footer-bar">
          <span class="footer-showing-text" id="showingText">Showing 12 of 120 documents</span>
          <div class="pagination-group" id="paginationGroup">
            <!-- Injected by JS -->
          </div>
        </div>

      </div><!-- /main-documents-card -->
    </div><!-- /doc-right-col -->
  </div><!-- /doc-body-grid -->

</main>


<!-- ── Action Dropdown (shared, positioned by JS) ────────────────── -->
<div class="action-dropdown" id="actionDropdown">
  <a href="#" class="action-item"><i class="bi bi-eye"></i> View</a>
  <a href="#" class="action-item"><i class="bi bi-download"></i> Download</a>
  <div class="action-divider"></div>
  <a href="#" class="action-item danger"><i class="bi bi-trash"></i> Delete</a>
</div>


<!-- ── Upload Document Modal ─────────────────────────────────────── -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg upload-modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold fs-6" id="uploadModalLabel">
          <i class="bi bi-cloud-arrow-up-fill me-2 text-primary"></i>Upload New Document
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 pb-4">
        <div class="upload-dropzone-mini" id="modalDropzone">
          <i class="bi bi-cloud-upload text-primary" style="font-size:2rem;"></i>
          <p class="mt-2 mb-0 fw-semibold" style="color:#0f172a;">Drag & drop your file here</p>
          <p class="text-muted small">or click to browse</p>
        </div>
        <form id="uploadForm" class="mt-3" method="post" action="<?= site_url('upload/store'); ?>" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="upload-label">Document Title</label>
            <input type="text" name="title" class="upload-input" placeholder="e.g. Passport Copy" required id="uploadTitle">
          </div>
          <div class="mb-3">
            <label class="upload-label">File</label>
            <input type="file" name="document" required class="upload-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
          </div>
          <div class="mb-4">
            <label class="upload-label">Category</label>
            <select name="category" class="upload-input" required id="uploadCategory">
              <option value="">Select Category</option>
              <option value="identity">Identity</option>
              <option value="personal">Personal</option>
              <option value="education">Education</option>
              <option value="certificates">Certificates</option>
              <option value="images">Images</option>
              <option value="records">Records</option>
            </select>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-modal-upload">
              <i class="bi bi-upload me-1"></i>Upload Document
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- ================================================================
     DOCUMENTS PAGE JAVASCRIPT
     ================================================================ -->
<script>
(function () {
  'use strict';

  /* ── Data ──────────────────────────────────────────────────────── */
  const ALL_DOCS = <?= json_encode(array_map(function ($document) { return array('id'=>(int)$document->id, 'name'=>$document->title, 'type'=>strtoupper(ltrim($document->file_type,'.')), 'cat'=>strtolower($document->category), 'updated'=>date('d M Y, h:i A', strtotime($document->uploaded_at)), 'size'=>round($document->file_size / 1048576, 2) . ' MB', 'sizeBytes'=>(int)$document->file_size, 'starred'=>(bool)$document->is_important); }, $documents)); ?>;
  /*
    { id:1,  name:'PAN Card.pdf',               type:'PDF', cat:'identity',     updated:'Yesterday, 09:15 PM', size:'240 KB',  sizeBytes:245760,  starred:true  },
    { id:2,  name:'Resume.pdf',                 type:'PDF', cat:'personal',     updated:'05 July 2025',        size:'1.2 MB',  sizeBytes:1258291, starred:false },
    { id:3,  name:'Aadhaar Card.pdf',           type:'PDF', cat:'identity',     updated:'Today, 10:30 AM',     size:'456 KB',  sizeBytes:466944,  starred:true  },
    { id:4,  name:'10th Marksheet.xls',         type:'XLS', cat:'education',    updated:'04 July 2025',        size:'512 KB',  sizeBytes:524288,  starred:false },
    { id:5,  name:'Passport.pdf',               type:'PDF', cat:'identity',     updated:'01 June 2025',        size:'600 KB',  sizeBytes:614400,  starred:true  },
    { id:6,  name:'Driving Licence.pdf',        type:'PDF', cat:'identity',     updated:'28 May 2025',         size:'310 KB',  sizeBytes:317440,  starred:false },
    { id:7,  name:'B.Tech Degree.pdf',          type:'PDF', cat:'education',    updated:'20 May 2025',         size:'890 KB',  sizeBytes:911360,  starred:true  },
    { id:8,  name:'Vaccination Certificate.pdf',type:'PDF', cat:'certificates', updated:'12 May 2025',         size:'220 KB',  sizeBytes:225280,  starred:false },
    { id:9,  name:'Family Photo.jpg',           type:'JPG', cat:'images',       updated:'02 May 2025',         size:'3.4 MB',  sizeBytes:3565158, starred:false },
    { id:10, name:'Rent Agreement.docx',        type:'DOC', cat:'records',      updated:'28 Apr 2025',         size:'540 KB',  sizeBytes:552960,  starred:false },
    { id:11, name:'Bank Statement.pdf',         type:'PDF', cat:'personal',     updated:'20 Apr 2025',         size:'1.1 MB',  sizeBytes:1153434, starred:false },
    { id:12, name:'Insurance Policy.pdf',       type:'PDF', cat:'records',      updated:'15 Apr 2025',         size:'760 KB',  sizeBytes:778240,  starred:false },
  ]; */

  /* ── State ─────────────────────────────────────────────────────── */
  let docs        = ALL_DOCS.map(d => ({ ...d }));
  let activeFilter= 'all';
  let sortMode    = 'newest';
  let viewMode    = 'list';
  let currentPage = 1;
  const PER_PAGE  = 12;

  /* ── Helpers ───────────────────────────────────────────────────── */
  const typeCls  = { PDF:'type-pdf', DOC:'type-doc', XLS:'type-xls', JPG:'type-jpg' };
  const catLabel = { identity:'Identity', personal:'Personal', education:'Education',
                     certificates:'Certificates', images:'Images', records:'Records' };
  const catBadge = { identity:'badge-identity', personal:'badge-personal', education:'badge-education',
                     certificates:'badge-certificates', images:'badge-images', records:'badge-records' };
  const catIcon  = { identity:'bi-person-vcard-fill', personal:'bi-person-fill',
                     education:'bi-mortarboard-fill', certificates:'bi-award-fill',
                     images:'bi-image-fill', records:'bi-folder2-open' };

  /* ── Filter + Sort ─────────────────────────────────────────────── */
  function getFiltered() {
    let list = activeFilter === 'all' ? docs : docs.filter(d => d.cat === activeFilter);
    switch (sortMode) {
      case 'oldest':   list = list.slice().sort((a,b) => a.id - b.id); break;
      case 'name_asc': list = list.slice().sort((a,b) => a.name.localeCompare(b.name)); break;
      case 'size_desc':list = list.slice().sort((a,b) => b.sizeBytes - a.sizeBytes); break;
      default:         list = list.slice().sort((a,b) => b.id - a.id);
    }
    return list;
  }

  /* ── Render Table ──────────────────────────────────────────────── */
  function renderTable(page) {
    const list      = getFiltered();
    const total     = list.length;
    const totalPages= Math.max(1, Math.ceil(total / PER_PAGE));
    currentPage     = Math.min(page, totalPages);
    const slice     = list.slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);

    const tbody = document.getElementById('documentsTableBody');
    tbody.innerHTML = '';

    if (slice.length === 0) {
      tbody.innerHTML = `<tr><td colspan="6" class="empty-state-cell">
        <i class="bi bi-folder2-open" style="font-size:2rem;color:#cbd5e1;display:block;margin-bottom:.5rem;"></i>
        No documents found for this filter.
      </td></tr>`;
    } else {
      slice.forEach(doc => {
        const tr = document.createElement('tr');
        tr.className = 'doc-table-row';
        tr.dataset.id = doc.id;
        tr.innerHTML = `
          <td>
            <div class="file-name-cell">
              <span class="file-type-badge ${typeCls[doc.type]}">${doc.type}</span>
              <span class="file-name-text">${escHtml(doc.name)}</span>
            </div>
          </td>
          <td><span class="table-cat-badge ${catBadge[doc.cat]}">${catLabel[doc.cat]}</span></td>
          <td class="td-muted">${doc.updated}</td>
          <td class="td-muted">${doc.size}</td>
          <td class="text-center">
            <a class="star-btn${doc.starred?' starred':''}" href="<?= site_url('documents/toggleImportant/'); ?>${doc.id}" data-id="${doc.id}" title="${doc.starred?'Unstar':'Star'}">
              <i class="bi bi-star${doc.starred?'-fill':''}"></i>
            </a>
          </td>
          <td class="text-center">
            <button class="action-dots-btn" data-id="${doc.id}" title="More options">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
          </td>`;
        tbody.appendChild(tr);
      });
    }

    updateFooter(total, slice.length, currentPage, totalPages);
  }

  /* ── Render Grid ───────────────────────────────────────────────── */
  function renderGrid(page) {
    const list      = getFiltered();
    const total     = list.length;
    const totalPages= Math.max(1, Math.ceil(total / PER_PAGE));
    currentPage     = Math.min(page, totalPages);
    const slice     = list.slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);

    const grid = document.getElementById('documentsGrid');
    grid.innerHTML = '';

    slice.forEach(doc => {
      const fileEmoji = doc.type==='JPG'?'🖼️': doc.type==='XLS'?'📊': doc.type==='DOC'?'📝':'📄';
      const card = document.createElement('div');
      card.className = 'grid-doc-card';
      card.dataset.id = doc.id;
      card.innerHTML = `
        <div class="grid-card-top">
          <span class="file-type-badge ${typeCls[doc.type]}">${doc.type}</span>
          <a class="star-btn${doc.starred?' starred':''}" href="<?= site_url('documents/toggleImportant/'); ?>${doc.id}" data-id="${doc.id}" title="${doc.starred?'Unstar':'Star'}">
            <i class="bi bi-star${doc.starred?'-fill':''}"></i>
          </a>
        </div>
        <div class="grid-file-icon">${fileEmoji}</div>
        <p class="grid-file-name">${escHtml(doc.name)}</p>
        <div class="grid-card-meta">
          <span class="table-cat-badge ${catBadge[doc.cat]}">${catLabel[doc.cat]}</span>
          <span class="grid-size">${doc.size}</span>
        </div>
        <p class="grid-date">${doc.updated}</p>
        <div class="grid-card-footer">
          <a class="btn btn-sm btn-outline-secondary" target="_blank" href="<?= site_url('documents/view/'); ?>${doc.id}" title="View"><i class="bi bi-eye"></i></a>
          <a class="btn btn-sm btn-outline-secondary" href="<?= site_url('documents/download/'); ?>${doc.id}" title="Download"><i class="bi bi-download"></i></a>
          <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this document permanently?');" href="<?= site_url('documents/delete/'); ?>${doc.id}" title="Delete"><i class="bi bi-trash"></i></a>
        </div>`;
      grid.appendChild(card);
    });

    updateFooter(total, slice.length, currentPage, totalPages);
  }

  /* ── Footer / Pagination ───────────────────────────────────────── */
  function updateFooter(total, shown, page, totalPages) {
    const start = total === 0 ? 0 : (page-1)*PER_PAGE+1;
    const end   = start + shown - 1;
    document.getElementById('showingText').textContent =
      `Showing ${end} of ${total} documents`;

    const pg = document.getElementById('paginationGroup');
    pg.innerHTML = '';

    const mkBtn = (label, disabled, active, clickFn) => {
      const b = document.createElement('button');
      b.className = `page-btn${active?' active':''}`;
      b.textContent = label;
      b.disabled = disabled;
      if (!disabled && !active) b.addEventListener('click', clickFn);
      return b;
    };

    pg.appendChild(mkBtn('Prev', page===1, false, ()=>render(page-1)));

    const maxPages = Math.min(totalPages, 10);
    for (let i=1; i<=maxPages; i++) {
      const n = i;
      pg.appendChild(mkBtn(n, false, n===page, ()=>render(n)));
    }

    pg.appendChild(mkBtn('Next', page===totalPages||totalPages===0, false, ()=>render(page+1)));
  }

  /* ── Master Render ─────────────────────────────────────────────── */
  function render(page=1) {
    if (viewMode === 'list') {
      document.getElementById('tableViewWrap').classList.remove('d-none');
      document.getElementById('gridViewWrap').classList.add('d-none');
      renderTable(page);
    } else {
      document.getElementById('tableViewWrap').classList.add('d-none');
      document.getElementById('gridViewWrap').classList.remove('d-none');
      renderGrid(page);
    }
  }

  /* ── Star Toggle ───────────────────────────────────────────────── */
  function handleStar(id) {
    const doc = docs.find(d => d.id === id);
    if (!doc) return;
    doc.starred = !doc.starred;
    render(currentPage);
  }

  /* ── Event Delegation ──────────────────────────────────────────── */
  document.addEventListener('click', e => {
    // Filter pills
    const pill = e.target.closest('.filter-pill');
    if (pill) {
      document.querySelectorAll('.filter-pill').forEach(p=>p.classList.remove('active'));
      pill.classList.add('active');
      activeFilter = pill.dataset.filter;
      // Sync sidebar categories
      document.querySelectorAll('.cat-row-item').forEach(c => {
        c.classList.toggle('active', c.dataset.category === activeFilter);
      });
      render(1);
      return;
    }

    // Sidebar category rows
    const catRow = e.target.closest('.cat-row-item');
    if (catRow) {
      const cat = catRow.dataset.category;
      document.querySelectorAll('.cat-row-item').forEach(c=>c.classList.remove('active'));
      catRow.classList.add('active');
      activeFilter = cat;
      // Sync pills
      document.querySelectorAll('.filter-pill').forEach(p => {
        p.classList.toggle('active', p.dataset.filter === cat);
      });
      render(1);
      return;
    }

    // Star buttons
    const starBtn = e.target.closest('.star-btn');
    if (starBtn) { window.location.href = '<?= site_url('documents/toggleImportant/'); ?>' + starBtn.dataset.id; return; }

    // Dots / action button
    const dotsBtn = e.target.closest('.action-dots-btn');
    if (dotsBtn) {
      showActionDropdown(dotsBtn);
      e.stopPropagation();
      return;
    }

    // Hide dropdown on outside click
    const dd = document.getElementById('actionDropdown');
    if (!dd.contains(e.target)) dd.classList.remove('show');
  });

  /* ── Action Dropdown ───────────────────────────────────────────── */
  function showActionDropdown(btn) {
    const dd  = document.getElementById('actionDropdown');
    const id = btn.dataset.id;
    const actions = dd.querySelectorAll('a');
    actions[0].href = '<?= site_url('documents/view/'); ?>' + id;
    actions[0].target = '_blank';
    actions[1].href = '<?= site_url('documents/download/'); ?>' + id;
    actions[2].href = '<?= site_url('documents/delete/'); ?>' + id;
    actions[2].onclick = function () { return confirm('Delete this document permanently?'); };
    const rect= btn.getBoundingClientRect();
    const scrollY = window.scrollY || document.documentElement.scrollTop;
    dd.style.top  = (rect.bottom + scrollY + 4) + 'px';
    dd.style.left = Math.max(0, rect.right - 160) + 'px';
    dd.classList.toggle('show');
  }

  /* ── Sort ──────────────────────────────────────────────────────── */
  document.getElementById('sortSelect').addEventListener('change', function() {
    sortMode = this.value;
    render(1);
  });

  /* ── View Switch ───────────────────────────────────────────────── */
  document.getElementById('listViewBtn').addEventListener('click', function() {
    viewMode = 'list';
    this.classList.add('active');
    document.getElementById('gridViewBtn').classList.remove('active');
    render(currentPage);
  });

  document.getElementById('gridViewBtn').addEventListener('click', function() {
    viewMode = 'grid';
    this.classList.add('active');
    document.getElementById('listViewBtn').classList.remove('active');
    render(currentPage);
  });

  /* ── Upload Form ───────────────────────────────────────────────── */
  /* document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const title = document.getElementById('uploadTitle').value.trim();
    const cat   = document.getElementById('uploadCategory').value;
    if (!title || !cat) return;

    const ext  = title.split('.').pop().toUpperCase();
    const type = ['PDF','DOC','DOCX'].includes(ext) ? (ext==='PDF'?'PDF':'DOC')
               : ['XLS','XLSX'].includes(ext) ? 'XLS'
               : ['JPG','PNG','JPEG'].includes(ext) ? 'JPG' : 'PDF';

    docs.unshift({
      id: Date.now(), name: title, type, cat,
      updated: 'Just now', size: '—', sizeBytes: 0, starred: false
    });

    bootstrap.Modal.getInstance(document.getElementById('uploadModal')).hide();
    this.reset();
    activeFilter = 'all';
    document.querySelectorAll('.filter-pill').forEach(p =>
      p.classList.toggle('active', p.dataset.filter==='all'));
    document.querySelectorAll('.cat-row-item').forEach(c=>c.classList.remove('active'));
    render(1);
  }); */

  /* ── Escape HTML helper ────────────────────────────────────────── */
  function escHtml(str) {
    return str.replace(/[&<>"']/g, c =>
      ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  }

  /* ── Initial Render ────────────────────────────────────────────── */
  render(1);

})();
</script>
