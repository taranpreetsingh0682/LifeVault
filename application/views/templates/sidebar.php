<?php $controller = $this->router->fetch_class(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

       <!-- Bootstrap CSS-ICONS -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


        <!-- Bootstrap CSS-GOOGLE FONTS -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


         <!-- Custom CSS  -->
    <link rel="stylesheet" href="<?= base_url('assets/dashboard.css?v=' . time()); ?>">

<title>Sidebar LifeVault</title>
</head>
<body>
  
 <aside class="sidebar">

 <nav class="menu-item">

    
  <a href="<?= site_url('Dashboard/dashboard');  ?>"
  class="<?= ($controller =='Dashboard')? 'active': ''; ?>">
    <i class="bi bi-house-door-fill"></i>
    
    <span>
      Dashboard
    </span>
  </a>

  <a href="<?= site_url('Documents/documents'); ?>"
  class="<?= ($controller =='Document')? 'active': ''; ?>">
    <i class="bi bi-folder-fill"></i>
    <span>Documents</span>
  </a>

  <a href="<?= site_url('Upload/upload'); ?>"
  class="<?= ($controller == 'Upload')? 'active': ''; ?>">
    <i class="bi bi-cloud-arrow-up-fill"></i>
    <span>Uploads</span>
  </a>

  <a href="<?= site_url('Important/important'); ?>"
  class="<?= ($controller =='Important')? 'active': ''; ?>">
    <i class="bi bi-star-fill"></i>
    <span>Important</span>
  </a>

  <hr class="sidebar-line">
<div class="account">
  <span>
    Accounts
  </span>
</div>
 

  <a href="<?= site_url('Profile/profile'); ?>"
  class="<?= ($controller=='Profile')? 'active': ''; ?>">
    <i class="bi bi-person-circle"></i>
    <span>
      Profile
    </span>
  </a>

  <a href="<?= site_url('Settings/settings'); ?>"
  class="<?= ($controller == 'Settings')? 'active': ''; ?>">
    <i class="bi bi-gear-fill"></i>
    <span>
      Settings
    </span>
  </a>

  <a href="<?= site_url('Logout/logout'); ?>"
  class="<?= ($controller =='Logout')? 'active': ''; ?>">
    <i class="bi bi-box-arrow-right"></i>
    <span>
      Logout
    </span>
  </a>
 </nav>
 </aside>
</body>
</html>