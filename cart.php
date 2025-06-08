<?php
require_once 'includes/session.php';
require_once 'config/database.php';
require_once 'includes/cart_functions.php';

// Get cart items
$cart_items = getCartItems();
$cart_total = getCartTotal();
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
    <title>Shopping Cart - Furniture</title>

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
        .cart-section {
            padding: 80px 0;
        }
        .cart-table {
            margin-bottom: 30px;
        }
        .cart-table th {
            background-color: #f8f9fd;
            color: #5f5b57;
            font-weight: 500;
            text-transform: uppercase;
            padding: 15px;
        }
        .cart-table td {
            vertical-align: middle;
            padding: 15px;
        }
        .cart-product-img {
            width: 100px;
            height: auto;
        }
        .cart-quantity {
            width: 120px;
        }
        .cart-actions {
            text-align: right;
        }
        .cart-summary {
            background-color: #f8f9fd;
            padding: 20px;
            border-radius: 5px;
        }
        .cart-summary h3 {
            margin-bottom: 20px;
            color: #5f5b57;
        }
        .cart-summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .cart-summary-total {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }
        .btn-continue {
            background-color: #5f5b57;
            color: #fff;
        }
        .btn-continue:hover {
            background-color: #4a4745;
            color: #fff;
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
                                    <?php if (count($cart_items) > 0): ?>
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
                                            <button class="btn-cart pull-right" onclick="window.location.href='index.php'">shop now</button>
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
                            <li><a href="products.php">products</a></li>
                            <li class="active"><a href="cart.php">cart</a></li>
                            <li><a href="#">contact</a></li>
                        </ul><!--/.nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!--/.container-->
            </nav><!--/nav-->
            <!-- End Navigation -->
        </div><!--/.header-area-->
    </div><!-- /.top-area-->
    <!-- top-area End -->

    <!-- Cart Section Start -->
    <section class="cart-section">
        <div class="container">
            <div class="section-header">
                <h2>Shopping Cart</h2>
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

            <?php if (count($cart_items) > 0): ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="cart-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="cart-product-img">
                                                    <div class="ml-3">
                                                        <h4><?php echo $item['name']; ?></h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                                            <td>
                                                <form action="process/update_cart.php" method="post">
                                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                                    <div class="cart-quantity">
                                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control">
                                                    </div>
                                                    <button type="submit" name="update" class="btn btn-sm btn-primary mt-2">Update</button>
                                                </form>
                                            </td>
                                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                            <td>
                                                <form action="process/update_cart.php" method="post">
                                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                                    <button type="submit" name="remove" class="btn btn-sm btn-danger">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-actions">
                            <a href="process/clear_cart.php" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to empty your cart? This action cannot be undone.');"><i class="fa fa-trash"></i> Empty Cart</a>
                            <a href="index.php" class="btn btn-continue btn-lg">Continue Shopping</a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="cart-summary">
                            <h3>Cart Summary</h3>
                            <div class="cart-summary-item">
                                <span>Subtotal:</span>
                                <span>$<?php echo number_format($cart_total, 2); ?></span>
                            </div>
                            <div class="cart-summary-item">
                                <span>Shipping:</span>
                                <span>Free</span>
                            </div>
                            <div class="cart-summary-item cart-summary-total">
                                <span>Total:</span>
                                <span>$<?php echo number_format($cart_total, 2); ?></span>
                            </div>
                            <div class="mt-4">
                                <a href="#" class="btn btn-cart btn-block">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center">
                    <h3>Your cart is empty</h3>
                    <p>Looks like you haven't added any products to your cart yet.</p>
                    <a href="index.php" class="btn btn-cart mt-3">Continue Shopping</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Cart Section End -->

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
