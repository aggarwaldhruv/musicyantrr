<?php
include '../layout/index.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$error=FALSE;
if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
    $email=  htmlspecialchars($_POST['email']);
    $pass=  htmlspecialchars(md5($_POST['pass']));
    $error=true;
    $connect = new db();
    $link= $connect->connect('earphone_db', htmlspecialchars($config['db_user']), htmlspecialchars($config['db_pass']));
    $query="select name,email,pass from member_db where email = :email and pass= :pass limit 1";
    $handle=$connect->execute($link, $query,array('email'=>$email,'pass'=>$pass));
    $result = $handle->fetchAll(PDO::FETCH_ASSOC);

    if(count($result)==1)
    {
    $_SESSION['user']=$result[0]['name'];
    header('location:../homepage/index.php');
    }
    else{
        $err='Wrong Username Password';
    }
}
$action = htmlspecialchars($_SERVER['PHP_SELF']);
    
?>

<div class="login_form">
    <form action="<?=$action?>" method="post">
    <fieldset style="margin: 10px;">
        <legend style="text-align: center;">Login</legend>
    <table>
        <tr>
            <td>
                <label>Email </label></td><td>:</td><td> <input type="email" name="email"  placeholder="Enter Email"></td> 
        </tr>
        <tr>
            <td><label>Password  </label></td><td>:</td> <td><input type="password" name="pass"  placeholder="Enter Password"></td>
        </tr>
        <tr id="login_button">
            <td>
            </td>
            <td>

            </td>
            <td>
                <input type="reset" name="Reset" value="Reset">
                <input type="submit" name="Submit" value="Login">
            </td>
        </tr>
        <caption class="error">
                    <?php
                    if ($error == TRUE) {
                        echo $err;
                    }
                    ?>
                </caption> 
    </table>
    </fieldset>
</form>
    </div>
<?php include '../footer.php';
