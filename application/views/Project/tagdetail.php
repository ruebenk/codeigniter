<?php include("header.php") ?>
      <div style="position:absolute; top:20%;">
        <h1><?php echo $T_Name; ?></h1>
         <?php if($sess):?>
       <form  method="POST">
       <?php if(! $followed):?><?php $t="Follow";?>
       <?php else:?><?php $t="Unfollow";?>
         <?php endif; ?>
       <input type="button" onclick="chngfollowontag(<?php echo $T_Id; ?>)" id="tag" value="<?php echo $t;?>" >
       </form>
     <?php endif;?>
        <?php $o=0;?>
      <?php foreach($ques as $a){ ?>
       <div style="margin-left:40px; margin-top:20px;">
             <?php if($sess):?>
                <b style="font-size:25px;">
                  <a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id ?>"><?php echo $a->Title; ?></a>
                  <a style="color:#8D623D;" href="#">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $a->ans?>&nbsp;Answers</a>
                </b>
             <?php else:?>
                <b style="font-size:25px;"><a style="color:#EC8E40;" href="/Home/quesdetail/<?php echo $a->Q_Id?>"><?php echo $a->Title; ?></a></b>
             <?php endif;?>
             <br><br>
             <p><?php echo $a->Description;?></p>
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
                      <form  method="POST">
                      <?php if(! $a->ans2): $t="Follow";?>
                      <?php else:  $t="Unfollow";?>
                      <?php endif; ?>
                      <input type="button" onclick="chngfollowonques(<?php echo $a->Q_Id; ?>)" id="sd" value="<?php echo $t;?>" >
                      </form>
              <?php endif;?>
       </div>
      <?php }?>
    </div>
<?php include("footer.php") ?>
