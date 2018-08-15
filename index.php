<?php
if (isset($_POST["upload_imagem"])){
	if($_FILES["foto"]["name"] != '') {
		die(var_dump($_FILES["foto"]));
		$allowed_ext = array("jpg", "png");
		$ext = end(explode(".", $_FILES["foto"]["name"]));
		if (in_array($ext, $allowed_ext)) {
			if ($_FILES["foto"]["size"]>5000) { //verifica tamanho da imagem 5MB
				$name = md5(rand()) . '.' . $ext;
				$path = "uploads/" . $name;
				move_uploaded_file($_FILES["foto"]["tmp_name"], $path);
				header("location: index.php?file-name=".$name);
			} else {
				echo "Tamanho da imagem superior a 5MB";
			}
		} else {
			echo "Arquivo de imagem inválido.";
		}
	} else {
		echo "Por favor selecione um arquivo.";
	}
}
?>

<html>
<head>
	<title>Exemplo upload de imagens</title>
</head>
<body>
	<div align="center">
		<form method="post" action="" enctype="multipart/form-data">
			<input type="file" name="foto">
			<button type="submit" name="upload_imagem" value="Upload Image">Confirmar</button>
		</form>
		<?php
			if(isset($_GET["file-name"])){
				echo 'Salva com sucesso.</br>';
				echo '<img src="uploads/'.$_GET["file-name"].'>';
			}
		?>
	</div>

</body>
</html>

