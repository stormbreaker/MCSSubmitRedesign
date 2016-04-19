<?php
	require 'user.php';
	if ($_FILES["file1"]["error"] > 0)
	{
		echo "ERROR";
	}
	else
	{
		$newFilePath = "uploads/" . User::getUsername() . $_FILES["file1"]["name"];
		$tempFilePath = $newFilePath;
		$canUpload = 1;
		$index = 1;
		while (file_exists($tempFilePath)) {
			$tempFilePath = $newFilePath . "(" . $index . ")";
			$index = $index + 1;
		}
		$newFilePath = $tempFilePath;
		move_uploaded_file($_FILES["file1"]["tmp_name"], $newFilePath);
	}
?>
