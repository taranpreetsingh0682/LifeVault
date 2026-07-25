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


  <title>footer Dashboard</title>
</head>
<body>

 <footer>
      <div class="container-fluid footer-home">
        <div class="footer-complete">
        <div class="footer-mid">
        <div class="project-name">
          <i class="bi bi-shield-lock-fill"></i>

          <span>
            LifeVault
          </span>
        </div>
        <div class="project-p">
          <p>
            Your trusted digital document vault-secure,private,and always yours.
          </p>
        </div>
        </div>

    <div class="footer-column">
    <span>PRODUCT</span>


    <ul>


  
    <li>
    
    <a href="<?= site_url('Dashboard/dashboard'); ?>">Dashboard</a>
    </li>


    <li>
    <a href="<?= site_url('Documents/documents'); ?>">Documents</a>
    </li>

<li>
    <a href="<?= site_url('Settings/setting'); ?>">Setting</a>
</li>
</ul>
    </div>
        

 <div class="footer-legal">
<span>
  LEGAL
</span>

<ul>
  <li>
    <a href="#">Privacy Policy</a>
  </li>

    <li>
    <a href="#">Terms of Service</a>
  </li>
</ul>
  </div>   


</div>
<hr class="footer-line">
        
<div class="footer-reserved">
  <span>
    © 2026 LifeVault. All rights reserved.
  </span>
</div>
 </div>
</footer>
</body>
</html>