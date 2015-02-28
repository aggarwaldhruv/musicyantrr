<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../layout/index.php';
echo '<div style="top:50px; margin-bottom:7%; padding:10px;" class="signup_form">';


$search='%'.  htmlspecialchars($_POST['name']).'%';
$connection=new db();
$link= $connection->connect($config['db_name'], $config['db_user'], $config['db_pass']);
$bindings=array('name'=>$search);
$handle=$connection->execute($link,"select * from headphone where name like :name limit 10" ,$bindings);
$result=$handle->fetchall(PDO::FETCH_FUNC,'print_pro');

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
