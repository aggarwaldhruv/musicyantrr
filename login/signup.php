<?php
include '../layout/index.php';
$connection = new db();
$link = $connection->connect($config['db_name'], $config['db_user'], $config['db_pass']);
$error = false;

if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
    
    $error = TRUE;
    $nameerr = $unameerr = $emailerr = $passerr = $re_passerr = '';

    $name = htmlspecialchars($_POST['name']);
    $uname = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $re_pass = htmlspecialchars($_POST['re_pass']);
    
    if (empty($name)) {
        $nameerr = "Missing Name <br>";
    } else
    if (empty($uname)) {
        $unameerr = "Missing Username <br>";
    } else
    if (empty($email) && filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $emailerr = "Missing Incorrect Format Of Email <br>";
    } else
    if (empty($pass)) {
        $passerr = "Missing Password <br>";
    } else
    if(strlen($pass)<6){
       $passerr='Password min length is 6 <br>';
    }else
    if ($pass != $re_pass) {
        $re_passerr = "Password Dont Match <br>";
    } else {
        try {
        $handle_check = $connection->execute($link, 'select uname , email from member_db');
        if(empty($handle_check)){
            throw new Exception;
        }
        $result_check = $handle_check->fetchall(PDO::FETCH_NUM);
        if(empty($result_check)){
            throw new Exception;
        }
        $result_count = count($result_check);   
        if(empty($result_count)){
            throw new Exception;
        } 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $username = array();
        $emailadd = array();

        for ($i = 0; $i < $result_count; $i++) {
            $username[] = $result_check[$i]['0'];
            $emailadd[] = $result_check[$i]['1'];
        }
        foreach ($username as $value) {
            if ($value == $uname) {
                $unameerr = 'Username Exist <br>';
            }
        }
        foreach ($emailadd as $value) {
            if ($value == $email) {
                $emailerr = "Email Exist <br>";
            }
        }

        if (empty($unameerr) && empty($emailerr)) {
            try {
                $handle = $connection->execute($link, 'insert into member_db(name,uname,email,pass) values(:name,:uname,:email , :pass)', array('name' => $name, 'uname' => $uname, 'email' => $email, 'pass' => md5($pass)));
                if(empty($handle)){
                    throw new Exception;
                }
                $message = "Welcome $name" . "\r\n" . "Your Username  : $uname  " . "\r\n" . "Your Password : $pass";
                $headers = 'From: admin@e&h.com' . "\r\n" . 'Reply-To: admin@e&h.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                mail($email, "Welcome to E&H", $message, $headers);

            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }

            header('location:../homepage/index.php');
        }
    }
}
$action = htmlspecialchars($_SERVER['PHP_SELF']);
?>

<div class="signup_form">
    <form action="<?= $action ?>" autocomplete="off" method="post">
        <fieldset style="margin: 10px;">
            <legend class="label">Registration Form</legend>

            <table>
                <tr>
                    <td class="label"><label for="name" class="required">Name</label> </td>
                    <td><b>:</b></td>
                    <td><input autocomplete='off' type="text" id="name" name="name" placeholder="Enter Name"></td>
                </tr>
                <tr>
                    <td class="label"><label for="uname" class="required"> Username</label></td>
                    <td><b>:</b></td>
                    <td><input autocomplete='off' type="text" id="uname" name="username" placeholder="Enter Username"></td>
                </tr>
                <tr>
                    <td class="label"><label for="email" class="required">Email Id</label> </td>
                    <td><b>:</b></td>
                    <td><input autocomplete='off' type="email" name="email" id="email" placeholder="Enter Email"></td>
                </tr>
                <tr>
                    <td class="label"><label for="pass" class="required">Password</label> </td>
                    <td><b>:</b></td>
                    <td><input autocomplete='off' type="password" name="pass" id="pass"	 placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td class="label"><label for="re_pass" class="required">Retype Password</label></td>
                    <td><b>:</b></td>
                    <td><input autocomplete='off' type="password" name="re_pass" id="re_pass" placeholder="Retype Password"></td>
                </tr>
                <tr>
                    <td class="label"><label for="mob">Mobile no</label></td>
                    <td><b>:</b></td>
                    <td><input type="tel" name="mob" id="mob" placeholder="Enter Mobile Number"></input></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="reset" name="" value="Reset">
                        <input type="submit" name="submit" value="Submit">
                    </td>
                </tr>

                <caption class="error">
                    <?php
                    if ($error == TRUE) {
                        echo $nameerr . $unameerr . $emailerr . $passerr . $re_passerr;
                    }
                    ?>
                </caption> 

            </table>

        </fieldset>
    </form>
</div>


<?php
unset($connection);
include '../footer.php';
?>
