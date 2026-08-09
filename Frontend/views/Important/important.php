<!-- Main Important View Area -->
<main class="documents-container important-page-container">

  <!-- Header Section -->
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

  <!-- Quick Summary Stats Bar -->
  <div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-lg-3">
      <div class="important-stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="imp-stat-icon bg-warning-subtle text-warning">
            <i class="bi bi-star-fill"></i>
          </div>
          <div>
            <span class="imp-stat-label">Starred Files</span>
            <h3 class="imp-stat-val mb-0">16</h3>
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
            <h3 class="imp-stat-val mb-0">6</h3>
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
            <h3 class="imp-stat-val mb-0">100%</h3>
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
            <h3 class="imp-stat-val mb-0">2 hrs ago</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter & View Controls Toolbar -->
  <div class="filter-toolbar">
    <div class="filter-pills-group" id="importantPillsGroup">
      <button class="filter-pill active" data-category="All">All Starred (16)</button>
      <button class="filter-pill" data-category="Identity">Identity (6)</button>
      <button class="filter-pill" data-category="Education">Education (4)</button>
      <button class="filter-pill" data-category="Personal">Personal (3)</button>
      <button class="filter-pill" data-category="Financial">Financial (3)</button>
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

  <!-- Starred Documents Table -->
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
          
          <tr data-category="Identity">
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <div>
                  <strong class="doc-table-name d-block">Aadhaar Card.pdf</strong>
                  <span class="text-muted-sub text-xs">Official National ID Card</span>
                </div>
              </div>
            </td>
            <td><span class="table-cat-badge badge-identity">Identity</span></td>
            <td class="text-muted-sub">Today, 10:30 AM</td>
            <td><strong>456 KB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar item">
                <i class="bi bi-star-fill text-warning"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> Preview</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-share"></i> Share Link</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-star"></i> Remove Star</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr data-category="Identity">
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <div>
                  <strong class="doc-table-name d-block">Passport_Scan_Original.pdf</strong>
                  <span class="text-muted-sub text-xs">Valid until 2030</span>
                </div>
              </div>
            </td>
            <td><span class="table-cat-badge badge-identity">Identity</span></td>
            <td class="text-muted-sub">Yesterday</td>
            <td><strong>1.8 MB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar item">
                <i class="bi bi-star-fill text-warning"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> Preview</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-share"></i> Share Link</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-star"></i> Remove Star</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr data-category="Education">
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-doc">DOC</span>
                <div>
                  <strong class="doc-table-name d-block">BTech_Degree_Certificate.docx</strong>
                  <span class="text-muted-sub text-xs">Graduation Certificate</span>
                </div>
              </div>
            </td>
            <td><span class="table-cat-badge badge-education">Education</span></td>
            <td class="text-muted-sub">12 July 2025</td>
            <td><strong>2.4 MB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar item">
                <i class="bi bi-star-fill text-warning"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> Preview</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-share"></i> Share Link</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-star"></i> Remove Star</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr data-category="Personal">
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-jpg">JPG</span>
                <div>
                  <strong class="doc-table-name d-block">Vehicle_RC_Registration.jpg</strong>
                  <span class="text-muted-sub text-xs">Car Ownership Proof</span>
                </div>
              </div>
            </td>
            <td><span class="table-cat-badge badge-personal">Personal</span></td>
            <td class="text-muted-sub">02 June 2025</td>
            <td><strong>1.1 MB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar item">
                <i class="bi bi-star-fill text-warning"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> Preview</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-share"></i> Share Link</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-star"></i> Remove Star</a></li>
                </ul>
              </div>
            </td>
          </tr>

          <tr data-category="Financial">
            <td>
              <div class="d-flex align-items-center gap-2">
                <span class="badge-file-type badge-type-pdf">PDF</span>
                <div>
                  <strong class="doc-table-name d-block">Income_Tax_Return_2025.pdf</strong>
                  <span class="text-muted-sub text-xs">Financial Year 2024-2025</span>
                </div>
              </div>
            </td>
            <td><span class="table-cat-badge badge-certificates">Financial</span></td>
            <td class="text-muted-sub">15 May 2025</td>
            <td><strong>890 KB</strong></td>
            <td>
              <button class="star-btn starred" type="button" title="Unstar item">
                <i class="bi bi-star-fill text-warning"></i>
              </button>
            </td>
            <td class="text-end">
              <div class="dropdown">
                <button class="action-dots-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-eye"></i> Preview</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-download"></i> Download</a></li>
                  <li><a class="dropdown-content-item" href="#"><i class="bi bi-share"></i> Share Link</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-content-item text-danger" href="#"><i class="bi bi-star"></i> Remove Star</a></li>
                </ul>
              </div>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

</main>
