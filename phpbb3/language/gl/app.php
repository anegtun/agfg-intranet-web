<?php
/**
*
* captcha_qa [Galician]
*
* @package language
* @version $Id$
* @copyright (c) 2009 phpBB Group
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
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'CONTROLLER_ARGUMENT_VALUE_MISSING'	=> 'Falta o valor do argumento #%1$s: <strong>%3$s</strong> na clase <strong>%2$s</strong>',
	'CONTROLLER_NOT_SPECIFIED'			=> 'Non se espcificou ningún controlador.',
	'CONTROLLER_METHOD_NOT_SPECIFIED'	=> 'Non se especificou ningún método para o controlador.',
	'CONTROLLER_SERVICE_UNDEFINED'		=> 'O servizo para o controlador “<strong>%s</strong>” non está definido no ficheiro ./config/services.yml.',
));
