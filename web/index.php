< ?php 
$file = @file("count.txt");
$count = @implode("", $file);
$count++;
$myfile = fopen("count.txt","w");
fputs($myfile,$count);
fclose($myfile);
?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>
  <span>Просмотров: < ?=$count ?></span>
</body>
</html>