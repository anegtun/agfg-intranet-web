<?php
/**
* acp_permissions_phpbb (phpBB Permission Set) [Galician]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

/**
*	EXTENSION-DEVELOPERS PLEASE NOTE
*
*	You are able to put your permission sets into your extension.
*	The permissions logic should be added via the 'core.permissions' event.
*	You can easily add new permission categories, types and permissions, by
*	simply merging them into the respective arrays.
*	The respective language strings should be added into a language file, that
*	start with 'permissions_', so they are automatically loaded within the ACP.
*/

$lang = array_merge($lang, array(
	'ACL_CAT_ACTIONS'		=> 'Accións',
	'ACL_CAT_CONTENT'		=> 'Contido',
	'ACL_CAT_FORUMS'		=> 'Foros',
	'ACL_CAT_MISC'			=> 'Outros',
	'ACL_CAT_PERMISSIONS'	=> 'Permisos',
	'ACL_CAT_PM'			=> 'Mensaxes Privadas',
	'ACL_CAT_POLLS'			=> 'Enquisas',
	'ACL_CAT_POST'			=> 'Mensaxe',
	'ACL_CAT_POST_ACTIONS'	=> 'Accións de mensaxe',
	'ACL_CAT_POSTING'		=> 'Publicando',
	'ACL_CAT_PROFILE'		=> 'Perfil',
	'ACL_CAT_SETTINGS'		=> 'Configuración',
	'ACL_CAT_TOPIC_ACTIONS'	=> 'Accións de tema',
	'ACL_CAT_USER_GROUP'	=> 'Usuarios e Grupos',
));

// User Permissions
$lang = array_merge($lang, array(
	'ACL_U_VIEWPROFILE'	=> 'Podes visualizar perfís, lista de membros e lista de conectados',
	'ACL_U_CHGNAME'		=> 'Podes cambiar o nome de usuario',
	'ACL_U_CHGPASSWD'	=> 'Podes cambiar o contrasinal',
	'ACL_U_CHGEMAIL'	=> 'Podes cambiar enderezo do email',
	'ACL_U_CHGAVATAR'	=> 'Podes cambiar representación dixital (avatar)',
	'ACL_U_CHGGRP'		=> 'Podes cambiar grupo de usuario predeterminado',
	'ACL_U_CHGPROFILEINFO'	=> 'Podes mudar información de perfil',

	'ACL_U_ATTACH'		=> 'Podes anexar ficheiros',
	'ACL_U_DOWNLOAD'	=> 'Podes descargar ficheiros',
	'ACL_U_SAVEDRAFTS'	=> 'Podes gardar rascuños',
	'ACL_U_CHGCENSORS'	=> 'Podes desactivar censores de palabras',
	'ACL_U_SIG'			=> 'Podes usar sinatura',
	'ACL_U_EMOJI'		=> 'Podes usar emojis e texto rico no tíutlo do tema',

	'ACL_U_SENDPM'		=> 'Podes enviar mensaxes privadas',
	'ACL_U_MASSPM'		=> 'Podes enviar mensaxes a múltiples usuarios',
	'ACL_U_MASSPM_GROUP'=> 'Podes enviar mensaxes a grupos',
	'ACL_U_READPM'		=> 'Podes ler mensaxes privadas',
	'ACL_U_PM_EDIT'		=> 'Podes editar mensaxes privadas propias',
	'ACL_U_PM_DELETE'	=> 'Podes eliminar mensaxes privadas desde o propio cartafol',
	'ACL_U_PM_FORWARD'	=> 'Podes envíar mensaxes privadas',
	'ACL_U_PM_EMAILPM'	=> 'Podes enviar por mail mensaxes privadas',
	'ACL_U_PM_PRINTPM'	=> 'Podes imprimir mensaxes privadas',
	'ACL_U_PM_ATTACH'	=> 'Podes engadir arquivos anexos a mensaxes privadas',
	'ACL_U_PM_DOWNLOAD'	=> 'Podes baixar arquivos en mensaxes privadas',
	'ACL_U_PM_BBCODE'	=> 'Podes usar BBCode en mensaxes privadas',
	'ACL_U_PM_SMILIES'	=> 'Podes usar risoños en mensaxes privadas',
	'ACL_U_PM_IMG'		=> 'Podes usar a etiqueta BBCode [img] en mensaxes privadas',
	'ACL_U_PM_FLASH'	=> 'Podes usar a etiqueta BBCode [flash] en mensaxes privadas',

	'ACL_U_SENDEMAIL'	=> 'Podes enviar correo-e',
	'ACL_U_SENDIM'		=> 'Podes enviar mensaxes instantáneos',
	'ACL_U_IGNOREFLOOD'	=> 'Podes ignorar o límite de fluxo',
	'ACL_U_HIDEONLINE'	=> 'Podes agochar o status en liña',
	'ACL_U_VIEWONLINE'	=> 'Podes mirar todo en rede',
	'ACL_U_SEARCH'		=> 'Podes procurar no taboleiro',
));

