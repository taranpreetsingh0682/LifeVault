<!-- Main Documents View Area -->
<main class="documents-container">

  <!-- Header Section: Title & Primary Action -->
  <div class="documents-header">
    <div class="doc-title-area">
      <h1 class="doc-title">Documents</h1>
      <p class="doc-subtitle">All your files, organized, searchable and secure.</p>
    </div>
    <div class="doc-action-area">
      <button class="btn-upload-file" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="bi bi-upload"></i>
        <span>Upload file</span>
      </button>
    </div>
  </div>

  <!-- Filter Pills & View Controls Toolbar -->
  <div class="filter-toolbar">
    <div class="filter-pills-group" id="categoryPillsGroup">
      <button class="filter-pill active" data-category="All">All</button>
      <button class="filter-pill" data-category="Identity">Identity</button>
      <button class="filter-pill" data-category="Personal">Personal</button>
      <button class="filter-pill" data-category="Education">Education</button>
      <button class="filter-pill" data-category="Certificates">Certificates</button>
      <button class="filter-pill" data-category="Images">Images</button>
      <button class="filter-pill" data-category="Records">Records</button>
    </div>

    <div class="controls-group">
      <div class="sort-dropdown-wrap">
        <select class="sort-select" id="sortSelect">
          <option value="newest">Newest first</option>
          <option value="oldest">Oldest first</option>
          <option value="name_asc">Name (A-Z)</option>
          <option value="name_desc">Name (Z-A)</option>
          <option value="size_desc">Largest size</option>
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

  <!-- Content Layout: Left Sidebar Cards & Right Main Table Panel -->
  <div class="row g-4">
    
    <!-- Left Column: Categories List & Storage Card -->
    <div class="col-lg-3">
      
      <!-- Categories Card -->
      <div class="side-categories-card">
        <h5 class="side-card-title">Categories</h5>
        <div class="categories-vertical-list">
          
          <div class="cat-row-item" data-category="Identity">
            <div class="cat-icon-badge cat-icon-identity">
              <i class="bi bi-person-vcard"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Identity</h6>
              <span class="cat-row-count">30 files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="Personal">
            <div class="cat-icon-badge cat-icon-personal">
              <i class="bi bi-person"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Personal</h6>
              <span class="cat-row-count">18 files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="Education">
            <div class="cat-icon-badge cat-icon-education">
              <i class="bi bi-mortarboard"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Education</h6>
              <span class="cat-row-count">28 files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="Certificates">
            <div class="cat-icon-badge cat-icon-certificates">
              <i class="bi bi-award"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Certificates</h6>
              <span class="cat-row-count">22 files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="Images">
            <div class="cat-icon-badge cat-icon-images">
              <i class="bi bi-image"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Images</h6>
              <span class="cat-row-count">12 files</span>
            </div>
          </div>

          <div class="cat-row-item" data-category="Records">
            <div class="cat-icon-badge cat-icon-records">
              <i class="bi bi-folder2"></i>
            </div>
            <div class="cat-row-meta">
              <h6 class="cat-row-name">Records</h6>
              <span class="cat-row-count">10 files</span>
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
        <div class="side-storage-meta">
          <strong>1.8 GB</strong> of 5 GB Used
        </div>
        <div class="side-storage-bar-wrap">
          <div class="side-storage-bar-fill" style="width: 36%;"></div>
        </div>
        <div class="side-storage-footer">
          <span>3.2 GB Available</span>
          <strong>36%</strong>
        </div>
      </div>

    </div>

    <!-- Right Column: Main Documents Panel -->
    <div class="col-lg-9">
      <div class="main-documents-card">
        
        <!-- Table View Container -->
        <div class="documents-table-wrap" id="documentsTableView">
          <table class="table-documents">
            <thead>
              <tr>
                <th>DOCUMENT NAME</th>
                <th>CATEGORY</th>
                <th>UPDATED ON</th>
                <th>SIZE</th>
                <th class="text-center">STARRED</th>
                <th class="text-center">ACTIONS</th>
              </tr>
            </thead>
            <tbody id="documentsTableBody">
              
              <!-- Row 1 -->
              <tr data-category="Identity" data-name="PAN Card.pdf" data-starred="true">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">PAN Card.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-identity">Identity</span></td>
                <td>Yesterday, 09:15 PM</td>
                <td>240 KB</td>
                <td class="text-center">
                  <button class="star-btn starred" title="Unstar">
                    <i class="bi bi-star-fill"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 2 -->
              <tr data-category="Personal" data-name="Resume.pdf" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-doc">DOC</div>
                    <span class="file-name-text">Resume.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-personal">Personal</span></td>
                <td>05 July 2025</td>
                <td>1.2 MB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 3 -->
              <tr data-category="Identity" data-name="Aadhaar Card.pdf" data-starred="true">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Aadhaar Card.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-identity">Identity</span></td>
                <td>Today, 10:30 AM</td>
                <td>456 KB</td>
                <td class="text-center">
                  <button class="star-btn starred" title="Unstar">
                    <i class="bi bi-star-fill"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 4 (Highlighted in Screenshot) -->
              <tr class="highlight-row" data-category="Education" data-name="10th Marksheet.xls" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-xls">XLS</div>
                    <span class="file-name-text">10th Marksheet.xls</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-education">Education</span></td>
                <td>04 July 2025</td>
                <td>512 KB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 5 -->
              <tr data-category="Identity" data-name="Passport.pdf" data-starred="true">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Passport.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-identity">Identity</span></td>
                <td>01 June 2025</td>
                <td>600 KB</td>
                <td class="text-center">
                  <button class="star-btn starred" title="Unstar">
                    <i class="bi bi-star-fill"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 6 -->
              <tr data-category="Identity" data-name="Driving Licence.pdf" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Driving Licence.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-identity">Identity</span></td>
                <td>28 May 2025</td>
                <td>310 KB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 7 -->
              <tr data-category="Education" data-name="B.Tech Degree.pdf" data-starred="true">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">B.Tech Degree.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-education">Education</span></td>
                <td>20 May 2025</td>
                <td>890 KB</td>
                <td class="text-center">
                  <button class="star-btn starred" title="Unstar">
                    <i class="bi bi-star-fill"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 8 -->
              <tr data-category="Certificates" data-name="Vaccination Certificate.pdf" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Vaccination Certificate.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-certificates">Certificates</span></td>
                <td>12 May 2025</td>
                <td>220 KB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 9 -->
              <tr data-category="Images" data-name="Family Photo.jpg" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-jpg">JPG</div>
                    <span class="file-name-text">Family Photo.jpg</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-images">Images</span></td>
                <td>02 May 2025</td>
                <td>3.4 MB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 10 -->
              <tr data-category="Records" data-name="Rent Agreement.docx" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-doc">DOC</div>
                    <span class="file-name-text">Rent Agreement.docx</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-records">Records</span></td>
                <td>28 Apr 2025</td>
                <td>540 KB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 11 -->
              <tr data-category="Personal" data-name="Bank Statement.pdf" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Bank Statement.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-personal">Personal</span></td>
                <td>20 Apr 2025</td>
                <td>1.1 MB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

              <!-- Row 12 -->
              <tr data-category="Records" data-name="Insurance Policy.pdf" data-starred="false">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="file-badge-box file-badge-pdf">PDF</div>
                    <span class="file-name-text">Insurance Policy.pdf</span>
                  </div>
                </td>
                <td><span class="table-cat-badge badge-records">Records</span></td>
                <td>15 Apr 2025</td>
                <td>760 KB</td>
                <td class="text-center">
                  <button class="star-btn" title="Star">
                    <i class="bi bi-star"></i>
                  </button>
                </td>
                <td class="text-center">
                  <button class="action-menu-btn" title="More options"><i class="bi bi-three-dots-vertical"></i></button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <!-- Grid View Container (Initially Hidden) -->
        <div class="documents-grid-view d-none" id="documentsGridView">
          <!-- Dynamically populated via JS when switching to grid view -->
        </div>

        <!-- Footer / Pagination Controls -->
        <div class="table-footer-bar">
          <span class="footer-showing-text" id="showingCountText">Showing 12 of 120 documents</span>
          <div class="pagination-group">
            <button class="page-btn" id="prevPageBtn">Prev</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn" id="nextPageBtn">Next</button>
          </div>
        </div>

      </div>
    </div>

  </div>

</main>

<!-- Upload Document Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg style-modal">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="uploadModalLabel">Upload New Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="uploadForm">
          <div class="mb-3">
            <label class="form-label fw-semibold text-secondary">Document Title</label>
            <input type="text" class="form-control" placeholder="e.g. Passport_Copy.pdf" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold text-secondary">Category</label>
            <select class="form-select" required>
              <option value="">Select Category</option>
              <option value="Identity">Identity</option>
              <option value="Personal">Personal</option>
              <option value="Education">Education</option>
              <option value="Certificates">Certificates</option>
              <option value="Images">Images</option>
              <option value="Records">Records</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label fw-semibold text-secondary">File Attachment</label>
            <input type="file" class="form-control" required>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark rounded-3 px-4">Upload Document</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>