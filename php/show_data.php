
<div class="all_pro"> 
        <div class="all_pro_img">
            <img src="<?=$path?>">
            <a href="<?=$url?>"><h3>Buy Now</h3></a>
        </div>
        <div class="all_pro_text">
            <h2>
                <a href="<?=$url?>" style="text-decoration: none;color: inherit;">
                    <?=$name?>
                </a>
            </h2>
            <br>
            <h4>Price : &#8377;</h4>
            <?=$price?>
            <br>
            <h4>Description : </h4>
            <?php $desc= nl2br($desc); 
                $desc=  explode('<br />', $desc);?>
            <span style='margin:0px;display: inline'><?=$desc[0]?></span>
            <br>
            <h4>Company : </h4><?=$company?><br>
        </div>
