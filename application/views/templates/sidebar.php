<?php $controller = $this->router->fetch_class(); ?>
<!-- Mobile Backdrop Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="appSidebar">
  <div class="sidebar-header-wrapper d-flex align-items-center justify-content-between">
    <div class="sidebar-brand">
      <div class="brand-icon">
        <i class="bi bi-shield-lock-fill"></i>
      </div>
      <span class="brand-name">LifeVault</span>
    </div>
    <button class="sidebar-close-btn d-lg-none" id="mobileSidebarClose" aria-label="Close menu">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <nav class="sidebar-menu">
    <a href="<?= site_url('Dashboard/dashboard'); ?>" class="menu-link <?= ($controller == 'Dashboard') ? 'active' : ''; ?>">
      <i class="bi bi-shield-check"></i>
      <span class="link-text">Dashboard</span>
    </a>

    <a href="<?= site_url('Documents/documents'); ?>" class="menu-link <?= ($controller == 'Documents') ? 'active' : ''; ?>">
      <i class="bi bi-folder-fill"></i>
      <span class="link-text">Documents</span>
      <span class="menu-badge">129</span>
    </a>

    <a href="<?= site_url('Upload/upload'); ?>" class="menu-link <?= ($controller == 'Upload') ? 'active' : ''; ?>">
      <i class="bi bi-cloud-arrow-up-fill"></i>
      <span class="link-text">Uploads</span>
    </a>

    <a href="<?= site_url('Important/important'); ?>" class="menu-link <?= ($controller == 'Important') ? 'active' : ''; ?>">
      <i class="bi bi-star-fill"></i>
      <span class="link-text">Important</span>
      <span class="menu-badge">16</span>
    </a>

    <a href="<?= site_url('Profile/profile'); ?>" class="menu-link <?= ($controller == 'Profile') ? 'active' : ''; ?>">
      <i class="bi bi-person-fill"></i>
      <span class="link-text">Profile</span>
    </a>

    <a href="<?= site_url('Settings/settings'); ?>" class="menu-link <?= ($controller == 'Settings') ? 'active' : ''; ?>">
      <i class="bi bi-gear-fill"></i>
      <span class="link-text">Settings</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="storage-widget">
      <div class="storage-info">
        <span class="storage-title">Storage</span>
        <span class="storage-value">1.8 / 5 GB</span>
      </div>
      <div class="storage-bar-wrapper">
        <div class="storage-bar-fill" style="width: 36%;"></div>
      </div>
      <div class="storage-subtext">3.2 GB available</div>
    </div>

    <a href="<?= site_url('Auth/logout'); ?>" class="logout-link">
      <i class="bi bi-box-arrow-right"></i>
      <span>Logout</span>
    </a>
  </div>
</aside>

<div class="main-wrapper">
  <!-- Top Navigation Bar -->
  <header class="top-navbar">
    <div class="d-flex align-items-center gap-2">
      <button class="mobile-toggle-btn d-lg-none" id="mobileSidebarToggle" type="button" aria-label="Open sidebar">
        <i class="bi bi-list"></i>
      </button>
      <div class="search-container">
        <form class="search-form d-flex align-items-center" onsubmit="return false;">
          <div class="search-input-wrap">
            <i class="bi bi-search search-icon"></i>
            <input type="search" class="form-control search-input" placeholder="Search documents..." aria-label="Search">
          </div>
          <button class="btn btn-search-outline ms-2 d-none d-sm-inline-block" type="submit">Search</button>
        </form>
      </div>
    </div>

    <div class="user-action-group">
      <button class="btn icon-btn bell-btn" type="button" title="Notifications">
        <i class="bi bi-bell"></i>
      </button>

      <a href="<?= site_url('Profile/profile'); ?>" class="user-profile-pill text-decoration-none">
        <div class="avatar-circle">TS</div>
        <div class="user-meta d-none d-sm-block">
          <span class="user-name"><?= $this->session->userdata('name'); ?></span>
          <span class="user-plan">Premium Plan</span>
        </div>
      </a>
    </div>
  </header>