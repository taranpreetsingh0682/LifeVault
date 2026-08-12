<main class="dashboard-content">
  <!-- Greeting Header Banner -->
  <div class="welcome-header d-flex align-items-center justify-content-between mb-4">
    <div class="greeting-text">


      <h1 class="greeting-title">Welcome back, <?= $this->session->userdata('name'); ?>👋


      </h1>


      <p class="greeting-subtitle mb-0">Manage and secure your documents in one place


      </p>


    </div>
    <div class="header-action">
      <button class="btn btn-upload-dark d-flex align-items-center gap-2">
        <i class="bi bi-upload"></i>
        <span>Upload file</span>


      </button>
    </div>
  </div>

  <!-- Top Stat Cards Row -->
  <div class="row g-3 mb-4 stat-cards-row">
    <!-- Stat 1: Total Documents -->
    <div class="col">
      <div class="stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="stat-icon-box icon-purple">
            <i class="bi bi-file-earmark-text"></i>
          </div>
          <div class="stat-details">
            <span class="stat-label"> Total Documents</span>
            <h2 class="stat-value"><?= $total_documents; ?></h2>
          </div>
        </div>
        <div class="stat-footer mt-2">
          <span class="text-success-growth">+12 this week</span>
        </div>
      </div>
    </div>

    <!-- Stat 2: Storage Used -->
    <div class="col">
      <div class="stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="stat-icon-box icon-green">
            <i class="bi bi-database"></i>
          </div>
          <div class="stat-details">
            <span class="stat-label">Storage Used</span>
            <h2 class="stat-value"><?= $storage_used; ?></h2>
          </div>
        </div>
        <div class="stat-footer mt-2">
          <span class="text-muted-sub">of 5 GB</span>
        </div>
      </div>
    </div>

    <!-- Stat 3: Important -->
    <div class="col">
      <div class="stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="stat-icon-box icon-yellow">
            <i class="bi bi-star"></i>
          </div>
          <div class="stat-details">
            <span class="stat-label">Important</span>
            <h2 class="stat-value"><?= $important_documents; ?></h2>
          </div>
        </div>
        <div class="stat-footer mt-2">
          <a href="<?= site_url('Important/important'); ?>" class="stat-link">View all &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Stat 4: Shared Files -->
    <div class="col">
      <div class="stat-card">
        <div class="d-flex align-items-center gap-3">
          <div class="stat-icon-box icon-pink">
            <i class="bi bi-share"></i>
          </div>
          <div class="stat-details">
            <span class="stat-label">Shared Files</span>
            <h2 class="stat-value"><?= $shared_documents; ?></h2>
          </div>
        </div>
        <div class="stat-footer mt-2">
          <a href="#" class="stat-link">View all &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Stat 5: Storage Usage -->
    <div class="col-lg-3">
      <div class="stat-card storage-card">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="stat-card-title">Storage Usage</span>
          <a href="#" class="stat-link text-sm">View Details</a>
        </div>
        <div class="storage-usage-meta mb-2">
          <strong><?= $storage_used; ?></strong> <span class="text-muted">of 5 GB Used</span>
        </div>
        <div class="progress storage-progress-bar mb-2">
          <div class="progress-bar gradient-bar" role="progressbar" style="width: 36%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="d-flex align-items-center justify-content-between storage-sub-meta">
          <span>3.2 GB Available</span>
          <span class="fw-bold">36%</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Middle Grid: Recent Documents | Quick Access | Categories -->
  <div class="row g-3 mb-4">
    <!-- Recent Documents Table -->
    <div class="col-lg-6">
      <div class="dashboard-panel card-panel">
        <div class="panel-header d-flex align-items-center justify-content-between mb-3">
          <h5 class="panel-title">Recent Documents</h5>
          <a href="<?= site_url('Documents/documents'); ?>" class="panel-link">View all &rarr;</a>
        </div>

        <div class="table-responsive">
          <table class="table align-middle doc-table mb-0">
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
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="doc-file-icon pdf">PDF</div>
                    <span class="doc-name">Pdf</span>
                  </div>
                </td>
                <td><span class="category-badge badge-identity">Identity</span></td>
                <td class="text-muted text-sm">Yesterday, 09:15 PM</td>
                <td class="text-muted text-sm">240 KB</td>
                <td><i class="bi bi-star-fill text-warning"></i></td>
                <td><i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i></td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="doc-file-icon doc">DOC</div>
                    <span class="doc-name">Resume.pdf</span>
                  </div>
                </td>
                <td><span class="category-badge badge-personal">Personal</span></td>
                <td class="text-muted text-sm">05 July 2025</td>
                <td class="text-muted text-sm">1.2 MB</td>
                <td><i class="bi bi-star text-muted"></i></td>
                <td><i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i></td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="doc-file-icon pdf">PDF</div>
                    <span class="doc-name">Aadhaar Card.pdf</span>
                  </div>
                </td>
                <td><span class="category-badge badge-identity">Identity</span></td>
                <td class="text-muted text-sm">Today, 10:30 AM</td>
                <td class="text-muted text-sm">456 KB</td>
                <td><i class="bi bi-star-fill text-warning"></i></td>
                <td><i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i></td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="doc-file-icon xls">XLS</div>
                    <span class="doc-name">10th Marksheet.xls</span>
                  </div>
                </td>
                <td><span class="category-badge badge-education">Education</span></td>
                <td class="text-muted text-sm">04 July 2025</td>
                <td class="text-muted text-sm">512 KB</td>
                <td><i class="bi bi-star text-muted"></i></td>
                <td><i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i></td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="doc-file-icon pdf">PDF</div>
                    <span class="doc-name">Passport.pdf</span>
                  </div>
                </td>
                <td><span class="category-badge badge-identity">Identity</span></td>
                <td class="text-muted text-sm">01 June 2025</td>
                <td class="text-muted text-sm">600 KB</td>
                <td><i class="bi bi-star-fill text-warning"></i></td>
                <td><i class="bi bi-three-dots-vertical text-muted cursor-pointer"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Quick Access Grid -->
    <div class="col-lg-3">
      <div class="dashboard-panel card-panel">
        <div class="panel-header mb-3">
          <h5 class="panel-title">Quick Access</h5>
        </div>

        <div class="quick-access-grid">
          <a href="<?= site_url('Upload/upload'); ?>" class="quick-tile tile-blue">
            <div class="tile-icon">
              <i class="bi bi-upload"></i>
            </div>
            <span class="tile-label">Upload Documents</span>
          </a>

          <a href="<?= site_url('Documents/documents'); ?>" class="quick-tile tile-green">
            <div class="tile-icon">
              <i class="bi bi-folder2-open"></i>
            </div>
            <span class="tile-label">My Documents</span>
          </a>

          <a href="#" class="quick-tile tile-purple">
            <div class="tile-icon">
              <i class="bi bi-share"></i>
            </div>
            <span class="tile-label">Share Document</span>
          </a>

          <a href="<?= site_url('Important/important'); ?>" class="quick-tile tile-yellow">
            <div class="tile-icon">
              <i class="bi bi-star"></i>
            </div>
            <span class="tile-label">View Favorites</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Categories Stack -->
    <div class="col-lg-3">
      <div class="dashboard-panel card-panel">
        <div class="panel-header mb-3">
          <h5 class="panel-title">Categories</h5>
        </div>

        <div class="categories-list d-flex flex-column gap-2">
          <div class="cat-item">
            <div class="cat-icon-box bg-cat-blue">
              <i class="bi bi-file-earmark-person"></i>
            </div>
            <div class="cat-meta">
              <h6 class="cat-name">Identity</h6>
              <span class="cat-count">30 files</span>
            </div>
          </div>

          <div class="cat-item">
            <div class="cat-icon-box bg-cat-orange">
              <i class="bi bi-mortarboard"></i>
            </div>
            <div class="cat-meta">
              <h6 class="cat-name">Education</h6>
              <span class="cat-count">28 files</span>
            </div>
          </div>

          <div class="cat-item">
            <div class="cat-icon-box bg-cat-teal">
              <i class="bi bi-award"></i>
            </div>
            <div class="cat-meta">
              <h6 class="cat-name">Certificates</h6>
              <span class="cat-count">22 files</span>
            </div>
          </div>

          <div class="cat-item">
            <div class="cat-icon-box bg-cat-pink">
              <i class="bi bi-image"></i>
            </div>
            <div class="cat-meta">
              <h6 class="cat-name">Images</h6>
              <span class="cat-count">12 files</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bottom Grid: Documents by Category & Recent Activity -->
  <div class="row g-3">
    <!-- Documents by Category (Chart) -->
    <div class="col-lg-6">
      <div class="dashboard-panel card-panel">
        <div class="panel-header d-flex align-items-center justify-content-between mb-3">
          <h5 class="panel-title">Documents by Category</h5>
          <a href="#" class="panel-link">Manage &rarr;</a>
        </div>

        <div class="chart-content d-flex align-items-center justify-content-around py-3">
          <!-- Donut Graphic -->
          <div class="donut-chart-container">
            <svg viewBox="0 0 36 36" class="donut-svg">
              <!-- Background Ring -->
              <path class="donut-ring" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f1f5f9" stroke-width="3.8"/>
              <!-- Identity Segment (Blue ~33%) -->
              <path class="donut-segment segment-blue" stroke-dasharray="33, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#3b82f6" stroke-width="3.8"/>
              <!-- Education Segment (Teal ~28%) -->
              <path class="donut-segment segment-teal" stroke-dasharray="28, 100" stroke-dashoffset="-33" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#10b981" stroke-width="3.8"/>
              <!-- Certificates Segment (Orange ~22%) -->
              <path class="donut-segment segment-orange" stroke-dasharray="22, 100" stroke-dashoffset="-61" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#f59e0b" stroke-width="3.8"/>
              <!-- Images Segment (Red ~17%) -->
              <path class="donut-segment segment-red" stroke-dasharray="17, 100" stroke-dashoffset="-83" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831" fill="none" stroke="#ef4444" stroke-width="3.8"/>
            </svg>
            <div class="donut-inner-text">
              <span class="donut-number">120</span>
              <span class="donut-label">files</span>
            </div>
          </div>

          <!-- Legend -->
          <div class="donut-legend d-flex flex-column gap-2">
            <div class="legend-item d-flex align-items-center justify-content-between gap-4">
              <div class="d-flex align-items-center gap-2">
                <span class="legend-dot bg-blue"></span>
                <span class="legend-name">Identity</span>
              </div>
              <span class="legend-val">30</span>
            </div>

            <div class="legend-item d-flex align-items-center justify-content-between gap-4">
              <div class="d-flex align-items-center gap-2">
                <span class="legend-dot bg-teal"></span>
                <span class="legend-name">Education</span>
              </div>
              <span class="legend-val">28</span>
            </div>

            <div class="legend-item d-flex align-items-center justify-content-between gap-4">
              <div class="d-flex align-items-center gap-2">
                <span class="legend-dot bg-orange"></span>
                <span class="legend-name">Certificates</span>
              </div>
              <span class="legend-val">22</span>
            </div>

            <div class="legend-item d-flex align-items-center justify-content-between gap-4">
              <div class="d-flex align-items-center gap-2">
                <span class="legend-dot bg-red"></span>
                <span class="legend-name">Images</span>
              </div>
              <span class="legend-val">12</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="col-lg-6">
      <div class="dashboard-panel card-panel">
        <div class="panel-header mb-3">
          <h5 class="panel-title">Recent Activity</h5>
        </div>

        <div class="activity-timeline d-flex flex-column gap-3">
          <div class="activity-item d-flex align-items-center gap-3">
            <div class="activity-icon-circle icon-circle-blue">
              <i class="bi bi-upload"></i>
            </div>
            <div class="activity-content">
              <p class="activity-text mb-0">You uploaded <strong>Aadhaar Card.pdf</strong></p>
              <span class="activity-time">2 hours ago</span>
            </div>
          </div>

          <div class="activity-item d-flex align-items-center gap-3">
            <div class="activity-icon-circle icon-circle-purple">
              <i class="bi bi-share"></i>
            </div>
            <div class="activity-content">
              <p class="activity-text mb-0">You shared <strong>Resume.pdf</strong> with HR Team</p>
              <span class="activity-time">5 hours ago</span>
            </div>
          </div>

          <div class="activity-item d-flex align-items-center gap-3">
            <div class="activity-icon-circle icon-circle-yellow">
              <i class="bi bi-star"></i>
            </div>
            <div class="activity-content">
              <p class="activity-text mb-0">You marked <strong>PAN Card.pdf</strong> as important</p>
              <span class="activity-time">Yesterday</span>
            </div>
          </div>

          <div class="activity-item d-flex align-items-center gap-3">
            <div class="activity-icon-circle icon-circle-green">
              <i class="bi bi-check-lg"></i>
            </div>
            <div class="activity-content">
              <p class="activity-text mb-0">Backup completed for all files</p>
              <span class="activity-time">2 days ago</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
