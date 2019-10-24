<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">

    <title>
        <?php echo $title ?> | <?php echo $description ?>
    </title>

    <!-- Bootstrap CSS -->
    <link href="/application/public/css/bootstrap.css" rel="stylesheet">

    <!-- Optional CSS -->
    <?php if(isset($css)): foreach($css as $style):?>
    <link href="/application/public/css/<?php echo $style;?>.css" rel="stylesheet">
    <?php endforeach; endif; ?>

    <!-- jQuery JS -->
    <script src="/application/public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!---->

</head>

<body>
   <a href="" id="up" name="up"></a>
    <div class="container">
        <header class="row">
            <img class="logo" src="/application/public/img/logo.png" alt="Logo">
        </header>
        <div class="content">
