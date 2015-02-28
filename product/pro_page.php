<?php
include '../layout/index.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (htmlspecialchars($_GET['id'])) {
$id=  htmlspecialchars($_GET['id']);    
}else {
    header('location:index.php');   
}

$connection=new db();
$link=$connection->connect($config['db_name'], $config['db_user'], $config['db_pass']);
$handle=$connection->execute($link,'select * from headphone where id= :id', array('id'=>$id));
$result=$handle->fetchall(PDO::FETCH_NUM);
?>
<div class="main_pro">
    <?php  
    $result1=$result[0];
    list($id,$desc,$name,$comp,,$price)=$result1;

    $descr=nl2br($desc);
    $desc= strtr($descr,array('<br>'=>'<li><br>'));
    $path='../Img/prod/'.$comp.'/'.strtr($name,array(' '=>'_')).'.jpg';
    ?>
    <img src="<?=$path?>" class="main_pro_img">
    <h2><?=$name?></h2>
    <h4>Price : &nbsp;&#8377; </h4><?=$price?>
    <br>
    <h4>Company : &nbsp; </h4><?=$comp?>
    <br>
    
    <h4>Description : </h4>
    <div class="main_pro_desc">    
        <?=$desc?>
    </div>
 	<br>
        <h4>Quantity : </h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <form class="main_pro_form" action="<?='../cart/index.php?id='.$id; ?>" method="post">
                <select name="select">
                    <?php for($i=1;$i<20;$i++) {
                    echo " <option value=$i>$i</option>"; }?>
                </select>
                <br><br>
                <div>
                    <button type="submit" class="buy_button">Buy</button>
                </div>
                
        
            </form>
        
</div>
<?php include "../footer.php" ?>