// Forum Permissions
$lang = array_merge($lang, array(
	'ACL_F_LIST'		=> 'Podes mirar o Foro',
	'ACL_F_LIST_TOPICS' => 'Podes ver temas',
	'ACL_F_READ'		=> 'Podes ler o Foro',
	'ACL_F_SEARCH'		=> 'Podes procurar no foro',
	'ACL_F_SUBSCRIBE'	=> 'Podes subscribirte ao foro',
	'ACL_F_PRINT'		=> 'Podes imprimir temas',
	'ACL_F_EMAIL'		=> 'Podes enviar temas por correo',
	'ACL_F_BUMP'		=> 'Podes subir temas',
	'ACL_F_USER_LOCK'	=> 'Podes bloquear temas propios',
	'ACL_F_DOWNLOAD'	=> 'Podes descargar ficheiros',
	'ACL_F_REPORT'		=> 'Podes denunciar mensaxes',

	'ACL_F_POST'		=> 'Podes publicar mensaxes no foro',
	'ACL_F_STICKY'		=> 'Podes publicar notas',
	'ACL_F_ANNOUNCE'	=> 'Podes publicar anuncios',
	'ACL_F_ANNOUNCE_GLOBAL'	=> 'Podes publicar anuncios globáis',
	'ACL_F_REPLY'		=> 'Podes responder a mensaxes publicados',
	'ACL_F_EDIT'		=> 'Podes editar as túas propias mensaxes',
	'ACL_F_DELETE'		=> 'Podes eliminar as túas propias mensaxes de xeito permanente',
	'ACL_F_SOFTDELETE'	=> 'Podes elimianr de xeito brando as túas mensaxes<br /><em>Os moderadores, que poden aprobar mensaxes, poden restaurar mensaxes borradas de xeito brando.</em>',
	'ACL_F_IGNOREFLOOD' => 'Podes ignorar o límite de desbordamento',
	'ACL_F_POSTCOUNT'	=> 'Incrementa o contador de mensaxes<br /><em>Ten en conta que este axuste só afecta a mensaxes novas.</em>',
	'ACL_F_NOAPPROVE'	=> 'Pode publicar se aprobación previa',

	'ACL_F_ATTACH'		=> 'Pode achegar ficheiros adxuntos',
	'ACL_F_ICONS'		=> 'Podes usar iconas nas mensaxes e temas',
	'ACL_F_BBCODE'		=> 'Pode usar BBCode',
	'ACL_F_FLASH'		=> 'Pode usar a etiqueta [flash]',
	'ACL_F_IMG'			=> 'Pode usar a etiqueta [img]',
	'ACL_F_SIGS'		=> 'Poude usar firmas',
	'ACL_F_SMILIES'		=> 'Pode usar smilies',

	'ACL_F_POLL'		=> 'Podes crear enquisas',
	'ACL_F_VOTE'		=> 'Podes votar nas enquisas',
	'ACL_F_VOTECHG'		=> 'Podes cambiar o voto existente',
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'ACL_M_EDIT'		=> 'Podes editar mensaxes publicadas',
	'ACL_M_DELETE'		=> 'Podes eliminar mensaxes publicadas',
	'ACL_M_SOFTDELETE'	=> 'Podes eliminar mensaxes de xeito brando<br /><em>Os moderadores, que poden aprobar mensaxes, poden restaurar mensaxes eliminadas de xeito brando.</em>',
	'ACL_M_APPROVE'		=> 'Podes aprobar mensaxes publicadas',
	'ACL_M_REPORT'		=> 'Podes pechar e eliminar informes',
	'ACL_M_CHGPOSTER'	=> 'Podes mudar o autor da mensaxe publicada'

	'ACL_M_MOVE'	=> 'Podes mover temas',
	'ACL_M_LOCK'	=> 'Podes bloquear temas',
	'ACL_M_SPLIT'	=> 'Podes dividir temas',
	'ACL_M_MERGE'	=> 'Podes unir temas',

	'ACL_M_INFO'		=> 'Podes ver os pormenores das mensaxes publicadas',
	'ACL_M_WARN'		=> 'Podes emitir advertencias<br /><em>Este axuste asignase só de xeito global. Non depende do foro.</em>',
	'ACL_M_PM_REPORT'	=> 'Podes pechar e eliminar denuncias de mensaxes privadas<br /><em>Este axuste só se pode asignar de xeito global, non por foro.</em>', // This moderator setting is only global (and not local)
	'ACL_M_BAN'			=> 'Podes xestionar prohibicións<br /><em>Este axuste asignase só de xeito global. Non depende do foro.</em>', // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'ACL_A_BOARD'		=> 'Podes modificar a configuración do taboleiro',
	'ACL_A_SERVER'		=> 'Podes modificar a configuración do servidor ou da comunicación',
	'ACL_A_JABBER'		=> 'Podes modificar a configuración do Jabber',
	'ACL_A_PHPINFO'		=> 'Podes ver a configuración do php',

	'ACL_A_FORUM'		=> 'Podes xestionar os foros',
	'ACL_A_FORUMADD'	=> 'Podes engadir novos foros',
	'ACL_A_FORUMDEL'	=> 'Podes eliminar foros',
	'ACL_A_PRUNE'		=> 'Podes purgar foros',

	'ACL_A_ICONS'		=> 'Podes modificar risoños e iconas dos temas e mensaxes',
	'ACL_A_WORDS'		=> 'Podes modificar os censores de verbas',
	'ACL_A_BBCODE'		=> 'Podes definir etiquetas BBCode',
	'ACL_A_ATTACH'		=> 'Podes modificar a configuración relativa aos adxuntos',

	'ACL_A_USER'		=> 'Podes xestionar usuarios<br /><em>Isto inclúe tamén ver o axente navegador dos usuarios amosados na lista de conectados.</em>',
	'ACL_A_USERDEL'		=> 'Podes eliminar ou purgar usuarios',
	'ACL_A_GROUP'		=> 'Podes xestionar grupos',
	'ACL_A_GROUPADD'	=> 'Podes engadir novos grupos',
	'ACL_A_GROUPDEL'	=> 'Podes eliminar grupos',
	'ACL_A_RANKS'		=> 'Podes xestionar rangos',
	'ACL_A_PROFILE'		=> 'Podes xestionar campos de perfil á machada',
	'ACL_A_NAMES'		=> 'Podes xestionar nomes non permitidos',
	'ACL_A_BAN'			=> 'Podes xestionar prohibicións',

	'ACL_A_VIEWAUTH'	=> 'Podes ver as máscaras de permisos',
	'ACL_A_AUTHGROUPS'	=> 'Podes modificar os permisos para os grupos',
	'ACL_A_AUTHUSERS'	=> 'Podes modificar os permisos para os usuarios',
	'ACL_A_FAUTH'		=> 'Podes modificar os permisos dos foros',
	'ACL_A_MAUTH'		=> 'Podes modificar os permisos de moderador',
	'ACL_A_AAUTH'		=> 'Podes modificar os permisos de administración',
	'ACL_A_UAUTH'		=> 'Podes modificar os permisos de usuario',
	'ACL_A_ROLES'		=> 'Podes xestionar regras',
	'ACL_A_SWITCHPERM'	=> 'Podes usar outros permisos',

	'ACL_A_STYLES'		=> 'Podes xestionar estilos',
	'ACL_A_EXTENSIONS'	=> 'Podes ver rexistros',
	'ACL_A_VIEWLOGS'	=> 'Podes baleirar rexistros',
	'ACL_A_CLEARLOGS'	=> 'Podes limpar os rexistros (logs)',
	'ACL_A_MODULES'		=> 'Podes xestionar módulos',
	'ACL_A_LANGUAGE'	=> 'Podes xestionar paquetes de idioma',
	'ACL_A_EMAIL'		=> 'Podes enviar correos-e masivos',
	'ACL_A_BOTS'		=> 'Podes xestionar robots',
	'ACL_A_REASONS'		=> 'Podes xestionar motivos de informe ou rexeitamento',
	'ACL_A_BACKUP'		=> 'Podes facer/restaurar unha copia de respaldo da base de datos',
	'ACL_A_SEARCH'		=> 'Podes xestionar backends de procura e configuracións',
));