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

                                
    <?php isset($data) ? $this->load->view($content, $data) : $this->load->view($content); ?>

 
   <?php include('includes/js.php'); ?>
</body>

</html>
