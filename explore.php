<?php
    $time = date(DATE_RSS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/Molybdenum/res/bootstrap.inc.php');?>
  <title>Jobs</title> 
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/Molybdenum/res/navbar.inc.php');?>
    <?php echo $time; ?>
</body>
</html>