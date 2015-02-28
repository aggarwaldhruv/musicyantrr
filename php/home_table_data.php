<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
try {
    
    $connection = new db();
    if(empty($connection)){
        throw new Exception;
    }
    $link= $connection->connect('earphone_db', $config['db_user'], $config['db_pass']);
    if(empty($link)){
        throw new Exception;
    }
    $handle= $connection->execute($link,'Select * from home_comp limit 5');
    if(empty($handle)){
        throw new Exception;
    }  
    $result1= $handle->fetchall(pdo::FETCH_ASSOC);
    if(empty($result1)){
        throw new Exception;
    }
    $count= count($result1);
    if(empty($count)){
        throw new Exception;
    }
    for($i=0 ; $i < $count ; $i++)
    {
        echo '<tr>';
        $url="../product/allpro.php?company=".$result1[$i]['name'];
        echo '<td>'."<a href=$url>".'<img src="../'.$result1[$i]['logo'].'"></a></td>';
        $text=  substr($result1[$i]['desc'], 0,320);
        echo "<td><h2>".$result1[$i]['name']."</h2><p>" .$string = substr($text, 0, strrpos($text, ' ')) .'...</p></td>';
    }
    
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    die();
    
}
