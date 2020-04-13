<?php
/**
*
* memberlist [Galician]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'PLUPLOAD_ADD_FILES'		=> 'Engadir ficheiros',
	'PLUPLOAD_ADD_FILES_TO_QUEUE'	=> 'Engadir ficheiros á cola de subida e preme no botón de comezar.',
	'PLUPLOAD_ALREADY_QUEUED'	=> '%s xa está presente na cola.',
	'PLUPLOAD_CLOSE'			=> 'Pechar',
	'PLUPLOAD_DRAG'				=> 'Arrastra os ficheiros aquí.',
	'PLUPLOAD_DUPLICATE_ERROR'	=> 'Erro por ficheiro duplicado.',
	'PLUPLOAD_DRAG_TEXTAREA'	=> 'Tamén podes achegar ficheiros arrastrándoos á caixa da mensaxe.',
	'PLUPLOAD_ERR_INPUT'		=> 'Fallo ao abrir o fluxo de entrada.',
	'PLUPLOAD_ERR_MOVE_UPLOADED'	=> 'Fallo ao mover o ficheiro subido.',
	'PLUPLOAD_ERR_OUTPUT'		=> 'Fallo ao abrir o fluxo de saída.',
	'PLUPLOAD_ERR_FILE_TOO_LARGE'	=> 'Ficheiro moi grande:',
	'PLUPLOAD_ERR_FILE_COUNT'	=> 'Erro ao contar ficheiros.',
	'PLUPLOAD_ERR_FILE_INVALID_EXT'	=> 'Extensión inválida:',
	'PLUPLOAD_ERR_RUNTIME_MEMORY'	=> 'O sitema quedouse sen memoría.',
	'PLUPLOAD_ERR_UPLOAD_URL'	=> 'A URL de subida parece estar mal ou non existe.',
	'PLUPLOAD_EXTENSION_ERROR'	=> 'Erro na extensión do ficheiro.',
	'PLUPLOAD_FILE'				=> 'Ficheiro: %s',
	'PLUPLOAD_FILE_DETAILS'		=> 'Ficheiro: %s, tamaño: %d, tamaño máximo: %d',
	'PLUPLOAD_FILENAME'			=> 'Nome do ficheiro',
	'PLUPLOAD_FILES_QUEUED'		=> '%d ficheiros encolados',
	'PLUPLOAD_GENERIC_ERROR'	=> 'Erro xenérico.',
	'PLUPLOAD_HTTP_ERROR'		=> 'Erro HTTP.',
	'PLUPLOAD_IMAGE_FORMAT'		=> 'O formato de imaxe é erróneo ou non está soportado.',
	'PLUPLOAD_INIT_ERROR'		=> 'Erro de inicialización.',
	'PLUPLOAD_IO_ERROR'			=> 'Erro de E/S.',
	'PLUPLOAD_NOT_APPLICABLE'	=> 'N/A',
	'PLUPLOAD_SECURITY_ERROR'	=> 'Erro de seguridade.',
	'PLUPLOAD_SELECT_FILES'		=> 'Escolle os ficheiros',
	'PLUPLOAD_SIZE'				=> 'Tamaño',
	'PLUPLOAD_SIZE_ERROR'		=> 'Erro no tamaño do ficheiro.',
	'PLUPLOAD_STATUS'			=> 'Estado',
	'PLUPLOAD_START_UPLOAD'		=> 'Comezar subida',
	'PLUPLOAD_START_CURRENT_UPLOAD'	=> 'Comezar a subida da cola',
	'PLUPLOAD_STOP_UPLOAD'		=> 'Para subida',
	'PLUPLOAD_STOP_CURRENT_UPLOAD'	=> 'Parar subida actual',
	// Note: This string is formatted independently by plupload and so does not
	// use the same formatting rules as normal phpBB translation strings
	'PLUPLOAD_UPLOADED'			=> 'Subidos %d/%d ficheiros',
));
