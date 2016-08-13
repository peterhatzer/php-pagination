<?php 

include "pagination.php";

?>

<html>
<head>
	<title>Pagnation</title>
</head>
<body>

	<h1>Pagnation</h1>

	<ul>
		<?php for ($i=0; $i < count($results); $i++) { 
			echo $results[$i]->title;
		} ?>
	</ul>

	<ul>
	<?php for ($i=1; $i <= $pages; $i++) { 
		if($current_page == $i){?>
		<span><?php echo $i; ?></span>
		<?php } else{ ?>
		<li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php }
	} ?>
	</ul>

</body>
</html>