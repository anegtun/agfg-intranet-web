<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'CLI_CONFIG_CANNOT_CACHED'			=> 'Habilita esta opción se a configuración cambia frecuentemente e non pode ser cacheada eficientemente.',
	'CLI_CONFIG_CURRENT'				=> 'Valor actual, usa 0 e 1 para especificar valores booleanos',
	'CLI_CONFIG_DELETE_SUCCESS'			=> 'Borrada configuración %s correctamente.',
	'CLI_CONFIG_NEW'					=> 'Novo valor de configuración, usa 0 e 1 para especificar valores booleanos',
	'CLI_CONFIG_NOT_EXISTS'				=> 'A configuración %s non existe',
	'CLI_CONFIG_OPTION_NAME'			=> 'O nome da opción de configuración',
	'CLI_CONFIG_PRINT_WITHOUT_NEWLINE'	=> 'Habilita esta opción se o valor debe imprimirse sen salto de liña ao final.',
	'CLI_CONFIG_INCREMENT_BY'			=> 'Cantidade a incrementar',
	'CLI_CONFIG_INCREMENT_SUCCESS'		=> 'Incrementada configuración %s correctamente',
	'CLI_CONFIG_SET_FAILURE'			=> 'Non se puido establecer a configuración %s',
	'CLI_CONFIG_SET_SUCCESS'			=> 'Establecida configuración %s correctamente',

	'CLI_DESCRIPTION_CRON_LIST'					=> 'Amosa unha lista de tarefas cron listos e non listos.',
	'CLI_DESCRIPTION_CRON_RUN'					=> 'Lanza todas as tarefas cron listas.',
	'CLI_DESCRIPTION_CRON_RUN_ARGUMENT_1'		=> 'Nome da tarefa a lanzar',
	'CLI_DESCRIPTION_DB_LIST'					=> 'Lista de todas as migracións instaladas e dispoñibles.',
	'CLI_DESCRIPTION_DB_MIGRATE'				=> 'Actualiza a base de datos aplicando a migración.',
	'CLI_DESCRIPTION_DB_REVERT'					=> 'Revertir a migración.',
	'CLI_DESCRIPTION_DELETE_CONFIG'				=> 'Borra a opción de configuración',
	'CLI_DESCRIPTION_DISABLE_EXTENSION'			=> 'Deshabilita a extensión.',
	'CLI_DESCRIPTION_ENABLE_EXTENSION'			=> 'Habilita a extensión.',
	'CLI_DESCRIPTION_FIND_MIGRATIONS'			=> 'Atopa migracións das que non se depende.',
	'CLI_DESCRIPTION_FIX_LEFT_RIGHT_IDS'		=> 'Repara a estrutura en árbore dos foros e móulos.',
	'CLI_DESCRIPTION_GET_CONFIG'				=> 'Obtén o valor da opción de configuración',
	'CLI_DESCRIPTION_INCREMENT_CONFIG'			=> 'Incrementa o valor da opción de configuración',
	'CLI_DESCRIPTION_LIST_EXTENSIONS'			=> 'Amosa todas as extensión na base de datos ou no sistema de arquivos.',

	'CLI_DESCRIPTION_OPTION_ENV'				=> 'O nome do contorno.',
	'CLI_DESCRIPTION_OPTION_SAFE_MODE'			=> 'Lanzar en Modo Seguro (sen extensións).',
	'CLI_DESCRIPTION_OPTION_SHELL'				=> 'Lanza a liña de comandos.',

	'CLI_DESCRIPTION_PURGE_EXTENSION'			=> 'Purga a extensión.',

	'CLI_DESCRIPTION_REPARSER_LIST'						=> 'Amosa os tipos de texto que poden volver ser parseados.',
	'CLI_DESCRIPTION_REPARSER_AVAILABLE'				=> 'Re-parsers dispoñibles:',
	'CLI_DESCRIPTION_REPARSER_REPARSE'					=> 'Volve a parsear o texto almacenado no servizo "text_formatter" actual.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_ARG_1'			=> 'Type de texto a parsear. Déixao en branco para volver a parsear todo.',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_DRY_RUN'		=> 'Non gardar ningún cambio; só amosa o que pasaría',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MIN'	=> 'ID do rexistro máis baixo a procesar',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_MAX'	=> 'ID do rexistro máis alto a procesar',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RANGE_SIZE'	=> 'Número aproximado de rexistros a procesar dunha vez',
	'CLI_DESCRIPTION_REPARSER_REPARSE_OPT_RESUME'		=> 'Comeza a parsear onde rematou a última execución',

	'CLI_DESCRIPTION_SET_ATOMIC_CONFIG'					=> 'Establece a opción de configuración só se o valor antigo coincide co actual',
	'CLI_DESCRIPTION_SET_CONFIG'						=> 'Establece o valor da opción de configuración',

	'CLI_DESCRIPTION_THUMBNAIL_DELETE'					=> 'Borra todas as miniaturas.',
	'CLI_DESCRIPTION_THUMBNAIL_GENERATE'				=> 'Xera todas as miniaturas que faltan.',
	'CLI_DESCRIPTION_THUMBNAIL_RECREATE'				=> 'Recrea todas as miniaturas.',

	'CLI_DESCRIPTION_UPDATE_CHECK'					=> 'Comproba se o taboleiro está ao día.',
	'CLI_DESCRIPTION_UPDATE_CHECK_ARGUMENT_1'		=> 'Nome da extensión a comprobar (se "all", comproba todas as extensións)',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_CACHE'		=> 'Lanza o comando de comprobación con caché.',
	'CLI_DESCRIPTION_UPDATE_CHECK_OPTION_STABILITY'	=> 'Lanza o comando escollendo se comprobar só versións estables ou inestables.',

	'CLI_DESCRIPTION_UPDATE_HASH_BCRYPT'		=> 'Actualiza hashes de password antigos para utilizar bcrypt.',

	'CLI_ERROR_INVALID_STABILITY' => '"%s" necesita ser "stable" ou "unstable".',

	'CLI_DESCRIPTION_USER_ACTIVATE'				=> 'Activa (ou desactiva) unha conta de usuario.',
	'CLI_DESCRIPTION_USER_ACTIVATE_USERNAME'	=> 'Nome de usuario da conta a activar.',
	'CLI_DESCRIPTION_USER_ACTIVATE_DEACTIVATE'	=> 'Desactiva a conta de usuario',
	'CLI_DESCRIPTION_USER_ACTIVATE_ACTIVE'		=> 'O usuario xa está activo.',
	'CLI_DESCRIPTION_USER_ACTIVATE_INACTIVE'	=> 'O usuario xa está inactivo.',
	'CLI_DESCRIPTION_USER_ADD'					=> 'Engade un novo usuario.',
	'CLI_DESCRIPTION_USER_ADD_OPTION_USERNAME'	=> 'Nome de usuario do novo usuario',
	'CLI_DESCRIPTION_USER_ADD_OPTION_PASSWORD'	=> 'Contrasinal do novo usuario',
	'CLI_DESCRIPTION_USER_ADD_OPTION_EMAIL'		=> 'Correo electrónico do novo usuario',
	'CLI_DESCRIPTION_USER_ADD_OPTION_NOTIFY'	=> 'Envía correo de verificación ao usuario para activar a conta (non se envía por defecto)',
	'CLI_DESCRIPTION_USER_DELETE'				=> 'Borra unha conta de usuario.',
	'CLI_DESCRIPTION_USER_DELETE_USERNAME'		=> 'Nome de usuario do usuario a eliminar',
	'CLI_DESCRIPTION_USER_DELETE_OPTION_POSTS'	=> 'Borra todas as publicacións do usuario. Sen esta opción, as publicacións do usuario manteranse.',
	'CLI_DESCRIPTION_USER_RECLEAN'				=> 'Limpa nomes de usuario.',

	'CLI_EXTENSION_DISABLE_FAILURE'		=> 'Non se puido deshabilitar a extensión %s',
	'CLI_EXTENSION_DISABLE_SUCCESS'		=> 'Deshabilitada correctamente a extensión %s',
	'CLI_EXTENSION_DISABLED'			=> 'A extensión %s non está habilitada',
	'CLI_EXTENSION_ENABLE_FAILURE'		=> 'Non se puido habilitar a extensión %s',
	'CLI_EXTENSION_ENABLE_SUCCESS'		=> 'Habilitada correctamente a extensión %s',
	'CLI_EXTENSION_ENABLED'				=> 'A extension %s xa está habilitada',
	'CLI_EXTENSION_NOT_EXIST'			=> 'A extension %s non existe',
	'CLI_EXTENSION_NAME'				=> 'Nome da extensión',
	'CLI_EXTENSION_PURGE_FAILURE'		=> 'Non se puido purgar a extensióń %s',
	'CLI_EXTENSION_PURGE_SUCCESS'		=> 'Purgada correctamente a extensión %s',
	'CLI_EXTENSION_UPDATE_FAILURE'		=> 'Non se puido actualizar a extensión %s',
	'CLI_EXTENSION_UPDATE_SUCCESS'		=> 'Actualizada correctamente a extensión %s',
	'CLI_EXTENSION_NOT_FOUND'			=> 'Non se atoparon extensións.',
	'CLI_EXTENSION_NOT_ENABLEABLE'		=> 'A extension %s non se pode habilitar.',
	'CLI_EXTENSIONS_AVAILABLE'			=> 'Dispoñible',
	'CLI_EXTENSIONS_DISABLED'			=> 'Deshabilitada',
	'CLI_EXTENSIONS_ENABLED'			=> 'Habilitada',

	'CLI_FIXUP_FIX_LEFT_RIGHT_IDS_SUCCESS'		=> 'Reparada correctamente a estrutura en árbore dos foros e módulos.',
	'CLI_FIXUP_UPDATE_HASH_BCRYPT_SUCCESS'		=> 'Actualizados correctamente os hashes dos contrarináis a bcrypt.',

	'CLI_MIGRATION_NAME'					=> 'Nome da migración, incluíndo o espazo de nomes -namespace- (utiliza barras normáis en lugar de barras invertidas para evitar problemas).',
	'CLI_MIGRATIONS_AVAILABLE'				=> 'Migracións dispoñibles',
	'CLI_MIGRATIONS_INSTALLED'				=> 'Migracións instaladas',
	'CLI_MIGRATIONS_ONLY_AVAILABLE'		    => 'Amosa só migracións dispoñibles',
	'CLI_MIGRATIONS_EMPTY'                  => 'Non existen migracións.',

	'CLI_REPARSER_REPARSE_REPARSING'		=> 'Re-parseando %1$s (rango %2$d..%3$d)',
	'CLI_REPARSER_REPARSE_REPARSING_START'	=> 'Re-parseando %s...',
	'CLI_REPARSER_REPARSE_SUCCESS'			=> 'O re-parseado acabou correctamente',

	// In all the case %1$s is the logical name of the file and %2$s the real name on the filesystem
	// eg: big_image.png (2_a51529ae7932008cf8454a95af84cacd) generated.
	'CLI_THUMBNAIL_DELETED'		=> 'Eliminada miniatura %1$s (%2$s).',
	'CLI_THUMBNAIL_DELETING'	=> 'Borrando miniaturas',
	'CLI_THUMBNAIL_SKIPPED'		=> 'Saltando miniatura %1$s (%2$s).',
	'CLI_THUMBNAIL_GENERATED'	=> 'Xerada miniatura %1$s (%2$s).',
	'CLI_THUMBNAIL_GENERATING'	=> 'Xerando miniaturas',
	'CLI_THUMBNAIL_GENERATING_DONE'	=> 'Todas as miniaturas foron xeradas de novo.',
	'CLI_THUMBNAIL_DELETING_DONE'	=> 'Todas as miniaturas foron borradas.',

	'CLI_THUMBNAIL_NOTHING_TO_GENERATE'	=> 'Non hai miniaturas a xerar.',
	'CLI_THUMBNAIL_NOTHING_TO_DELETE'	=> 'Non hai miniaturas a borrar.',

	'CLI_USER_ADD_SUCCESS'		=> 'Engadido usuario %s correctamente.',
	'CLI_USER_DELETE_CONFIRM'	=> 'Estás seguro de borrar ao usuario ‘%s’? [y/N]',
	'CLI_USER_RECLEAN_START'	=> 'Limpando nomes de usuario',
	'CLI_USER_RECLEAN_DONE'		=> [
		0	=> 'Limpeza de nomes de usuario rematada. Ningún nome de usuario necesitaba ser limpado.',
		1	=> 'Limpeza de nomes de usuario rematada. Limpado %d nome de usuario.',
		2	=> 'Limpeza de nomes de usuario rematada. Limpados %d nomes de usuario.',
	],
));

// Additional help for commands.
$lang = array_merge($lang, array(
	'CLI_HELP_CRON_RUN'			=> $lang['CLI_DESCRIPTION_CRON_RUN'] . ' Opcionalmente podes especificar un nome para a tarefa cron para lanzar só esa tarefa.',
	'CLI_HELP_USER_ACTIVATE'	=> 'Activa unha conta de usuario, ou desactiva a conta usando a opción <info>--deactivate</info>.
Para mandar o correo de activación ao usuario, usa a opción <info>--send-email</info>.',
	'CLI_HELP_USER_ADD'			=> 'O comando <info>%command.name%</info> egade un novo usuario:
Se este comando se lanza sen opcións, pediráseche que as vaias cubrindo.
Para mandar un correo ao novo usuario, usa a opción <info>--send-email</info>.',
	'CLI_HELP_USER_RECLEAN'		=> 'A limpeza de nomes de usuario comprobará todos os nomes de usuario almacenados para asegurarse de que a versión "limpa" tamén está gardada. Os nomes de usuario limpos son unha forma case-insensitive, normalizada en NFC e convertida a ASCII.',
));
