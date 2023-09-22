<html>
<head>
<title>API QRCODE - PMSP</title>
<link rel="stylesheet" href="bootstrap.min.css">
<style type="text/css">

.margim_top{
  height: 22px;
}

</style>
<body topmargin="0" leftmargin="0">
<?php

echo '<div class="margim_top"></div>';

echo "<table border='1' align='left'>";

for( $ixz = 1; $ixz <= 40; $ixz++)
{

echo "<tr>";

	for( $ix = 1; $ix <= 25; $ix++)
	{
	echo "<td align='center' width='30' height='25px' style='font-size:10px;'>".$ixz.'-'.$ix."</td>";
	}

echo "</tr>";
}

echo "</table>";


?>