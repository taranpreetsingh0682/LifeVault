<!-- Login Page UI Completed -->
 <?php
$method = $this->router->fetch_method();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
<link rel="stylesheet" href="<?= base_url('assets/life.css?v=' . time()); ?>">

    <title>Login LIFEVAULT </title>
  </head>
  <body>



<nav class="navbar navbar-dark ">
  <div class="navbar-logo">
    <i class="bi bi-shield-lock-fill">

    </i>
    <h4>
    LifeVault
    </h4>
  </div>

<!-- Home landing page -->

<div class="navbar-menu">
  <a href="<?= site_url('Auth/Home'); 
  ?>"
  class="<?= ($method =='Home')? 'active': ''; ?>">
  Home</a>

  <a href="<?= site_url('Auth/login'); 
  ?>" class="<?= ($method=='login')? 'active': ''; ?>">Login</a>

  <a href="<?= site_url('Auth/register'); ?>"
  class="<?= ($method=='register')? 'active': ''; ?>">Register</a>
  
</div>

</nav>
   

   

   <!-- <section class="container my-4 bg-dark text-light py-4 "> -->
    <section class="container my-5">
      <div class="main-box">
       <div class="left-panel">
        
    <div class="logo-item">
       <i class="bi bi-circle-fill">
   
       </i>
       <h4>
        Secure.Private.Yours
       </h4>
    </div>
        
       <h2>
        Secure Your Documents.
       </h2>
       <h1>Protect Your Future.</h1>
     
       <div class="paragraph-item">
       <p>
        <h6 style="font-family: Georgia, 'Times New Roman', Times, serif;" >
          LifeVault helps you store, manage and protect your important documents in our secure place. Access them anytime,anywhere with complete peace of mind.
        </h6>        

        
       </p>
       </div>
    <div class="container  features-setup">
  <div class="feature-item">
    <i class="bi bi-check">

    </i>
    <span>
      Easy Access to every document
    </span>
    
   
    
  </div>

  <div class="feature-item">
   <i class="bi bi-file-earmark-text">

   </i>
   <span>
    Digital records,always in sync
   </span>
  </div>

  <div class="feature-item">
    <i class="bi bi-credit-card"></i>
      <span>Aadhaar & PAN, safely stored</span>
    
  </div>

  <div class="feature-item">
    <i class="bi bi-award"></i>
      <span>Certifications, verified & ready</span>
    
  </div>
    </div>
  

 
       </div> 

     <div class="right-panel">


<div class="row">

<div class="text-center">
  
  <i class="bi bi-person-plus fs-1 text-primary"></i>
  <h2 class="fw-bold">
    Welcome Back!
  </h2>
  <p class="text-muted">
    Login to access your vault
  </p>
</div>



</div>
    <?php echo form_open_multipart('auth/login',['class'=>'row g-3']);  ?>
  <div class="row">
  <div class="col-md-6">
    <label for="validationcustom1" class="form-label">Email
      <span class="text-primary">*</span>
    </label>

    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-envelope"></i>
      </span>

    <input type="email" 
    name="email"
    class="form-control" 
    id="inputEmail4" 
    placeholder="you@example.com"
    required>
    </div>
    <br>


  </div>
  <div class="col-md-6">
    <label for="validationcustom2" class="form-label">Password
      <span class="text-primary">*</span>
    </label>

    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-lock"></i>
      </span>


    <input type="password" 
    name="password"
    autocomplete="new-password"
    
    class="form-control"
    id="password"
    placeholder="Enter your password"
    required>

    <span class="input-group-text"
    onclick="showPassword()"
    style="cursor:pointer;">
  <i class="bi bi-eye" id="eyeIcon"></i></span>
    
    </div>

  </div>
  </div>
  <div class="forget-item">
  <a href="<?= site_url('auth/forgotPassword'); ?>" class="forgot-link">
    Forgot Password?
</a>

  </div>

    <div class="col-12" >
    <button  type="login" class="btn btn-primary">Login</button>
 
  </div>
     
  <!-- Divider for gmail -->

  <div class="divider">
    <span>
      OR
    </span>
  </div>
       

<div class="col-12">
  
 <div class="col-12" >
  
    <button  type="google" class="btn google-btn">Continue with Gmail</button>
 
  </div>
</div>
     
  


<div class="register-item">
  <span>
    Don't have an account?
  </span>
   <a href="<?= site_url('auth/register'); ?>" class="register-link">

  Register
  </a>
  
  </a>
</div>


</div>
   <?php echo form_close();?>
</section>

<!-- ----footer -->

  <footer>
      <div class="container-fluid footer-home">
        <div class="footer-complete">
        <div class="footer-mid">
        <div class="project-name">
          <i class="bi bi-shield-lock"></i>

          <span>
            LifeVault
          </span>
        </div>
        <div class="project-p">
          <p>
            Your trusted digital document vault-secure,private,and always yours.
          </p>
        </div>

        <div class="social-icons">

   

    <a href="#" class="social-icon">
        <i class="bi bi-twitter"></i>
    </a>

    <a href="#" class="social-icon">
        <i class="bi bi-linkedin"></i>
    </a>

    

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
    <a href="<?= site_url('Storage/storage'); ?>">Storage</a>
</li>

<li>
    <a href="<?= site_url('Settings/setting'); ?>">Setting</a>
</li>
</ul>
    </div>
<div class="footer-company">
  <span>
    COMPANY
  </span>

  <ul>
    <li>
      <a href="<?= site_url('About/about');  ?>">About</a>
    </li>

      <li>
      <a href="<?= site_url('Security/security');  ?>">Security</a>
    </li>


      <li>
      <a href="<?= site_url('Careers/career');  ?>">Career</a>
    </li>



      <li>
      <a href="<?= site_url('Contact/contact');  ?>">Contact</a>
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
</div>

   <script src="<?= base_url('assets/vault.js'); ?>"></script>
  </body>
</html>