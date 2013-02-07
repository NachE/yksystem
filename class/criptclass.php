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
 * ALL Right Reserved.
 * Created on 07/05/2008
 *
 */

 class cript extends yks{

 	function cript(){
		parent::__construct();
 	}

	function superhash($plainText, $salt = null){
		if ($salt === null){
			$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
		}else{
			$salt = substr($salt, 0, SALT_LENGTH);
		}
	return $salt . sha1($salt . $plainText);
	}
 }
?>
