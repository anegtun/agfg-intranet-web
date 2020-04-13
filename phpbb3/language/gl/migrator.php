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
	'CONFIG_NOT_EXIST'					=> 'O axuste de configuración "%s" non exsite.',

	'GROUP_NOT_EXIST'					=> 'O grupo "%s" non existe.',

	'MIGRATION_APPLY_DEPENDENCIES'		=> 'Aplicar dependencias de %s.',
	'MIGRATION_DATA_DONE'				=> 'Instalados datos: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_DATA_IN_PROGRESS'		=> 'Instalando datos: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_DATA_RUNNING'			=> 'Instalando datos: %s.',
	'MIGRATION_EFFECTIVELY_INSTALLED'	=> 'A migración xa foi instalada (omitida): %s',
	'MIGRATION_EXCEPTION_ERROR'			=> 'Algo foi mal e lanzouse unha excepción. Revertíronse o mellor que puidemos os cambios feitos antes de que ocurrira o erro, pero deberías revisar se hai algún erro no foro:<br><br>%s',
	'MIGRATION_NOT_FULFILLABLE'			=> 'A migración "%1$s" non se pode completar, falta a migración "%2$s".',
	'MIGRATION_NOT_INSTALLED'			=> 'A migración "%s" non está instalada.',
	'MIGRATION_NOT_VALID'				=> '%s non é unha migración válida.',
	'MIGRATION_SCHEMA_DONE'				=> 'Instalado esquema: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_SCHEMA_IN_PROGRESS'		=> 'Instalando esquema: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_SCHEMA_RUNNING'			=> 'Instalando esquema: %s.',

	'MIGRATION_REVERT_DATA_DONE'		=> 'Revertidos datos: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_REVERT_DATA_IN_PROGRESS'	=> 'Revertindo datos: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_REVERT_DATA_RUNNING'		=> 'Revertindo datos: %s.',
	'MIGRATION_REVERT_SCHEMA_DONE'		=> 'Revertido esquema: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_REVERT_SCHEMA_IN_PROGRESS'	=> 'Revertindo esquema: %1$s; Tempo: %2$.2f segundos',
	'MIGRATION_REVERT_SCHEMA_RUNNING'	=> 'Revertindo esquema: %s.',

	'MIGRATION_INVALID_DATA_MISSING_CONDITION'		=> 'Unha migración é inválida. A unha sentenza condicional fáltalle unha condición.',
	'MIGRATION_INVALID_DATA_MISSING_STEP'			=> 'Unha migración é inválida. A unha sentenza condicional fáltalle unha chamada a un paso da migración.',
	'MIGRATION_INVALID_DATA_CUSTOM_NOT_CALLABLE'	=> 'Unha migración é inválida. Non se puido chamar a unha función propia.',
	'MIGRATION_INVALID_DATA_UNKNOWN_TYPE'			=> 'Unha migración é inválida. Atopouse un tipo de ferramenta de migración descoñecida.',
	'MIGRATION_INVALID_DATA_UNDEFINED_TOOL'			=> 'Unha migración é inválida. Atopouse unha ferramenta de migración sen definir.',
	'MIGRATION_INVALID_DATA_UNDEFINED_METHOD'		=> 'Unha migración é inválida. Atopuse un método na ferramenta de migración sen definir.',

	'MODULE_ERROR'						=> 'Ocorriu un erro creando o módulo: %s',
	'MODULE_EXISTS'						=> 'Un módulo xa existe: %s',
	'MODULE_EXIST_MULTIPLE'				=> 'Varios módulos co módulo pai "langname" xa existen: %s. Probar a usar claves antes/despóis para clarificar a ubicación do módulo.',
	'MODULE_INFO_FILE_NOT_EXIST'		=> 'Falta información sobre un módulo requerido: %2$s',
	'MODULE_NOT_EXIST'					=> 'Un módulo requerido non existe: %s',

	'PARENT_MODULE_FIND_ERROR'			=> 'Non foi posible determinar o módulo pai: %s',
	'PERMISSION_NOT_EXIST'				=> 'O axuste de permiso "%s" non existe.',

	'ROLE_NOT_EXIST'					=> 'O rol "%s" non existe.',
));
