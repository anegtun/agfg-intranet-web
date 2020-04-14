<?php
/**
*
* acp_attachments [Galician]
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
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> 'Aquí podes configurar os axustes principais para os adxuntos e as categorías especiais asociadas.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> 'Aquí podes engadir, eliminar, modificar ou deshabilitar os teus grupos de extensión. Tamén podes asignarlles unha categoría especial, mudar o mecanismo de descarga e tamén definir unha icona que se amosará ao carón de calqueira anexo pertencente ao grupo.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> 'Aquí podes administrar as túas extensións. Para activar as extensións, vai ao panel de administración de grupos de extensións. Recomendámosche non permitir de ningún xeito extensións de tipo scripting (como <code>php</code>, <code>php3</code>, <code>php4</code>, <code>phtml</code>, <code>pl</code>, <code>cgi</code>, <code>asp</code>, <code>aspx</code>...)',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> 'Aquí podes ver os adxuntos orfos. Isto soe pasar se os usuarios achegan ficheiros pero non publican a mensaxe. Podes eliminalos ou achegalos a outras mensaxes existentes. Para o segundo fará falla un ID de mensaxe válido, que deberás obter por ti mesmo.',
	'ADD_EXTENSION'						=> 'Engadir extensión',
	'ADD_EXTENSION_GROUP'				=> 'Engadir grupo de extensións',
	'ADMIN_UPLOAD_ERROR'				=> 'Erros ao tentar achegar o arquivos: %s',
	'ALLOWED_FORUMS'					=> 'Foros permitidos',
	'ALLOWED_FORUMS_EXPLAIN'			=> 'Podes publicar as extensións asignadas nos foros escollidos.',
	'ALLOWED_IN_PM_POST'				=> 'Permitido',
	'ALLOW_ATTACHMENTS'					=> 'Permitir arquivos anexos',
	'ALLOW_ALL_FORUMS'					=> 'Permitir "todos os foros"',
	'ALLOW_IN_PM'						=> 'Permitido na mensaxería privada',
	'ALLOW_PM_ATTACHMENTS'				=> 'Permitir anexos nas mensaxes privadas',
	'ALLOW_SELECTED_FORUMS'				=> 'Só nos foros seleccionados embaixo',
	'ASSIGNED_EXTENSIONS'				=> 'Extensións asignadas',
	'ASSIGNED_GROUP'					=> 'Grupo de extensións asignado',
	'ATTACH_EXTENSIONS_URL'				=> 'Extensións',
	'ATTACH_EXT_GROUPS_URL'				=> 'Grupos de extensións',
	'ATTACH_ID'							=> 'ID',
	'ATTACH_MAX_FILESIZE'				=> 'Tamaño máximo de arquivo',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> 'Tamaño máximo de cada arquivo. Se o valor é 0, o límite será o da configuración de PHP',
	'ATTACH_MAX_PM_FILESIZE'			=> 'Tamaño máximo de arquivo nas mensaxes',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> 'Tamaño máximo de cada arquivo para adxuntos en mensaxes privadas. 0 significa sen limite.',
	'ATTACH_ORPHAN_URL'					=> 'Anexos orfos',
	'ATTACH_POST_ID'					=> 'ID da mensaxe',
	'ATTACH_POST_TYPE'					=> 'Tipo da mensaxe',
	'ATTACH_QUOTA'						=> 'Cota total para adxuntos',
	'ATTACH_QUOTA_EXPLAIN'				=> 'Espazo máximo dispoñíble no disco para adxuntos, 0 significa sen límite.',
	'ATTACH_TO_POST'					=> 'Engadir arquivo anexo á mensaxe',

	'CAT_IMAGES'				=> 'Imaxes',
	'CHECK_CONTENT'				=> 'Comprobar arquivos adxuntos',
	'CHECK_CONTENT_EXPLAIN'		=> 'Algúns navegadores poden ser enganados para que asuman un tipo mime incorrecto para os arquivos subidos. Esta opción asegura que se rexeiten os arquivos sospeitosos de causar isto.',
	'CREATE_GROUP'				=> 'Crear novo grupo',
	'CREATE_THUMBNAIL'			=> 'Crear miniatura',
	'CREATE_THUMBNAIL_EXPLAIN'	=> 'Crear unha miniatura sempre que se poida.',

	'DEFINE_ALLOWED_IPS'			=> 'Definir IPs/hosts permitidos',
	'DEFINE_DISALLOWED_IPS'			=> 'Definir IPs/hosts non permitidos',
	'DOWNLOAD_ADD_IPS_EXPLAIN'		=> 'Para indicar varios enderezos IP ou hosts, insire cada un nunha liña diferente. Para indicar un rango de enderezos IP, separa o comezo do final cun guión medio (-), e emprega “*” coma comodín.',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'	=> 'Podes eliminar varios enderezos IP dunha soa vez usando a combinación de teclado e rato axeitada para o teu ordenador e navegador. As IPs excluídas teñen un fondo azul.',
	'DISPLAY_INLINED'				=> 'Amosar imaxes incrustadas',
	'DISPLAY_INLINED_EXPLAIN'		=> 'Se esta posto a"Non", as imaxes adxuntas veranse coma unha ligazón.',
	'DISPLAY_ORDER'					=> 'Orde de visualización dos adxuntos',
	'DISPLAY_ORDER_EXPLAIN'			=> 'Amosar adxuntos ordenados por data.',
	
	'EDIT_EXTENSION_GROUP'			=> 'Editar grupo de extensións',
	'EXCLUDE_ENTERED_IP'			=> 'Activa isto para excluír o enderezo IP ou host inserido.',
	'EXCLUDE_FROM_ALLOWED_IP'		=> 'Excluír IP dos hosts/IPs permitidas',
	'EXCLUDE_FROM_DISALLOWED_IP'	=> 'Excluír IP dos hosts/IPs non permitidos',
	'EXTENSIONS_UPDATED'			=> 'Extensións actualizadas correctamente',
	'EXTENSION_EXIST'				=> 'A extensión %s xa existe',
	'EXTENSION_GROUP'				=> 'Grupo de extensións',
	'EXTENSION_GROUPS'				=> 'Grupos de extensións',
	'EXTENSION_GROUP_DELETED'		=> 'Grupo de extensións eliminado correctamente.',
	'EXTENSION_GROUP_EXIST'			=> 'O grupo de extensións %s xa existe',

	'EXT_GROUP_ARCHIVES'			=> 'Arquivos',
	'EXT_GROUP_DOCUMENTS'			=> 'Documentos',
	'EXT_GROUP_DOWNLOADABLE_FILES'	=> 'Ficheiros Descargables',
	'EXT_GROUP_IMAGES'				=> 'Imaxes',
	'EXT_GROUP_PLAIN_TEXT'			=> 'Texto Plano',

	'FILES_GONE'			=> 'Algúns dos adxuntos que queres eliminar non existen. Pode ser que xa foran eliminados. En todo caso elimináronse os adxuntos que aínda existían.',
	'FILES_STATS_WRONG'		=> 'As estatísticas de ficheiros semellan ser incorrectas e precisan ser sincronizadas. Os valores actuáis son: número de adxuntos = %1$d, tamaño total dos adxuntos = %2$s.<br />Preme %3$saquí%4$s para resincronizar.',

	'GO_TO_EXTENSIONS'		=> 'Ir á pantalla de xestión de extensións',
	'GROUP_NAME'			=> 'Nome do grupo',

	'IMAGE_LINK_SIZE'			=> 'Dimensións da imaxe ligada',
	'IMAGE_LINK_SIZE_EXPLAIN'	=> 'Amosar imaxes adxuntas coma ligazóns se a imaxe é maior que isto. Pono a 0x0 píxeles para desactivalo.',

	'MAX_ATTACHMENTS'				=> 'Numero máximo de adxuntos por mensaxe',
	'MAX_ATTACHMENTS_PM'			=> 'Numero máximo de adxuntos por mensaxe privada',
	'MAX_EXTGROUP_FILESIZE'			=> 'Tamaño máximo de arquivo',
	'MAX_IMAGE_SIZE'				=> 'Dimensións máximas das imaxes',
	'MAX_IMAGE_SIZE_EXPLAIN'		=> 'Tamaño máximo das imaxes adxuntas. Pono a 0x0 px para desactivar as imaxes adxuntas.',
	'MAX_THUMB_WIDTH'				=> 'Ancho máximo da miniatura en píxeles',
	'MAX_THUMB_WIDTH_EXPLAIN'		=> 'As miniaturas xeradas non excederán do ancho indicado aquí',
	'MIN_THUMB_FILESIZE'			=> 'Tamaño mínimo da miniatura',
	'MIN_THUMB_FILESIZE_EXPLAIN'	=> 'Non crear unha miniatura para imaxes máis pequenas ca isto.',
	'MODE_INLINE'					=> 'Incrustada',
	'MODE_PHYSICAL'					=> 'Físico',

	'NOT_ALLOWED_IN_PM'			=> 'Non permitido en mensaxes privadas',
	'NOT_ALLOWED_IN_PM_POST'	=> 'Non permitido',
	'NOT_ASSIGNED'				=> 'Sen asignar',
	'NO_ATTACHMENTS'			=> 'Non hai adxuntos para o período de tempo indicado.',
	'NO_EXT_GROUP'				=> 'Ningún',
	'NO_EXT_GROUP_NAME'			=> 'Non se inseriu nome de grupo ningún',
	'NO_EXT_GROUP_SPECIFIED'	=> 'Non se especificou grupo de extensións ningún.',
	'NO_FILE_CAT'				=> 'Ningún',
	'NO_IMAGE'					=> 'Sen imaxe',
	'NO_UPLOAD_DIR'				=> 'O directorio de subida especificado non existe.',
	'NO_WRITE_UPLOAD'			=> 'Non se pode escribir no directorio de subida especificado. Múdalle os permisos para que o servidor web poida escribir nel.',

	'ONLY_ALLOWED_IN_PM'	=> 'Só permitido en mensaxes privadas',
	'ORDER_ALLOW_DENY'		=> 'Permitir',
	'ORDER_DENY_ALLOW'		=> 'Denegar',

	'REMOVE_ALLOWED_IPS'			=> 'Eliminar ou retirar exclusión de IPs/hosts permitidos',
	'REMOVE_DISALLOWED_IPS'			=> 'Eliminar ou retirar exclusión de IPs/hosts non permitidos',
	'RESYNC_FILES_STATS_CONFIRM'	=> 'Estás seguro de quereres sincronizar as estatísticas dos adxuntos?',

	'SECURE_ALLOW_DENY'				=> 'Lista de permitidos/denegados',
	'SECURE_ALLOW_DENY_EXPLAIN'		=> 'Mudar o comportamento por defecto cando se habilita a descarga segura. Se se configura a Permitir funcionará coma unha <strong>lista branca (whitelist)</strong> e se se configura como Denegar funcionará coma unha <strong>lista negra (blacklist)</strong>.',
	'SECURE_DOWNLOADS'				=> 'Habilitar descargas seguras',
	'SECURE_DOWNLOADS_EXPLAIN'		=> 'Se activas esta opción, as descargas limitaranse ás IPs/hosts que teñas definido.',
	'SECURE_DOWNLOAD_NOTICE'		=> 'As descargas seguras están desactivadas. Os axustes de embaixo só se aplicarán unha vez se activen.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'=> 'A lista de enderezos IP foi actualizada correctamente',
	'SECURE_EMPTY_REFERRER'			=> 'Permitir referencias (Referrer) baleiras',
	'SECURE_EMPTY_REFERRER_EXPLAIN'	=> 'As descargas seguras están baseadas nos valores da cabeceira HTTP "Referrer". Queres permitir descargas para aqueles que omitan o Referer?',
	'SETTINGS_CAT_IMAGES'			=> 'Opcións de categorías de imaxes',
	'SPECIAL_CATEGORY'				=> 'Categoría especial',
	'SPECIAL_CATEGORY_EXPLAIN'		=> 'As categorías especiais difiren nos xeitos en que son presentadas nas mensaxes publicadas.',
	'SUCCESSFULLY_UPLOADED'			=> 'Subido correctamente',
	'SUCCESS_EXTENSION_GROUP_ADD'	=> 'Grupo de extensións engadido correctamente',
	'SUCCESS_EXTENSION_GROUP_EDIT'	=> 'Grupo de extensións actualizado correctamente',

	'UPLOADING_FILES'				=> 'Subindo arquivos',
	'UPLOADING_FILE_TO'				=> 'Subindo arquivo “%1$s” á mensaxe %2$d…',
	'UPLOAD_DENIED_FORUM'			=> 'Non tes permiso para subir arquivos ao foro “%s”',
	'UPLOAD_DIR'					=> 'Directorio de subidas',
	'UPLOAD_DIR_EXPLAIN'			=> 'Ruta ao espazo de almacén dos adxuntos. Ten en conta que se o mudas unha vez existan arquivos subidos, deberás movelos a man.',
	'UPLOAD_ICON'					=> 'Icona de subida',
	'UPLOAD_NOT_DIR'				=> 'A ubicación de subida que especificaches non semella ser un directorio.',
));