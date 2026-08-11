<!-- Update the navbar of Home Page Ui  -->
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
<link rel="stylesheet" href="<?= base_url('assets/home.css?v=' . time()); ?>">

<style>
.lv-nav-toggle{display:none;background:none;border:none;font-size:1.6rem;color:#0D1235;cursor:pointer;padding:.25rem;line-height:1}
@media(max-width:991px){
.Middle{padding-left:0!important;padding:0 1rem}
.text-field h2{font-size:clamp(1.6rem,5vw,2.2rem)!important}
.text-field h1{font-size:clamp(1.8rem,6vw,2.5rem)!important}
.text-field h3{font-size:clamp(1.6rem,5vw,2.2rem)!important}
.text-field h4{font-size:clamp(1.5rem,4.5vw,2rem)!important}
.paragraph-item h6{font-size:1rem!important;line-height:1.6!important;max-width:100%!important}
.btn-register{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;width:100%;max-width:320px}
.trust-section{flex-wrap:wrap;justify-content:center;text-align:center;gap:.75rem}
.section-vault .middle,.document-supported .middle,.working .middle-set,.view-section .middle{flex-wrap:wrap;gap:1rem}
.vault-card,.step-card,.users-card{flex:1 1 100%!important;max-width:100%!important;width:100%!important;margin:.75rem 0!important}
.file-documents{padding:1.5rem 1rem!important}
.works-segment{padding:1.5rem 1rem!important}
.document-section{padding:1rem!important;margin:0!important}
.document{flex-direction:column!important;text-align:center;gap:1rem;padding:1.5rem 1rem!important}
.child-btn{justify-content:center!important;width:100%}
.child-btn .btn{width:100%;max-width:280px}
.users-trust{padding:0 1rem}
}
@media(max-width:768px){
.lv-nav-toggle{display:block}
.navbar{flex-wrap:wrap;padding:.75rem 1rem!important}
.navbar-menu{display:none;flex-direction:column;width:100%;gap:.35rem;padding:.75rem 0 .25rem;border-top:1px solid #E5E7EB;margin-top:.5rem}
.navbar-menu.lv-nav-open{display:flex}
.navbar-menu a{padding:.55rem .75rem;width:100%;text-align:center;border-radius:8px}
.Home-first.my-5{margin-top:1rem!important;margin-bottom:1rem!important}
.first-layout{padding:1rem .5rem!important}
.doc-card{margin-bottom:.75rem!important}
.footer-home{padding:1.5rem 1.25rem!important}
.footer-complete{flex-direction:column!important;gap:1.25rem;text-align:center;align-items:center}
.social-icons{justify-content:center}
.text-vault span{font-size:1.35rem!important;margin:0!important;text-align:center}
.p-vault p{text-align:center;padding:0 1rem;font-size:.95rem}
.why-vault span,.file span{font-size:.75rem!important}
.child-file span{font-size:1.1rem!important}
}
@media(max-width:480px){
.doc-card span{margin:0!important;font-size:.9rem}
.icons{padding:4px 16px!important}
}
</style>

    <title>Home LifeVault</title>
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
  <a href="<?= site_url('Auth/login'); ?>" class="<?= ($method=='Login')? 'active': ''; ?>">Login</a>
  <a href="<?= site_url('Auth/register'); ?>" class="<?= ($method=='register')? 'active': ''; ?>">Register</a>
</div>

</nav>
   

   <!-- <section class="container my-4 bg-dark text-light py-4 "> -->
    <section class="Home-first my-5">
    
       <div class="container   first-layout">
    <div class="Middle">
    <div class="logo-item">
       <i class="bi bi-shield-lock">
   
       </i>
       <div class="h4-text">
       <h4 style="color: blue;">
        Secure . Private . Yours
       </h4>
       </div>
    </div>
    <div class="text-field">
       <h2>
        Every important
       </h2>
       <h1 style="color: black;"> Document,</h1>
       <h3>
        One 
       </h3>
       <h4>
        Vault away.
       </h4>
    </div>
       
     
       <div class="paragraph-item">
       
        <h6>
          LifeVault is your smart digital vault to store,organize and protect your important documents and memories--encrypted , Indexed , and ready whenever you need them.
        </h6>        

        
       
       </div>
      
 <a href="<?= site_url('Auth/register'); ?>" class="btn-register">
    <i class="bi bi-person-plus"></i>
    Create free account
</a>

<div class="trust-section">

    <div class="trust-users">
        <div class="user-circle user1">TS</div>
        <div class="user-circle user2">RK</div>
        <div class="user-circle user3">AM</div>
        <div class="user-circle user4">
            <i class="bi bi-plus"></i>
        </div>
    </div>

    <div class="trust-text">
        <strong>12,000+</strong> people trust LifeVault
    </div>

    <div class="trust-rating">
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-half"></i>

        <span>4.9 / 5</span>
    </div>
</div>
</div>
       
       </div>
    </section>
   




<div class="section-vault">
  <div class="container vault-support">
<div class="why-vault">
  <span>
    WHY LIFEVAULT
  </span>
</div>
<div class="text-vault">
  <span>
    Built for security and simplicity
  </span>
</div>
<div class="p-vault">
  <p>
    Everything you need to keep your important documents safe , organized, and accessible.
  </p>
</div>


  <div class="row">
         <div class="middle">
  <div class="col-md-3  vault-card">
    <div class="vault-icon">
      <i class="bi bi-shield-check"></i>

   
    </div>
    <div class="vault-span">
       <span>
        Bank-grade encrypted
      </span>
    </div>

    <div class="vault-p">
      <p>
        Every file is encrypted at upload and in storage , so only you hold the key to your vault.
      </p>
    </div>
  </div> 

<!-- 2nd card -->


 <div class=" col-md-3 vault-card">
    <div class="vault-icon">
      <i class="bi bi-shield-check"></i>

   
    </div>
    <div class="vault-span">
       <span>
        Smart organization
      </span>
    </div>

    <div class="vault-p">
      <p>
        Documents are auto-sorted into categories,Identity cards,PDFs and certificates 
      </p>





</div>
 </div>

  <!-- 3rd card -->



   <div class=" col-md-3 vault-card">
    <div class="vault-icon">
      <i class="bi bi-shield-check"></i>

   
    </div>
    <div class="vault-span">
       <span>
        Access anywhere
      </span>
    </div>

    <div class="vault-p">
      <p>
        Retrieve or share any document securely from your phone , tablet or desktop-anytime.
      </p>





</div>
 </div>
  
</div>
</div>
  </div>
</div>





  







<section class="document-supported">

<div class="container-fluid  file-documents">
  <div class="file">
    <span>
      WHAT YOU CAN STORE
    </span>
  </div>
<div class="child-file">
  <span>
    Supported Documents
  </span>
</div>

<div class="title-line"></div>
<!-- Identity Card -->

<div class="row">
  <div class="middle">
<div class=" col-md-2 col-6 doc-card">
   <div class="row">
    <div class="middle">
    <div class="col-md-2 col-6 icons">
      <i class="bi bi-person-vcard"></i>
    </div>
     
    </div>

   </div>
   <div class="s-mid">
    <span>
        Identity
      </span>
   </div>
  

</div>


<div class=" col-md-2 col-6 doc-card">
   <div class="middle">
    <div class="col-md-2 col-6 icons">

      <i class="bi bi-person"></i>
     
    </div>

   </div>
   <div class="s-mid">
    <span>
     Contact
      </span>
   </div>

</div>

<div class=" col-md-2 col-6 doc-card">
   <div class="middle">
    <div class="col-md-2 col-6 icons">

      <i class="bi bi-patch-check"></i>
     
    </div>
   </div>

   
   <div class="s-mid">
    <span>
      Certificates
      </span>
   </div>
</div>



<div class=" col-md-2 col-6 doc-card">
   <div class="middle">
    <div class="col-md-2 col-6 icons">

      <i class="bi bi-file-earmark-pdf"></i>
     
    </div>
   </div>

   
   <div class="s-mid">
    <span >    
      PDFs
</span>
   </div>
</div>


<div class=" col-md-2 col-6 doc-card">
   <div class="middle">
      <div class="col-md-2 col-6 icons">
      <i class="bi bi-image"></i>
     
    </div>

   </div>
   <div class="s-mid">
    <span>
        Images
      </span>
   </div>

</div>



<div class=" col-md-2 col-6 doc-card">
   <div class="middle">
    <div class="col-md-2 col-6 icons">
  <i class="bi bi-clipboard-check"></i>
     
    </div>

   </div>
   <div class="s-mid">
    <span>
        Records
      </span>
   </div>

</div>
  </div>


</div>







</section>


<section class="working">
  <div class="container-fluid works-segment">
    <div class="text-fields">
      <span>
        GETTING STARTED
      </span>
    </div>

    <div class="how-works">
      <span>
        How LifeVault works
      </span>

    </div>

    <div class="p-texts">
      <p>
        Three simple steps to a fully organized , secure digital vault.
      </p>

    </div>

    <!-- step-1 -->
     <div class="row">
      <div class="middle-set">
<div class="col-md-3
step-card">
    <div class="step-number">
      
        01
      
    </div>
<div class="accounts-mid">
  <span>
    Create your account
  </span>
</div>
<div class="p-mid">
  <p>
    Sign up in seconds with secure,encrypted registration.
  </p>
</div>
  </div>
<!-- step-2 -->


<div class="col-md-3
step-card">
    <div class="step-number">
      
        02
      
    </div>
<div class="accounts-mid">
  <span>
    Upload your documents
  </span>
</div>
<div class="p-mid">
  <p>
    Add IDs,certificates,and files-sorted into categories automatically.
  </p>
</div>
  </div>
    
  <!-- 3rd step -->


  <div class="col-md-3
  step-card">
    <div class="step-number">
      
        03
      
    </div>
<div class="accounts-mid">
  <span>
    Access anywhere,anytime
  </span>
</div>
<div class="p-mid">
  <p>
    Retrieve or share your documents securely from any device.
  </p>
</div>
  </div>
     </div>
     </div>

  </div>


 
</section>


<section class="view-section">


  <div class="container-fluid users-trust">

  <div class="middle">
   <div  class="row">
    <div class="col-md-3 users-card">
      <div class="users-text">
      <span>
        12K+
      </span>
      </div>
<div class="users-p">
    <p>
      Users trust
    </p>
   </div>
    </div>

<!-- 2nd card -->

    <div class="col-md-3
    users-card">
      <div class="users-text">
      <span>
        256-bit
      </span>
      </div>
<div class="users-p">
    <p>
      AES Encryption
    </p>
   </div>

    </div>
<!-- 3rd card -->
  <div class="col-md-3 users-card">
    <div class="users-text">
      <span>
        99.9%
      </span>
      </div>
  <div class="users-p">
    <p>
      Uptime
    </p>
   </div>

    </div>

    <!-- 4th card -->
    <div class="col-md-3 users-card">
    <div class="users-text">
      <span>
        4.9/5
      </span>
      </div>
  <div class="users-p">
    <p>
      Average rating
    </p>
   </div>

    </div>

   </div>
  
</section>

<section class="document-section">
  <div class="container-fluid document">
    <div class="child_div">
  
    <h5>
      Ready to Secure your documents ?
    </h5>
    <p>
      Join LifeVault today and take control of your important documents.
    </p>

   
    </div>
    <div class="child-btn">
 <a href="<?= site_url('Auth/register'); ?>" class="btn btn-light">Create Account
      <i class="bi bi-arrow-right"></i></a>
    </div>
   
</div>
  
  


</section>
<!-- Updated footer ui -->
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

<script>
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
})();
</script>

  </body>
</html>