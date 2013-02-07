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

 function izset($array){
 	$return=1;

 	if(is_array($array)){
 		if(count($array)>1){
			foreach($array as $var){
				if(isset($var) && $var != "" && $var != NULL){
					//nada por ahora
				}else{
					$return=0;
				}
			}
 		}
 	}else{
 		if(isset($array) && $array != "" && $array != NULL){
 				//nada por ahora
 		}else{
 				$return=0;
 		}
 	}

	if($return==0){
		//echo "retornamos false";
		return FALSE;
	}elseif($return==1){
		//echo "retornamos true";
 		return TRUE;
	}
 }


 function show_mem(){
 	//echo "<br />Script ejecutado en: ".xdebug_time_index()." segundos";
 	//echo "<br />Memoria actual usada: ".xdebug_memory_usage();
 	//echo "<br />Maximo de memoria usada: ".xdebug_peak_memory_usage()/1024;

 }

?>
