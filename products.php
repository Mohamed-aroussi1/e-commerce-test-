<?php
require_once 'includes/session.php';
require_once 'config/database.php';
require_once 'includes/cart_functions.php';

// Include product functions
require_once 'includes/product_functions.php';

// Get all products
$products = getAllProducts();
$cart_count = getCartItemCount();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- title of site -->
    <title>Products - Furniture</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!--linear icon css-->
    <link rel="stylesheet" href="assets/css/linearicons.css">

    <!--animate.css-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- bootsnav -->
    <link rel="stylesheet" href="assets/css/bootsnav.css" >

    <!--style.css-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--responsive.css-->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!--custom.css-->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .products-section {
            padding: 80px 0;
        }
        .product-card {
            margin-bottom: 30px;
            transition: all 0.3s ease;
            border: 1px solid #f1f1f1;
            border-radius: 5px;
            overflow: hidden;
        }
        .product-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        .product-img {
            position: relative;
            overflow: hidden;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fd;
        }
        .product-img img {
            max-width: 100%;
            max-height: 100%;
            transition: all 0.5s ease;
        }
        .product-card:hover .product-img img {
            transform: scale(1.05);
        }
        .product-overlay {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            background-color: rgba(233, 156, 46, 0.9);
            padding: 10px;
            transition: all 0.3s ease;
            opacity: 0;
        }
        .product-card:hover .product-overlay {
            bottom: 0;
            opacity: 1;
        }
        .product-info {
            padding: 20px;
            text-align: center;
        }
        .product-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 16px;
            color: #e99c2e;
            font-weight: 500;
        }
        .product-desc {
            margin: 10px 0;
            color: #777;
            font-size: 14px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- top-area Start -->
    <div class="top-area">
        <div class="header-area">
            <!-- Start Navigation -->
            <nav class="navbar navbar-default bootsnav navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                <!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->

                <div class="container">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <li class="search">
                                <a href="#"><span class="lnr lnr-magnifier"></span></a>
                            </li><!--/.search-->
                            <li class="nav-setting">
                                <a href="#"><span class="lnr lnr-cog"></span></a>
                            </li><!--/.search-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                                    <span class="lnr lnr-cart"></span>
                                    <span class="badge badge-bg-1"><?php echo $cart_count; ?></span>
                                </a>
                                <ul class="dropdown-menu cart-list s-cate">
                                    <?php
                                    $cart_items = getCartItems();
                                    $cart_total = getCartTotal();

                                    if (count($cart_items) > 0):
                                    ?>
                                        <?php foreach ($cart_items as $item): ?>
                                            <li class="single-cart-list">
                                                <div class="cart-item-content">
                                                    <div class="cart-product-img">
                                                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                                    </div>
                                                    <div class="cart-list-txt">
                                                        <h6><a href="#"><?php echo $item['name']; ?></a></h6>
                                                        <p><?php echo $item['quantity']; ?> x - <span class="price">$<?php echo number_format($item['price'], 2); ?></span></p>
                                                    </div>
                                                </div><!--/.cart-item-content-->
                                                <div class="cart-close">
                                                    <a href="process/remove_from_cart.php?cart_id=<?php echo $item['cart_id']; ?>" onclick="return confirm('Are you sure you want to remove this item?');">
                                                        <span class="lnr lnr-cross"></span>
                                                    </a>
                                                </div><!--/.cart-close-->
                                            </li><!--/.single-cart-list -->
                                        <?php endforeach; ?>
                                        <li class="total">
                                            <span>Total: $<?php echo number_format($cart_total, 2); ?></span>
                                            <button class="btn-cart pull-right" onclick="window.location.href='cart.php'">view cart</button>
                                        </li>
                                        <li style="text-align: center; padding: 10px;">
                                            <a href="process/clear_cart.php" class="btn btn-danger btn-sm" style="width: 100%; display: block;" onclick="return confirm('Are you sure you want to empty your cart? This action cannot be undone.');"><i class="fa fa-trash"></i> Empty Cart</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="single-cart-list text-center">
                                            <p>Your cart is empty</p>
                                        </li>
                                        <li class="total">
                                            <span>Total: $0.00</span>
                                            <button class="btn-cart pull-right" onclick="window.location.href='products.php'">shop now</button>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li><!--/.dropdown-->
                        </ul>
                    </div><!--/.attr-nav-->
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="index.php">furn.</a>
                    </div><!--/.navbar-header-->
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                            <li><a href="index.php">home</a></li>
                            <li class="active"><a href="products.php">products</a></li>
                            <li><a href="cart.php">cart</a></li>
                            <li><a href="#">contact</a></li>
                        </ul><!--/.nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!--/.container-->
            </nav><!--/nav-->
            <!-- End Navigation -->
        </div><!--/.header-area-->
    </div><!-- /.top-area-->
    <!-- top-area End -->

    <!-- Products Section Start -->
    <section class="products-section">
        <div class="container">
            <div class="section-header">
                <h2>Products</h2>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-card">
                                <div class="product-img">
                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                    <div class="product-overlay">
                                        <form action="process/add_to_cart.php" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-cart btn-block">
                                                <span class="lnr lnr-cart"></span> Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title"><?php echo $product['name']; ?></h3>
                                    <p class="product-desc"><?php echo substr($product['description'], 0, 60) . '...'; ?></p>
                                    <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            <h3>No products found</h3>
                            <p>We are updating our inventory. Please check back later.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Products Section End -->

    <!--footer start-->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="hm-footer-copyright text-center">
                <div class="footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                    &copy;copyright. designed and developed by <a href="https://www.themesine.com/">themesine</a>
                </p><!--/p-->
            </div><!--/.text-center-->
        </div><!--/.container-->

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
            </div>
        </div><!--/.scroll-Top-->
    </footer><!--/.footer-->
    <!--footer end-->

    <!-- Include all js compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/jquery.js"></script>

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- bootsnav js -->
    <script src="assets/js/bootsnav.js"></script>

    <!--owl.carousel.js-->
    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!--Custom JS-->
    <script src="assets/js/custom.js"></script>
</body>
</html>
