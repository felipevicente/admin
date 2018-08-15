<?php


class upload_img {

	public function uploadImagem($img){
		//die(var_dump($img));
		//if($_FILES["foto"]["name"] != '') {
		if($img) {
			$allowed_ext = array("jpg", "png");
			$ext = end(explode(".", $_FILES[$img]["name"]));
			if (in_array($ext, $allowed_ext)) {
				if ($_FILES[$img]["size"]>5000) { //verifica tamanho da imagem 5MB
					$name = md5(rand()) . '.' . $ext;
					$path = "uploads/" . $name;
					move_uploaded_file($_FILES[$img]["tmp_name"], $path);
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
}
?>