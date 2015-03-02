<?php
$crop = TRUE;
$width = 200;
$height = 200;
$src = $_GET["thumbpath"];
list($w, $h, $type) = getimagesize($src);

  switch($type){
    case 6:
		//header('Content-type:image/bmp');
		$img = imagecreatefromwbmp($src);  
		break;
	
    case 1: 
		//header('Content-type:image/gif');	
		$img = imagecreatefromgif($src);
		break;
	
    case 2:
		//header('Content-type:image/jpg'); 
		$img = imagecreatefromjpeg($src); 
		break;
	
    case 3:
		//header('Content-type:image/png'); 
		$img = imagecreatefrompng($src); 
		break;
	
    
  }

  // resize
  if($crop){
    $ratio = max($width/$w, $height/$h);
    $h = $height / $ratio;
    $x = ($w - $width / $ratio) / 2;
    $w = $width / $ratio;
  }
  else{
    $ratio = min($width/$w, $height/$h);
    $width = $w * $ratio;
    $height = $h * $ratio;
    $x = 0;
  }

  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if($type == 1 || $type == 3){
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }

  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

  switch($type){
    case 6: imagewbmp($new); break;
    case 1: imagegif($new); break;
    case 2: imagejpeg($new); break;
    case 3: imagepng($new); break;
  }
  return true;

?> 
