<?php
  // O nome original do arquivo no computador do usuário
  $arqName = $_FILES['arqlista']['name'];
  // O tipo mime do arquivo. Um exemplo pode ser "image/gif"
  $arqType = $_FILES['arqlista']['type'];
  // O tamanho, em bytes, do arquivo
  $arqSize = $_FILES['arqlista']['size'];
  // O nome temporário do arquivo, como foi guardado no servidor
  $arqTemp = $_FILES['arqlista']['tmp_name'];
  // O código de erro associado a este upload de arquivo
  $arqError = $_FILES['arqlista']['error'];
 

    $row = 0;
    $handle = @fopen ($arqTemp,"r");
    $duplicados = 0;
    $inseridos = 0;

    while ($data = fgetcsv ($handle, 1000, ";")) 
    {

       $num = count ($data);

       if ( $data[0] != NULL )
       {
        //$qrcode[$row] = "qrcode_".$row;
        $qrcode[$row]['cod'] = $cod = utf8_encode($data[0]);
        $qrcode[$row]['descricao'] = utf8_encode($data[1]);
        $qrcode[$row]['nota_fiscal'] = utf8_encode($data[2]);
        $qrcode[$row]['data_nota'] = utf8_encode($data[3]);
        $qrcode[$row]['coluna1'] = utf8_encode($data[4]);
        $qrcode[$row]['coluna2'] = utf8_encode($data[5]);
        $row++;
      }

    }

    ?>
<html>
<head>
<title>API QRCODE - PMSP</title>
<link rel="stylesheet" href="bootstrap.min.css">
<style type="text/css">
#textoVertical {
  font-size: 12px;
-moz-transform: rotate(-90deg);
-webkit-transform:  rotate(-90deg);
-o-transform: rotate(-90deg);
-ms-transform:  rotate(-90deg);
transform: rotate(-90deg);
}

.margim_top{
  height: 23px;
}

</style>
</head>
<body topmargin="0" leftmargin="0">
<?php

include('phpqrcode/qrlib.php');

//$dados_json = $_GET['json'];
$conv_dados_t = json_encode($qrcode);

$conv_dados = json_decode($conv_dados_t);
$total = count($conv_dados);

  echo '<div class="margim_top"></div>';
//echo '<div class="row">';

$espacos_et = 1;
$linha = 1;

$album="etiquetas";
  foreach (scandir($album) as $fotos){
    //echo $fotos."<br>";
    if ( $fotos != '.' && $fotos != '..' )
    {      
    unlink($album."/".$fotos);
    }
  }
/*

echo "<table border='1' align='left' style='position:absolute;z-index:-9999;'>";

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
*/
echo "<table border='0' align='left'>";
echo "<tr>";

for( $i = 0; $i < $total; $i++)
{
//unlink("etiquetas/QR_code_".md5($i)."_".$i.".png");
//unlink("etiquetas/*.png");

$nome_qrcode = 'etiquetas/'.$i."_".md5(time()).".png";

QRcode::png( utf8_decode($conv_dados[$i]->cod).' | '.utf8_decode($conv_dados[$i]->descricao).' | '.utf8_decode($conv_dados[$i]->nota_fiscal).' | '.utf8_decode($conv_dados[$i]->data_nota).' | '.utf8_decode($conv_dados[$i]->coluna1).' | '.utf8_decode($conv_dados[$i]->coluna2), $nome_qrcode, QR_ECLEVEL_H, 4); 


  echo "<td align='center' width='10'></td>";

  echo "<td align='center' width='30'>";
  echo '<div><img src="pmsp_lado.png" height="100px"></div>';
  echo "</td>";
  echo "<td align='center' width='100'>";
  echo '<div><img src="'.$nome_qrcode.'" width="100px"></div>';
  echo "</td>";
  echo "<td align='center' id='textoVertical' width='6'>";
  echo "<span>".$conv_dados[$i]->cod."</span>";
  echo "</td>";

  if ( $espacos_et == 1 ) { echo "<td align='center' width='20'></td>"; }
  if ( $espacos_et == 2 ) { echo "<td align='center' width='15'></td>"; }
  if ( $espacos_et == 3 ) { echo "<td align='center' width='15'></td>"; }

	if ( $espacos_et >= 4 )
	{

  echo "</tr>";

  if ( $linha < 8 )
  {
  echo "<tr>";
    echo "<td colspan='19' height='34'></td>";
  echo "</tr>";
  }

  echo "<tr>";

	$espacos_et = 1;
  $linha++;
	} else { 
	$espacos_et++;
	}

}


echo "</table>";

?>

</body>

</html>

