<?php
// Current controller is used to highlight the active sidebar item.
$controller = $this->router->fetch_class();

// Sidebar statistics come from the controller that loaded the page.
// When a page does not provide them, we calculate them here from the model.
$user_id = $this->session->userdata('user_id');

if ($user_id) {
    $this->load->model('Document_model');

    $sidebar_total_documents = $this->Document_model->get_total_documents($user_id);
    $sidebar_important_documents = $this->Document_model->get_important_documents($user_id);
    $sidebar_storage_used = (float) $this->Document_model->get_storage_used($user_id);
} else {
    $sidebar_total_documents = 0;
    $sidebar_important_documents = 0;
    $sidebar_storage_used = 0;
}

// LifeVault currently uses a 5 GB storage limit.
$sidebar_storage_limit = 5 * 1024 * 1024 * 1024;
$sidebar_storage_percent = $sidebar_storage_limit > 0
    ? min(100, round(($sidebar_storage_used / $sidebar_storage_limit) * 100, 1))
    : 0;

$sidebar_used_gb = round($sidebar_storage_used / 1073741824, 2);
$sidebar_available_gb = round(
    max(0, $sidebar_storage_limit - $sidebar_storage_used) / 1073741824,
    2
);

// Logged-in user's name is used to build the navbar initials.
$user_name = trim((string) $this->session->userdata('name'));
$user_initials = '';

if ($user_name !== '') {
    $name_parts = preg_split('/\s+/', $user_name);
    $user_initials = strtoupper(substr($name_parts[0], 0, 1));

    if (count($name_parts) > 1) {
        $last_name = end($name_parts);
        $user_initials .= strtoupper(substr($last_name, 0, 1));
    }
}

