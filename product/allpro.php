<?php
if(!(include '../layout/index.php')){
    echo "Error Connecting to header file";
    die();
}

if(htmlspecialchars(isset($_GET['company']))){
    $company=  htmlspecialchars($_GET['company']);
    $query='select * from headphone where company= :company';
    $bindings=array('company'=>$company);
    
    $query2='select * from home_comp where name= :company';
    $bindings2=array('company'=>$company);
    
    $conn1=new db();
    $link1=$conn1->connect($config['db_name'], $config['db_user'], $config['db_pass']);
    $handle1=$conn1->execute($link1,$query2,$bindings2);
    $res1=$handle1->fetchall(PDO::FETCH_NUM);
    $link_of_company=$res1[0][4];
    $wid_of_company=$res1[0][5];
}
else{
    $bindings=NULL;
    $query='select * from headphone';
}
/* css in signup.css
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="sidebar_container">
    <div class="sidebar">
    <h3>By Company</h3>
        <ul>
            <?php
            $conn=new db();
            try {

             if(!($link=$conn->connect($config['db_name'], $config['db_user'], $config['db_pass']))){
                 throw new Exception('Something bad');
             }

            $handle=$conn->execute($link,'select name from home_comp');
            $result=$handle->fetchall(PDO::FETCH_ASSOC);
            $count=  count($result);
             } catch (Exception $exc) {
                    echo $exc->getTraceAsString();
                    die();
            }

            for($i=0;$i<$count;$i++) {
                $urlforcomp='./allpro.php?company='.$result[$i]['name'];
                echo "<a href=$urlforcomp style='color:inherit;text-decoration:none;'><li style='padding: 2px;'>".$result[$i]['name'].'</li></a>'; 
            }
            unset($link);
            unset($conn);
            unset($handle);
            unset($result);
            ?>
        </ul>
    </div>

    <?php if(htmlspecialchars(isset($_GET['company']))){ ?>
    <div class="twitter">
        <a data-chrome="nofooter noheader noscrollbar" data-border-color="#827f7f" data-theme="dark" height="400px" width="110%" class="twitter-timeline" href="<?=$link_of_company?>" data-widget-id="<?=$wid_of_company?>" >Tweets</a>
            </div>
    <?php }
    ?>

    <div class="signup_form" id="show_pro_info">
    <?php
        $connection=new db();
        $link_signup=$connection->connect($config['db_name'], $config['db_user'], $config['db_pass']);
        $handle_signup=$connection->execute($link_signup,$query,$bindings);
        $res=$handle_signup->fetchall(PDO::FETCH_FUNC,'print_pro');
        if(empty($res)){
                echo '<b>Out Of Stock</b>';
            }
        function print_pro($id,$desc,$name,$company,$type,$price,$time) { 
            $url="pro_page.php?id=$id";
            $path=  '../Img/prod/'.$company."/".strtr($name, array(' '=>'_')).'.jpg';
            include '../php/show_data.php'; 
    ?>
    </div>
        <?php
    }

        echo '</div>';
        ?>
    
</div>    
    <?php
include '../footer.php';
?>
 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";js.src = "https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>        
