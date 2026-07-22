<!-- Update the navbar of Home Page UI   -->
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

    <title>Home LifeVault</title>
  </head>
  <body>



   <div class="container-fluid">
   
<nav class="navbar navbar-dark bg-light">
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
  <i class="bi bi-house"></i>Home</a>

  <a href="<?= site_url('Auth/login'); 
  ?>" class="<?= ($method=='Login')? 'active': ''; ?>"><i class="bi bi-key"></i>Login</a>

  <a href="<?= site_url('Auth/register'); ?>"
  class="<?= ($method=='register')? 'active': ''; ?>"><i class="bi bi-person-add"></i>Register</a>
  
</div>

</nav>
   </div>

   <!-- <section class="container my-4 bg-dark text-light py-4 "> -->
    <section class="container my-5">
    
       <div class="container">
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
        Secure Your
       </h2>
       <h1 style="color: black;">Important Documents</h1>
       <h3>
        For Life
       </h3>
    </div>
       
     
       <div class="paragraph-item">
       
        <h6>
          LifeVault is your smart digital vault tpo store,organize and protect your important documents and memories.
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


</section>
<hr class="after-container">

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
<!-- <div class="row"> -->
  <div class="output">
  <div class="col-md-3 registration">
<div class="row">
  <div class="col-md-3 icon">
    <i class="bi bi-person-add"></i>
  </div>
</div>
<div class="text-reg">
  <span>
    Secure Registration
  </span>
</div>

<div class="text-p">
  <p>
    Your data is encrypted end-to-end and protected from unauthorized access at every step.
  </p>
</div>
  </div>


<!-- second card -->
  
  <div class="col-md-3 registration">
<div class="row">
  <div class="col-md-3 icon">
    <i class="bi bi-file-earmark-text"></i>
  </div>
</div>
<div class="text-reg">
  <span>
    Secure Documents
  </span>
</div>

<div class="text-p">
  <p>
    Upload and organize identity cards,certificates,reality,images,and PDFs in one place.
  </p>
</div>
  </div>



<!-- third card -->

    <div class="col-md-3 registration">
<div class="row">
  <div class="col-md-3 icon">
    <i class="bi bi-cloud"></i>
  </div>
</div>
<div class="text-reg">
  <span>
    Cloud Accessibility
  </span>
</div>

<div class="text-p">
  <p>
   Access your organized digital vault from anywhere, on any device, whenever you need it.
  </p>
</div>
    </div>
  </div>


<section class="document-supported">
<div class="container-file">
<div class="child-file">
  <span>
    Supported Documents
  </span>
</div>

<div class="title-line"></div>

<div class="doc-card">
     <!-- <img src="<?= base_url('assets/images/aadhar.png'); ?>" alt="Aadhar"> -->

     <a href="#">
      <i class="bi-person-badge-fill"></i>
     </a>
 <a href="#">
   <i class="bi bi-person-vcard-fill"></i>
 </a>
    
<a href="#">
  <i class="bi bi-patch-check-fill"></i>
</a>
    
<a href="#">
  <i class="bi-file-earmark-pdf-fill"></i>
</a>
    
<a href="#">
  <i class="bi-image-fill"></i>
</a>
     
    <a href="#">
 <i class="bi-clipboard2-check-fill"></i>
    </a>
    
</div>






</div>







</section>

<section class="document-section">
  <div class="container-document">
    <div class="child_div">
    <i  class="bi bi-shield-lock-fill" style="color: white;"></i>
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

     
</div>

<footer>
  <div class="footer-container">
    <div class="footer-logo">
      <i class="bi bi-shield-lock-fill"></i>
      <h4>
        LifeVault
      </h4>
     
    </div>
    <div class="footer-p">
      <p>
        Your Trusted Digital Document Vault
      </p>
    </div>

    <div class="footer-copyright">
      <p>
        © 2026 LifeVault. All Rights Reserved.
      </p>
    </div>

  

  </div>
</footer>

   <script src="<?= base_url('assets/vault.js'); ?>"></script>
  </body>
</html>