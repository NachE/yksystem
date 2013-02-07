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

class files extends yks{
/*
** 'r'	Apertura para sólo lectura; ubica el apuntador de archivo al comienzo del mismo.
**
** 'r+'	Apertura para lectura y escritura; ubica el apuntador de archivo al comienzo del mismo.
**
** 'w'	Apertura para sólo escritura; ubica el apuntador de archivo al comienzo de éste y lo trunca a
**	una longitud de cero. Si el archivo no existe, intenta crearlo.
**
** 'w+'	Apertura para lectura y escritura; ubica el apuntador de archivo al comienzo de éste y lo
**	trunca a una longitud cero. Si el archivo no existe, intenta crearlo.
**
** 'a'	Apertura para sólo escritura; ubica el apuntador de archivo al final del mismo. Si el
**	archivo no existe, intenta crearlo.
** 'a+'	Apertura para lectura y escritura; ubica el apuntador de archivo al final del mismo. Si el
**	archivo no existe, intenta crearlo.
**
** 'x'	Creación y apertura para sólo escritura; ubica el apuntador de archivo al comienzo de éste.
**      Si el archivo ya existe, la llamada a fopen() fallará devolviendo FALSE y generando un error
**	de nivel E_WARNING. Si el archivo no existe, intenta crearlo.
**	Esto es equivalente a especificar las banderas O_EXCL|O_CREAT en la llamada de sistema open(2) interna.
**
** 'x+'	Creación y apertura para lectura y escritura; ubica el apuntador de archivo al comienzo de éste.
**	Si el archivo ya existe, la llamada a fopen() fallará devolviendo FALSE y generando un error de nivel
**	E_WARNING. Si el archivo no existe, intenta crearlo. Esto es equivalente a especificar las
**	banderas O_EXCL|O_CREAT en la llamada de sistema open(2) interna.
*/

private $filegestor;

function abre_archivo($archivo, $opciones="r"){
        if (!$archivo){
                $this->debug("class files, abre_archivo(): Falta el parametro archivo",1);
        }else{
                $this->debug("class files, abre_archivo(): Abriendo el archivo ".$archivo,2);
                $this->filegestor = fopen($archivo, $opciones);
                $this->debug("class files abre_archivo(): El gestor de archivo ahora es: $this->filegestor para el archivo: $archivo",2);
                return $this->filegestor;
        }
}



function lee_archivo($archivo,$opciones="r"){

        if (!file_exists ($archivo)){
                $this->debug("class files, lee_archivo(): el archivo ".$archivo." no existe",1);
        }else{
                if(filesize($archivo)){
                        $this->debug("class files, lee_archivo(): Se procede a leer archivo",2);
                        $gestor=$this->abre_archivo($archivo,$opciones);
                        $contenido = fread($gestor, filesize($archivo));
                        $this->cierra_archivo($gestor);
                return $contenido;
                }else{
                        $this->debug("class files, lee_archivo(): el archivo $archivo esta vacio",2);
                return FALSE;
                }
        }
}



function escribe_archivo($archivo,$texto,$opciones="r+"){

        if (!file_exists ($archivo)){
                $this->debug("class files, escribe_archivo(): el archivo ".$archivo." no existe",1);
        }else{
				$this->debug("class files, escribe_archivo(): Se escribe archivo",2);
                
                $gestor=$this->abre_archivo($archivo,$opciones);
                fwrite($gestor,$texto,strlen($texto));

                $this->cierra_archivo($gestor);
                
                              
        }
}

function cierra_archivo($gestor){
        if(!$gestor){
                $this->debug("class files, cierra_archivo(): Se intento cerrar un archivo no abierto",1);
        }else{
                $this->debug("class files, cierra_archivo(): cerrando archivo con gestor: $this->filegestor | $gestor",2);
                fclose($gestor);
                $this->debug("class files, cierra_archivo(): Archivo cerrado, gestor actual: $this->filegestor | $gestor",2);


                //$this->debug("Funcion cierra_archivo: Archivo cerrado");
        }
}


function scandir_php4($dir){
	if ($gestor = opendir($dir)) {
    //echo "Gestor de directorio: $gestor\n";
    //echo "Archivos:\n";

    /* Esta es la forma correcto de iterar sobre el directorio. */
    while (false !== ($archivo = readdir($gestor))) {
    	$files[]=$archivo;
    	//echo $archivo."<br />";
        //echo "$archivo\n";
        sort($files,SORT_NUMERIC);
    }

    closedir($gestor);
    return $files;
}


}



}//fin class files


?>
