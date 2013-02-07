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



class db extends dbconfig{

  var $nombre;
  var $host;
  var $usuario;
  var $password;
  var $cursor;
  var $resultado;
  var $conexion;
  private $query;

  function __construct() {
	parent::__construct();
	$link=mysql_connect($this->getconfdb('DB_HOST'), $this->getconfdb('DB_USER'), $this->getconfdb('DB_PASS'));
	if (!$link)	{
		//echo '<br>H:'.$this->host;
		//echo '<br>U:'.$this->usuario;
		echo mysql_error();
		$this->debug("class db, db(): Error al conectar con la DB");
	}else{
		mysql_select_db($this->getconfdb('DB'), $link);
		$this->conexion=$link;
		$this->debug("class db, db(): Conexión a DB establecida");
    }
  }



	function conectar(){
		//this now not be will necesary
		//esto ya no sera necesario
	}


	public function print_query(){
		echo $this->query;
	}

	function consult($consulta){
		return $this->consulta($consulta);
	}

	function consulta($consulta){
		$this->query=$consulta;
		$this->debug("class db, consulta(): ".$consulta);
		//echo $consulta."<br />";
		$this->libera();
		$this->resultado = mysql_query ($consulta, $this->conexion);
		if ($this->resultado == false) {
			$this->debug("class db, consulta(): Error en la consulta (".$this->query.") ".mysql_errno($this->conexion)." : ".mysql_error($this->conexion),1);
			$res=-1;
		}else{
			if (strtolower (substr (ltrim ($consulta), 0, 6)) == 'select') {
				$res=mysql_num_rows ($this->resultado);
			}else{
				$res=@mysql_affected_rows ($this->resultado);
			}
		}
		return $res;
	}

	function error() {
    	echo '<br>Error '.mysql_errno($this->conexion).': '.mysql_error($this->conexion).'<br>';
	}

	function conexion() {
		return $this->conexion;
	}

	function resultado() {
		return $this->resultado;
	}

	function libera () {
		@mysql_free_result($this->resultado);
		@reset ($this->cursor);
	}

	function cursor() {
    	$this->cursor=mysql_fetch_array ($this->resultado, MYSQL_ASSOC);
		return $this->cursor;
	}

	function cursorn() {
		$this->cursor=mysql_fetch_array ($this->resultado, MYSQL_NUM);
		return $this->cursor;
	}


	function desconectar() {
		//echo $this->conexion;
		//mysql_close($this->conexion);
		//echo "\n".$this->conexion;
	}

	function __destruct() {
		$this->debug("class db, __destruct(): Desconectamos DB.");
		show_mem();
		$this->desconectar();
		parent::showdebug();

   }
}
?>
