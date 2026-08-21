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

<style>
.lv-nav-toggle{display:none;background:none;border:none;font-size:1.6rem;color:#0D1235;cursor:pointer;padding:.25rem;line-height:1}
@media(max-width:768px){
.lv-nav-toggle{display:block}


.navbar{flex-wrap:wrap;padding:.75rem 1rem!important}


.navbar-menu{display:none;flex-direction:column;width:100%;gap:.35rem;
padding:.75rem 0 .25rem;border-top:1px solid #E5E7EB;margin-top:.5rem}


.navbar-menu.lv-nav-open{display:flex}

.navbar-menu a{padding:.55rem .75rem;width:100%;text-align:center;border-radius:8px}

.main-box{flex-direction:column!important;gap:0}

.left-panel,.right-panel{width:100%!important;padding:1.5rem 1.25rem!important}

.left-panel h1{font-size:1.75rem!important}

.left-panel h2{font-size:1.4rem!important}

.paragraph-item h6{font-size:.95rem!important;line-height:1.5!important}

.logo-item{width:auto!important;max-width:100%;margin:1rem 0!important}

.features-setup .feature-item span{font-size:.95rem!important}

.col-md-6{width:100%!important;padding:0!important}

.forget-item{padding:0 0 .75rem!important;margin-bottom:0!important}

.btn-primary,.google-btn{width:100%!important;padding:11px 1rem!important;display:block;margin-bottom:.5rem}

.divider{width:100%!important;margin:1rem 0!important}


.login-actions-row{flex-direction:column!important}

.login-actions-row>.col-md-6{width:100%!important;max-width:100%!important}

.footer-home{padding:1.5rem 1.25rem!important}

.footer-complete{flex-direction:column!important;gap:1.25rem;text-align:center;align-items:center}

.social-icons{justify-content:center}


section.container.my-5{padding-left:.75rem;padding-right:.75rem;margin-top:1rem!important;margin-bottom:1rem!important}

}
@media(min-width:769px) and (max-width:991px){
.main-box{flex-direction:column!important}

.left-panel,.right-panel{width:100%!important}


.btn-primary,.google-btn{padding:11px 2rem!important}
}

#forgotPasswordModal .modal-content.forgot-modal{background:#fff;border:none;border-radius:16px;box-shadow:0 25px 50px -12px rgba(13,18,53,.28);padding:0;overflow:hidden}

#forgotPasswordModal .modal-header{padding:1.75rem 1.75rem .25rem;border:0;background:#fff}

#forgotPasswordModal .modal-title{color:#0D1235;font-weight:700;font-size:1.35rem;width:100%;text-align:center}

#forgotPasswordModal .modal-header .btn-close{position:absolute;right:1.25rem;top:1.25rem}


#forgotPasswordModal .modal-body{padding:.5rem 1.75rem 1.75rem;text-align:center}

#forgotPasswordModal .forgot-icon-wrap{width:58px;height:58px;background:#EFF6FF;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem}


#forgotPasswordModal .forgot-icon-wrap i{font-size:1.45rem;color:#2563eb}
#forgotPasswordModal .forgot-description{color:#6B7280;font-size:.92rem;margin-bottom:1.1rem;line-height:1.55}

#forgotPasswordModal .form-label{display:block;text-align:left;font-weight:600;font-size:.85rem;color:#0D1235;margin-bottom:.35rem}


#forgotPasswordModal .form-control{border:2px solid #E5E7EB;border-radius:10px;padding:.7rem .9rem;background:#F7F6F4;font-size:.95rem}


#forgotPasswordModal .form-control:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.15)}


#forgotPasswordModal .btn-reset-link{background:#0D1235;border:none;padding:.75rem 1rem!important;width:100%;border-radius:10px;font-weight:600;margin-top:1rem!important}



#forgotPasswordModal .btn-reset-link:hover{background:#1a2250}
.forget-item a{color:#2563eb;font-weight:600}

.forget-item a:hover{color:#1d4ed8;text-decoration:underline!important}
.input-group>.bi-lock,.input-group>.bi-envelope,.input-group>.password-toggle{padding:8px;margin:0;background-color:#efefef;color:#A7A4AF;border-radius:8px;flex-shrink:0}

.input-group>.password-toggle{cursor:pointer}

.input-group>.password-toggle:hover{color:#0D1235}

.alert-reset-link{font-size:.88rem;word-break:break-all}

.alert-reset-link a{font-weight:600}
</style>

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

<button type="button" class="lv-nav-toggle" id="lvNavToggle" aria-label="Toggle navigation" aria-expanded="false">
  <i class="bi bi-list"></i>
</button>

<div class="navbar-menu" id="lvNavMenu">
  <a href="<?= site_url('auth/Home'); ?>" class="<?= ($method =='Home')? 'active': ''; ?>">Home</a>
  <a href="<?= site_url('auth/login'); ?>" class="<?= ($method=='login')? 'active': ''; ?>">Login</a>
  <a href="<?= site_url('auth/register'); ?>" class="<?= ($method=='register')? 'active': ''; ?>">Register</a>
</div>

</nav>
   

   

   <!-- <section class="container my-4 bg-dark text-light py-4 "> -->
    <section class=" my-5">
    
      <div class="main-box">
        <div class="container page-1">
          <div class="row">
       <div class="left-panel col-md-6">
        
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

     <div class="right-panel col-md-6">


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

    <?php echo form_open_multipart('auth/loginUser',['class'=>'row g-3', 'autocomplete'=>'off']);  ?>



      <?php if ($this->session->flashdata('error') && !$this->session->flashdata('open_forgot_modal')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

      <?php if ($this->session->flashdata('reset_link')): ?>
        <div class="alert alert-info alert-reset-link">
            <strong>Reset link (for testing):</strong>
            <a href="<?= $this->session->flashdata('reset_link'); ?>">
                <?= $this->session->flashdata('reset_link'); ?>
            </a>
        </div>
    <?php endif; ?>
  <div class="row">
  <div class="col-md-12">
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
    autocomplete="off">
    </div>
    <br>


  </div>
  <div class="col-md-12">
    <label for="validationcustom2" class="form-label">Password
      <span class="text-primary">*</span>
    </label>

    <div class="input-group">
      <i class="bi bi-lock"></i>

    <input type="password" 
    name="password"
    class="form-control"
    id="loginPassword"
    placeholder="Enter your password"
    autocomplete="new-password">

    <i class="bi bi-eye password-toggle" data-target="loginPassword" title="Show password"></i>
    </div>

  </div>
  </div>
  <div class="forget-item">
<a href="<?= site_url('auth/forgetPassword'); ?>">
    Forgot Password?
</a>
  </div>
<div class="row login-actions-row g-2">
    <div class="col-md-12">
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </div>

  <div class="col-md-12 divider">
    <span>OR</span>
  </div>

  <div class="col-md-12">
    <a href="<?= site_url('auth/googleLogin'); ?>" type="button" class="btn google-btn w-100">Continue with Gmail</a>
  </div>
</div>

<div class="register-item">
  <span>Don't have an account?</span>
  <a href="<?= site_url('auth/register'); ?>" class="register-link">Register</a>
</div>

   <?php echo form_close();?>
</div>
     
</div>
        </div>
      </div>
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



  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+FtVtCyLGsbjV3x1d6tYxLy4o+oeZz5UqA6DysdZQGPi0N" crossorigin="anonymous"></script>
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