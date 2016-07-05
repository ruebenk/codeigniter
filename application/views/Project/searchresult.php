<?php include("header.php") ?>
      <div style="position:absolute; top:20%;">
        <?php $o=0;?>
      <?php foreach($ques as $as)
        foreach($as as $a){ ?>
       <div style="margin-left:40px; margin-top:20px;">
             <?php if($sess):?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id;?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="#">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
                </b>
             <?php else:?>
                <b style="font-size:25px;"><a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>"><?php echo $a->Title; ?></a></b>
             <?php endif;?>
             <?php
                foreach ($tags[$a->Q_Id] as $x) { ?>
                  <p class='tag' style='display:none background:#8D623D;'><a style="color:white;" href="/Home/tagdetail/<?php echo $x->T_Id;?>/<?php echo $x->T_Name;?>"><?php echo $x->T_Name; ?></a></p>
             <?php }
             ?>
             <br><br>
             <p><?php echo $a->Description;?></p>
             <br><br>
             <?php if($a->ans>0)
              if($ans[$o]->Q_Id==$a->Q_Id)
             {echo $ans[$o]->Q_Id;
               echo $ans[$o]->Answer;
               echo $ans[$o]->Name;
             }   $o=$o+1;?>

       </div>
      <?php }?>
    </div>
<?php include("footer.php") ?>
