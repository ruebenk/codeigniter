<?php include("header.php") ?>
      <div style="position:absolute; top:20%;">
      <?php $i=0; foreach($ques as $a){ ?>
      <div style="margin-left:40px; margin-top:20px;">
             <?php if($sess):?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.$a->ans2 ?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.$a->ans2 ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
                </b>
             <?php else:?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.-1 ?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.-1 ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
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
             }   $o=$o+1;?>

             <?php if($sess):?>
                      <form action="Home/answer/<?php echo $a->Q_Id; ?>" method="POST">
                        <textarea name="Answer" style="width:440px; height:100px;"></textarea><br>
                        <input type="submit" value="Reply">
                      </form>
                      <form action="Home/followques/<?php echo $a->Q_Id; ?>" method="POST">
                      <?php if(! $a->ans2):?>
                          <input type="submit" name='Follow' value="Follow">
                      <?php else:?>
                          <input type="submit" name='Unfollow' value="Unfollow">
                      <?php endif; ?>
                      </form>
            <?php endif;?>
       </div>
      <?php }?>
    </div>
<?php include("footer.php") ?>
