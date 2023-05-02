<?php
include('./connect.php');
 /*Check if form is submitted*/
 if(isset($_POST['TraderLoginSubmit'])){
    /*Check if all fields are filled*/ 
    if (empty($_POST['TraderLoginUsername']) || empty($_POST['TraderLoginPassword'])){
        header('Location:./TraderLogin.php?error=Please make sure all text fields are not empty.');
    }
    else{
        $TraderLoginUsername = trim(filter_input(INPUT_POST, 'TraderLoginUsername', FILTER_SANITIZE_STRING));
        $TraderLoginPassword = trim(filter_input(INPUT_POST, 'TraderLoginPassword', FILTER_SANITIZE_STRING));
        $TraderRole="Trader";
        /*Check if username is of 5-10 characters*/
        if(strlen($TraderLoginUsername) >= 5 && strlen($TraderLoginUsername) <= 10){
                $passwordPattern = '/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,10}$/';
                /*Check if password has 6 - 10 characters, 1 Uppercase, 1 Lowercase, 1 Number and 1 Special Character.*/
                if(preg_match($passwordPattern, $TraderLoginPassword))
                    {
                        //Gather detail submitted from POST and store 
                        $query = "SELECT * FROM USER_TABLE WHERE ROLE =:TraderRole AND USERNAME =:TraderLoginUsername AND PASSWORD =:TraderLoginPassword";
                        $result = oci_parse($conn, $query);
                        oci_bind_by_name($result, ':TraderLoginUsername', $TraderLoginUsername);
                        oci_bind_by_name($result, ':TraderRole', $TraderRole);
                        oci_bind_by_name($result, ':TraderLoginPassword', $TraderPassword);
                        oci_execute($result);
                        if(oci_num_rows($result) > 0){
                            $_SESSION['user'] = $TraderLoginUsername;
                        }else{
                            $_SESSION['error'] = "User not recognised";
                        }
                        
                        header('Location:./Sessions.php');

                    }
                else
                    {
                        header('Location:./TraderLogin.php?error=Please enter a valid password.');
                    }
            }
            else{
                header('Location:./TraderLogin.php?error=Please enter a valid username.');

            }
        }
    }
?>