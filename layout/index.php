<!DOCTYPE html>

<?php
        session_start();
        include '../php/database.php';
        include '../config/index.php';?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Buy Headphones And Earphones Online</title>
        <link rel="stylesheet" href="../css/header.css">
        <link rel="stylesheet" href="../css/body.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/login_form.css">
        <link rel="stylesheet" href="../css/signup.css">
        <link rel="stylesheet" href="../css/checkout.css">
        <link rel="stylesheet" href="../css/pro.css">
        <link rel="shortcut icon" href="../Img/fav-20140731-favicon.ico" >
        <script src="jquery-2.1.1.js"></script>
        
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="logo">
                    <a href="../homepage/index.php">
                    <img src="../Img/earphone.png" alt="Sorry">
                    <br>
                    <img src="../Img/headphone.png" alt="sorry">
            
                    </a>
                </div>
                
            <div class="search">
                <form action="../product/search.php" method="post" id="searchform" accept-charset="utf-8">
                    <input type="text" id='search_text' name="name">
                    <input type="submit" name="submit" value="Search" id='search_box'>	
                </form>
            </div>   
                <div class="nav">
                    

                    <ul>
                        <a href="../homepage/index.php" style="color: inherit">
                            <li>Home</li>
                        </a> 
                        <li>About</li>
                        <a href="../product/new_pro.php" style="color: inherit"><li>New Products</li></a>
                        <li><a href="../product/allpro.php"  style="color: inherit">
                        All Products
                        </a>        <ul>
                                <?php include '../php/drop_down_menu.php';  ?>
                                </ul>
                            </li>
                        <a style="color: inherit">
                        <li><?php if(!isset($_SESSION['user'])) {echo 'Login/Signup';} else {echo 'Logout';}?>
                          </a>  <ul>
                                <?php if(!isset($_SESSION['user'])) {
                                    echo '<a href="../login/login.php"><li>Login</li></a>';
                                
                                echo '<a href="../login/signup.php"><li>Signup</li></a>';
                                    
                                } 
                                else { 
                               echo '<li>'.  strtoupper(htmlspecialchars($_SESSION['user'])).'</li>';  
                               echo '<a href="../cart/index.php"><li>Cart</li></a>';
                               echo '<a href="../login/logout.php"><li>Logout</li></a>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="../contact/index.php" style="color:inherit;">Contact</a></li>
                        
                    </ul>
                    </div>
            </div>
   <div class="content">
       <div class="backgrnd"></div>
