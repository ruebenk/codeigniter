<?php include("header.php") ?>
      <img  style="position:absolute; top:22%; left:4.5%; width:200px; height:200px; border-radius:50%" src="<?php echo base_url(); ?>uploads/<?php echo $obj["pic"];?>">
      <div style="position:absolute; left:3%; top:57%;">

        <b style="font-size:30px; color:#8D623D;"><?php echo $obj['Name'];?></b><br><br>
        <p style="color:#8D623D;"><?php echo $obj["Email"];?></p><br>
        <p style="color:#8D623D;"><?php echo $obj["Mobile"];?></p><br>

      </div>
      <div class="left_col" style="position:absolute; left:3%; top:73%;">
        <?php
        if($isfollowed!=-1):
          if(! $isfollowed):
           $t="Follow";
          else:
           $t="Unfollow";
          endif;
          ?>
        <input type="button" onclick="chngfollowonuser(<?php echo $obj["Id"]; ?>)" id="user" value="<?php echo $t;?>" >
        <?php endif; ?>
        <br><br>
          <a href="/<?php echo 'Home/followers/'.$obj["Id"];?>" style="color:#8D623D;"><?php echo $obj["followers"]; echo " ";?>Followers</a><br><br>
  				<a href="/<?php echo 'Home/follows/'.$obj["Id"];?>" style="color:#8D623D;"><?php echo $obj["follows"]; echo " ";?>Following</a><br><br>
          <a href="/<?php echo 'Home/tags/'.$obj["Id"];?>" style="color:#8D623D;"><?php echo $obj["interest"];?>Tags Following</a><br><br>
          <a href="/<?php echo 'Home/quesposted/'.$obj["Id"];?>" style="color:#8D623D;"><?php echo $obj["ques_posted"];?>Questions Posted</a><br><br>
          <a href="/<?php echo 'Home/quesfollowing/'.$obj["Id"];?>" style="color:#8D623D;"  ><?php echo $obj["ques_followed"];?>Questions Following</a><br>
  		</div>


<?php include("footer.php") ?>
