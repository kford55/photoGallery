<!--
Kenneth Ford Photo Gallery
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>

</head>

<body>
<?php
$ext = array("jpg", "gif", "jpeg");
function read($path){
	global $ext;
	$list = array();
	if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
			$temp = explode(".", $file);
			$extension = strtolower(end($temp));
			if (in_array($extension, $ext)){
            	echo "filename: $file : filetype: " . filetype($path ."/". $file) . "<br />";
				$list[] = ($path ."/". $file);
				
			}
        }
        closedir($dh);
    }
	else{
		echo "File path doesn't exist";
	}
	print_r($list);
	return $list;
}
function display($list){
	echo "<table>";
	for($i = 1; $i <= sizeof($list); $i++){
		if(!isset($row)){
			echo "<tr>";
			$row = true;
		}
		echo "<td>";
	 	echo "<a class = \"fancybox\" rel = \"group\" href = \"".$list[$i-1]."\" /><img src = \"thumbnail.php?thumbpath=".$list[$i-1]."\" ></a>";
		echo "</td>\n";
		
		if($i>0 && $i%5==0)
		{
			echo "</tr>\n";
			unset($row);
	}
	
}
echo "</table>";
}
$a = read(".");
display($a)
?>
</body>
</html>
