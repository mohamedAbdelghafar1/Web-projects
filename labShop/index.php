
        <?php
// First establish the database connection
$link = mysqli_connect("localhost", "root", "", "feedback");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}

// Process form submission
if (isset($_POST['save'])) {
    $firstName = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $message   = $_POST['message'];

    // Security improvement: prevent SQL injection
    $firstName = mysqli_real_escape_string($link, $firstName);
    $lastName = mysqli_real_escape_string($link, $lastName);
    $email = mysqli_real_escape_string($link, $email);
    $phone = mysqli_real_escape_string($link, $phone);
    $message = mysqli_real_escape_string($link, $message);

    $result = mysqli_query($link, "INSERT INTO users (`firist_name`, `last_name`, `email`, `messege`, `phone`)
            VALUES('$firstName', '$lastName', '$email', '$message', '$phone')");
    
    if ($result) {
        echo "<div class='alert alert-success'>Data saved successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($link) . "</div>";
    }
    mysqli_close($link);
}
if (isset($_POST['edit'])) {
    $firstName = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $message   = $_POST['message'];

    $stmt = mysqli_prepare($link, "UPDATE users SET firist_name=?, last_name=?, messege=?, phone=? WHERE email=?");
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $message, $phone, $email);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        echo "<div class='alert alert-success'>Data edited successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($link) . "</div>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
if (isset($_POST['delete'])) {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $result = mysqli_query($link, "DELETE FROM users WHERE email = '$email'");
    if ($result) {
        echo "<div class='alert alert-success'>Data deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($link) . "</div>";
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabShop</title>
    <link rel="shortcut icon" href="../coffe_project/Uploads/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <img src="uploads\logo.png" style="width: 50px;">
            <span style="font-size: 1.1em;color: #f3f3f3;font-weight: 700;">Lab-shop</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto mb-2 ">
                    <li class="nav-item">
                        <a class="nav-link active  " aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">Portfolio</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="https://support.hp.com/us-en/product/product-specs/hp-elitebook-840-g5-notebook-pc/model/18491275"
                                    target="_blank" style="color: black;">HP EliteBook 840 G5</a></li>
                            <li><a class="dropdown-item"
                                    href="https://www.bing.com/search?q=Mate+Book+X+Pro+2022&FORM=HDRSC1"
                                    target="_blank" style="color: black;">Huawei MateBook X 2022</a></li>
                            <li><a class="dropdown-item"
                                    href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                                    target="_blank" style="color: black;">Precision 5570</a></li>
                            <li><a class="dropdown-item"
                                    href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                                    target="_blank" style="color: black;">ASUS Vivobook 16</a></li>
                            <li><a class="dropdown-item"
                                    href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                                    target="_blank" style="color: black;">Lenovo IdeaPad S540</a></li>
                            <li><a class="dropdown-item"
                                    href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                                    target="_blank" style="color: black;">HP Zbook 17 </a></li>
                        </ul>
                    </li>
                    <li class="nav-item"></li>
                    <a class="nav-link " href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- nav -->
    <!-- slider -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="uploads/hawa1.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="uploads/dell1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="uploads/hp1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="uploads/asus1.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- slider -->
    <br>
    <!-- cards -->
    <div class="container text-center" ></div>
    <div class="row" id="services">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="uploads/hp1.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">HP EliteBook 840 G5 </h5>
                    <p class="card-text">Intel Core i5-8350U
                        Intel UHD Graphics 620
                        14.0”, Full HD (1920 x 1080), IPS
                        256GB SSD
                        8GB DDR4, 2400 MHz
                        1.48 kg (3.3 lbs)</p>
                    <a href="https://support.hp.com/us-en/product/product-specs/hp-elitebook-840-g5-notebook-pc/model/18491275"
                        target="_blank" class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="uploads/hawa1.png" class="card-img-top" style="height: 185px;">
                <div class="card-body">
                    <h5 class="card-title">Huawei MateBook X 2022</h5>
                    <p class="card-text">ProcessorIntel Core i7-1195G7 ,
                        Graphics adapterIntel Iris Xe Graphics G7 96EUs
                        Memory16 GB
                        , DDR4
                        Display14.20 inch , IPS, 60 Hz
                        Storage1 TB NVMe PCIe SSD</p>
                    <a href="https://consumer.huawei.com/uk/laptops/matebook-x-pro-2022-12th-gen-core/" target="_blank"
                        class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="uploads/dell1.png" class="card-img-top" style="height: 185px;">
                <div class="card-body">
                    <h5 class="card-title">Precision 5570 </h5>
                    <p class="card-text">15" workstation with 4-sided InfinityEdge display, Dell Optimizer for Precision
                        and up to 12th Gen Intel® Core™ i9 and NVIDIA RTX™ A2000 graphics..</p>
                    <a href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                        target="_blank" class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem; ">
                <img src="uploads/asus1.png" class="card-img-top ;" style="width: 232px;height: 161px;padding-left: 15px;">
                <div class="card-body">
                    <h5 class="card-title">ASUS Vivobook 16 </h5>
                    <p class="card-text">ASUS Vivobook 16" WUXGA Notebook Intel Core i7-1355U 16GB RAM 1TB SSD Indie Black - 16" WUXGA Display - Intel Core i7-1355U (Deca-Core) - 16GB RAM - 1TB SSD - Intel Iris Xe Graphics</p>
                    <a href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                        target="_blank" class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="uploads/lenovo1.png" class="card-img-top" style="height: 162px;">
                <div class="card-body">
                    <h5 class="card-title">Lenovo IdeaPad S540 </h5>
                    <p class="card-text">ProcessorIntel Core i5-8265U 4 x 1.6 - 3.9 GHz,
Graphics cardNVIDIA GeForce MX250 - GDDR5, Nvidia 217.88, Nvidia Optimus
Memory8 GB, Dual-Channel, 4 GB fest verlötet + 4 GB Module, max.</p>
                    <a href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                        target="_blank" class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="uploads/zbook1.png" class="card-img-top" style="height: 185px;">
                <div class="card-body">
                    <h5 class="card-title">HP Zbook 17 </h5>
                    <p class="card-text">processor/intel-core-i7-8850h HDD/SSD
up to 2512GB SSD + up to 2000GB HDD
RAM
up to 64GB
OS
Windows 10 Pro, Windows 10 Home
</p>
                    <a href="https://www.dell.com/en-us/shop/dell-laptops/precision-5570-workstation/spd/precision-15-5570-laptop?msockid=12578c28b71a657a024d9f99b6666443"
                        target="_blank" class="btn btn-primary">view Details</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>

<!-- Contact Section -->
<section class="contact-section py-5" style="background-color: #2e88ba;">
  <div class="container">
    <div class="row g-5">
      <!-- Map Column (Left) -->
      <div class="col-lg-6">
        <div class="contact-info">
          <div class="row row-cols-md-2 g-4 mb-4">
            <div class="col">
              <div class="bg-light p-3 h-100">
                <div class="d-flex align-items-center mb-2">
                  <i class="fa-solid fa-envelope h4 pe-2"></i>
                  <h5 class="mb-0">Email</h5>
                </div>
                <span>mohamedabdelghafar@gmail.com</span>
              </div>
            </div>
            <div class="col">
              <div class="bg-light p-3 h-100">
                <div class="d-flex align-items-center mb-2">
                  <i class="fa-solid fa-phone h4 pe-2"></i>
                  <h5 class="mb-0">Phone</h5>
                </div>
                <span>+0123456789, +9876543210</span>
              </div>
            </div>
          </div>
          
          <div class="bg-light p-3 mb-4">
            <div class="d-flex align-items-center mb-2">
              <i class="fa-solid fa-location-pin h4 pe-2"></i>
              <h5 class="mb-0">Office location</h5>
            </div>
            <span>#007, Street name, Bigtown BG23 4YZ, England</span>
          </div>
          
          <div class="map-container">
            <iframe width="100%" height="345" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                    src="https://maps.google.com/maps?width=100%&amp;height=300&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
            </iframe>
          </div>
        </div>
      </div>

      <!-- Form Column (Right) -->
      <div class="col-lg-6">
        <div class="contact-form bg-light p-4 rounded">
          <h2 class="mb-4">Leave a message</h2>
          <form action="index.php" method="post">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your firist name" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="+1234567890">
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" value="save" name="save">save</button>
            <button type="submit" class="btn btn-primary" value="edit" name="edit">Edit</button>
            <button type="submit" class="btn btn-primary" value="delete" name="delete">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

  <!-- Footer Block -->
  <footer id="site-footer">
    <div class="bg-success bg-opacity-25 py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3"><i class="fa-solid fa-user-group pe-1"></i> About us</h5>
            <span class="text-secondary">This is a wider card with supporting text below as a natural lead-in to additional content.</span>
          </div>
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3"><i class="fa-solid fa-link pe-1"></i> Important links</h5>
            <ul>
              <li><a href="#" class="text-decoration-none link-secondary">About us</a></li>
              <li><a href="#" class="text-decoration-none link-secondary">Privacy policy</a></li>
              <li><a href="#" class="text-decoration-none link-secondary">Terms of services</a></li>
            </ul>
          </div>
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3"><i class="fa-solid fa-location-dot pe-1"></i> Our location</h5>
            <span class="text-secondary">
              Milannagar bazar<br>
              Tamluk, East Medinipore, West Bengal<br>
              720001, India<br>
            </span>
          </div>
          <div class="col-md-6 col-xl-3 col-sm-12">
            <h5 class="pb-3"><i class="fa-solid fa-paper-plane pe-1"></i> Stay updated</h5>
            <form>
              <input type="text" class="w-100 mb-2 form-control" name="" placeholder="Email ID">
              <button class="w-100 btn btn-dark">Subscribe now</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-dark py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a class="btn btn-outline-secondary" href="https://www.facebook.com/me/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i class="fa-brands fa-youtube"></i></a></li>
              <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i class="fa-brands fa-twitter"></i></a></li>
              <li class="list-inline-item"><a class="btn btn-outline-secondary" href="https://www.linkedin.com/in/mohamed-ahmed-58353429b/?lipi=urn%3Ali%3Apage%3Ad_flagship3_notifications%3BI8IiiiC0QkilWjqeC9dR3w%3D%3D"><i class="fa-brands fa-linkedin-in"></i></a></li>
              <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i class="fa-brands fa-github"></i></a></li>
            </ul>
          </div>
          <div class="col-md-6 col-sm-12"><span class="text-secondary pt-1 float-md-end float-sm-start">Copyright &copy; Dev/MohamedAbdelghafar</span></div>
        </div>
      </div>
    </div>
  </footer>
    <!--contact us  -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>


