<header class="header">
	<div class="head">
		<img src="../images/NYSC_LOGO.svg" class="upper_logo">
		Welcome, <?php  
			$name = $row['name'];
			$del = " ";
			$array = explode($del, $name);
			print_r($array[0]);
		?>
	</div>
	<div style="position: absolute; right: 10px; top: 50px;">
		<div>
			<a href="?logout_user=1" class="logger"><span class="fa fa-sign-out-alt"></span> Logout</a>
		</div>
	</div>
</header>