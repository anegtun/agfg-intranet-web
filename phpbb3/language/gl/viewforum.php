<?php
/**
*
* viewforum [Galician]
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
	'ACTIVE_TOPICS'			=> 'Temas activos',
	'ANNOUNCEMENTS'			=> 'Anuncios',

	'FORUM_PERMISSIONS'		=> 'Permisos do foro',

	'ICON_ANNOUNCEMENT'		=> 'Anuncio',
	'ICON_STICKY'			=> 'Destacado',

	'LOGIN_NOTIFY_FORUM'	=> 'Envióuseche unha notificación verbo deste foro, por favor, inicia sesión para a ver.',

	'MARK_TOPICS_READ'		=> 'Marcar temas como lidos',

	'NEW_POSTS_HOT'			=> 'Novas mensaxes publicadas [Popular]',	// Not used anymore
	'NEW_POSTS_LOCKED'		=> 'Novas mensaxes publicadas [Bloqueado]',	// Not used anymore
	'NO_NEW_POSTS_HOT'		=> 'Non hai novas mensaxes [Popular]',	// Not used anymore
	'NO_NEW_POSTS_LOCKED'	=> 'Non hai novas mensaxes [Bloqueado]',	// Not used anymore
	'NO_READ_ACCESS'		=> 'Non dispós dos permisos precisos para ler temas incluídos neste foro.',
	'NO_FORUMS_IN_CATEGORY'	=> 'Non hai foro ningún nesta categoría.',
	'NO_UNREAD_POSTS_HOT'		=> 'Non hai mensaxes publicadas sen ler [ Popular ]',
	'NO_UNREAD_POSTS_LOCKED'	=> 'Non hai mensaxes publicadas sen ler [ Bloqueado ]',

	'POST_FORUM_LOCKED'		=> 'O foro está bloqueado',

	'TOPICS_MARKED'			=> 'Os temas deste foro foron marcados como lidos',

	'UNREAD_POSTS_HOT'		=> 'Mensaxes publicadas sen ler [ Popular ]',
	'UNREAD_POSTS_LOCKED'	=> 'Mensaxes publicadas sen ler [ Bloqueado ]',

	'VIEW_FORUM'			=> 'Ver foro',
	'VIEW_FORUM_TOPICS'		=> array(
		1	=> '%d tema',
		2	=> '%d temas',
	),
));
