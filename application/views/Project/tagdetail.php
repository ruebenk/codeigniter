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
				<?php echo $T_Id; echo "\n"; echo $T_Name; ?>
				<form action="/Home/followtag/<?php echo $T_Id; ?>" method="POST">
			 <input type="submit" value="Follow">
			 </form>
				<table style="width:100%">
				<?php
				foreach($ques as $a){
					?>
					 <tr>
						 <td><?php echo $a->Q_Id; ?></td>
						 <td><?php echo $a->Title; ?></td>
						 <td><a href="/Home/profileviewload/<?php echo $a->Id;?>"<?php echo $a->Id;?></a></td>
						 <td><?php echo $a->Description;?></td>
						 <td><?php echo $a->ans;?></td>
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
				 <?php endif; ?>
					 </tr>
					 <?php }?>
	      </table>

	</body>
</html>