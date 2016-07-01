<html>
	<head>
					<link rel="icon" type="image/x-icon" href="http://www.quopro.com/assets/img/favicon.ico" />
					<title>QuoPro</title>
					<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

					<script src="http://www.quopro.com/assets/js/index.js"></script>
					<link rel="stylesheet" href="http://www.quopro.com/assets/css/style.css">
	</head>
	<body>

				<table style="width:100%">
				<?php
				foreach($ques as $a){
					?>
					 <tr>
						 <td><?php echo $a->Q_Id; ?></td>
						 <td><?php echo $a->Title; ?></td>
						 <td><?php echo $a->Description;?></td>
						 <?php if($sess): ?>
						 <td>	<form action="/Home/answer/<?php echo $a->Q_Id; ?>" method="POST">
		 				<input type="text" name="Answer"><br>
		 				<input type="submit" value="Reply">
		 				</form></td>
						<td>	<form action="/Home/followques/<?php echo $a->Q_Id; ?>" method="POST">
					<?php if(! $followed[0]):?>
					 <input type="submit" name='Follow' value="Follow">
				  <?php else:?>
				  <input type="submit" name='Unfollow' value="Unfollow">
					<?php endif; ?>
					 </form></td>
				 <?php endif; ?>
					 </tr>
					 <?php }?>
	      </table>
				<table style="width:100%">
				<?php
				foreach($ans as $a){
					?>
					 <tr>
						 <td><?php echo $a->A_id; ?></td>
						 <td><?php echo $a->Answer; ?></td>
						 <td><?php echo $a->Replied_on;?></td>
						 <td><?php echo $a->Id?></td>
						 <td><a href="/Home/profileviewload/<?php echo $a->Id;?>"><?php echo $a->Name?></td>
					 </tr>
					 <?php }?>
				</table>
				<table style="width:100%">
				<?php
				foreach($tags as $a){
					?>
					 <tr>
						 <td><?php echo $a->T_Id; ?></td>
						 <td><a href="/Home/tagdetail/<?php echo $a->T_Id;?>/<?php echo $a->T_Name;?>"><?php echo $a->T_Name; ?></td>
					 </tr>
					 <?php }?>
				</table>
	</body>
</html>
