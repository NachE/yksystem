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

class theme extends files{
	protected $html;

	function theme($archivo=""){//constructor
		parent::__construct();	//construye yks() <- cuidado con esto si en la clase
								//files metemos un constructor.
		if($archivo != ""){
			$this->carga_archivo($archivo);
		}
	}

	public function clean(){
		$this->html="";
	}

	public function carga_archivo($archivo){
		$this->debug("class theme, carga_archivo(): Cargando archivo ".$archivo);
		$this->html.=$prehtml=$this->lee_archivo(SO_THEMES_PATH.ACTIVE_THEME.$archivo);
	}

	public function reemplaza($busqueda,$reemplazo){
		$this->debug("class theme, reemplaza(): reemplazando ".$busqueda." por ".$reemplazo." en ".$this->html,2);
		$this->html=$this->reemplazo_string($busqueda,$reemplazo,$this->html);
	}

	public function return_file($file){
		return $this->lee_archivo(SO_THEMES_PATH.ACTIVE_THEME.$file);
	}

	public function return_html(){
		return $this->html;
	}

	public function reemplazo_archivo($busqueda,$reemplazo,$archivo){
		$prehtml=$this->lee_archivo(SO_THEMES_PATH.ACTIVE_THEME.$archivo);
		return str_replace($busqueda,$reemplazo,$prehtml);
	}

	public function reemplazo_string($busqueda,$reemplazo,$string){
		return str_replace($busqueda,$reemplazo,$string);
	}

 	public function reemplaza_file($reemplazo,$file){
 		$this->reemplaza($reemplazo,$this->return_file($file));
 	}

	function __destruct(){
		unset ($this->html);
		unset ($this->filegestor);
		parent::showdebug();

	}
}

?>
