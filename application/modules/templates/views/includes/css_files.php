
<?php
   //Modules::run("auth/index");
   $config =Modules::run("settings/getAll");
   $userdata= @$this->user->user_data;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $config->system_name; ?></title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL; ?>assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

  
</head>
