<?php 
include('common.php');

//
//******* Inicio - Funciones que Cargan los Combos
//
function getEstudiantes()
{

	global $db;
	$start = (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
	$limit = (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
	
	$sql_count = "SELECT	* FROM	app_estudiantes ";
	$sql = $sql_count . ' LIMIT ' . $start . ', '. $limit;	
	
	if( !($resultado = $db->sql_query($sql)) )
	{			
		$rows['Estudiantes']['mensaje']    = "Error de BD al Intentar recuperar la Informacion. <br>" .$sql  ;
		$rows['Estudiantes']['exitoso']    = false;
		$response = json_encode($rows);		
	}
	else
	{
		$result_count = $db->sql_query($sql_count);
		$records = $db->sql_numrows($result_count);		
		
		$i=0;
		while ( $row = $db->sql_fetchrow($resultado) )
		{
			$rows['Estudiantes']['datos'][] = $row;
			$i++;
		}
					
		$rows['Estudiantes']['mensaje']    = 'Estudiantes cargadas Exitosamente!';
		$rows['Estudiantes']['exitoso']    = true;
		$rows['Estudiantes']['totalFilas'] = $records;
		$response = json_encode($rows);
	}
	print $response;
}

function getGradoInstruccion()
{
	global $db;
	$sql = "SELECT	co_grado_instruccion,nb_grado_instruccion  FROM	app_grado_instruccion ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['GradoInstruccion'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getProfesiones()
{
	global $db;
	$sql = "SELECT	co_profesion,nb_profesion  FROM	app_profesiones ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Profesiones'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getMisiones()
{
	global $db;
	$sql = "SELECT	co_mision,nb_mision  FROM	app_misiones ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Misiones'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getPNF()
{
	global $db;
	$sql = "SELECT	co_pnf,nb_pnf  FROM	app_pnf ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['PNF'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getGerencias()
{
	global $db;
	$sql = "SELECT	co_gerencia,nb_gerencia  FROM	app_gerencias ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Gerencias'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}


function getEstados()
{

	global $db;
	$sql = "SELECT	co_estado,nb_estado  FROM	app_estados ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Estados'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getInstitutos()
{

	global $db;
	$sql = "SELECT	co_instituto,nb_instituto  FROM	app_institutos ";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Institutos'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getMunicipios()
{

	global $db;
	$criterio="";
	
	$co_estado = (isset($_POST['co_estado']) ? $_POST['co_estado'] : $_GET['co_estado']);	
	
	if ($co_estado!='0' && $co_estado!='') 
	{
		$criterio=" WHERE co_estado = '$co_estado' ";
	}
	$sql = "SELECT	co_municipio,co_estado,nb_municipio FROM app_municipios $criterio";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Municipios'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getParroquias()
{

	global $db;
	$criterio = "";
	
	$co_estado = (isset($_POST['co_estado']) ? $_POST['co_estado'] : $_GET['co_estado']);	
	$co_municipio = (isset($_POST['co_municipio']) ? $_POST['co_municipio'] : $_GET['co_municipio']);

	if ($co_estado != '0' && $co_estado != '') 
	{
		$criterio = " WHERE co_estado = '$co_estado' ";
	}
	if ($co_municipio != '0' && $co_municipio != '') 
	{
		$criterio .= (( $criterio == '' ) ? " WHERE ":" AND ") . " co_municipio = '$co_municipio' ";
	}
	$sql = "SELECT co_estado , co_municipio, co_parroquia , nb_parroquia
		FROM app_parroquias $criterio GROUP BY co_parroquia,nb_parroquia ORDER BY co_parroquia";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Parroquias'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

function getCentros()
{

	global $db;
	$criterio = "";
	
	$co_estado = (isset($_POST['co_estado']) ? $_POST['co_estado'] : $_GET['co_estado']);	
	$co_municipio = (isset($_POST['co_municipio']) ? $_POST['co_municipio'] : $_GET['co_municipio']);
	$co_parroquia = (isset($_POST['co_parroquia']) ? $_POST['co_parroquia'] : $_GET['co_parroquia']);

	if ($co_estado != '0' && $co_estado != '') 
	{
		$criterio = " WHERE co_estado = '$co_estado' ";
	}
	if ($co_municipio != '0' && $co_municipio != '') 
	{
		$criterio .= (( $criterio == '' ) ? " WHERE ":" AND ") . " co_municipio = '$co_municipio' ";
	}
	if ($co_parroquia != '0' && $co_parroquia != '') 
	{
		$criterio .= (( $criterio == '' ) ? " WHERE ":" AND ") . " co_parroquia = '$co_parroquia' ";
	}
	
	$sql = "SELECT co_centro , dir_centro, nb_centro 
		FROM centros $criterio GROUP BY co_centro,nb_centro ORDER BY co_centro";

	if( !($resultado = $db->sql_query($sql)) )
	{			
		$response = "{'mensaje':'Ha ocurrido un error al Agregar a la persona','success':false}";		
		$response = json_encode($rows);		
	}
	else
	{		
		while ( $row = $db->sql_fetchrow($resultado) )
		{			
			$rows['Centros'][] = $row;
		}
		$response = json_encode($rows);
	}
	print $response;
}

$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
    
switch ($accion) 
{
	case 'getEstados':
	{
		getEstados();
		break;
	}
	case 'getMunicipios':
	{    
		getMunicipios();
		break;
	}
	case 'getParroquias':
	{    
		getParroquias();
		break;
	}
	case 'getCentros':
	{    
		getCentros();
		break;
	}
	case 'getEstudiantes':
	{    
		getEstudiantes();
		break;
	}
	case 'getGradoInstruccion':
	{    
		getGradoInstruccion();
		break;
	}
	case 'getMisiones':
	{    
		getMisiones();
		break;
	}
	case 'getPNF':
	{    
		getPNF();
		break;
	}
	case 'getGerencias':
	{    
		getGerencias();
		break;
	}
	case 'getInstitutos':
	{    
		getInstitutos();
		break;
	}
	case 'getProfesiones':
	{    
		getProfesiones();
		break;
	}
	break;
}
?>