$user_initials = $user_initials ?: 'LV';
?>

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

    <a href="<?= site_url('Documents'); ?>" class="menu-link <?= ($controller == 'Documents') ? 'active' : ''; ?>">
      <i class="bi bi-folder-fill"></i>
      <span class="link-text">Documents</span>
      <span class="menu-badge"><?= $sidebar_total_documents; ?></span>
    </a>

    <a href="<?= site_url('Upload/upload'); ?>" class="menu-link <?= ($controller == 'Upload') ? 'active' : ''; ?>">
      <i class="bi bi-cloud-arrow-up-fill"></i>
      <span class="link-text">Uploads</span>
    </a>

    <a href="<?= site_url('Important/important'); ?>" class="menu-link <?= ($controller == 'Important') ? 'active' : ''; ?>">
      <i class="bi bi-star-fill"></i>
      <span class="link-text">Important</span>
      <span class="menu-badge"><?= $sidebar_important_documents; ?></span>
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
        <span class="storage-value"><?= $sidebar_used_gb; ?> / 5 GB</span>
      </div>

      <div class="storage-bar-wrapper">
        <div class="storage-bar-fill" style="width: <?= $sidebar_storage_percent; ?>%;"></div>
      </div>

      <div class="storage-subtext"><?= $sidebar_available_gb; ?> GB available</div>
    </div>

    <a href="<?= site_url('auth/logout'); ?>" class="logout-link">
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
        <form class="search-form d-flex align-items-center" action="<?= site_url('Documents'); ?>" method="get">
          <div class="search-input-wrap">
            <i class="bi bi-search search-icon"></i>
            <input
              type="search"
              name="search"
              class="form-control search-input"
              value="<?= html_escape($this->input->get('search')); ?>"
              placeholder="Search documents..."
              aria-label="Search documents"
            >
          </div>
          <button class="btn btn-search-outline ms-2 d-none d-sm-inline-block" type="submit">Search</button>
        </form>
      </div>
    </div>

    <div class="user-action-group">
      <!-- Notification button. Recent uploads become real notifications. -->
      <div class="notification-wrapper">
        <button class="btn icon-btn bell-btn" id="notificationBell" type="button" title="Notifications" aria-label="Notifications">
          <i class="bi bi-bell"></i>
          <?php
          $notification_count = 0;
          if ($user_id) {
              $notification_count = $this->Document_model->get_recent_notification_count($user_id);
          }
          ?>
          <?php if ($notification_count > 0): ?>
            <span class="notification-badge"><?= $notification_count > 9 ? '9+' : $notification_count; ?></span>
          <?php endif; ?>
        </button>

        <div class="notification-panel" id="notificationPanel" hidden>
          <div class="notification-panel-header">
            <strong>Notifications</strong>
            <span><?= $notification_count; ?></span>
          </div>

          <div class="notification-list">
            <?php
            $notifications = $user_id
                ? $this->Document_model->get_recent_notifications($user_id, 5)
                : array();
            ?>

            <?php if (!empty($notifications)): ?>
              <?php foreach ($notifications as $notification): ?>
                <a class="notification-item" href="<?= site_url('Documents'); ?>">
                  <span class="notification-icon">
                    <i class="bi bi-file-earmark-text"></i>
                  </span>
                  <span class="notification-text">
                    <strong><?= html_escape($notification->title); ?></strong>
                    <small>Document uploaded · <?= date('d M Y, h:i A', strtotime($notification->uploaded_at)); ?></small>
                  </span>
                </a>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="notification-empty">No recent notifications.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- User name and initials are taken from the logged-in session. -->
      <a href="<?= site_url('Profile/profile'); ?>" class="user-profile-pill text-decoration-none">
        <div class="avatar-circle"><?= html_escape($user_initials); ?></div>
        <div class="user-meta d-none d-sm-block">
          <span class="user-name"><?= html_escape($user_name ?: 'LifeVault User'); ?></span>
          <span class="user-plan">Premium Plan</span>
        </div>
      </a>
    </div>
  </header>

  <style>
    /* Small navbar styles kept here so the notification feature is easy to find. */
    .notification-wrapper {
      position: relative;
    }

    .notification-badge {
      position: absolute;
      top: 1px;
      right: 1px;
      min-width: 18px;
      height: 18px;
      padding: 0 5px;
      border-radius: 999px;
      background: #ef4444;
      color: #fff;
      font-size: 10px;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #fff;
    }

    .notification-panel {
      position: absolute;
      top: 48px;
      right: 0;
      width: 340px;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      box-shadow: 0 15px 40px rgba(13, 18, 53, .15);
      overflow: hidden;
      z-index: 1000;
    }

    .notification-panel-header {
      display: flex;
      justify-content: space-between;
      padding: 15px 16px;
      border-bottom: 1px solid #eef0f4;
      color: #0d1235;
    }

    .notification-panel-header span {
      color: #6b7280;
      font-size: 13px;
    }

    .notification-item {
      display: flex;
      gap: 11px;
      padding: 13px 16px;
      color: inherit;
      text-decoration: none;
      border-bottom: 1px solid #f1f3f5;
    }

    .notification-item:hover {
      background: #f8fafc;
    }

    .notification-icon {
      width: 34px;
      height: 34px;
      flex: 0 0 34px;
      border-radius: 10px;
      background: #eef2ff;
      color: #2563eb;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .notification-text {
      min-width: 0;
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .notification-text strong {
      font-size: 13px;
      color: #111827;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .notification-text small,
    .notification-empty {
      color: #6b7280;
      font-size: 12px;
    }

    .notification-empty {
      padding: 22px 16px;
      text-align: center;
    }

    @media (max-width: 575px) {
      .notification-panel {
        position: fixed;
        top: 72px;
        right: 12px;
        left: 12px;
        width: auto;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const bell = document.getElementById('notificationBell');
      const panel = document.getElementById('notificationPanel');

      if (!bell || !panel) return;

      // Open/close the notification panel when the bell is clicked.
      bell.addEventListener('click', function (event) {
        event.stopPropagation();
        panel.hidden = !panel.hidden;
      });

      // Close the panel when the user clicks somewhere else.
      document.addEventListener('click', function (event) {
        if (!panel.contains(event.target) && !bell.contains(event.target)) {
          panel.hidden = true;
        }
      });
    });
  </script>