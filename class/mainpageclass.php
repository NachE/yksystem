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

 class mainpage extends theme{

	private $txterror;

 	function __construct($mainfile=""){

 		if($mainfile==""){
 			$this->debug("Cargando archivo main: ".THEME_MAINFILE);
 			$this->carga_archivo(THEME_MAINFILE);
 		}else{
 			$this->debug("Cargando archivo main: ".$mainfile);
 			$this->carga_archivo($mainfile);
 		}
 		parent::__construct(); 	// construimos yks(), pero cuidado al meter constructores
 								// en las clases padre, que la jodemos
		$this->parse_includes();
		$this->parse_vars();
 	}

 	function force_mainfile($file){
 		$this->clean();
 		$this->carga_archivo($file);
 	}

 	private function parse_includes(){
 		$regs=array();
		while(ereg('\{INCLUDE\:([^}]+\.html)\}',$this->html,$regs)){

			if($regs[1]!=THEME_MAINFILE){
				$this->reemplaza($regs[0],$this->return_file($regs[1]));
			}else{
				$this->reemplaza($regs[0],"");
			}

			$this->debug("class mainpage, parse_includes(): including ".$regs[1]);
		}
		//$this->debug("class mainpage, parse_includes(): resultado ereg: $r");
		//print_r($regs);
 	}

 	private function parse_vars(){
 		$this->reemplaza("{THEMES_URL}",THEMES_URL);
 		$this->reemplaza("{ACTIVE_THEME}",ACTIVE_THEME);
 		$this->reemplaza("{PAGENAME}",PAGENAME);
 		$this->reemplaza("{YEAR}",COPYRIGHTYEAR);
 		$this->reemplaza("{AUTOR}",AUTOR);
 		$this->reemplaza("{REQUEST_URI}", $_SERVER['REQUEST_URI']);
 		$this->reemplaza("{SCRIPT_NAME}", $_SERVER['SCRIPT_NAME']);
 		$this->reemplaza("{HTTPDOCS_URL}",HTTPDOCS_URL);
 	}

	public function error($text){
		$this->debug("class mainpage, error(): Registrando error: ".$text);
		$this->txterror=$this->reemplazo_archivo("{ERROR}",$text,"errortext.html");
	}

	public function return_html(){
		$this->parse_vars();
		if($this->txterror != ""){
			$this->debug("class mainpage, return_html(): Hubo errores");
			$prehtml=$this->reemplazo_archivo("{ERRORTEXT}",$this->txterror,"errorbox.html");
			$this->reemplaza("{ERRORBOX}",$prehtml);
		}else{
			$this->debug("class mainpage, return_html(): Ningun error");
			$this->reemplaza("{ERRORBOX}","");
		}
		return $this->html;
	}

 	public function put_content($file){
 		$this->reemplaza("{CONTENT}",$this->return_file($file));
 		$this->parse_includes();
 		$this->parse_vars();
 	}

	public function add_file($reemplazo,$file){
		$this->reemplaza($reemplazo,$this->return_file($file).$reemplazo);
 		$this->parse_includes();
 		$this->parse_vars();
	}

 	public function insert_content($content){
 		$this->reemplaza("{CONTENT}",$content);
 		$this->parse_includes();
 		$this->parse_vars();
 	}

 	public function reemplaza_file($reemplazo,$file){
 		$this->reemplaza($reemplazo,$this->return_file($file));
 		$this->parse_includes();
 		$this->parse_vars();
 	}

 	function __destruct(){
 			parent::__destruct();
 	}
 }


?>
