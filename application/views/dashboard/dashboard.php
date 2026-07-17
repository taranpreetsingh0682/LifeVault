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
  <title>Dashboard LifeVault</title>
</head>
<body>

<div class="dashboard-layout">  <!---Parent div --->
  <?php $this->load->view('templates/sidebar'); ?> <!---child 1--->


<section class="main-content"> <!----Child 2 --->
  <div class="wel-up">
  <div class="welcome">
    <div class="text">
    <h2>
      
      Welcome back, Taranpreet  👋
    </h2>
    <p>
      Manage and secure your documents in one place 
    </p>
    </div>
 <div class="button-container">
  <div class="btn-upload">
    <button class="btn-btn">
      <i class="bi bi-upload"></i>
      Upload file
    </button>
  </div>
 
 </div>
  </div>
  
  

  <div class="all-set">



<!--- container/card 2 -->
<div class="card-documents">
  <div class="icon-documents">
    <i class="bi bi-file-earmark-fill"></i>
  </div>

  <div class="text-documents">
    <span>
      Total Documents
    </span>

    <h5>
      120
    </h5>
    <p>
      +12 this week
    </p>
  </div>
</div>


<div class="card-storage">
  <div class="icon-storage">

    <i class="bi bi-database-fill"></i>
  </div>
    <div class="storage-use">
   <span>
    Storage Used
   </span>

   <h5>
    1.8
   </h5>

   <h4>
    GB
   </h4>

   <p>
    of 5 GB
   </p>
   
  </div>
  
</div>

<div class="card-important">
  <div  class="card-icon">
    <i class="bi bi-star-fill"></i>
  </div>

  <div class="important-use">
    <span>
     Importants
    </span>

    <h5>
      16
    </h5>
    <a href="#">View all</a>
  </div>
</div>


  <div class="card-share">
    <div class="share-card-icon">
      <i class="bi bi-share-fill"></i>
    </div>

    <div class="share-use">
      
      <span>
        Shared Files
      </span>
      <h5>
        8
      </h5>

      <a href="#">View all</a>
      
    </div>
  </div>

  <div class="storage-usage">
    <div class="display">
    <h4>
      Storage Usage
    </h4>

  <a href="#">View Details</a>
 
  </div>
  
   <p>
    2.5 GB of 5 GB Used
  </p>

   <div class="progress-bar">
   
    <div class="progress-fill"></div>

 
 

   
   </div>
<div class="percentage">
   <span>
    2.5 GB Available
   </span>


<h6>
  50%
</h6>
</div>

 
  

</div>
   

  </div>
  </div>

<div class="all-fit">
  <div class="container-recent">
    <div class="view">
      <h5>
        Recent Documents
      </h5>
    <a href="#">View all</a>
   
    </div>
    <hr class="recent-line">


  <div class="name">
    <span>
      Document Name
    </span>

    <div class="category">
    <span>
      Category
    </span>
    </div>

    <div class="update">
      <span>
        Updated On
      </span>
    </div>


    <div class="size">
      <span>
        Size
      </span>
    </div>
   
  </div>
   <hr class="line">

<div class="pan-card">
  <i class="bi bi-file-earmark-pdf-fill"></i>


  <span>
    PAN Card.pdf
  </span>



<div class="identity-a-pan">
  <span>
    Identity
  </span>

</div>


  
  <div class="date-pan">
    <span>
      Yesterday,09:15 PM
    </span>
  </div>
<div class="size-pan">
  <span>
    240 KB
  </span>
</div>

<div class="dot-pan">
  <i class="bi bi-three-dots-vertical"></i>
</div>

  


    

  </div>


  <div class="Resume">
  <i class="bi bi-file-earmark-word-fill"></i>

  <span>
    Resume.pdf
  </span>

  <div class="personal">
    <span>
      Personal
    </span>
  </div>

  <div class="resume-date">
    <span>
      05 July 2025
    </span>
  </div>

  <div class="resume-size">
    <span>
      1.2 MB
    </span>
  </div>
<div class="dot">
  <i class="bi bi-three-dots-vertical"></i>
</div>




</div>

<div class="aadhar-pdf">
  <i class="bi bi-file-earmark-pdf-fill"></i>

  <span>
    Aadhaar Card.pdf
  </span>


  <div class="identity-aadhar">

  <span>
    Identity
  </span>
  </div>

  <div class="aadhar-date">
    <span>
      Today,10:30 AM
    </span>
  </div>

  <div class="aadhar-size">
    <span>
      456 KB
    </span>
  </div>

  <div class="aadhar-dot">
    <i class="bi bi-three-dots-vertical"></i>
  </div>

</div>

<div class="mark">
  <i class="bi bi-file-earmark-excel-fill"></i>

  <span>
    10th Marksheet.pdf
  </span>

  <div class="Ed">
    <span>
      Education
    </span>

  </div>

  <div class="mark-date">
    <span>
      04 July 2025
    </span>
  </div>

  <div class="mark-size">
    <span>
      512 KB
    </span>
  </div>

  <div class="mark-menu">
    <i class="bi bi-three-dots-vertical"></i>
  </div>

</div>


<div class="passport">
  <i class="bi bi-file-earmark-pdf-fill"></i>

  <span>
    Passport.pdf
  </span>

  <div class="passport-i">
    <span>
      Identity
    </span>
  </div>

<div class="pass-date">
  <span>
    01 June 2025
  </span>
</div>

<div class="pass-size">
  <span>
    600 KB
  </span>
</div>

<div class="pass-menu">
  <i class="bi bi-three-dots-vertical">
    
  </i>
</div>

</div>



</div>

  
<div class="all-access">
  <div class="Container-quick">
    <div class="q">
      <h4>
        Quick Access
      </h4>
    </div>
    <div class="complete">
<div class="fit">
 <div class="upload-doc">
  <i class="bi bi-upload"></i>

  <h4>
    Upload
  </h4>
  <h3>
    Documents
  </h3>
</div>
</div>


<div class="my-doc">
  <i class="bi bi-file-earmark-text-fill"></i>

  <h4>
    My
  </h4>
  <h3>
    Documents
  </h3>
</div>

    
  
  </div>
<div class="all-view">
  <div class="share">
    <i class="bi bi-share-fill"></i>
    <span>
      Share
    </span>
    <p>
      Document
    </p>
  </div>

  <div class="view-fav">
    <i class="bi bi-star-fill"></i>
    <span>
      View
    </span>
    <p>
      Favorites
    </p>
  </div>
</div>
  </div>




</div>

<div class="container-category">
  <div class="identity-id">
    <div class="middle">
    <i class="bi bi-person-vcard"></i>

    <span>
      Identity
    </span>
    </div>
    <p>
      30 files
    </p>
  </div>

  <div class="Education">
    <div class="edu">
      <i class="bi bi-mortarboard-fill"></i>
      <span>
        Education
      </span>
    </div>
     <p>
    28 files
  </p>
  </div>

  <div class="certificates">
    <div class="cer">
      <i class="bi bi-patch-check-fill"></i>
      <span>
        Certificates
      </span>
    </div>
    <p>
      22 files
    </p>
  </div>

  <div class="images">
   <div class="img">
    <i class="bi bi-image"></i>
    <span>
      Images
    </span>
   </div>
   <p>
    12 files
   </p>
  </div>
 
</div>





</section>



</div>
</body>
</html>