<?php
/**
*
* acp_ban [Galician]
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

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'		=> '1 hora',
	'30_MINS'		=> '30 minutos',
	'6_HOURS'		=> '6 horas',

	'ACP_BAN_EXPLAIN'	=> 'Aquí podes prohibir o acceso a usuarios segundo o seu nome, IP ou correo electrónico, evitando que poidan acceder a calquera parte dos foros. Podes incluír unha breve explicación (255 caracteres) da prohibición, que se amosará no rexistro (log) de administración. Tamén podes especificar a duración da prohibición. Se queres manter unha prohibición ata unha data concreta no canto dun período de tempo determinado, selecciona <u>Ata</u> para a duración e insire a data en formato aaaa-mm-dd.',

	'BAN_EXCLUDE'			=> 'Excluír das prohibicións',
	'BAN_LENGTH'			=> 'Duración da prohibición',
	'BAN_REASON'			=> 'Motivo da prohibición',
	'BAN_GIVE_REASON'		=> 'Motivo amosado ao usuario',
	'BAN_UPDATE_SUCCESSFUL'	=> 'A lista de prohibicións foi actualizada correctamente.',
	'BANNED_UNTIL_DATE'		=> 'até %s', // Example: "until Mon 13.Jul.2009, 14:44"
	'BANNED_UNTIL_DURATION'	=> '%1$s (até %2$s)', // Example: "7 days (until Tue 14.Jul.2009, 14:44)"

	'EMAIL_BAN'					=> 'Prohibir un ou máis enderezos de correo electrónico',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> 'Activa isto para excluír o correo inserido de todas as prohibicións actuáis.',
	'EMAIL_BAN_EXPLAIN'			=> 'Para indicar máis dun correo, insire cada un nunha liña. Podes empregar o * como comodín (por exemplo <samp>*@hotmail.com</samp> ou <samp>*@*.dominio.gal</samp>).',
	'EMAIL_NO_BANNED'			=> 'Non prohibiches enderezos de correo electrónico ningún',
	'EMAIL_UNBAN'				=> 'Quitar prohibición de correos',
	'EMAIL_UNBAN_EXPLAIN'		=> 'Podes quitar a prohibición/exclusión sobre varios correos usando a combinación de rato e teclado axeitada do teu ordenador e navegador. Os enderezos de correo excluídos teñen o fondo resaltado.',

	'IP_BAN'					=> 'Prohibir unha ou máis IPs',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> 'Activa isto para excluír a IP inserida de todas as prohibicións actuáis.',
	'IP_BAN_EXPLAIN'			=> 'Para indicar máins dunha IP ou host, insire cada un nunha liña diferente. Podes indicar un rango de enderezos IP separando o comezo do final cun trazo (-), e empregar * como comodín',
	'IP_HOSTNAME'				=> 'Enderezos IP ou hosts',
	'IP_NO_BANNED'				=> 'Non hai enderezos IP prohibidos',
	'IP_UNBAN'					=> 'Quitar prohibición por IP',
	'IP_UNBAN_EXPLAIN'			=> 'Podes quitar a prohibición/exclusión sobre varias IPs usando a combinación de rato e teclado axeitada ao teu ordenador e navegador. As IPs excluídas teñen o fondo resaltado.',

	'LENGTH_BAN_INVALID'		=> 'A data debe seguir o formato <kbd>YYYY-MM-DD</kbd>.',

	'OPTIONS_BANNED'			=> 'Prohibido',
	'OPTIONS_EXCLUDED'			=> 'Excluído',

	'PERMANENT'		=> 'Permanente',
	
	'UNTIL'						=> 'Até',
	'USER_BAN'					=> 'Prohibir un ou máis nomes de usuario',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> 'Activa isto para excluír os usuarios inseridos de todas as prohibicións actuáis.',
	'USER_BAN_EXPLAIN'			=> 'Podes prohibir varios usuarios dunha vez inserindo cada nome nunha nova liña. Podes usar a opción <span style="text-decoration: underline;">Procurar un membro</span> para facilitarche a vida.',
	'USER_NO_BANNED'			=> 'Non hai nomes de usuario prohibidos',
	'USER_UNBAN'				=> 'Quitar prohibición de nomes de usuario',
	'USER_UNBAN_EXPLAIN'		=> 'Podes quitar a prohibición/exclusión sobre varios usuarios usando a combinación de rato e teclado axeitada ao teu ordenador e navegador. Os usuarios excluídos teñen o fondo resaltado.',
));