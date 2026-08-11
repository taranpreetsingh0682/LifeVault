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

<style>
.lv-nav-toggle{display:none;background:none;border:none;font-size:1.6rem;color:#0D1235;cursor:pointer;padding:.25rem;line-height:1}
@media(max-width:768px){
.lv-nav-toggle{display:block}
.navbar{flex-wrap:wrap;padding:.75rem 1rem!important}
.navbar-menu{display:none;flex-direction:column;width:100%;gap:.35rem;padding:.75rem 0 .25rem;border-top:1px solid #E5E7EB;margin-top:.5rem}
.navbar-menu.lv-nav-open{display:flex}
.navbar-menu a{padding:.55rem .75rem;width:100%;text-align:center;border-radius:8px}
.main-box{flex-direction:column!important;gap:0}
.left-panel,.right-panel{width:100%!important;padding:1.5rem 1.25rem!important}
.left-panel h1{font-size:1.75rem!important}
.left-panel h2{font-size:1.4rem!important}
.paragraph-item h6,.left-panel h6{font-size:.95rem!important;line-height:1.5!important}
.logo-item{width:auto!important;max-width:100%;margin:1rem 0!important}
.features-view .feature-item{flex-direction:column;text-align:center;align-items:center;gap:.5rem}
.features-view .features-text p{font-size:.85rem!important}
.parent-set{flex-direction:column!important;gap:0!important}
.parent-set>.col-md-6{width:100%!important;max-width:100%!important;padding:0!important}
.Secure-item{flex-wrap:wrap;justify-content:center;gap:1rem!important;position:static!important;margin-top:1.5rem!important;bottom:auto!important;right:auto!important;left:auto!important}
.left-panel{position:relative!important;padding-bottom:2rem!important}
.line{margin:1rem 0!important}
.fields-set{padding:0!important}
.btn-primary,.google-btn{width:100%!important;padding:11px 1rem!important;display:block}
.divider{width:100%!important;margin:1rem 0!important}
.footer-home{padding:1.5rem 1.25rem!important}
.footer-complete{flex-direction:column!important;gap:1.25rem;text-align:center;align-items:center}
.social-icons{justify-content:center}
section.container.my-5{padding-left:.75rem;padding-right:.75rem;margin-top:1rem!important;margin-bottom:1rem!important}
}
@media(min-width:769px) and (max-width:991px){
.main-box{flex-direction:column!important}
.left-panel,.right-panel{width:100%!important}
}
.input-group>.password-toggle{cursor:pointer}
.input-group>.password-toggle:hover{color:#0D1235}
</style>

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

<button type="button" class="lv-nav-toggle" id="lvNavToggle" aria-label="Toggle navigation" aria-expanded="false">
  <i class="bi bi-list"></i>
</button>

<div class="navbar-menu" id="lvNavMenu">
  <a href="<?= site_url('Auth/Home'); ?>" class="<?= ($method =='Home')? 'active': ''; ?>">Home</a>
  <a href="<?= site_url('Auth/login'); ?>" class="<?= ($method=='login')? 'active': ''; ?>">Login</a>
  <a href="<?= site_url('Auth/register'); ?>" class="<?= ($method=='register')? 'active': ''; ?>">Register</a>
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
    <?php echo form_open_multipart('auth/registerUser',['class'=>'row g-3']);  ?>


        <div class="row ">

            <!-- Full Name -->
            <div class="col-12">
                <label class="form-label">
                    Full Name <span class="text-primary">*</span>
                </label>

                <div class="input-group">
                    
                        <i class="bi bi-person"></i>
                   

                    <input type="text"
                    name="name"
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
                    name="phone_number"
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
                    

                    <select name="country"
                    class="form-select">
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
                    name="email"
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
                    name="password"
                           class="form-control"
                           id="registerPassword"
                           placeholder="Password"
                           autocomplete="new-password">

                    <i class="bi bi-eye password-toggle" data-target="registerPassword" title="Show password"></i>
                    
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
                    name="confirm_password"
                           class="form-control"
                           id="confirmPassword"
                           placeholder="Confirm Password">

                    <i class="bi bi-eye password-toggle" data-target="confirmPassword" title="Show password"></i>
                    
                </div>
            </div>
            </div>
  
  
  

  

    
    <button type="submit" class="btn btn-primary w-100">Create account</button>
 
  
     
  <!-- Divider for gmail -->

  <div class="divider">
    <span>
      OR
    </span>
  </div>
       

  <button type="button" class="btn google-btn w-100">
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
    
    <a href="<?= site_url('#'); ?>">Dashboard</a>
    </li>


    <li>
    <a href="<?= site_url('#'); ?>">Documents</a>
    </li>

<li>
    <a href="<?= site_url('#'); ?>">Storage</a>
</li>

<li>
    <a href="<?= site_url('#'); ?>">Setting</a>
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

<script src="<?= base_url('assets/vault.js'); ?>"></script>
<script>
function initPasswordToggles(){
  document.querySelectorAll('.password-toggle').forEach(function(toggle){
    toggle.addEventListener('click',function(){
      var input=document.getElementById(this.getAttribute('data-target'));
      if(!input)return;
      if(input.type==='password'){
        input.type='text';
        this.classList.replace('bi-eye','bi-eye-slash');
        this.setAttribute('title','Hide password');
      }else{
        input.type='password';
        this.classList.replace('bi-eye-slash','bi-eye');
        this.setAttribute('title','Show password');
      }
    });
  });
}
(function(){
  var t=document.getElementById('lvNavToggle');
  var m=document.getElementById('lvNavMenu');
  if(t&&m){
    t.addEventListener('click',function(){
      var open=m.classList.toggle('lv-nav-open');
      t.setAttribute('aria-expanded',open?'true':'false');
      t.innerHTML=open?'<i class="bi bi-x-lg"></i>':'<i class="bi bi-list"></i>';
    });
  }
  initPasswordToggles();
})();
</script>
  </body>
</html>