<?php
  include('connect.php');
  $deleteProductId = $_GET['id'];
  if(isset($_GET['id'])&&isset($_GET['action']))
    {
      $sql = "DELETE FROM PRODUCT WHERE PRODUCT_ID = $deleteProductId";     
      $DeleteQuery = oci_parse($conn, $sql);
      oci_execute($DeleteQuery);
      header("Location:./AdminViewTraderItemsPage.php?success= Product has been deleted.");
    }
    else{
      header("Location:./AdminViewTraderItemsPage.php?error= Something went wrong. Please try again.");
    }
?>