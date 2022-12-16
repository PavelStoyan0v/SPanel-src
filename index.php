<?php
  require "config.php";
  require "vendor/autoload.php";
  require "class/AllClasses.php";

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/template/headincludes.php"; ?>
  <title>SPanel</title>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <br>
  <div class="content-wrapper">
    <div class="container-fluid">
 <?php
   include("includes/template/nav.php");
   include("includes/template/content.php");
 ?>
</div>
</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>© SPanel.BG 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <?php include "includes/template/scripts.php" ?>
  </div>
</body>

</html>
