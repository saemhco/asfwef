
<?php
    
     class conexion
		{   private $conex;
			function __construct($host,$usuario,$clave,$bd)
			 {
				$conex=mysql_connect($host,$usuario,$clave) or die("No se encontró servidor $host");
				$bd=mysql_select_db($bd,$conex) or die("No se encontró la BD: $bd");
				$this->conex=$conex;
			 }
			 
			function consultar($sql)
			{
				$r=mysql_query($sql,$this->conex) or die("Error en consulta");				
				$registros=array();
				while($f=mysql_fetch_array($r))
				{
				   $registros[]=$f;
				}
				return $registros;
			}
			
			function insertar($tabla, $campos)// inserta los datos   			
			{				
			    //$campos=Array("nombres"=>"Juan","usuario"=>"admin","clave"=>"123");
				// $obj->insertar("usuario",$campos);
				
				$cad="INSERT INTO $tabla(";
				foreach($campos as $campo=>$valor)
				  {
					 $cad=$cad.$campo.",";
				  }
				$cad=substr($cad,0,strlen($cad)-1);
				
				$cad=$cad.") VALUES(";
				foreach($campos as $campo=>$valor)
				  {
					 $cad=$cad."'".$valor."',";
				  }
				$cad=substr($cad,0,strlen($cad)-1);
				
				$cad=$cad.")";  //insert into usuario(nombres, usuario, clave) values('juan', 'admin','123')
				
				mysql_query($cad,$this->conex) or die("Error en insertar: ".mysql_error()."<br><br> $cad <br><br>");				
			}
			
			function actualizar($tabla, $campos,$condicion="")// actualiza los datos   			
			{				
			    //$campos=Array("nombres"=>"Juan","usuario"=>"admin","clave"=>"123");
				// $obj->actualizar("usuario",$campos,"idusuario='10'");
				if($condicion!=""){ $condicion="WHERE $condicion"; }
				$cad="UPDATE $tabla SET ";
				foreach($campos as $campo=>$valor)
				  {
					 $cad=$cad." $campo='$valor',";
				  }
				$cad=substr($cad,0,strlen($cad)-1);
				
				$cad=$cad." $condicion";// UPDATE usuario SET nombres='juan', usuario='admin', clave='123' where idusuario='10'				
				mysql_query($cad,$this->conex) or die("Error en actualizar: ".mysql_error()."<br><br> $cad <br><br>");	
			}
			
			
			function eliminar($tabla, $condicion="")// 
			{
				if($condicion!=""){ $condicion="WHERE $condicion"; }
				mysql_query("DELETE FROM $tabla $condicion ",$this->conex) or die("Error en consulta: ".mysql_error()."<br><br> $sql <br><br>");				
			}
			
			function retornadato($sql)// retorna el valor del primer campo y registro de una consulta
			{				
				$r=mysql_query($sql,$this->conex) or die("Error en consulta de retorno: ".mysql_error()."<br><br> $sql <br><br>");
				if($f=mysql_fetch_array($r))
				  {
				    return $f[mysql_field_name($r,0)];
				  }
				  else
				  {
				    return "NULO";
				  }				 
			}
			
		}
		
	
?>