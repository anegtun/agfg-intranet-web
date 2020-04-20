<?php
/**
*
* acp_bots [Galician]
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

// Bot settings
$lang = array_merge($lang, array(
	'BOTS'				=> 'Xestionar bots',
	'BOTS_EXPLAIN'		=> 'Os “bots”, “spiders” ou “crawlers” son axentes automatizados utilizados normalmente polos motores de procura para actualizar as súas bases de datos. Como non adoitan facer un uso axeitado das sesións poden distorsionar o contador de visitantes, incrementar a carga e, ás veces, fallar na indexación correcta dos sitios. Aquí poderás definir un tipo especial de usuario para solucionar estes problemas.',
	'BOT_ACTIVATE'		=> 'Activar',
	'BOT_ACTIVE'		=> 'Bot activo',
	'BOT_ADD'			=> 'Engadir bot',
	'BOT_ADDED'			=> 'Novo bot engadido correctamente',
	'BOT_AGENT'			=> 'Coincidencia co nome do axente',
	'BOT_AGENT_EXPLAIN'	=> 'Unha cadea que coincida co axente navegador (browser agent) dos bots. Permítense coincidencias parciais.',
	'BOT_DEACTIVATE'	=> 'Desactivar',
	'BOT_DELETED'		=> 'Bot eliminado correctamente',
	'BOT_EDIT'			=> 'Editar bots',
	'BOT_EDIT_EXPLAIN'	=> 'Aquí podes engadir ou editar unha entrada de bot existente. Podes definir unha cadea de axentes e/ou un ou máis enderezos IP (ou rango de enderezos) coincidentes. Ten coidado ao definila. Podes especificar un estilo e idioma que o bot visualizará cando visite a web. Isto reduce o largo de banda ao configurar un estilo sinxelo para os bots. Lembra estabelecer os permisos axeitados para o grupo especial de usuarios Bot.',
	'BOT_LANG'			=> 'Idioma do bot',
	'BOT_LANG_EXPLAIN'	=> 'O idioma presentado ao bot mentres este navega.',
	'BOT_LAST_VISIT'	=> 'Última visita',
	'BOT_IP'			=> 'Enderezo IP do bot',
	'BOT_IP_EXPLAIN'	=> 'Permítense coincidencias parciais. Separa os enderezos con comas.',
	'BOT_NAME'			=> 'Nome do bot',
	'BOT_NAME_EXPLAIN'	=> 'Utilizado só para a túa propia información.',
	'BOT_NAME_TAKEN'	=> 'Este nome xa está en uso e se non pode empregar para o Bot.',
	'BOT_NEVER'			=> 'Nunca',
	'BOT_STYLE'			=> 'Estilo para o bot',
	'BOT_STYLE_EXPLAIN'	=> 'O estilo a amosar cando visite un bot.',
	'BOT_UPDATED'		=> 'Bot existente actualizado axeitadamente.',

	'ERR_BOT_AGENT_MATCHES_UA'	=> 'O axente bot proporcionado é semellante ao que usas actualmente. Axusta o axente para este bot.',
	'ERR_BOT_NO_IP'				=> 'Os enderezos IP que proporcionaches son inválidos ou non se puido resolver o host.',
	'ERR_BOT_NO_MATCHES'		=> 'Debes proporcionar polo menos un axente ou un IP para esta coincidencia de bot.',

	'NO_BOT'		=> 'Non se atopou ningún bot co ID especificado.',
	'NO_BOT_GROUP'	=> 'Non se puido atopar o grupo especial de bot',
));
