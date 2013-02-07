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
 * Created on 24/01/2008
 *
 *
 ******************************************************************************
 * Este es el archivo principal de YKSystem. Incluyendo este archivo
 * en cualquier file php deberiamos tener acceso a todas las clases,
 * incluidas las de los modulos.
 ******************************************************************************
 */

define("DEBUG_MODE",1); //0=desactivado, 1=solo errores, 2=errores y mensajes informativos

class dbconfig extends yks{
	private $configdb=array();

	function __construct(){
		//configuracion de la base de datos
		$this->configdb["YKSYSTEMVER"]="YKSystem litle V1.0";
		$this->configdb["CLIENTTITLE"]="Version litle 1.0 de YKSystem";
		$this->configdb["DB_HOST"]="localhost"; //host donde se encuentra el servidor mysql
		$this->configdb["DB_USER"]="mydbuser"; //usuario de la base de datos
		$this->configdb["DB_PASS"]="mydbpass"; //contrasenia de la base de datos
		$this->configdb["DB"]="mydbname";  //nombre de la base de datos
	}

	function getconfdb($key){
 		return $this->configdb[$key];
 	}

}


class yks{
 	//var $config;
	protected $config=array();
	protected $debuglog;
	private $debugstatus="on";
	//private $lang;

 	function __construct(){

		//configuracion de YKSystem litle
 		$this->config["PAGENAME"]="Pagename Sample";
 		$this->config["COPYRIGHTYEAR"]="2008";
 		$this->config["AUTOR"]="NachE";

		$this->config["YKSPATH"]="/var/www/yksystem/"; //directorio de YKSystem litle
		$this->config["HTTPDOCS_PATH"]="/var/www/";    //directorio principal de la pagina
		$this->config["HTTPDOCS_URL"]="/";             //url donde se encuentra la pagina

		$this->config["CLASS_PATH"]=$this->config["YKSPATH"]."/class/";
		$this->config["LIB_PATH"]=$this->config["YKSPATH"]."/lib/";
		$this->config["MODULES_PATH"]=$this->config["YKSPATH"]."/modules/";
		$this->config["ADMIN_MODULES_PATH"]=$this->config["YKSPATH"]."/adminmodules/";
		$this->config["SO_THEMES_PATH"]=$this->config["HTTPDOCS_PATH"]."/themes/";
		$this->config["THEMES_URL"]=$this->config["HTTPDOCS_URL"]."themes/";

		$this->config["UPLOADS_URL"]="/archivos/";
		$this->config["UPLOADS_PATH"]=$this->config["HTTPDOCS_PATH"]."../archivos/";
		$this->config["ACTIVE_THEME"]="default/";              //theme activo
		$this->config["SO_WEBROOT_PATH"]="";
		$this->config["WEBROOT_PATH"]="/";
		$this->config["TB_X"]="100";
		$this->config["TB_Y"]="100";
		$this->config["TH_X"]="450";
		$this->config["TH_Y"]="450";
		$this->config["TB_QUALITY"]="100";
		$this->config["SALT_LENGTH"]="9";
		$this->config["THEME_MAINFILE"]="main.html";

		$this->config["DB_USER_IDNAME"]="id";
		$this->config["DB_USER_TABLENAME"]="users";
		$this->config["DB_PASSWORD_KEYNAME"]="password";
		$this->config["DB_USERNAMECOLUMN_NAME"]="username";
		$this->config["DB_MAILCOLUMN_NAME"]="mail";

		//include($this->config["YKSPATH"]."lang/es.php");
		//$this->lang=$lang;
		$this->configtodefine();
		$this->debug("class yks, __construct(): He sido instanciada. I give you the power!! :D");
 	}

 	public function getconf($key){
 		if(isset($this->config[$key])){
 			return $this->config[$key];
 		}else{
 			$this->debug("class yks, getconf(): La clave $key no existe.",1);
 		}
 	}

 	public function configtodefine(){
 		foreach ($this->config as $key => $value){
 			 define($key, $value);
 		}
 	}

	public function debug($texto,$nivel="2"){
		// 0=No se mostrara nada, 1=Se mostraran solo los errores, 2=Se muestra informacion y errores
		if(DEBUG_MODE != 0 && DEBUG_MODE >= $nivel){
			$time=date('h:i:s:u A');
			if($nivel==1){
				$this->debuglog.="<p style=\"color: #ff0000; background-color: #cccccc; font-size: 11px; margin: 0px;\">\nDebug: ".$time." -> ".$texto."</p>\n";
	        }elseif($nivel==2){
	        	$this->debuglog.="<p style=\"color: #00ff00; background-color: #ffffff; font-size: 11px; margin: 0px;\">\nDebug: ".$time." -> ".$texto."</p>\n";
	        }
		}
	}


 	function force_disable_debug_print(){
 		define("FORCE_DISABLE_PRINT_DEBUG","off");
 	}

	function showdebug(){
		if(DEBUG_MODE != 0 && FORCE_DISABLE_PRINT_DEBUG != "off"){
			echo $this->debuglog;
		}
	}

	function __destruct() {
		$this->showdebug();
	}

 }

$yks=new yks();

//Iincluimos las clases del sistema
include($yks->getconf('CLASS_PATH')."dbclass.php");
//include_once($conf['CLASS_PATH']."zapatoclass.php");
include($yks->getconf('CLASS_PATH')."filesclass.php");
include($yks->getconf('CLASS_PATH')."themesclass.php");
//include($yks->getconf('CLASS_PATH')."dbifaceclass.php");
//include($yks->getconf('CLASS_PATH')."dbuserclass.php");
include($yks->getconf('CLASS_PATH')."criptclass.php");
//include($yks->getconf('CLASS_PATH')."checkuserclass.php");
include($yks->getconf('CLASS_PATH')."mainpageclass.php");
//include($yks->getconf('CLASS_PATH')."modclass.php");
include($yks->getconf('LIB_PATH')."fileslib.php");
include($yks->getconf('LIB_PATH')."utillib.php");
include($yks->getconf('LIB_PATH')."session.php");
//include($yks->getconf('LIB_PATH')."sendmailcontacto.php");
//incluimos los modulos

$files=new files();

//por compatibilidad con php4
$archivos = $files->scandir_php4($yks->getconf('MODULES_PATH'));

foreach ($archivos as $values){
	if(($values == "." || $values == "..") || !is_dir($yks->getconf('MODULES_PATH').$values)){
		//no se hace nada por ahora
	}else{
		if (file_exists($yks->getconf('MODULES_PATH').$values."/main.php")){
			include_once($yks->getconf('MODULES_PATH').$values."/main.php");
		}else{
			echo "se detectó un directorio de modulo incorrecto: $values";
		}
	}
}

?>
