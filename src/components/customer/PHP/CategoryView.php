<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop The Hudd</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel = "icon" href = "./../../../dist/public/logo.png" sizes = "16x16 32x32" type = "image/png">
    <link rel="stylesheet" href="./../../../dist/CSS/bootstrap.css">
    <link rel="stylesheet" href="../CSS/product.css" />
  </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <?php
            include('./connect.php');
            if(isset($_GET['user']) && isset($_GET['category'])){
                $user = $_GET['user'];
                $productCategory = $_GET['category'];
            }
        ?>
        <!--NavBar-->
        <div class="topbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-my-custom-color bg-success">
            <div class="container-fluid">
                <?php echo("<a class='navbar-brand' href='./CustomerSession.php?user=$user'>"); ?>
                    <img src="./../../../dist/public/logo.jpg" class="img-fluid rounded-circle img-thumbnail" width="80" height="70" alt="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item me-5">
                            <?php echo("<a class='nav-link mr-3 text-light' aria-current='page' href='./CustomerSession.php?user=$user'>HOME</a>"); ?>
                        </li>

                        <li class="nav-item dropdown me-5"><!---->
                            <a class='nav-link mr-3 dropdown-toggle text-light' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                SHOP
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php echo("<li><a class='dropdown-item text-success' href='./Categories.php?user=$user'>CATEGORY</a></li>"); ?>
                            </ul>
                        </li>

                        <li class="nav-item me-5">
                        <?php echo("<a class='nav-link mr-3 text-light' href='./Sale.php?user=$user'>SALE</a>"); ?>

                        </li>

                        <li class="nav-item me-5">
                            <?php echo("<a class='nav-link mr-3 text-light' href='./About.php?user=$user'>ABOUT</a>"); ?>
                        </li>

                        <li class="nav-item me-5">
                            <?php echo("<a class='nav-link mr-3 text-light' href='./Contact.php?user=$user'>CONTACT</a>"); ?>
                        </li>
                    </ul>

                    <ul class="d-flex mb-2 mb-lg-0 list-unstyled">
                        <li class="nav-item me-3">
                        <?php echo("<a class='nav-link' href='./ShopNow.php?user=$user'><i class='fa-solid fa-magnifying-glass fa-lg text-white'></i></a>"); ?>
                        </li>
                        <li class="nav-item me-3">
                            <?php echo("<a class='nav-link' href='./WishList.php?user=$user'><i class='fa-regular fa-heart fa-lg text-white'></i></a>"); ?>
                        </li>

                        <li class="nav-item dropdown me-3">
                            <a class='nav-link' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class="fa-regular fa-user fa-lg text-white"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php echo ("<li><a class='dropdown-item text-success' href='./ProfilePage.php?user=$user'>Manage Profile</a></li>")?>
                                <li><hr class="dropdown-divider"></li>
                                <?php echo ("<li><a class='dropdown-item text-success' href='./MyOrders.php?user=$user'>My Orders</a></li>");?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-success" href="./CustomerLogout.php">Log Out</a></li>
                            </ul>
                        </li>
                        <li class="nav-item me-5">
                            <?php echo("<a class='nav-link' href='./Checkout.php?user=$user'><i class='fa-solid fa-cart-shopping fa-lg text-white' ></i></a>"); ?>
                        </li>
                        
                    </ul>

                </div>
            </div>
        </nav>
    </div>
  <section class="product_page">
    <div class = "container mt-5">&nbsp;</div>
    <div class = "container mt-5">&nbsp;</div>
    <?php echo ("<h2 class='product_page--title mt-5 text-success'>"); echo(strtoupper($productCategory)); echo(" PRODUCTS</h2>") ?>
    <div class = "container mt-5">&nbsp;</div>
    <div class = "container mt-5">&nbsp;</div>
    <div class = "container mt-5">&nbsp;</div>
    
    <div class = "container-fluid p-5">
        <div class="row row-cols-1 row row-cols-md-2 row-cols-xl-4 g-2 ">
            <?php
                $queryCategory = "SELECT * FROM CATEGORY WHERE CATEGORY_NAME = '$productCategory'";
                $resultCategory = oci_parse($conn, $queryCategory);
                oci_execute($resultCategory);

                while($row = oci_fetch_array($resultCategory, OCI_ASSOC)){
                    $categoryid = $row['CATEGORY_ID'];
                }
                
                
                if(!empty($categoryid)){
                    $query = "SELECT * FROM PRODUCT WHERE CATEGORY_ID = '$categoryid'";
                    $result = oci_parse($conn, $query);
                    oci_execute($result);
                    while($row = oci_fetch_array($result, OCI_ASSOC)){
                        $id = $row['PRODUCT_ID'];
                        $name = ucwords($row['PRODUCT_NAME']);
                        $categoryId = $row['CATEGORY_ID'];
                        $shopId = $row['SHOP_ID'];
                        $categoryName = $row['CATEGORY_NAME'];
                        $productImage = $row['PRODUCT_IMAGE'];
                        $productName = $row['PRODUCT_NAME'];
                        $productDescription = $row['PRODUCT_DESCRIPTION'];
                        $productPrice = $row['PRODUCT_PRICE'];
                        $productStock = $row['PRODUCT_STOCK'];
                        echo("<div class='col p-5'>");
                        echo("<div class='card bg-light'>");
                        echo("<a class = 'text-decoration-none color-gray' href = './ProductDetail.php?user=$user&id=$id&name=$productName&description=$productDescription&image=$productImage&price=$productPrice&stock=$productStock'>
                            <img src='./../../../dist/public/TraderItemImages/$row[PRODUCT_IMAGE]' class='card-img-top' alt='...' 
                            
                            style='width:100%;
                            height:17vw;
                            object-fit:cover;'>");//or use contain here
                        echo("<div class='card-body'>");
                        echo("<div class = 'row'>            
                        <h3 class='card-title text-dark'>$name</h3>
                    </div>
                    <div class = 'row'>
                        <h3 class='card-title text-success' > &pound;$row[PRODUCT_PRICE]</h3>
                    </div>");
                        // echo("<p class='card-text'>$row[PRODUCT_DESCRIPTION]</p>");              
                        echo("</div></a>");            
                        echo("<div class='d-flex flex-row flex-wrap p-2 align-self-center w-100'>");
                        echo("<a class='#add-to-cart'></a>");   //section of page to be redirected when header is passed            
                        echo("<a class='btn btn-productsize btn-success border border-dark w-50' 
                        href='./CartProducts.php?user=$user&id=$id&image=$productImage&name=$productName&description=$productDescription&price=$productPrice&quantity=1' 
                        role='button'>
                        <img src = './../../../dist/public/cart2.svg'
                        style='filter: invert(100%) sepia(0%) saturate(7482%) hue-rotate(83deg) brightness(97%) contrast(109%);'
                         alt = 'cart2'/></a>
                        ");                
                        echo("<a class='btn btn-productsize btn-success border border-dark w-50' 
                        href='./WishListProducts.php?user=$user&id=$id&image=$productImage&name=$productName&description=$productDescription&price=$productPrice&quantity=1' 
                        role='button'>
                        <img src = './../../../dist/public/heart2.svg' 
                        style='filter: invert(100%) sepia(0%) saturate(7482%) hue-rotate(83deg) brightness(97%) contrast(109%);'
                        alt = 'cart2'/></a>
                        ");               
                        echo("</div>");
                        echo("</div>");
                        echo("</div>");
                    }
                }
                else{
                    echo("<div class='col-12 p-5'>");
                    echo("<div class='alert alert-danger text-center' role='alert'>No Products Found</div>");
                    echo("</div>");
                    
                }

            ?>
        </div>
    </div>
    
  </section>
       <!--footer-->
       <footer class="mt-5">
        <div class="container-fluid bg-success" style="color: white;">
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <div class="col mt-2 text-center">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <h3 class="mt-5">Cleck Cart</h3>
                            <h5 class="mt-4">Satisfy your cravings, with local farm savings.</h5>
                            <h6>&#169; 2023 CleckCart. All rights reserved.</h6>
                        </div>
                        <div class="d-flex flex-row flex-wrap p-2 align-self-center">
                            <a class="nav-link p-3" href="https://twitter.com/" target="_blank"><i class="fa-brands fa-twitter fa-2xl" style="color: #ffffff;"></i></a>
                            <a class="nav-link p-3" href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook fa-2xl" style="color: #ffffff;"></i></a>
                            <a class="nav-link p-3" href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram fa-2xl" style="color: #ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col mt-2 text-center">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <h3 class="mt-5">Join Us</h3>
                            <a href="./../../trader/PHP/TraderRegisterPage.php" class='text-decoration-none text-light' target="_blank"><h5 class="mt-5">Sell on CleckCart</h5></a>
                            <a href="./../../guest/PHP/Register.php" class='text-decoration-none text-light' target="_blank"><h5 class="mt-3">Buy from CleckCart</h5></a>
                        </div>
                    </div>
                </div>
                <div class="col mt-2 text-center">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <h3 class="mt-5">Help</h3>
                            <?php echo("<a href='./Contact.php?user=$user' class='text-decoration-none text-light' target='_blank'><h5 class='mt-4 mb-3'>Contact Us</h5></a>"); ?>
                            <a href="#" class='text-decoration-none text-light'><h5 class="mb-3">Back to top</h5></a>
                            <a class='text-decoration-none text-light' target="_blank"><h5 class="mb-3">Opens From<br> 10:00 - 19:00</h5></a>
                        </div>
                    </div>
                </div>
                <div class="col mt-2 text-center">
                    <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight">
                            <h3 class="mt-5">Send Us a message</h3>
                        </div>
                        <div class="p-2 bd-highlight text-center">
                            <a class="nav-link text-reset text-decoration-none"><i class="fa-solid fa-location-dot fa-xl" style="color: #ffffff;"></i>&nbsp;Cleckhuddersfax, UK </a>
                            <a class="nav-link text-reset text-decoration-none"><i class="fa-solid fa-phone fa-xl" style="color: #ffffff;"></i>&nbsp;01632 960315 </a>
                            <a class="nav-link text-reset text-decoration-none" href="https://mail.google.com/?" target="_blank"><i class="fa-regular fa-envelope fa-xl" style="color: #ffffff;"></i>&nbsp;cleckcart@gmail.com </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
<script src="app/js/script.js"></script>
</body>
</html>