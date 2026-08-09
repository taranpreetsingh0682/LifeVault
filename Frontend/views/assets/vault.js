/**
 * LifeVault - Interactive UI Controller (vault.js)
 */

document.addEventListener('DOMContentLoaded', () => {

  // -------------------------------------------------------------------------
  // 0. Mobile Drawer Sidebar Toggle
  // -------------------------------------------------------------------------
  const mobileToggleBtn = document.getElementById('mobileSidebarToggle');
  const mobileCloseBtn = document.getElementById('mobileSidebarClose');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const sidebar = document.getElementById('appSidebar');

  function openSidebar() {
    if (sidebar) sidebar.classList.add('show');
    if (sidebarOverlay) sidebarOverlay.classList.add('show');
  }

  function closeSidebar() {
    if (sidebar) sidebar.classList.remove('show');
    if (sidebarOverlay) sidebarOverlay.classList.remove('show');
  }

  if (mobileToggleBtn) mobileToggleBtn.addEventListener('click', openSidebar);
  if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', closeSidebar);
  if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

  // -------------------------------------------------------------------------
  // 1. Documents Page Category Filtering & Grid Switcher
  // -------------------------------------------------------------------------
  const filterPills = document.querySelectorAll('#categoryPillsGroup .filter-pill');
  const catRowItems = document.querySelectorAll('.cat-row-item');
  const searchInput = document.querySelector('.search-input');
  const sortSelect = document.getElementById('sortSelect');
  const listViewBtn = document.getElementById('listViewBtn');
  const gridViewBtn = document.getElementById('gridViewBtn');
  const tableViewContainer = document.getElementById('documentsTableView');
  const gridViewContainer = document.getElementById('documentsGridView');
  const tableBody = document.getElementById('documentsTableBody');
  const showingCountText = document.getElementById('showingCountText');

  let currentCategory = 'All';
  let currentSearchQuery = '';

  function applyFilters() {
    if (!tableBody) return;
    const rows = tableBody.querySelectorAll('tr');
    let visibleCount = 0;

    rows.forEach(row => {
      const rowCategory = row.getAttribute('data-category') || '';
      const rowName = (row.getAttribute('data-name') || row.innerText).toLowerCase();

      const matchesCategory = (currentCategory === 'All' || rowCategory.toLowerCase() === currentCategory.toLowerCase());
      const matchesSearch = (!currentSearchQuery || rowName.includes(currentSearchQuery.toLowerCase()));

      if (matchesCategory && matchesSearch) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    if (showingCountText) {
      showingCountText.textContent = `Showing ${visibleCount} of ${rows.length} documents`;
    }

    if (gridViewContainer && !gridViewContainer.classList.contains('d-none')) {
      renderGridView();
    }
  }

  if (filterPills.length > 0) {
    filterPills.forEach(pill => {
      pill.addEventListener('click', () => {
        filterPills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        currentCategory = pill.getAttribute('data-category') || 'All';

        catRowItems.forEach(item => {
          if (item.getAttribute('data-category') === currentCategory) {
            item.classList.add('active');
          } else {
            item.classList.remove('active');
          }
        });

        applyFilters();
      });
    });
  }

  if (catRowItems.length > 0) {
    catRowItems.forEach(item => {
      item.addEventListener('click', () => {
        const cat = item.getAttribute('data-category');
        const targetPill = Array.from(filterPills).find(p => p.getAttribute('data-category') === cat);
        if (targetPill) targetPill.click();
      });
    });
  }

  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      currentSearchQuery = e.target.value.trim();
      applyFilters();
    });
  }

  // -------------------------------------------------------------------------
  // 2. Star / Unstar Toggle
  // -------------------------------------------------------------------------
  document.addEventListener('click', (e) => {
    const starBtn = e.target.closest('.star-btn');
    if (starBtn) {
      e.preventDefault();
      const icon = starBtn.querySelector('i');
      if (starBtn.classList.contains('starred')) {
        starBtn.classList.remove('starred');
        icon.className = 'bi bi-star';
        starBtn.setAttribute('title', 'Star');
      } else {
        starBtn.classList.add('starred');
        icon.className = 'bi bi-star-fill text-warning';
        starBtn.setAttribute('title', 'Unstar');
      }
    }
  });

  // -------------------------------------------------------------------------
  // 3. Grid View Renderer
  // -------------------------------------------------------------------------
  function renderGridView() {
    if (!gridViewContainer || !tableBody) return;
    gridViewContainer.innerHTML = '';

    const visibleRows = Array.from(tableBody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');

    visibleRows.forEach(row => {
      const name = row.getAttribute('data-name') || 'Document.pdf';
      const category = row.getAttribute('data-category') || 'Identity';
      const cells = row.querySelectorAll('td');
      const date = cells[2] ? cells[2].innerText : 'Recently';
      const size = cells[3] ? cells[3].innerText : '1.2 MB';
      const isStarred = row.querySelector('.star-btn') ? row.querySelector('.star-btn').classList.contains('starred') : false;

      const fileExt = name.split('.').pop().toLowerCase();
      let badgeClass = 'badge-type-pdf';
      let badgeText = 'PDF';

      if (fileExt === 'doc' || fileExt === 'docx') { badgeClass = 'badge-type-doc'; badgeText = 'DOC'; }
      else if (fileExt === 'xls' || fileExt === 'xlsx') { badgeClass = 'badge-type-xls'; badgeText = 'XLS'; }
      else if (fileExt === 'jpg' || fileExt === 'png' || fileExt === 'jpeg') { badgeClass = 'badge-type-jpg'; badgeText = 'JPG'; }

      let catBadgeClass = 'badge-identity';
      if (category === 'Personal') catBadgeClass = 'badge-personal';
      else if (category === 'Education') catBadgeClass = 'badge-education';
      else if (category === 'Certificates') catBadgeClass = 'badge-certificates';

      const card = document.createElement('div');
      card.className = 'grid-doc-card';
      card.innerHTML = `
        <div class="grid-card-top">
          <span class="badge-file-type ${badgeClass}">${badgeText}</span>
          <button class="star-btn ${isStarred ? 'starred' : ''}">
            <i class="bi ${isStarred ? 'bi-star-fill text-warning' : 'bi-star'}"></i>
          </button>
        </div>
        <div class="grid-card-body">
          <div class="grid-doc-name">${name}</div>
          <span class="table-cat-badge ${catBadgeClass}">${category}</span>
        </div>
        <div class="grid-card-footer">
          <span>${date}</span>
          <strong>${size}</strong>
        </div>
      `;
      gridViewContainer.appendChild(card);
    });
  }

  if (listViewBtn && gridViewBtn) {
    listViewBtn.addEventListener('click', () => {
      listViewBtn.classList.add('active');
      gridViewBtn.classList.remove('active');
      if (tableViewContainer) tableViewContainer.classList.remove('d-none');
      if (gridViewContainer) gridViewContainer.classList.add('d-none');
    });

    gridViewBtn.addEventListener('click', () => {
      gridViewBtn.classList.add('active');
      listViewBtn.classList.remove('active');
      if (tableViewContainer) tableViewContainer.classList.add('d-none');
      if (gridViewContainer) gridViewContainer.classList.remove('d-none');
      renderGridView();
    });
  }

  // -------------------------------------------------------------------------
  // 4. Upload Page Interactive Drag & Drop Controller
  // -------------------------------------------------------------------------
  const dropzoneArea = document.getElementById('dropzoneArea');
  const browseFilesBtn = document.getElementById('browseFilesBtn');
  const fileDropInput = document.getElementById('fileDropInput');
  const uploadQueueList = document.getElementById('uploadQueueList');

  if (browseFilesBtn && fileDropInput) {
    browseFilesBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      fileDropInput.click();
    });

    if (dropzoneArea) {
      dropzoneArea.addEventListener('click', () => {
        fileDropInput.click();
      });

      ['dragenter', 'dragover'].forEach(eventName => {
        dropzoneArea.addEventListener(eventName, (e) => {
          e.preventDefault();
          e.stopPropagation();
          dropzoneArea.classList.add('dragover');
        }, false);
      });

      ['dragleave', 'drop'].forEach(eventName => {
        dropzoneArea.addEventListener(eventName, (e) => {
          e.preventDefault();
          e.stopPropagation();
          dropzoneArea.classList.remove('dragover');
        }, false);
      });

      dropzoneArea.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFilesUpload(files);
      });
    }

    fileDropInput.addEventListener('change', (e) => {
      handleFilesUpload(e.target.files);
    });
  }

  function handleFilesUpload(files) {
    if (!files || files.length === 0 || !uploadQueueList) return;

    Array.from(files).forEach(file => {
      const ext = file.name.split('.').pop().toLowerCase();
      let badgeClass = 'badge-type-pdf';
      let badgeText = ext.toUpperCase().substring(0, 3);
      if (['doc', 'docx'].includes(ext)) badgeClass = 'badge-type-doc';
      else if (['xls', 'xlsx'].includes(ext)) badgeClass = 'badge-type-xls';
      else if (['jpg', 'png', 'jpeg'].includes(ext)) badgeClass = 'badge-type-jpg';

      const queueItem = document.createElement('div');
      queueItem.className = 'queue-item';
      queueItem.innerHTML = `
        <div class="d-flex align-items-center justify-content-between mb-1">
          <div class="file-name-wrap d-flex align-items-center gap-2">
            <span class="badge-file-type ${badgeClass}">${badgeText}</span>
            <span class="file-title-text">${file.name}</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <span class="progress-percent">0%</span>
            <span class="status-pill status-uploading">Uploading</span>
          </div>
        </div>
        <div class="progress queue-progress-bar">
          <div class="progress-bar bg-blue-progress" role="progressbar" style="width: 0%"></div>
        </div>
      `;

      uploadQueueList.prepend(queueItem);

      // Simulate upload progress animation
      let progress = 0;
      const interval = setInterval(() => {
        progress += Math.floor(Math.random() * 25) + 15;
        if (progress >= 100) {
          progress = 100;
          clearInterval(interval);
          queueItem.querySelector('.progress-percent').textContent = '100%';
          const statusPill = queueItem.querySelector('.status-pill');
          statusPill.textContent = 'Done';
          statusPill.className = 'status-pill status-done';
          queueItem.querySelector('.progress-bar').style.width = '100%';
          queueItem.querySelector('.progress-bar').className = 'progress-bar bg-emerald-progress';
        } else {
          queueItem.querySelector('.progress-percent').textContent = progress + '%';
          queueItem.querySelector('.progress-bar').style.width = progress + '%';
        }
      }, 300);
    });
  }

  // -------------------------------------------------------------------------
  // 5. Important Page Category Filter
  // -------------------------------------------------------------------------
  const impPills = document.querySelectorAll('#importantPillsGroup .filter-pill');
  const impTableBody = document.getElementById('importantTableBody');

  if (impPills.length > 0 && impTableBody) {
    impPills.forEach(pill => {
      pill.addEventListener('click', () => {
        impPills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        const cat = pill.getAttribute('data-category');
        const rows = impTableBody.querySelectorAll('tr');

        rows.forEach(r => {
          const rowCat = r.getAttribute('data-category') || '';
          if (cat === 'All' || rowCat.toLowerCase() === cat.toLowerCase()) {
            r.style.display = '';
          } else {
            r.style.display = 'none';
          }
        });
      });
    });
  }

});
