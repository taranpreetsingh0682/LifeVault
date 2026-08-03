/**
 * LifeVault - Interactive UI Controller (vault.js)
 */

document.addEventListener('DOMContentLoaded', () => {

  // Elements
  const filterPills = document.querySelectorAll('.filter-pill');
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

  // -------------------------------------------------------------------------
  // 1. Category Filtering
  // -------------------------------------------------------------------------
  function applyFilters() {
    const rows = tableBody.querySelectorAll('tr');
    let visibleCount = 0;
    const totalCount = rows.length;

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

    // Update count text
    if (showingCountText) {
      showingCountText.textContent = `Showing ${visibleCount} of 120 documents`;
    }

    // Refresh grid view if active
    if (gridViewContainer && !gridViewContainer.classList.contains('d-none')) {
      renderGridView();
    }
  }

  // Filter Pill Clicks
  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.remove('active'));
      pill.classList.add('active');

      currentCategory = pill.getAttribute('data-category') || 'All';
      
      // Highlight matching side category item
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

  // Left Side Category Cards Click
  catRowItems.forEach(item => {
    item.addEventListener('click', () => {
      const cat = item.getAttribute('data-category');
      const targetPill = Array.from(filterPills).find(p => p.getAttribute('data-category') === cat);
      if (targetPill) {
        targetPill.click();
      }
    });
  });

  // Search Input Event
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
        icon.className = 'bi bi-star-fill';
        starBtn.setAttribute('title', 'Unstar');
      }
    }
  });

  // -------------------------------------------------------------------------
  // 3. View Switcher (List View vs Grid View)
  // -------------------------------------------------------------------------
  function renderGridView() {
    if (!gridViewContainer) return;
    gridViewContainer.innerHTML = '';

    const visibleRows = Array.from(tableBody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');

    visibleRows.forEach(row => {
      const name = row.getAttribute('data-name');
      const category = row.getAttribute('data-category');
      const cells = row.querySelectorAll('td');
      const date = cells[2] ? cells[2].innerText : '';
      const size = cells[3] ? cells[3].innerText : '';
      const isStarred = row.querySelector('.star-btn').classList.contains('starred');

      // Determine badge type
      const fileExt = name.split('.').pop().toLowerCase();
      let badgeClass = 'file-badge-pdf';
      let badgeText = 'PDF';

      if (fileExt === 'doc' || fileExt === 'docx') { badgeClass = 'file-badge-doc'; badgeText = 'DOC'; }
      else if (fileExt === 'xls' || fileExt === 'xlsx') { badgeClass = 'file-badge-xls'; badgeText = 'XLS'; }
      else if (fileExt === 'jpg' || fileExt === 'png' || fileExt === 'jpeg') { badgeClass = 'file-badge-jpg'; badgeText = 'JPG'; }

      let catBadgeClass = 'badge-identity';
      if (category === 'Personal') catBadgeClass = 'badge-personal';
      else if (category === 'Education') catBadgeClass = 'badge-education';
      else if (category === 'Certificates') catBadgeClass = 'badge-certificates';
      else if (category === 'Images') catBadgeClass = 'badge-images';
      else if (category === 'Records') catBadgeClass = 'badge-records';

      const card = document.createElement('div');
      card.className = 'grid-doc-card';
      card.innerHTML = `
        <div class="grid-card-top">
          <div class="file-badge-box ${badgeClass}">${badgeText}</div>
          <button class="star-btn ${isStarred ? 'starred' : ''}">
            <i class="bi ${isStarred ? 'bi-star-fill' : 'bi-star'}"></i>
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
      tableViewContainer.classList.remove('d-none');
      gridViewContainer.classList.add('d-none');
    });

    gridViewBtn.addEventListener('click', () => {
      gridViewBtn.classList.add('active');
      listViewBtn.classList.remove('active');
      tableViewContainer.classList.add('d-none');
      gridViewContainer.classList.remove('d-none');
      renderGridView();
    });
  }

  // -------------------------------------------------------------------------
  // 4. Sorting Functionality
  // -------------------------------------------------------------------------
  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      const val = sortSelect.value;
      const rows = Array.from(tableBody.querySelectorAll('tr'));

      rows.sort((a, b) => {
        const nameA = a.getAttribute('data-name').toLowerCase();
        const nameB = b.getAttribute('data-name').toLowerCase();

        if (val === 'name_asc') return nameA.localeCompare(nameB);
        if (val === 'name_desc') return nameB.localeCompare(nameA);
        return 0;
      });

      rows.forEach(r => tableBody.appendChild(r));
      applyFilters();
    });
  }

  // -------------------------------------------------------------------------
  // 5. Upload Modal Form Handler
  // -------------------------------------------------------------------------
  const uploadForm = document.getElementById('uploadForm');
  if (uploadForm) {
    uploadForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Document uploaded successfully!');
      const modalEl = document.getElementById('uploadModal');
      const modal = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();
      uploadForm.reset();
    });
  }

});
