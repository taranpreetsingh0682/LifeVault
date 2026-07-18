<!-- Login Page UI Completed -->
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
  <a href="<?= site_url('Auth/Home'); ?>"><i class="bi bi-house-fill"></i>Home</a>
  <a href="<?= site_url('Auth/login'); ?>"><i class="bi bi-key-fill"></i>Login</a>
  <a href="<?= site_url('Auth/register'); ?>"><i class="bi bi-person-fill-add"></i>Register</a>
  
</div>





</nav>
   </div>

   <!-- <section class="container my-4 bg-dark text-light py-4 "> -->
    <section class="container my-5">
      <div class="main-box">
       <div class="left-panel">
    <div class="logo-item">
       <i class="bi bi-shield-lock-fill">
   
       </i>
       <h4 style="color: blue;">
        Secure,Private,Yours
       </h4>
    </div>
       <h2>
        Secure Your Documents.
       </h2>
       <h1 style="color: blue;">Protect Your Future.</h1>
     
       <div class="paragraph-item">
       <p>
        <h6 style="font-family: Georgia, 'Times New Roman', Times, serif;" >
          LifeVault helps you store, manage and protect your important documents in our secure place. Access them anytime,anywhere with complete peace of mind.
        </h6>        

        
       </p>
       </div>
      
  <div class="feature-item">
    <i class="bi bi-folder-check">

    </i>
    <span>
      Easy Access
    </span>
    
   
    
  </div>

  <div class="feature-item">
   <i class="bi bi-file-earmark-text-fill">

   </i>
   <span>
    Digital Record
   </span>
  </div>

  <div class="feature-item">
    <i class="bi bi-person-vcard">
      <span>Aadhaar</span>
    </i>
  </div>

  <div class="feature-item">
    <i class="bi bi-card-heading">
      <span>PAN</span>
    </i>
  </div>
  <div class="feature-item">
    <i class="bi bi-award">
      <span>Certifications</span>
    </i>
  </div>

  <div class="feature-item">
    <i class="bi bi-file-earmark-pdf">
      <span>
        PDF
      </span>
    </i>
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
    placeholder="email"
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
    placeholder="password"
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
  <button type="gmail" class="btn google-btn">
    <i class="bi bi-google">
    
    </i>
 
    Continue with Gmail
  </button>
</div>

<div class="register-item">
  <span>
    Don't have an account?
  </span>
  
  </a>
</div>

<div class="register-choose">
  <a href="<?= site_url('auth/register'); ?>" class="register-link">

  Register?
  </a>
    
</div>
</div>
   <?php echo form_close();?>
</section>

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