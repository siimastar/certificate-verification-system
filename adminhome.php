<?php
session_start();
if(!isset($_SESSION['admin'])){
    ?>
    <a href="./adminlogin.php">Login here</a>
    <?php
    die("You have to Login");
}
require("./conn.php");
if(isset($_POST['addcert'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $issuer = $_POST['issuer'];
    $cnumber = $_POST['cnumber'];

    $sql = "INSERT INTO cert VALUES(null,'$issuer', '$cnumber', '$name', '$email', '$phone', '')";
    $result = $conn->query($sql);
    if($result){
        ?>
    <script>
        alert("Certificate has been added successfully")
    </script>
        <?php
    }else{
        echo $conn->error;
    }
}

if(isset($_POST['verify'])){
    $cnumber = $_POST['cnumber'];
    

    $sql = "SELECT * FROM cert WHERE cnumber='$cnumber'";
    $result = $conn->query($sql);
    if($result){
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $name = $row['holdername'];
            $email = $row['holderemail'];
            $phone = $row['holderphone'];
            $issuer = $row['authority'];

            ?>
            <script>
                alert("This certificate is legit, and is owned by <?php echo $name.", phone number: ".$phone.", email: ".$email." and the issuer is ".$issuer?>");
                window.location.href="./adminhome.php";
            </script>
            <?php
        }else{
            echo "This certificate does not exist and may be fake";
        }
        
    }else{
        echo $conn->error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ADR Cert Ver</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <script src="./js/jquery-1.2.6.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">ADR certificate Verification System</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#addcert">Add certificate</a></li>
                    <li class="nav-item"><a class="nav-link" href="./index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Verify Certificate</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">ADR Online certificate Verification</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Verify certificates easily!</p>
                    <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="page-section" id="addcert">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Add Certificate</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5">Store new certificate!</p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="contactForm" method="POST" action="">
                    <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="name"
                                data-sb-validations="required,name" name="name"/>
                            <label for="email">Name</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">Name is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">name is not valid.</div>
                        </div>    
                    <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com"
                                data-sb-validations="required,email" name="email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="text" placeholder="2348169895827"
                                data-sb-validations="required" name="phone"/>
                            <label for="phone">Phone</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A password is required.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="issuer" type="text" placeholder="Certificate Issuer"
                                data-sb-validations="required" name="issuer"/>
                            <label for="issuer">Certificate issuer</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A password is required.
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="cnumber" type="text" placeholder="Certificate Number"
                                data-sb-validations="required,phone" name="cnumber"/>
                            <label for="cnumber">Certificate Number</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        
                        
                        <input class="btn btn-primary btn-xl" type="submit" value="Add Certificate" name="addcert" id="admin">
                    </form>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-4 text-center mb-5 mb-lg-0">
                    <i class="bi-phone fs-2 mb-3 text-muted"></i>
                    <div>+2348169895827</div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Verify Certificate</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5">Check for Validity!</p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form id="" action="" method="POST">
                        <!-- Phone number input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="Certificate Number"
                                data-sb-validations="required" name="cnumber"/>
                            <label for="phone">Certificate Number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A password is required.
                            </div>
                        </div>
                        
                        <input class="btn btn-primary btn-xl" type="submit" name="verify" value="Login" id="admin">
                    </form>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-4 text-center mb-5 mb-lg-0">
                    <i class="bi-phone fs-2 mb-3 text-muted"></i>
                    <div>+2348169895827</div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2021 - Sima star software</div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
