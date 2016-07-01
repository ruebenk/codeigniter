<?php include("header.php") ?>
 				<div style="position:absolute; top:20%;">
				<?php
				foreach($ques as $as)
					foreach($as as $a){
					?>
					 <tr>
						 <td><?php echo $a->Q_Id; ?></td>
						 <?php if($sess):?>
						 <td><a href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.$a->ans2 ?>"><?php echo $a->Title; ?></a></td>
					 <?php else:?>
						<td><a href="/Home/quesdetail/<?php echo $a->Q_Id.'/'.$a->ans.'/'.-1 ?>"><?php echo $a->Title; ?></a></td>
						 <?php endif;?>
						 <td><?php echo $a->Description;?></td>
						 <td><?php echo $a->ans?></td>
						 <?php if($sess):?>
						 <td>	<form action="/Home/answer/<?php echo $a->Q_Id; ?>" method="POST">
		 				<input type="text" name="Answer"><br>
		 				<input type="submit" value="Reply">
		 				</form></td>
						<td>	<form action="/Home/followques/<?php echo $a->Q_Id; ?>" method="POST">
					<?php if(! $a->ans2):?>
					 <input type="submit" name='Follow' value="Follow">
				  <?php else:?>
				  <input type="submit" name='Unfollow' value="Unfollow">
					<?php endif; ?>
					 </form></td>
				 <?php endif;?>
					 </tr>
					 <?php }?>
	      </div>
<php? include("footer.php") ?>
