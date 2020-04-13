<?php
/**
*
* acp_styles [Galician]
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
	'ACP_STYLES_EXPLAIN'						=> 'Aquí podes xestionar os estilos dispoñíbeis no taboleiro. Un estilo consiste nunha sobreplanta, tema e xogo de imaxes. Podes alterar estilos existentes, eliminalos, desactivalos, reactivalos, crealos ou importalos novos. Tamén podes ver como se presentará un estilo usando a función de previsualización. O estilo predeterminado actual está marcado cun asterisco(*). Tamén se indica a conta total de usuarios para cada estilo, omitindo os contradictorios.',

	'CANNOT_BE_INSTALLED'						=> 'Non se pode instalar',
	'CONFIRM_UNINSTALL_STYLES'					=> 'Estás seguro de quereres desinstalar os estilos escollidos?',
	'COPYRIGHT'									=> 'Copyright',

	'DEACTIVATE_DEFAULT'						=> 'Non podes desactivar o estilo por defecto.',
	'DELETE_FROM_FS'							=> 'Eliminar do sistema de arquivos',
	'DELETE_STYLE_FILES_FAILED'					=> 'Erro ao eliminar os ficheiros do estilo "%s".',
	'DELETE_STYLE_FILES_SUCCESS'				=> 'Elimináronse os ficheiros do estilo "%s".',
	'DETAILS'									=> 'Pormenores',

	'INHERITING_FROM'							=> 'Herdado de',
	'INSTALL_STYLE'								=> 'Instalar estilo',
	'INSTALL_STYLES'							=> 'Instalar estilos',
	'INSTALL_STYLES_EXPLAIN'					=> 'Aquí podes instalar un novo estilo e os correspondentes elementos de estilo se o consideras axeitado. Se xa instalaches os elementos de estilo máis relevantes, non serán sobrescritos. Algúns estilos requiren elementos de estilo previamente instalados. Recibirás un aviso se estás tentando instalar estilos deste tipo e non existen os elementos previos necesarios.',
	'INVALID_STYLE_ID'							=> 'ID de estilo non válido.',

	'NO_MATCHING_STYLES_FOUND'					=> 'Non se detectaron estilos que coincidan coa procuda.',
	'NO_UNINSTALLED_STYLE'						=> 'Non se detectaron estilos desinstalados',

	'PURGED_CACHE'								=> 'Purgouse a caché.',

	'REQUIRES_STYLE'							=> 'Este estilo require que se teña instalado o estilo "%s".',

	'STYLE_ACTIVATE'							=> 'Activar',
	'STYLE_ACTIVE'								=> 'Activo',
	'STYLE_DEACTIVATE'							=> 'Desactivar',
	'STYLE_DEFAULT'								=> 'Converter en estilo predeterminado',
	'STYLE_DEFAULT_CHANGE_INACTIVE'				=> 'Debes activar o estilo antes de establecelo como estilo por defecto.',
	'STYLE_ERR_INVALID_PARENT'					=> 'Estilo pai non válido.',
	'STYLE_ERR_NAME_EXIST'						=> 'Xa existe un estilo con ese nome',
	'STYLE_ERR_STYLE_NAME'						=> 'Debes proporcionar un nome para este estilo.',
	'STYLE_INSTALLED'							=> 'Instalouse o estilo "%s".',
	'STYLE_INSTALLED_RETURN_INSTALLED_STYLES'	=> 'Volve á lista de estilos',
	'STYLE_INSTALLED_RETURN_UNINSTALLED_STYLES'	=> 'Instalar máis estilos',
	'STYLE_NAME'								=> 'Nome do estilo',
	'STYLE_NAME_RESERVED'						=> 'Non se pode instalar o estilo "%s" porque o nome está reservado.',
	'STYLE_NOT_INSTALLED'						=> 'Non se instalou o estilo "%s".',
	'STYLE_PATH'								=> 'Ruta ao estilo',
	'STYLE_UNINSTALL'							=> 'Desinstalar',
	'STYLE_UNINSTALL_DEPENDENT'					=> 'Non se pode desinstalar o estilo "%s" porque ten estilos fillos.',
	'STYLE_UNINSTALLED'							=> 'Desinstalouse o estilo "%s".',
	'STYLE_PHPBB_VERSION'						=> 'Versión phpBB',
	'STYLE_USED_BY'								=> 'Utilizado por',
	'STYLE_VERSION'								=> 'Version do estilo',

	'UNINSTALL_PROSILVER'						=> 'Non podes desinstalar o estilo “prosilver”.',
	'UNINSTALL_DEFAULT'							=> 'Non podes desinstalar o estilo por defecto.',

	'BROWSE_STYLES_DATABASE'					=> 'Consulta a base de datos de estilos',
));