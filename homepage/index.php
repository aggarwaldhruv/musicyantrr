<?php include '../layout/index.php';  ?>
      
        <?php $files=  scandir('../Img/tab'); 
        array_shift($files);
        array_shift($files);
        include '../php/intToWord.php';?>
   
<div id="content-slider">
      <div id="slider">  <!-- Slider container -->
         <div id="mask">  <!-- Mask -->

         <ul>
         <?php for($i=1;$i<=5;$i++){?>
         
             <li id="<?=  convertDigit($i);?>" class="<?=  convertDigit($i).'animation';?>">  <!-- ID for tooltip and class for animation -->
         <a href="#">
             <?php $path='../Img/tab/'.$files[$i-1];?><img src="<?=$path;?>" alt="Rs 500 Discount"/> </a>
         
         </li>
         <?php }?>
         </ul>

         </div>  <!-- End Mask -->
         <div class="progress-bar"></div>  <!-- Progress Bar -->
      </div>  <!-- End Slider Container -->
   </div>

<div class="table">
        <table>
                <?php include '../php/home_table_data.php'; ?>
        </table>
    </div>
<?php include '../footer.php';
