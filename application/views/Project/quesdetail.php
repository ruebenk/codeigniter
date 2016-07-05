<?php include ("header.php")  ?>
			<div style="position:absolute; top:20%;">
			<?php foreach($ques as $a){ ?>
				<div style="margin-left:40px; margin-top:20px;">
					<b style="font-size:25px;">
						<a style="color:#EC8E40;" href=""><?php echo $a->Title; ?></a>
						<a style="color:#8D623D;" href="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $no_ans?>&nbsp;Answers</a>
					</b>
					&nbsp;&nbsp;&nbsp;
					<?php foreach($tags as $x){ ?>
							 <p class='tag' style='display:none background:#8D623D;'><a style="color:white;" href="/Home/tagdetail/<?php echo $x->T_Id;?>/<?php echo $x->T_Name;?>"><?php echo $x->T_Name; ?></a></p>
					<?php }?>
					<br><br>
					<p style="color:#8D623D;"><?php echo $a->Description;?></p>
					<br><br>

					<?php if($sess): ?>
							<form action="/Home/answer/<?php echo $a->Q_Id; ?>" method="POST">
								<textarea name="Answer" style="width:440px; height:100px;"></textarea><br>
								<input type="submit" value="Reply">
			 				</form>
							<form  method="POST">
							<?php if(! $followed[0]): $t="Follow";?>
							<?php else:  $t="Unfollow";?>
							<?php endif; ?>
							<input type="button" onclick="chngfollowonques(<?php echo $a->Q_Id; ?>)" id="ques" value="<?php echo $t;?>" >
							</form>
				 <?php endif; ?>
				 </div>
			<?php }?>

				<div style="margin-left:40px; margin-top:20px;">
				<?php foreach($ans as $a){ ?>
						 <p><?php echo $a->Answer; ?></p><br>
						 <p><?php echo $a->Replied_on;?></p>
						 <p><a href="/Home/profileviewload/<?php echo $a->Id;?>"><?php echo $a->Name?></p>
				<?php }?>
				</div>
				<div style="width:100%">

				</div>
			</div>
<?php include("footer.php") ?>
