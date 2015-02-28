<?php
include '../layout/index.php';
/* css in signup.css
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<div style="top:50px; margin-bottom:7%; padding:10px;" class="signup_form">';

try {
    $connection=new db();
    if(empty($connection)){
        throw new Exception;
    }
    $link=$connection->connect($config['db_name'], $config['db_user'], $config['db_pass']);
    if(empty($link)){
        throw new Exception;
    }
    $handle=$connection->execute($link,'select * from headphone order by timestamp desc limit 8');
    if(empty($handle)){
        throw new Exception;
    }
    $handle->fetchall(PDO::FETCH_FUNC,'print_pro');
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
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
include '../footer.php';
