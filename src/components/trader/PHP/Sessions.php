<?php
    include('./connectSession.php');

    if(isset($_SESSION['user'])){
        header('Location:./TraderDashboard.php');

    }else{
        include('./TraderLogin.php');
        if(isset($_SESSION['error'])){
            echo("<br>" .$_SESSION['error']);          
        }      
    }
?>