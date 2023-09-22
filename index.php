<html>
<head>
	<title>Enviar Remessa Lista QR CODE</title>
</head>
<body>


<center>

<h1>Enviar Remessa Lista QR CODE 22</h1>

<br/>
<center>
{ Nr.Pat;Descrição Fornecedor;NF;Data_NF }
<a href="remessa.txt">Donwload Arquivo Exemplo</a>
</center>

<br/>

<form enctype="multipart/form-data" action="qrcode.php" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    <input name="arqlista" type="file" />
    <br/>
    <br/>
    <br/>
    <input type="submit" value="Enviar Remessa" />
    <br/>
</form>

</center>

<br/>
<hr>

<center>


</center>

</body>
</html>