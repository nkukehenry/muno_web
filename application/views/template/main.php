<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo SYS_NAME; ?></title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <?php include('includes/css.php'); ?>

</head>
<!-- Menu horizontal fixed layout -->

<body class="horizontal-fixed">

    <!--top menu bar and others here -->

     <?php include('includes/top-menu.php'); ?>

    <!-- Main-body start -->
    <div class="main-body" >
        <div class="page-wrapper">
            <!-- Page header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4><?php echo ($title)?$title:''; ?></h4>                    
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item" style="border: 1px grey solid; padding: 5px; border-radius: 4px;"><a href="#!">
                            <small >
                                <?php $this->load->view('template/location', array('location' => $location)); //load location ?>
                           </small>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">

                 

                    <div class="col-lg-12">
                        <!-- Default card start -->
                        <div class="card">                            
                            <div class="card-block">
                                
        <?php isset($data) ? $this->load->view($content, $data) : $this->load->view($content); ?>

                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- Page body end -->
        </div>
    </div>
    <!-- Main-body end -->
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
   <?php include('includes/js.php'); ?>
</body>

</html>
