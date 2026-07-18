<!-- Registration page ui completed -->
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
        Create Your
       </h2>
       <h1 style="color: blue;">LifeVault.</h1>
       <h1>
        Secure Your Future.
       </h1>
       
     
       <div class="paragraph-item">
       <p>
        <h6 style="font-family: Georgia, 'Times New Roman', Times, serif;" >
          Create your LifeVault account to securely store,organize and protect your important documents anytime,anywhere.
        </h6>        

        
       </p>
       </div>
      
  <div class="feature-item">
    <i class="bi bi-person-fill">

    </i>
    <h4>Secure Registration

    </h4>
    <p>
      Your data is encrypted and protected from unauthorized access.
    </p>
    
   
    
  </div>

  <div class="feature-item">
   <i class="bi bi-file-earmark-text-fill">

   </i>
   <h4>
    Supported Documents
   </h4>
   <p>
    Upload and organize your important documents,including identity cards, certificates,results and PDFs.
   </p>
   
  </div>

  <div class="feature-item">
    <i class="bi bi-shield-lock">

    </i>
    <h4>
      Why Choose LifeVault?
    </h4>
    <p>
      Protect your personal and official documents with advanced security, cloud accessibility, and an organized digital vault.
    </p>
  </div>
<div class="register-image"
  <img src="<?= base_url('assets/images/register.png'); ?>" alt="Register">
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
    <?php echo form_open_multipart('auth/login',['class'=>'row g-3']);  ?>


  <div class="row">
  <div class="col-md-6">
    <label for="validationcustom1" class="form-label">Full Name
      <span class="text-primary">*</span>
    </label>

    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-person"></i>
      </span>

    <input type="name" 
    name="name"
    class="form-control" 
    id="inputname" 
    placeholder="Enter your full name"
    required>
    </div>
    <br>
  <div class="row">
  <div class="col-md-6">
    <label for="validationcustom1" class="form-label">Phone Number
      <span class="text-primary">*</span>
    </label>

    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-phone"></i>
      </span>

    <input type="phone" 
    name="phone"
    class="form-control" 
    id="inputphone" 
    placeholder="Enter your phone number"
    required>
    </div>

   <div class="col-md-6">

        <label class="form-label">
            Country
            <span class="text-primary">*</span>
        </label>

        <div class="input-group">

            <span class="input-group-text">
                <i class="bi bi-geo-alt"></i>
            </span>

            <select name="country" class="form-select">

                <option selected>Choose</option>
                <option>Afghanistan</option>
                <option>Albania</option>
                <option>Algeria</option>
                <option>Australia</option>
                <option>Austria</option>
                <option>Bangladesh</option>
                <option>Canada</option>
                <option>India</option>
                <option>New Zealand</option>
                <option>Sri Lanka</option>
                <option>UAE</option>
                <option>United Kingdom</option>
                <option>United States</option>

            </select>

        </div>

    </div>

 
    
  <div class="col-md-6">
  <label for="validationcustom1" class="form-label">Email Address
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
    placeholder="Enter your email address"
    required>

  </div>
</div>


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

   <div class="col-md-6">
    <label for="validationcustom2" class="form-label">Confirm Password
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
    placeholder="confirm password"
    required>

    <span class="input-group-text"
    onclick="showPassword()"
    style="cursor:pointer;">
  <i class="bi bi-eye" id="eyeIcon"></i></span>
    
    </div>

  </div>
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
  <a href="<?= site_url('auth/login'); ?>" class="login-link">

  Login
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