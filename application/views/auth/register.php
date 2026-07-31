<!-- Registration page ui completed -->
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
<link rel="stylesheet" href="<?= base_url('assets/register.css?v=' . time()); ?>">

    <title>Register LifeVault</title>
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
        Secure,Private,Yours
       </h4>
    </div>
       <h2>
        Create Your LifeVault
       </h2>
     
       <h1>
        Secure Your Future.
       </h1>
       
     
       <div class="paragraph-item">
       
        <h6>
          Create your LifeVault account to securely store,organize and protect your important documents anytime,anywhere.
        </h6>        

        
      
       </div>
      <div class=" container features-view">
  <div class="feature-item">
    <i class="bi bi-shield">

    </i>
    <div class="features-text">
    <span>
      Secure registration
    </span>
   
    
   
    <p>
      Your data is encrypted and protected from unauthorized access.
    </p>
    </div>
  </div>  

  <div class="feature-item">
   <i class="bi bi-file-earmark-text">

   </i>
   <div class="features-text">
   <span>
    Supported documents
   </span>
   
  <p>
    Upload identity cards,certificates,results and PDFs, all in one
  </p>
   
 
   </div>
  </div>

  <div class="feature-item">
    <i class="bi bi-shield-check">

    </i>
    <div class="features-text">
    <span>
      Why Choose LifeVault?
    </span>

    <p>
      Advanced security, cloud accessibility , and an organized digital vault
    </p>
    </div>
  </div>
       </div>
<!-- <div class="feature-parent">
       <hr class="feature-line">
</div> -->


<hr class="line">
<div class="Secure-item">
  <div class="lock">
    <div class="icon-mid">
  <i class="bi bi-lock"></i>
    </div>

<span>
  Secure
</span>
  
  
  </div>
  <div class="files">
    <div class="icon-mid">
  <i class="bi bi-file-earmark"></i>
    </div>
  
  <span>
    Organized
  </span>
  

  </div>
  <div class="clouds">
<div class="icon-mid">
  <i class="bi bi-cloud"></i>
</div>
      
  <span>
    Accessible
  </span>
      
 
  </div>
</div>
       </div>
       


     <div class="right-panel">


<div class="row">

<div class="text-center">
  
  <i class="bi bi-person-plus fs-1 text-primary"></i>
  <h2 class="fw-bold">
    Create Account
  </h2>
  <p class="text-muted">
    Create your secure digital vault
  </p>
</div>



</div>
<div class="container  fields-set">
    <?php echo form_open_multipart('auth/login',['class'=>'row g-3']);  ?>


        <div class="row ">

            <!-- Full Name -->
            <div class="col-12">
                <label class="form-label">
                    Full Name <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-person"></i>
                   

                    <input type="text"
                    
                           class="form-control"
                           placeholder="Enter your full name"
                           >
                           
                </div>
            </div>

            <!-- Phone Number -->
             <div class="row g-1">
              <div class="parent-set">
            <div class="col-md-6">
                <label class="form-label">
                    Phone Number <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-phone"></i>
                    

                    <input type="text"
                           class="form-control"
                           placeholder="Enter your phone number">
                </div>
            </div>

            <!-- Country -->
            <div class="col-md-6">
                <label class="form-label">
                    Country <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-geo-alt"></i>
                    

                    <select class="form-select">
                        <option selected>Choose Country</option>
                        <option>India</option>
                        <option>USA</option>
                        <option>Canada</option>
                    </select>
                </div>
            </div>
            </div>


             </div>

            <!-- Email -->
            <div class="col-12">
                <label class="form-label">
                    Email Address <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-envelope"></i>
                    

                    <input type="email"
                           class="form-control"
                           placeholder="Enter your email address"
                           autocomplete="off">
                </div>
            </div>

            <!-- Password -->

            <div class="parent-set g-1">
            <div class="col-md-6">
                <label class="form-label">
                    Password <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                   
                        <i class="bi bi-lock"></i>
                    

                    <input type="password"
                           class="form-control"
                           placeholder="Password"
                           autocomplete="new-password">

                    
                        <i class="bi bi-eye"></i>
                    
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
                <label class="form-label">
                    Confirm Password <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-lock"></i>
                    

                    <input type="password"
                           class="form-control"
                           placeholder="Confirm Password">

                
                        <i class="bi bi-eye"></i>
                    
                </div>
            </div>
            </div>
  
  
  

  

    
    <button  type="login" class="btn btn-primary">Create account</button>
 
  
     
  <!-- Divider for gmail -->

  <div class="divider">
    <span>
      OR
    </span>
  </div>
       

  <button type="gmail" class="btn google-btn">
    <i class="bi bi-google">
    
    </i>
 
    Continue with Gmail
  </button>


<div class="register-item">
  <span>
    Already have an account?
  </span>
  
  <a href="<?= site_url('auth/login'); ?>" class="login-link">

  Login
  </a>
  
</div>



   <?php echo form_close();?>
     </div>
</div>
</section>

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