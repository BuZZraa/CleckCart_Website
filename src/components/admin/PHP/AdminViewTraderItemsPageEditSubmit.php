<?php
        /*Check if form is submitted*/
        if (isset($_POST['TraderEditItemSubmit'])) {
            /*Check if all fields are filled*/ 
            if (empty($_POST['TraderEditItemName']) || empty($_POST['TraderEditItemCategory']) || empty($_POST['TraderEditItemDescription']) || empty($_POST['TraderEditItemStock']) 
            || empty($_POST['TraderEditItemPrice']) || empty($_POST['TraderEditItemDiscount'])) 
                {
                    header('Location:./AdminViewTraderItemsPage.php?error=Please make sure all text fields are not empty.');
                }

            else
                {
                    $TraderEditItemId = $_POST['TraderEditItemId'];
                    $TraderEditItemName = strtolower(trim(filter_input(INPUT_POST, 'TraderEditItemName', FILTER_SANITIZE_STRING)));
                    $TraderEditItemCategory = strtolower(trim(filter_input(INPUT_POST, 'TraderEditItemCategory', FILTER_SANITIZE_STRING)));
                    $TraderEditItemDescription = strtolower(trim(filter_input(INPUT_POST, 'TraderEditItemDescription', FILTER_SANITIZE_STRING)));
                    $TraderEditItemStock = trim(filter_input(INPUT_POST, 'TraderEditItemStock', FILTER_SANITIZE_NUMBER_INT));
                    $TraderEditItemPrice = $_POST['TraderEditItemPrice'];
                    $TraderEditItemDiscount = $_POST['TraderEditItemDiscount'];
                    $TraderEditItemImage = ($_FILES["TraderEditItemImage"]["name"]);
                    $TraderEditItemImageType = ($_FILES["TraderEditItemImage"]["type"]);
                    $TraderEditItemImageTmpName = ($_FILES["TraderEditItemImage"]["tmp_name"]);
                    $TraderEditItemImageLocation = "../../../dist/public/AdminItemImages/" . $TraderEditItemImage;
                    $alphabetPattern = "/[^a-zA-Z\s]/";
                    if(!preg_match($alphabetPattern,$TraderEditItemName))
                        {                               
                            if(!preg_match($alphabetPattern,$TraderEditItemCategory))
                                {                                                           
                                    if(filter_input(INPUT_POST, 'TraderEditItemStock', FILTER_VALIDATE_INT) == true)
                                        {
                                            if(filter_input(INPUT_POST, 'TraderEditItemPrice', FILTER_VALIDATE_FLOAT) == true)
                                                {                                                      
                                                    if($TraderEditItemImageType == "image/jpeg" || $TraderEditItemImageType == "image/jpg" || $TraderEditItemImageType == "image/png")
                                                        {
                                                            if(move_uploaded_file($TraderEditItemImageTmpName, $TraderEditItemImageLocation))
                                                                {          
                                                                    include('connect.php');                                                       
                                                                    $UpdateProductQuery = "UPDATE PRODUCT SET CATEGORY_NAME=:CategoryName, PRODUCT_IMAGE=:ProductImage, PRODUCT_NAME=:ProductName, PRODUCT_DESCRIPTION=:ProductDescription, PRODUCT_PRICE=:ProductPrice, PRODUCT_STOCK=:ProductStock WHERE PRODUCT_ID=$TraderEditItemId"; 
                                                                    $RunUpdateProductQuery = oci_parse($conn, $UpdateProductQuery);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':CategoryName', $TraderEditItemCategory);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':ProductImage',  $TraderEditItemImage);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':ProductName', $TraderEditItemName);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':ProductDescription', $TraderEditItemDescription);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':ProductPrice', $TraderEditItemPrice);
                                                                    oci_bind_by_name($RunUpdateProductQuery, ':ProductStock', $TraderEditItemStock);
                                                                    oci_execute($RunUpdateProductQuery); 
                                
                                                                    header('Location:./AdminViewTraderItemsPage.php?success=Details successfully updated.');  
                                                                }
                                                            
                                                            else
                                                                {
                                                                    header('Location:./AdminViewTraderItemsPage.php?error=Failed to upload image.');
                                                                }
                                                        }
                                                    
                                                    else
                                                        {
                                                            header('Location:./AdminViewTraderItemsPage.php?error=Please choose an image.');                                                                
                                                        }                                                    
                                                   
                                                }
                                            else
                                                {
                                                    header('Location:./AdminViewTraderItemsPage.php?error=Please type decimal numbers in product price.');
                                                }
                                        }

                                    else
                                        {
                                            header('Location:./AdminViewTraderItemsPage.php?error=Please type integer numbers in product stock.');
                                        }
                                                                           
                                }
                                                                                                             
                            else
                                {
                                    header('Location:./AdminViewTraderItemsPage.php?error=Please use alphabets only in product category.');
                                }
                            
                        }
                    else
                        {   
                            header('Location:./AdminViewTraderItemsPage.php?error=Please use alphabets only in product name.');                   
                        }
                }
            }
    ?>