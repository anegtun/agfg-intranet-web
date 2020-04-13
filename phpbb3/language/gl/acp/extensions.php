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
	'EXTENSION'					=> 'Estansión',
	'EXTENSIONS'				=> 'Estansións',
	'EXTENSIONS_ADMIN'			=> 'Xestor de Extensións',
	'EXTENSIONS_EXPLAIN'		=> 'O Xestor de Extensións é unha ferramenta que che permite xestionar todas as extensións (estado, información, etc.).',
	'EXTENSION_INVALID_LIST'	=> 'A extensión “%s” non é válida.<br />%s<br /><br />',
	'EXTENSION_NOT_AVAILABLE'	=> 'A extensión escollida non está dispoñible para este foro. Verifica a tua versión de phpBB e PHP (ver páxina de detalles).',
	'EXTENSION_DIR_INVALID'		=> 'A extensión escollida ten unha estrutura de directorios inválida e non se pode habilitar.',
	'EXTENSION_NOT_ENABLEABLE'	=> 'Non se pode habilitar a extensión escollida, por favor verifica os requerimentos da extensión.',
	'EXTENSION_NOT_INSTALLED'	=> 'A extensión %s non está dispoñible. Por favor comproba que a instalaches correctamente.',

	'DETAILS'				=> 'Detalles',

	'EXTENSIONS_DISABLED'	=> 'Extensións Deshabilitadas',
	'EXTENSIONS_ENABLED'	=> 'Extensións Habilitadas',

	'EXTENSION_DELETE_DATA'	=> 'Eliminar datos',
	'EXTENSION_DISABLE'		=> 'Deshabilitar',
	'EXTENSION_ENABLE'		=> 'Habilitar',

	'EXTENSION_DELETE_DATA_EXPLAIN'	=> 'Eliminar os datos dunha extensión elimina todos os datos incluíndo os axustes. Os ficheiros da extensión conservaranse para que se poida habilitar outra vez.',
	'EXTENSION_DISABLE_EXPLAIN'		=> 'Deshabilitar una extensión mantén os seus ficheiros, datos e axustes pero elimina calqueira funcionalidade engadida pola extensión.',
	'EXTENSION_ENABLE_EXPLAIN'		=> 'Habilitar unha extensión permite empregala no foro.',

	'EXTENSION_DELETE_DATA_IN_PROGRESS'	=> 'Estanse a eliminar os datos da extensión. Por favor non saias ou actualices a páxina ata que remate.',
	'EXTENSION_DISABLE_IN_PROGRESS'	=> 'Estase a deshabilitar a extensión. Por favor non saias ou actualices a páxina ata que remate.',
	'EXTENSION_ENABLE_IN_PROGRESS'	=> 'Estase a habilitar a extensión. Por favor non saias ou actualices a páxina ata que remate.',

	'EXTENSION_DELETE_DATA_SUCCESS'	=> 'Eliminaronse correctamente os datos da extensión',
	'EXTENSION_DISABLE_SUCCESS'		=> 'Deshabilitouse a extensión',
	'EXTENSION_ENABLE_SUCCESS'		=> 'Habilitouse a extensión',

	'EXTENSION_NAME'			=> 'Nome da Extensión',
	'EXTENSION_ACTIONS'			=> 'Accións',
	'EXTENSION_OPTIONS'			=> 'Opcións',
	'EXTENSION_INSTALL_HEADLINE'=> 'Instalando unha extensión',
	'EXTENSION_INSTALL_EXPLAIN'	=> '<ol>
			<li>Descargar unha extensión da base de datos de extensións de phpBB</li>
			<li>Descomprimir a extensión e subila ao directorio <samp>ext/</samp> de phpBB</li>
			<li>Habilitar a extensión no Xestor de Extensións (aquí)</li>
		</ol>',
	'EXTENSION_UPDATE_HEADLINE'	=> 'Actualizando unha extensión',
	'EXTENSION_UPDATE_EXPLAIN'	=> '<ol>
			<li>Deshabilitar a extensión</li>
			<li>Eliminar os ficheiros da extensión do sistema de ficheiros</li>
			<li>Subir novos ficheiros</li>
			<li>Habilitar a extensión</li>
		</ol>',
	'EXTENSION_REMOVE_HEADLINE'	=> 'Eliminar completamente unha extensión',
	'EXTENSION_REMOVE_EXPLAIN'	=> '<ol>
			<li>Deshabilitar a extensión</li>
			<li>Eliminar os datos da extensión</li>
			<li>Eliminar os ficheiros da extensión do sistema de ficheiros</li>
		</ol>',

	'EXTENSION_DELETE_DATA_CONFIRM'	=> 'Estás seguro de quereres eliminar os datos asociados a “%s”?<br /><br />Isto eliminará todos os datos e non se pode volver atrás!',
	'EXTENSION_DISABLE_CONFIRM'		=> 'Estás seguro de quereres deshabilitar a extensión “%s”?',
	'EXTENSION_ENABLE_CONFIRM'		=> 'Estás seguro de quereres habilitar a extensión “%s”?',
	'EXTENSION_FORCE_UNSTABLE_CONFIRM'	=> 'Estás seguro de quereres forzar o uso dunha extensión inestable?',

	'RETURN_TO_EXTENSION_LIST'	=> 'Volve ao listado de extensións',

	'EXT_DETAILS'			=> 'Detalles da Extensión',
	'DISPLAY_NAME'			=> 'Nome a Amosar',
	'CLEAN_NAME'			=> 'Nome Limpo',
	'TYPE'					=> 'Tipo',
	'DESCRIPTION'			=> 'Descrición',
	'VERSION'				=> 'Versión',
	'HOMEPAGE'				=> 'Páxina web',
	'PATH'					=> 'Ruta',
	'TIME'					=> 'Data de Publicación',
	'LICENSE'				=> 'Licenza',

	'REQUIREMENTS'			=> 'Requerimentos',
	'PHPBB_VERSION'			=> 'Versión phpBB',
	'PHP_VERSION'			=> 'Versión PHP',
	'AUTHOR_INFORMATION'	=> 'Información do Autor',
	'AUTHOR_NAME'			=> 'Nome',
	'AUTHOR_EMAIL'			=> 'Correo-e',
	'AUTHOR_HOMEPAGE'		=> 'Páxina web',
	'AUTHOR_ROLE'			=> 'Rol',

	'NOT_UP_TO_DATE'		=> '%s está desactualizado',
	'UP_TO_DATE'			=> '%s está ao día',
	'ANNOUNCEMENT_TOPIC'	=> 'Anuncio de Publicación',
	'DOWNLOAD_LATEST'		=> 'Descargar Versión',
	'NO_VERSIONCHECK'		=> 'Non se atopou información de comprobación de versión.',

	'VERSIONCHECK_FORCE_UPDATE_ALL'		=> 'Volver a comprobar todas as versións',
	'FORCE_UNSTABLE'					=> 'Comprobar sempre versións inestables',
	'EXTENSIONS_VERSION_CHECK_SETTINGS'	=> 'Axustes de comprobación de versión',

	'BROWSE_EXTENSIONS_DATABASE'		=> 'Consultar base de datos de extensións',

	'META_FIELD_NOT_SET'	=> 'Non se estableceu o campo meta requirido %s.',
	'META_FIELD_INVALID'	=> 'O campo meta %s é inválido.',
));