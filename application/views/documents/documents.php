<!-- Start  -->
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
<link rel="stylesheet" href="<?= base_url('assets/documents.css?v=' . time()); ?>">
  <title>Documents LifeVault</title>

  <link rel="stylesheet" href="<?= base_url('assets/react/index-Dykytf2W.css') ?>">


</head>
<body>
<div class="doc-layout">
  <!-- Parent div -->
    <?php  $this->load->view('templates/sidebar'); ?> 

    <!-- Child 1 -->

    <section class="contents">
      <!-- Child 2 -->
    <div class="docs">
      <div class="text-docs">
        <h4>
          Documents
        </h4>
        <p>
          All your important documents in one place.
        </p>
      </div>
      <div class="container-button">
        <div class="document-upload">
          <button class="btn">
            <div class="dis">
            <span>
              +
            </span>
            <h4>
              Upload Document
            </h4>
            </div>
          </button>
        </div>
         
        </div>
      </div>
      <div class="search">
        <div class="combine">
     <form class="flex">
      <input class="form-control me-2" type="search" placeholder="Search documents" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    
    <select class="selection">
      <option>
        All Categories
      </option>
      <option>
     Identity
      </option>
      <option>Education</option>
      <option>Personal</option>
      <option>
        Certifications
      </option>
      <option>
        Images
      </option>
      <option>
        Finance
      </option>
      <option>
        Medical
      </option>
      <option>
        Government
      </option>
      <option>
        Others
      </option>
      
    </select>
    <select class="sort">
      <option>
        Sort by:
      </option>
      <option>
        Newest First
      </option>
      <option>
        Oldest First
      </option>
      <option>
        Name (A-Z)
      </option>
      <option>
        Name (A-Z)
      </option>
      <option>
        Largest File
      </option>
      <option>
        Smallest File
      </option>
      <option>
        Recently Updated
      </option>
    </select>
        </div>
      </div>

  <div class="row">
        <div class="col-md-3 pdf-doc">
<div class="pdf-card">
  <div class="middle-menu">
    

<a href="#">
  <i class="bi bi-three-dots-vertical"></i>
</a>

  </div>
  <div class="pdf">
    <i class="bi bi-file-earmark-pdf"></i>
  </div>
  <div class="text-field">
    <span>
      10th_Certificate.pdf
    </span>
  </div>

  <div class="education">
    <span>Education</span>
    <p>
  20 May,2025
    </p>

    <h6>
      2.4 MB
    </h6>
  </div>
      
        
        </div>
      </div>
      
 


 
      
  

    
    </section>
</div>
<script type="module" src="<?= base_url('assets/react/index-B4rf5qx8.js') ?>"></script>
</body>
</html>