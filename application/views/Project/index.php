<?php include("header.php") ?>
      <div style="position:absolute; top:20%;">
      <?php $i=0; $o=0; foreach($ques as $a){ ?>
      <div style="margin-left:40px; margin-top:20px;">
             <?php if($sess):?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
                </b>
             <?php else:?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
                </b>
             <?php endif;?>
             &nbsp;&nbsp;&nbsp;
             <?php
                foreach ($tags[$a->Q_Id] as $x) { ?>
                  <p class='tag' style='display:none background:#8D623D;'><a style="color:white;" href="/Home/tagdetail/<?php echo $x->T_Id;?>/<?php echo $x->T_Name;?>"><?php echo $x->T_Name; ?></a></p>
             <?php }
             ?>
             <br><br>
             <p style="color:#8D623D;"><?php echo $a->Description;?></p>
             <br><br>
             <?php if($a->ans>0)
              if($ans[$o]->Q_Id==$a->Q_Id)
             {echo $ans[$o]->Q_Id;
               echo $ans[$o]->Answer;
               echo $ans[$o]->Name;
             }   $o=$o+1;
           ?>
             <?php if($sess):?>
                      <form action="Home/answer/<?php echo $a->Q_Id; ?>" method="POST">
                        <textarea name="Answer" style="width:440px; height:100px;"></textarea><br>
                        <input type="submit" value="Reply">
                      </form>
                      <form  method="POST">
                        <textarea name="Answer"  style="width:440px; height:100px;"></textarea><br>
                      <input type="button" onclick="chngrecans(<?php echo $a->Q_Id; ?>)" class="Answer" value="Reply" >
                      </form>
                      <form  method="POST">
                      <?php if(! $a->ans2): $t="Follow";?>
                      <?php else:  $t="Unfollow";?>
                      <?php endif; ?>
                      <input type="button" onclick="chngfollow(<?php echo $a->Q_Id; ?>)" class="Follow" value="<?php echo $t;?>" >
                      </form>
            <?php endif;?>
       </div>
      <?php }?>
    </div>
<?php include("footer.php") ?>
