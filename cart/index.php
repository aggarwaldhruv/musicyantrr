<?php
include('../layout/index.php');?>
	
<?php if($_SERVER['REQUEST_METHOD']!='POST'){
    
    $error= 'No Items In Cart';
}
else {
    $id=  htmlspecialchars($_GET['id']);
    $_SESSION['cart'][$id] = htmlspecialchars($_REQUEST['select']); 
    $sno = 0;
}
?>
<div class="checkout"> 
<div class="checkout_main">
    <h2>Checkout And Payment</h2>
    <table>
        <tr class="check_tr">
            <th >S.No.</th>
            <th>Item Name</th>
            <th style="">Quantity</th>
            <th style="">Price</th>
        </tr>
        <?php 
        if(!empty($error)){
            echo '</table> <div style="text-align:center;">';
            echo $error.'</div>';
        }
        else{
        $conn=new db;
        $link=$conn->connect('earphone_db',$config['db_user'],$config['db_pass']);
                foreach($_SESSION['cart'] as $id => $quantity)
                        { if($_SESSION['cart']!= null)
                            {
                            $handle=$conn->execute($link,"select name,price from headphone where Id=$id");
                            $row= $handle->fetchall(PDO::FETCH_NUM) ;

                            $count = 0;
                            $sno++;
                            list($Name,$Price)=$row[0];

                            $totalprice= (int)$Price*(int)$quantity;?>
                            <tr class="check_tr">	
                            <?php echo	"<td>$sno</td>";
                            echo	"<td>$Name</td>";
                            echo	"<td>$quantity</td>";
                            echo	"<td>$totalprice</td>";
                            echo "</tr>";				
                            }
                        }?>
    </table>
                
                
    <a href="#" class="bttn_checkout" style="float: right;">Checkout</a>
        <?php    }
        ?>
    <a href="../homepage/index.php" class="bttn_checkout" style="float:  left;">Continue Shopping</a>

</div>
</div>


<?php include('../footer.php');?>
