<?php
/*
 ******************************************************************************
 *    This file is part of YKSystem litle.
 *
 *    YKSystem litle is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    YKSystem litle is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************
 * (C)Copyright Juan Antonio Nache Ramos nache.nache G gmail O com
 ******************************************************************************
 */

function up_and_resize_image($files){

	$yks=new yks();

	$date=date('GisdmY');

	$imagen=$date.$files['file']['name'];
	$imagen=str_replace("%","",$imagen);
	$imagen=str_replace(" ","_",$imagen);
	$imagen=str_replace("&","",$imagen);

	$archivo_final_path_nombre=$yks->config['UPLOADS_PATH'].$imagen;
	$archivo_tb_path_nombre=$yks->config['UPLOADS_PATH']."tb/".$imagen;
	$archivo_th_path_nombre=$yks->config['UPLOADS_PATH']."th/".$imagen;
	$img_mimetype=$files['file']['type'];

	if (move_uploaded_file($files['file']['tmp_name'], $archivo_final_path_nombre)) {
		if(resize_img_tb($archivo_final_path_nombre,$archivo_tb_path_nombre,$img_mimetype)){
			if(resize_img_th($archivo_final_path_nombre,$archivo_th_path_nombre,$img_mimetype)){
				//echo "Subido ".$files['file']['name']." con el nombre $imagen";
				return $imagen;
			}else{
				return FALSE;
				//echo "Error redimensionando imagen!";
			}
		}else{
			return FALSE;
			echo "Error redimensionando imagen!";
		}
	}else{
		return FALSE;
		echo "Error subiendo imagen!";
	}
}



function resize_img_tb($img_original, $img_nueva,$mime_type){
	$yks=new yks();

//$img = ImageCreateFromJPEG($img_original);
$datos = getimagesize($img_original);
if($datos[2]==1){$img = @imagecreatefromgif($img_original);}
if($datos[2]==2){$img = @imagecreatefromjpeg($img_original);}
if($datos[2]==3){$img = @imagecreatefrompng($img_original);}

$thumb = imagecreatetruecolor($yks->config['TB_X'],$yks->config['TB_Y']);
imagecopyresampled($thumb,$img,0,0,0,0,$yks->config['TB_X'],$yks->config['TB_Y'],ImageSX($img),ImageSY($img));
//ImageCopyResized($thumb,$img,0,0,0,0,$config['TB_X'],$config['TB_Y'],ImageSX($img),ImageSY($img));
ImageJPEG($thumb,$img_nueva,$yks->config['TB_QUALITY']);
ImageDestroy($img);
if(file_exists($img_nueva)){
	//echo "imagen resizada";
	return TRUE;
}else{
	//echo "imagen NO resizada ";
	return FALSE;
}
}

function resize_img_th($img_original, $img_nueva,$mime_type){
	$yks=new yks();

	$anchura=$yks->config['TH_X'];
	$hmax=$yks->config['TH_Y'];
	$nombre=$img_original;
	$datos = getimagesize($nombre);

	if($datos[2]==1){
		$img = @imagecreatefromgif($nombre);
	}

	if($datos[2]==2){
		$img = @imagecreatefromjpeg($nombre);
	}

	if($datos[2]==3){
		$img = @imagecreatefrompng($nombre);
	}

	//print_r($datos);

	$ratio = ($datos[0] / $anchura);
	$altura = ($datos[1] / $ratio);

	if($altura>$hmax){$anchura2=$hmax*$anchura/$altura;$altura=$hmax;$anchura=$anchura2;}

	$thumb = imagecreatetruecolor($anchura,$altura);
	imagecopyresampled($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

	if($datos[2]==1){imagegif($thumb,$img_nueva);}
	if($datos[2]==2){imagejpeg($thumb,$img_nueva);}
	if($datos[2]==3){imagepng($thumb,$img_nueva);}

	imagedestroy($img);
//echo $img;
if(file_exists($img_nueva)){
	//echo "imagen resizada";
	return TRUE;
}else{
	//echo "imagen NO resizada ";
	return FALSE;
}
}


?>
