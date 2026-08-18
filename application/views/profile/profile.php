<!-- Main Profile View Area -->
<main class="documents-container profile-page-container">

  <!-- Header Section -->
  <div class="documents-header mb-4">
    <div class="doc-title-area">
      <h1 class="doc-title">
        Account Profile

      </h1>


      <p class="doc-subtitle">Manage your account information, security options, connected accounts, and storage settings.</p>


    </div>
  </div>

  <!-- Profile Hero Header Banner -->
  <div class="profile-hero-card mb-4">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
      <div class="d-flex align-items-center gap-3">



        <div class="profile-avatar-xl position-relative">



          <div class="avatar-big-circle">TS</div>


          <button class="avatar-edit-btn" title="Change Avatar">


            <i class="bi bi-camera-fill"></i>



          </button>
        </div>
        <div class="profile-meta-hero">
          <div class="d-flex align-items-center gap-2 flex-wrap">

            <h2 class="profile-user-name mb-0">
            <?= $this->session->userdata('name'); ?>
            </h2>


            <span class="badge bg-warning text-dark px-2.5 py-1 fw-bold rounded-pill">
              <i class="bi bi-star-fill me-1"></i> 
              Premium Plan

            </span>
            
          </div>
          <p class="profile-user-email text-muted mb-1">
            <?= $this->session->userdata('email'); ?></p>
          <span class="text-xs text-muted"> Verified Account</span>
        </div>
      </div>
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="button">
          <i class="bi bi-share me-1"></i> Share Profile
        </button>
        <button class="btn btn-dark btn-sm rounded-pill px-3" type="button">
          <i class="bi bi-check2-circle me-1"></i> Save All Changes
        </button>
      </div>
    </div>
  </div>

  <!-- Main Tabs Content -->
  <div class="row g-4">
    
    <!-- Tab Pills Sidebar Column -->
    <div class="col-12 col-lg-3">
      <div class="profile-nav-card shadow-sm">
        <div class="nav flex-column nav-pills custom-profile-pills" id="profileTab" role="tablist">
          
          <button class="nav-link active" id="pills-personal-tab" data-bs-toggle="pill" data-bs-target="#pills-personal" type="button" role="tab">
            <i class="bi bi-person me-2"></i> Personal Details
          </button>

          <button class="nav-link" id="pills-connected-tab" data-bs-toggle="pill" data-bs-target="#pills-connected" type="button" role="tab">
            <i class="bi bi-google me-2 text-danger"></i> Connected Accounts
          </button>

          <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab">
            <i class="bi bi-shield-lock me-2"></i> Security & Password
          </button>

          <button class="nav-link" id="pills-storage-tab" data-bs-toggle="pill" data-bs-target="#pills-storage" type="button" role="tab">
            <i class="bi bi-database me-2"></i> Storage & Plan
          </button>

          <button class="nav-link" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab">
            <i class="bi bi-bell me-2"></i> Notifications
          </button>

        </div>
      </div>
    </div>

    <!-- Tab Content Panes Column -->
    <div class="col-12 col-lg-9">
      <div class="tab-content profile-tab-content shadow-sm p-4 bg-white rounded-4" id="profileTabContent">
        
        <!-- Tab 1: Personal Details -->
        <div class="tab-pane fade show active" id="pills-personal" role="tabpanel">
          <h5 class="fw-bold mb-3 text-dark">Personal Information</h5>
          <p class="text-muted text-sm mb-4">Update your personal details and contact information.</p>
          
          <form method="post" action="<?= site_url('profile/update'); ?>">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">First Name</label>
                <input name="name" type="text" class="form-control profile-input" value="<?= html_escape($user->name); ?>">
              </div>

              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">Email Address</label>
                <input name="email" type="email" class="form-control profile-input" value="<?= html_escape($user->email); ?>">
              </div>

              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">Phone Number</label>
                <input name="phone_number" type="tel" class="form-control profile-input" value="<?= html_escape($user->phone_number); ?>">
              </div>

              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">Date of Birth</label>
                <input type="date" class="form-control profile-input" value="1998-05-18">
              </div>

              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">Location / Country</label>
                <input name="country" type="text" class="form-control profile-input" value="<?= html_escape($user->country); ?>">
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold text-sm">Bio / Remarks</label>
                <textarea class="form-control profile-input" rows="3">Secure vault user since 2024. Storing identity and academic documents safely.</textarea>
              </div>
            </div>

            <div class="mt-4 pt-2 d-flex justify-content-end">
              <button class="btn btn-dark px-4 rounded-3" type="submit">Save Changes</button>
            </div>
          </form>
        </div>

        <!-- Tab 2: Connected Accounts (with Google Account Integration) -->
        <div class="tab-pane fade" id="pills-connected" role="tabpanel">
          <h5 class="fw-bold mb-1 text-dark">Connected Accounts</h5>
          <p class="text-muted text-sm mb-4">Manage third-party social accounts linked to your LifeVault profile for Single Sign-On (SSO) and automated cloud backups.</p>

          <div class="connected-accounts-list d-flex flex-column gap-3">
            
            <!-- Google Account Connection Card -->
            <div class="connected-account-card border rounded-3 p-3.5 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 bg-light-subtle">
              <div class="d-flex align-items-center gap-3">
                <div class="social-icon-box bg-white border shadow-sm rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                  <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.27v3.15C3.25 21.3 7.31 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.27C.46 8.2.0 10.04.0 12s.46 3.8 1.27 5.42l4.01-3.15z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.31 0 3.25 2.7 1.27 6.58l4.01 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                  </svg>
                </div>
                <div>
                  <div class="d-flex align-items-center gap-2">
                    <h6 class="fw-bold mb-0 text-dark">Google Account</h6>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-0.5 text-xs fw-semibold">
                      <i class="bi bi-check-circle-fill me-1"></i> Connected
                    </span>
                  </div>
                  <p class="text-sm text-dark mb-0 font-monospace mt-0.5">taranpreet.singh@gmail.com</p>
                  <span class="text-xs text-muted">Linked on Jan 15, 2024 &bull; SSO & Google Drive Auto Sync Active</span>
                </div>
              </div>
              <div class="d-flex align-items-center gap-2 align-self-end align-self-md-center">
                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" type="button">
                  <i class="bi bi-gear me-1"></i> Permissions
                </button>
                <button class="btn btn-outline-danger btn-sm rounded-pill px-3" type="button" onclick="alert('Google account disconnected.')">
                  Disconnect
                </button>
              </div>
            </div>

            <!-- Microsoft Account Card (Unconnected Example) -->
            <div class="connected-account-card border rounded-3 p-3.5 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
              <div class="d-flex align-items-center gap-3">
                <div class="social-icon-box bg-light border rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                  <i class="bi bi-microsoft text-primary fs-4"></i>
                </div>
                <div>
                  <div class="d-flex align-items-center gap-2">
                    <h6 class="fw-bold mb-0 text-dark">Microsoft Account</h6>
                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2.5 py-0.5 text-xs fw-semibold">
                      Not Connected
                    </span>
                  </div>
                  <p class="text-xs text-muted mb-0 mt-0.5">Sign in with Microsoft 365 or Outlook to enable OneDrive backup.</p>
                </div>
              </div>
              <div class="align-self-end align-self-md-center">
                <button class="btn btn-dark btn-sm rounded-pill px-3" type="button" onclick="alert('Connecting Microsoft Account...')">
                  <i class="bi bi-plus-lg me-1"></i> Connect Account
                </button>
              </div>
            </div>

            <!-- GitHub Account Card (Unconnected Example) -->
            <div class="connected-account-card border rounded-3 p-3.5 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
              <div class="d-flex align-items-center gap-3">
                <div class="social-icon-box bg-dark text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                  <i class="bi bi-github fs-4"></i>
                </div>
                <div>
                  <div class="d-flex align-items-center gap-2">
                    <h6 class="fw-bold mb-0 text-dark">GitHub Account</h6>
                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2.5 py-0.5 text-xs fw-semibold">
                      Not Connected
                    </span>
                  </div>
                  <p class="text-xs text-muted mb-0 mt-0.5">Link GitHub to authenticate developer keys and code vault records.</p>
                </div>
              </div>
              <div class="align-self-end align-self-md-center">
                <button class="btn btn-dark btn-sm rounded-pill px-3" type="button" onclick="alert('Connecting GitHub Account...')">
                  <i class="bi bi-plus-lg me-1"></i> Connect Account
                </button>
              </div>
            </div>

          </div>
        </div>

        <!-- Tab 3: Security & Password -->
        <div class="tab-pane fade" id="pills-security" role="tabpanel">
          <h5 class="fw-bold mb-3 text-dark">Password & Account Security</h5>
          <p class="text-muted text-sm mb-4">Ensure your account is using a strong password and multi-factor protection.</p>
          
          <form method="post" action="<?= site_url('profile/changePassword'); ?>" class="mb-4">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-semibold text-sm">Current Password</label>
                <input name="current_password" type="password" required class="form-control profile-input" placeholder="••••••••••••">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">New Password</label>
                <input name="new_password" type="password" required minlength="6" class="form-control profile-input" placeholder="New password">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label fw-semibold text-sm">Confirm New Password</label>
                <input name="confirm_password" type="password" required minlength="6" class="form-control profile-input" placeholder="Confirm password">
              </div>
            </div>

            <div class="mt-3">
              <button class="btn btn-dark px-4 rounded-3" type="submit">Update Password</button>
            </div>
          </form>

          <hr class="my-4">

          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="fw-bold mb-1">Two-Factor Authentication (2FA)</h6>
              <p class="text-muted text-xs mb-0">Add an extra layer of security using an authenticator app.</p>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input custom-switch" type="checkbox" id="flexSwitchCheckChecked" checked>
            </div>
          </div>
        </div>

        <!-- Tab 4: Storage & Plan -->
        <div class="tab-pane fade" id="pills-storage" role="tabpanel">
          <h5 class="fw-bold mb-3 text-dark">Storage Usage & Subscription Plan</h5>
          <p class="text-muted text-sm mb-4">Monitor your vault storage quota and subscription status.</p>

          <div class="storage-box p-4 border rounded-3 mb-4 bg-light">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="fw-bold">Vault Storage Occupied</span>
              <span class="fw-bold text-primary">1.8 GB of 5 GB (36%)</span>
            </div>
            <div class="progress mb-3" style="height: 10px;">
              <div class="progress-bar bg-primary" style="width: 36%"></div>
            </div>
            <div class="row text-center g-2 text-xs text-muted">
              <div class="col-4">Identity: 800 MB</div>
              <div class="col-4">Education: 600 MB</div>
              <div class="col-4">Free: 3.2 GB</div>
            </div>
          </div>

          <div class="d-flex align-items-center justify-content-between border p-3 rounded-3">
            <div>
              <h6 class="fw-bold mb-1">Current Tier: Premium Gold</h6>
              <p class="text-muted text-xs mb-0">Renews on Jan 15, 2027 &bull; Unlimited Bandwidth</p>
            </div>
            <button class="btn btn-warning fw-semibold btn-sm rounded-pill px-3">Upgrade Plan</button>
          </div>
        </div>

        <!-- Tab 5: Notifications -->
        <div class="tab-pane fade" id="pills-notifications" role="tabpanel">
          <h5 class="fw-bold mb-3 text-dark">Notification Preferences</h5>
          <p class="text-muted text-sm mb-4">Choose how you want to be notified about vault activity.</p>

          <div class="d-flex flex-column gap-3">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
              <div>
                <h6 class="fw-bold mb-1">File Upload Confirmations</h6>
                <p class="text-muted text-xs mb-0">Receive email alerts whenever a new document is uploaded.</p>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox" checked>
              </div>
            </div>

            <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
              <div>
                <h6 class="fw-bold mb-1">Security & Login Alerts</h6>
                <p class="text-muted text-xs mb-0">Notify me of new logins from unknown devices.</p>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox" checked>
              </div>
            </div>

            <div class="d-flex align-items-center justify-content-between pb-2">
              <div>
                <h6 class="fw-bold mb-1">Storage Usage Warnings</h6>
                <p class="text-muted text-xs mb-0">Alert me when vault storage reaches 80% capacity.</p>
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input custom-switch" type="checkbox" checked>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

</main>
