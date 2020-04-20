<?php
/**
*
* acp_board [Galician]
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

// Board Settings
$lang = array_merge($lang, array(
	'ACP_BOARD_SETTINGS_EXPLAIN'	=> 'Aquí podes determinar o funcionamento básico do teu sistema, dárlle un nome e unha descrición axeitados, e, entre outros axustes, configura os valores predeterminados para a zona horaria e idioma.',
	'BOARD_INDEX_TEXT'				=> 'Texto para o índice',
	'BOARD_INDEX_TEXT_EXPLAIN'		=> 'Este texto amosarase para indicar o índice no camiño de migas. Se non se indica nada, por defecto amosarase “Board Index”.',
	'BOARD_STYLE'					=> 'Estilo',
	'CUSTOM_DATEFORMAT'				=> 'A medida…',
	'DEFAULT_DATE_FORMAT'			=> 'Formato das datas',
	'DEFAULT_DATE_FORMAT_EXPLAIN'	=> 'O formato das datas é o mesmo que na función <code><a href="https://secure.php.net/manual/function.date.php">date()</a></code> de PHP.',
	'DEFAULT_LANGUAGE'				=> 'Idioma por defecto',
	'DEFAULT_STYLE'					=> 'Estilo por defecto',
	'DEFAULT_STYLE_EXPLAIN'			=> 'O estilo que se establecerá por defecto para os usuarios novos.',
	'DISABLE_BOARD'					=> 'Desactivar sitio',
	'DISABLE_BOARD_EXPLAIN'			=> 'Isto fará que todo o sitio non estea dispoñíble para os usuarios. Podes escribir unha mensaxe curta explicativa (255 caracteres).',
	'DISPLAY_LAST_SUBJECT'			=> 'Amosar o asunto da última mensaxe na lista de foros',
	'DISPLAY_LAST_SUBJECT_EXPLAIN'	=> 'Amosarase o asunto da última mensaxe publicada na lista de foros, cun enlace á propia mensaxe. Non se amosará nada dos foros que estean protexidos por contrasinal ou nos que o usuario non teña permiso para ver.',
	'DISPLAY_UNAPPROVED_POSTS'		=> 'Amosar ao autor as mensaxes pendentes de aprobación',
	'DISPLAY_UNAPPROVED_POSTS_EXPLAIN'	=> 'O autor poderá ver as mensaxes que aínda non foron aprobadas. Non aplica para as mensaxes dos convidados.',
	'GUEST_STYLE'					=> 'Estilo para convidados',
	'GUEST_STYLE_EXPLAIN'			=> 'Estilo para os convidados (visitantes).',
	'OVERRIDE_STYLE'				=> 'Ignorar estilo de usuario',
	'OVERRIDE_STYLE_EXPLAIN'		=> 'Reempraza o estilo configurador por cada usuario polo predefinido.',
	'SITE_DESC'						=> 'Descrición do sitio',
	'SITE_HOME_TEXT'				=> 'Texto da web principal',
	'SITE_HOME_TEXT_EXPLAIN'		=> 'Amosarase este texto cun enlace ao teu sitio web principal no camiño de migas. Se non se especifica nada, por defecto amosarase “Home”.',
	'SITE_HOME_URL'					=> 'URL da web principal',
	'SITE_HOME_URL_EXPLAIN'			=> 'Se se insire un valor, engadirase ao comezo do camiño de migas un enlace a esta URL, e o logo apuntará a esta mesma URL. Precísase unha URL absoluta, por exemplo <samp>http://www.phpbb.com</samp>.',
	'SITE_NAME'						=> 'Nome do sitio',
	'SYSTEM_TIMEZONE'				=> 'Zona horaria para convidados',
	'SYSTEM_TIMEZONE_EXPLAIN'			=> 'Zona horaria a empregar para amosar as horas aos usuarios non identificados (convidados, bots). Os usuarios identificados configuran a súa zona no proceso de rexistro e poden mudala no seu panel de control.',
	'WARNINGS_EXPIRE'				=> 'Duración da advertencia',
	'WARNINGS_EXPIRE_EXPLAIN'		=> 'Número de días no que expirará unha advertencia no rexistro dun usuario logo de ser emitida. Configura este valor como 0 para que as advertencias sexan permanentes.',
));

// Board Features
$lang = array_merge($lang, array(
	'ACP_BOARD_FEATURES_EXPLAIN'	=> 'Aquí podes activar ou desactivar diversas funcionalidades do sistema',

	'ALLOW_ATTACHMENTS'			=> 'Permitir adxuntos',
	'ALLOW_BIRTHDAYS'			=> 'Permitir aniversarios',
	'ALLOW_BIRTHDAYS_EXPLAIN'	=> 'Permite aos usuarios inserir a súa data de nacemento e que a súa idade se amose no seu perfil. Ten en conta que a listaxe de aniversarios no índice contrólase noutro axuste.',
	'ALLOW_BOOKMARKS'			=> 'Permitir o marcado de temas como favoritos',
	'ALLOW_BOOKMARKS_EXPLAIN'	=> 'O usuario pode gardar temas como favoritos',
	'ALLOW_BBCODE'				=> 'Permitir BBCode',
	'ALLOW_FORUM_NOTIFY'		=> 'Permitir a subscrición aos foros',
	'ALLOW_NAME_CHANGE'			=> 'Permitir mudar os nomes de usuario',
	'ALLOW_NO_CENSORS'			=> 'Permitir a desactivación do censor de palabras',
	'ALLOW_NO_CENSORS_EXPLAIN'	=> 'Os usuarios poden desactivar a censura de palabras nas mensaxes do foro e mensaxes privadas.',
	'ALLOW_PM_ATTACHMENTS'		=> 'Permitir adxuntos en mensaxes privadas',
	'ALLOW_PM_REPORT'			=> 'Permitir aos usuarios denunciar mensaxes privadas',
	'ALLOW_PM_REPORT_EXPLAIN'	=> 'Se activas esta opción, os usuarios poderán denunciar aos moderadores mensaxes privadas que recibisen ou enviasen. Isto fará que estas mensaxes privadas sexan visibles no Panel de Control dos Moderadores.',
	'ALLOW_QUICK_REPLY'			=> 'Permitir resposta rápida',
	'ALLOW_QUICK_REPLY_EXPLAIN'	=> 'Este axuste permite desactivar a resposta rápida en todo o taboleiro. Se esta opción estiver activada, empregarase a configuración específica de cada foro para determinar se amosar ou non a resposta rápida no mesmo.',
	'ALLOW_QUICK_REPLY_BUTTON'	=> 'Activa a resposta rápida en todos os foros',
	'ALLOW_SIG'					=> 'Permitir sinaturas',
	'ALLOW_SIG_BBCODE'			=> 'Permitir BBCode nas sinaturas',
	'ALLOW_SIG_FLASH'			=> 'Permitir a etiqueta de BBCode <code>[FLASH]</code> nas sinaturas',
	'ALLOW_SIG_IMG'				=> 'Permitir a etiqueta de BBCode <code>[ÌMG]</code> nas sinaturas',
	'ALLOW_SIG_LINKS'			=> 'Permitir ligazóns nas sinaturas',
	'ALLOW_SIG_LINKS_EXPLAIN'	=> 'Se non se permite, tanto a etiqueta de BBCode <code>[URL]</code> coma as URLs automáticas/máxicas estarán desactivadas.',
	'ALLOW_SIG_SMILIES'			=> 'Permitir as emoticonas nas sinaturas',
	'ALLOW_SMILIES'				=> 'Permitir emoticona',
	'ALLOW_TOPIC_NOTIFY'		=> 'Permitir subcribirse a temas',
	'BOARD_PM'					=> 'Mensaxería privada',
	'BOARD_PM_EXPLAIN'			=> 'Habilitar a mensaxería privada para todos os usuarios.',
	'ALLOW_BOARD_NOTIFICATIONS' => 'Permitir notificacións',
));

// Avatar Settings
$lang = array_merge($lang, array(
	'ACP_AVATAR_SETTINGS_EXPLAIN'	=> 'Os avatares adoitan ser pequenas imaxes que os usuarios poden asociar con eles mesmos. Dependendo do estilo, xeralmente se amosan debaixo do nome do usuario cando se navega polos temas. Aquí podes determinar como os usuarios poden definir os seus avatares. Ten en conta que para que os usuarios poidan subir os seus propios avatares, precisas ter creado o directorio que configures como directorio de subida e que este conte cos permisos axeitados para que o servidor poida escribir nel. Pensa tamén que os límites de tamaño só se aplican aos avatares subidos, non aos que se ligan dende ubicacións remotas.',

	'ALLOW_AVATARS'					=> 'Activar avatares',
	'ALLOW_AVATARS_EXPLAIN'			=> 'Permite o uso xeral de avatares.<br />Se deshabilitas esta opción, ou algún tipo de avatar concreto, aqueles avatares afectados non se amosarán, pero os usuarios poderán descargar os seus propios avatares no seu panel de control.',
	'ALLOW_GRAVATAR'				=> 'Activar avatares Gravatar',
	'ALLOW_LOCAL'					=> 'Activar avatares de galería',
	'ALLOW_REMOTE'					=> 'Activar avatares remotos',
	'ALLOW_REMOTE_EXPLAIN'			=> 'Avatares ligados dende outro sitio web.<br><em><strong class="error">Advertencia:</strong> Habilitar esta funcionalidade podería permitir que algún usuario comprobe a existencia de ficheiros e/ou servizos que son só accesibles pola rede local do servidor.</em>',
	'ALLOW_REMOTE_UPLOAD'			=> 'Activar subida remota de avatares',
	'ALLOW_REMOTE_UPLOAD_EXPLAIN'	=> 'Permite cargar avatares desde outro sitio web.<br><em><strong class="error">Advertencia:</strong> Habilitar esta funcionalidade podería permitir que algún usuario comprobe a existencia de ficheiros e/ou servizos que son só accesibles pola rede local do servidor.</em>',
	'ALLOW_UPLOAD'					=> 'Activar subida de avatares',
	'AVATAR_GALLERY_PATH'			=> 'Ruta á galería de avatares',
	'AVATAR_GALLERY_PATH_EXPLAIN'	=> 'Ruta respecto do directorio raíz de phpBB onde se almacenan as imaxes precargadas, p.e.<samp>images/avatars/gallery</samp>.<br>Eliminaranse os puntos dobres coma <samp>../</samp> da ruta por razóns de seguridade.',
	'AVATAR_STORAGE_PATH'			=> 'Ruta ao espazo de almacenamento de avatares',
	'AVATAR_STORAGE_PATH_EXPLAIN'	=> 'Ruta respecto do directorio raíz de phpBB, p.e <samp>images/avatars/upload</samp>.<br><strong>Non se permitirá a subida de avatares</strong> se o servidor non pode escribir nesta ruta.<br>Eliminaranse os puntos dobres coma <samp>../</samp> da ruta por razóns de seguridade.',
	'MAX_AVATAR_SIZE'				=> 'Dimensións máximas dos avatares',
	'MAX_AVATAR_SIZE_EXPLAIN'		=> '(Ancho x Alto en píxeles)',
	'MAX_FILESIZE'					=> 'Tamaño máximo dos ficheiros de avatar',
	'MAX_FILESIZE_EXPLAIN'			=> 'Para os ficheiros de avatares subidos. Se o valor é 0, o límite será o da configuración de PHP.',
	'MIN_AVATAR_SIZE'				=> 'Dimensións mínimas dos avatares',
	'MIN_AVATAR_SIZE_EXPLAIN'		=> '(Ancho x Alto en píxeles)',
));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'		=> 'Aquí podes configurar todas as opcións por defecto para a mensaxería privada',

	'ALLOW_BBCODE_PM'			=> 'Permitir BBCode nas mensaxes privadas',
	'ALLOW_FLASH_PM'			=> 'Permitir a etiqueta de BBCode <code>[FLASH]</code>',
	'ALLOW_FLASH_PM_EXPLAIN'	=> 'Ten en conta que, aínda que actives aquí o uso do flash nas mensaxes privadas, a posibilidade de empregalo tamén dependerá dos permisos dos usuarios.',
	'ALLOW_FORWARD_PM'			=> 'Permitir o reenvío de mensaxes privadas',
	'ALLOW_IMG_PM'				=> 'Permitir a etiqueta de BBCode <code>[IMG]</code>',
	'ALLOW_MASS_PM'				=> 'Permitir o envío de mensaxes privadas a varios usuarios e grupos',
	'ALLOW_MASS_PM_EXPLAIN'		=> 'O envío aos grupos pode axustarse para cada un deles na páxina de configuración dos mesmos.',
	'ALLOW_PRINT_PM'			=> 'Permitir vista de impresión nas mensaxes privadas',
	'ALLOW_QUOTE_PM'			=> 'Permitir citas en mensaxes privadas',
	'ALLOW_SIG_PM'				=> 'Permitir sinaturas en mensaxes privadas',
	'ALLOW_SMILIES_PM'			=> 'Permitir emoticonas nas mensaxes privadas',
	'BOXES_LIMIT'				=> 'Número máximo de mensaxes privadas nas caixas de entrada',
	'BOXES_LIMIT_EXPLAIN'		=> 'Os usuarios non poderán ter na cúa caixa de entrada máis deste número de mensaxes privadas. Establéceo a 0 para non ter límite.',
	'BOXES_MAX'					=> 'Número máximo de cartafoles de mensaxes privadas',
	'BOXES_MAX_EXPLAIN'			=> 'Os usuarios poderán crear cartafoles para as súas mensaxes privadas ata este máximo.',
	'ENABLE_PM_ICONS'			=> 'Habilitar o uso de iconas de tema nas mensaxes privadas',
	'FULL_FOLDER_ACTION'		=> 'Acción por defecto para cartafol cheo',
	'FULL_FOLDER_ACTION_EXPLAIN'=> 'Acción predeterminada a levar a cabo cando o cartafol dun usuario estea cheo, e a acción configurada polo usuario (de existir) non se puidera realizar. Para o cartafol de “mensaxes enviadas” a acción predeterminada será sempre a de elminar as mensaxes máis antigas.',
	'HOLD_NEW_MESSAGES'			=> 'Reter novas mensaxes',
	'PM_EDIT_TIME'				=> 'Tempo límite de edición',
	'PM_EDIT_TIME_EXPLAIN'		=> 'Límite de tempo para editar unha mensaxe privada aínda sen enviar. Usa 0 para desactivar este límite.',
	'PM_MAX_RECIPIENTS'			=> 'Número máximo de destinatarios permitido',
	'PM_MAX_RECIPIENTS_EXPLAIN'	=> 'O número máximo de destinatarios permitido nunha mensaxe privada. Usa 0 para que sexan ilimitados. Esta configuración pode axustarse para cada grupo na páxina de configuración dos mesmos.',
));

// Post Settings
$lang = array_merge($lang, array(
	'ACP_POST_SETTINGS_EXPLAIN'			=> 'Aquí podes configurar todas as opcións por defecto para publicar mensaxes nos foros',
	'ALLOW_POST_LINKS'					=> 'Permitir ligazóns en mensaxes do foro e mensaxes privadas.',
	'ALLOW_POST_LINKS_EXPLAIN'			=> 'Se non se permite, tanto a etiqueta de BBCode <code>[URL]</code>coma as URLs automáticas/máxicas se desactivarán.',
	'ALLOWED_SCHEMES_LINKS'				=> 'Permitir protocolos nos enlaces',
	'ALLOWED_SCHEMES_LINKS_EXPLAIN'		=> 'Os usuarios só poden pulicar URLs sen protocolo ou con un dos aquí permitidos (separados por comas). P.e. http, https, etc.',
	'ALLOW_POST_FLASH'					=> 'Permitir o uso da etiqueta BBCode <code>[FLASH]</code> nas mensaxes do foro.',
	'ALLOW_POST_FLASH_EXPLAIN'			=> 'Se non permites isto, a etiqueta BBCode <code>[FLASH]</code> desactivarase para todas as mensaxes do foro. En caso contrario, será o sistema de permisos o que controlará cales son os usuarios que poden empregar a etiqueta <code>[FLASH]</code>.',

	'BUMP_INTERVAL'					=> 'Intervalo de reactivación',
	'BUMP_INTERVAL_EXPLAIN'			=> 'Número de minutos, horas ou días entre a última mensaxe dun tema e a posibilidade de reactivar o tema. Se insire 0, non se permitirá reactivar temas.',
	'CHAR_LIMIT'					=> 'Número máximo de caracteres permitido nas mensaxes do foro e nas privadas',
	'CHAR_LIMIT_EXPLAIN'			=> 'O número de caracteres permitido nunha mensaxe, pública ou privada. Pono a 0 para non ter límite.',
	'DELETE_TIME'					=> 'Límite de tempo para eliminar mensaxe',
	'DELETE_TIME_EXPLAIN'			=> 'Limita o tempo dispoñible para eliminar unha mensaxe recén publicada. Configurando este valor a 0, desactivarase a edición de mensaxes.',
	'DISPLAY_LAST_EDITED'			=> 'Amosar información sobre a data da última edición',
	'DISPLAY_LAST_EDITED_EXPLAIN'	=> 'Escolle se a información de edición dunha mensaxe aparece nela',
	'EDIT_TIME'						=> 'Tempo límite de edición',
	'EDIT_TIME_EXPLAIN'				=> 'Límite de tempo para editar unha nova mensaxe, o cero é igual a infinito',
	'FLOOD_INTERVAL'				=> 'Intervalo de saturación',
	'FLOOD_INTERVAL_EXPLAIN'		=> 'Número de segundos que os usuarios deberán agardar entre a publicación de novas mensaxes. Podes permitir que certos usuarios ignoren este límite a través do sistema de permisos.',
	'HOT_THRESHOLD'					=> 'Límite de popularidade dun tema',
	'HOT_THRESHOLD_EXPLAIN'			=> 'Mensaxes publicadas por tema requiridas para ser marcado como popular. Axústao a 0 para non marcar nunca temas coma populares.',
	'MAX_POLL_OPTIONS'				=> 'Número máximo de opcións nas enquisas',
	'MAX_POST_FONT_SIZE'			=> 'Tamaño máximo de fonte por mensaxe',
	'MAX_POST_FONT_SIZE_EXPLAIN'	=> 'Pono a 0 para permitir un tamaño de fonte ilimitado.',
	'MAX_POST_IMG_HEIGHT'			=> 'Altura máxima da imaxe por mensaxe',
	'MAX_POST_IMG_HEIGHT_EXPLAIN'	=> 'Altura máxima dunha imaxe ou arquivo flash nas mensaxes. Fixar en 0 para non ter límite.',
	'MAX_POST_IMG_WIDTH'			=> 'Anchura máxima da imaxe por mensaxe',
	'MAX_POST_IMG_WIDTH_EXPLAIN'	=> 'Ancho máximo dunha imaxe ou arquivo flash nas mensaxes. Fixar en 0 para non ter límite.',
	'MAX_POST_URLS'					=> 'Número máximo de ligazóns por mensaxe',
	'MAX_POST_URLS_EXPLAIN'			=> 'Pono a 0 para non limitar o número de ligazóns por mensaxe.',
	'MIN_CHAR_LIMIT'				=> 'Número mínimo de caracteres por mensaxe',
	'MIN_CHAR_LIMIT_EXPLAIN'		=> 'O número mínimo de caracteres que o usuario deberá inserir nunha mensaxe do foro ou privada. O valor mínimo é 1.',
	'POSTING'						=> 'Publicando',
	'POSTS_PER_PAGE'				=> 'Mensaxes por páxina',
	'QUOTE_DEPTH_LIMIT'				=> 'Número máximo de citas aniñadas por mensaxe',
	'QUOTE_DEPTH_LIMIT_EXPLAIN'		=> 'Pór 0 para permitir profundidade sen límite.',
	'SMILIES_LIMIT'					=> 'Número máximo de emoticonas por mensaxe',
	'SMILIES_LIMIT_EXPLAIN'			=> 'Pono a 0 para non ter límite.',
	'SMILIES_PER_PAGE'				=> 'Emoticonas por páxina',
	'TOPICS_PER_PAGE'				=> 'Temas por páxina',
));

// Signature Settings
$lang = array_merge($lang, array(
	'ACP_SIGNATURE_SETTINGS_EXPLAIN'	=> 'Aquí podes configurar todas as opcións por defecto para as sinaturas.',

	'MAX_SIG_FONT_SIZE'				=> 'Tamaño máximo de letra na sinatura',
	'MAX_SIG_FONT_SIZE_EXPLAIN'		=> 'Tamaño de letra permitido como máximo nas sinaturas. Establecer a 0 para non limitalo.',
	'MAX_SIG_IMG_HEIGHT'			=> 'Altura máxima das imaxes nas sinaturas',
	'MAX_SIG_IMG_HEIGHT_EXPLAIN'	=> 'Altura máxima dunha imaxe ou arquivo flash nas sinaturas. Establecer a 0 para non limitalo.',
	'MAX_SIG_IMG_WIDTH'				=> 'Máximo ancho de imaxe nas sinaturas',
	'MAX_SIG_IMG_WIDTH_EXPLAIN'		=> 'Ancho máximo dunha imaxe ou arquivo flash nas sinaturas. Establecer a 0 para non limitalo.',
	'MAX_SIG_LENGTH'				=> 'Lonxitude máxima das sinaturas',
	'MAX_SIG_LENGTH_EXPLAIN'		=> 'Número máximo de caracteres nas sinaturas.',
	'MAX_SIG_SMILIES'				=> 'Número máximo de emoticonas por sinatura',
	'MAX_SIG_SMILIES_EXPLAIN'		=> 'Máximo de emoticonas permitidas nas sinaturas. Establecer a 0 para non limitalo.',
	'MAX_SIG_URLS'					=> 'Máximo de ligazóns nas sinaturas',
	'MAX_SIG_URLS_EXPLAIN'			=> 'Número máximo de ligazóns nas sinaturas. Establecer a 0 para non limitalo.',
));

// Registration Settings
$lang = array_merge($lang, array(
	'ACP_REGISTER_SETTINGS_EXPLAIN'		=> 'Aquí podes definir o rexistro de usuarios e a configuración do perfil',

	'ACC_ACTIVATION'				=> 'Activación de conta',
	'ACC_ACTIVATION_EXPLAIN'		=> 'Con isto determínase se os usuarios recén rexistrados teñen acceso inmediato ou se se precisa confirmación. Tamén podes desactivar por completo os novos rexistros.',
	'ACC_ACTIVATION_WARNING'		=> 'Ten en conta que o método de activación que escolliches precisa que o envío de correos estexa activo, senón desactivarase o rexistro de usuarios directamente. Recomendámosche que escollas outro método de activación ou reactives o envío de correos.',
	'NEW_MEMBER_POST_LIMIT'			=> 'Límite de mensaxes para novos membros',
	'NEW_MEMBER_POST_LIMIT_EXPLAIN'	=> 'Os novos membros pertencerán ao grupo <em>Usuarios Recentemente Rexistrados</em> até que acaden este número de mensaxes. Podes empregar este grupo para evitares que accedan a certas funcionalidades, coma o sistema de mensaxería privada ou para revisar as súas mensaxes. <strong>Un valor de 0 desactiva esta opción.</strong>',
	'NEW_MEMBER_GROUP_DEFAULT'		=> 'Configurar o grupo "Usuarios Recentemente Rexistrados" como predeterminado',
	'NEW_MEMBER_GROUP_DEFAULT_EXPLAIN'	=> 'Se escolles SI e existe definido un límite de mensaxes para novos usuarios rexistrados, estes non só pertencerán ao grupo <em>Usuarios Recentemente Rexistrados</em>, senón que ademais este grupo será o seu predeterminado. Isto pode ser práctico se queres asignar un rango de grupo por defecto ou un avatar que logo herdará o usuario.',

	'ACC_ADMIN'					=> 'Polo Administrador',
	'ACC_DISABLE'				=> 'Desactivar rexistro de usuarios',
	'ACC_NONE'					=> 'Ningún (acceso inmediato)',
	'ACC_USER'					=> 'Polo Usuario (verificación por correo)',
//	'ACC_USER_ADMIN'			=> 'Usuario + Administrador',
	'ALLOW_EMAIL_REUSE'			=> 'Permitir a reutilización de enderezos de correo electrónico',
	'ALLOW_EMAIL_REUSE_EXPLAIN'	=> 'Permitirá que usuarios diferentes se rexistren co mesmo enderezo de correo.',
	'COPPA'						=> 'COPPA (Children's Online Privacy Protection Rule)',
	'COPPA_FAX'					=> 'Número de fax da COPPA',
	'COPPA_MAIL'				=> 'Enderezo de correo da COPPA',
	'COPPA_MAIL_EXPLAIN'		=> 'Este é o enderezo de correo onde os pais enviarán os formularios de rexistro "COPPA"',
	'ENABLE_COPPA'				=> 'Permitir COPPA',
	'ENABLE_COPPA_EXPLAIN'		=> 'Isto require que os usuarios declaren se son maiores de 13 anos para dar cumprimento á normativa COPPA dos Estados Unidos. Se desactivas esta opción, os grupos específicos para COPPA non se amosarán.',
	'MAX_CHARS'					=> 'Máx',
	'MIN_CHARS'					=> 'Mín',
	'NO_AUTH_PLUGIN'			=> 'Non se atopou ningún plug-in de autenticación axeitado.',
	'PASSWORD_LENGTH'			=> 'Lonxitude de contrasinal',
	'PASSWORD_LENGTH_EXPLAIN'	=> 'Número mínimo e máximo de caracteres en contrasinais.',
	'REG_LIMIT'					=> 'Intentos de rexistro',
	'REG_LIMIT_EXPLAIN'			=> 'Número de intentos que os usuar resolver o desafío visual anti-spam antes de bloquear a súa sesión.',
	'USERNAME_ALPHA_ONLY'		=> 'Só alfanuméricos',
	'USERNAME_ALPHA_SPACERS'	=> 'Alfanuméricos e espazos',
	'USERNAME_ASCII'			=> 'ASCII (non unicode internacional)',
	'USERNAME_LETTER_NUM'		=> 'Calquera letra e número',
	'USERNAME_LETTER_NUM_SPACERS'	=> 'Calquera letra, número, e espazador',
	'USERNAME_CHARS'			=> 'Limitar os caracteres do nome de usuario',
	'USERNAME_CHARS_ANY'		=> 'Calquera carácter',
	'USERNAME_CHARS_EXPLAIN'	=> 'Restrinxir o tipo de caracteres que poden ser usados nos nomes de usuario, considéranse espazadores: espazo, -, +, _, [ e ]',
	'USERNAME_LENGTH'			=> 'Lonxitude do nome de usuario',
	'USERNAME_LENGTH_EXPLAIN'	=> 'Número mínimo e máximo de caracteres nos nomes de usuario.',
));

// Feeds
$lang = array_merge($lang, array(
	'ACP_FEED_MANAGEMENT'				=> 'Configuración xeral dos fluxos de sindicación',
	'ACP_FEED_MANAGEMENT_EXPLAIN'		=> 'Este módulo dispoñibiliza varios fluxos ATOM, procesando o BBCode das mensaxes para que resulte lexible nos fluxos externos.',

	'ACP_FEED_GENERAL'					=> 'Configuración xeral de fluxos',
	'ACP_FEED_POST_BASED'				=> 'Configuración de fluxos baseados en mensaxes',
	'ACP_FEED_TOPIC_BASED'				=> 'Configuración de fluxos baseados en temas',
	'ACP_FEED_SETTINGS_OTHER'			=> 'Outros fluxos e configuracións',

	'ACP_FEED_ENABLE'					=> 'Activar fluxos',
	'ACP_FEED_ENABLE_EXPLAIN'			=> 'Activa ou desactiva os fluxos ATOM.<br />Desactivando isto, desactivaranse todos os fluxos, sen importar como estean configuradas as opcións que seguen.',
	'ACP_FEED_LIMIT'					=> 'Número de elementos',
	'ACP_FEED_LIMIT_EXPLAIN'			=> 'O número máximo de elementos de fluxo que se amosarán.',

	'ACP_FEED_OVERALL'					=> 'Activar fluxo para todos os foros',
	'ACP_FEED_OVERALL_EXPLAIN'			=> 'Novas mensaxes en todos os foros.',
	'ACP_FEED_FORUM'					=> 'Activar fluxos por foro',
	'ACP_FEED_FORUM_EXPLAIN'			=> 'Novas mensaxes dun só foro e subforos.',
	'ACP_FEED_TOPIC'					=> 'Activar fluxos por tema',
	'ACP_FEED_TOPIC_EXPLAIN'			=> 'Novas mensaxes dun só tema.',

	'ACP_FEED_TOPICS_NEW'				=> 'Activar fluxo de novos temas',
	'ACP_FEED_TOPICS_NEW_EXPLAIN'		=> 'Activa o fluxo de “Novos Temas”, que amosa os últimos temas creados, incluíndo a primeira mensaxe publicada.',
	'ACP_FEED_TOPICS_ACTIVE'			=> 'Activar fluxo de temas activos',
	'ACP_FEED_TOPICS_ACTIVE_EXPLAIN'	=> 'Activa o fluxo de “Temas Activos”, que amosa os últimos temas activos, incluíndo a última mensaxe publicada.',
	'ACP_FEED_NEWS'						=> 'Fluxo de novas',
	'ACP_FEED_NEWS_EXPLAIN'				=> 'Colle a primeira mensaxe destes foros. Non selecciones ningún foro para desactivares o fluxo de novas.<br />Selecciona varios foros mantendo a tecla <samp>CTRL</samp> e facendo clic.',

	'ACP_FEED_OVERALL_FORUMS'			=> 'Activar fluxo dos foros',
	'ACP_FEED_OVERALL_FORUMS_EXPLAIN'	=> 'Activa o fluxo de “Todos os Foros”, que amosa unha listaxe de foros.',

	'ACP_FEED_HTTP_AUTH'				=> 'Permitir Autenticación HTTP',
	'ACP_FEED_HTTP_AUTH_EXPLAIN'		=> 'Activa a autenticación HTTP, que permite recibir contido normalmente oculto para os usuarios convidados engadindo o parámetro <samp>auth=http</samp> á URL do fluxo. Ten en conta que algunhas configuracións de PHP requerirán cambios adicionáis no arquivo .htaccess. Podes atopar instrucións no devandito arquivo.',
	'ACP_FEED_ITEM_STATISTICS'			=> 'Estatísticas do elemento',
	'ACP_FEED_ITEM_STATISTICS_EXPLAIN'	=> 'Amosa estatísticas individuais embaixo dos elementos do fluxo<br />(p.e. publicado por, data e hora, respostas, vistas)',
	'ACP_FEED_EXCLUDE_ID'				=> 'Excluír estes foros',
	'ACP_FEED_EXCLUDE_ID_EXPLAIN'		=> 'O contido destes <strong>non será incluído nos fluxos</strong>. Non selecciones foro ningún para obter datos de todos os foros.<br />Selecciona varios foros mantendo a tecla <samp>CTRL</samp> e facendo clic.',
));

// Visual Confirmation Settings
$lang = array_merge($lang, array(
	'ACP_VC_SETTINGS_EXPLAIN'				=> 'Aquí poderás seleccionar e configurar os plug-ins deseñados para bloquear o envío automático de formularios (comunmente denominados spambots). Estes plug-ins habitualmente funcionan empregando CAPTCHAs, que presentan desafíos que son sinxelos de resolver por humanos pero difíciles para un programa informático.',
	'ACP_VC_EXT_GET_MORE'					=> 'Para máis (e posiblemente mellores) plug-ins anti-spam, visita a <a href="https://www.phpbb.com/go/anti-spam-ext"><strong>base de datos de extensións de phpBB.com</strong></a>. Para máis información previndo o spam no teu sitio, visita a <a href="https://www.phpbb.com/go/anti-spam"><strong>base de coñecemento de phpBB.com</strong></a>.',
	'AVAILABLE_CAPTCHAS'					=> 'Plug-ins dispoñibles',
	'CAPTCHA_UNAVAILABLE'					=> 'Non se pode seleccionar este plug-in porque non se cumpren os seus requirimentos.',
	'CAPTCHA_GD'							=> 'Imaxe GD',
	'CAPTCHA_GD_3D'							=> 'Imaxe GD en 3D',
	'CAPTCHA_GD_FOREGROUND_NOISE'			=> 'Ruído',
	'CAPTCHA_GD_EXPLAIN'					=> 'Usa GD para facer unha imaxe anti-spam máis avanzada',
	'CAPTCHA_GD_FOREGROUND_NOISE_EXPLAIN'	=> 'Usa o ruído para facer unha imaxe que sexa máis difícil de ler.',
	'CAPTCHA_GD_X_GRID'						=> 'Eixo X do ruído de fondo',
	'CAPTCHA_GD_X_GRID_EXPLAIN'				=> 'Utiliza valores baixos nisto para facer que a imaxe sexa máis dificil de ler. Insire 0 para desactivar o ruído no eixo X.',
	'CAPTCHA_GD_Y_GRID'						=> 'Eixo Y do ruído de fondo',
	'CAPTCHA_GD_Y_GRID_EXPLAIN'				=> 'Utiliza valores baixos nisto para facer que a imaxe sexa máis dificil de ler. Insire 0 para desactivar o ruído no eixo Y.',
	'CAPTCHA_GD_WAVE'						=> 'Distorsión de onda',
	'CAPTCHA_GD_WAVE_EXPLAIN'				=> 'Isto aplica unha distorsión de onda á imaxe.',
	'CAPTCHA_GD_3D_NOISE'					=> 'Engadir obxectos de ruído 3D',
	'CAPTCHA_GD_3D_NOISE_EXPLAIN'			=> 'Isto engade obxectos adicionais á imaxe, enriba das letras.',
	'CAPTCHA_GD_FONTS'						=> 'Empregar fontes distintas',
	'CAPTCHA_GD_FONTS_EXPLAIN'				=> 'Este axuste controla cantos tipos de letra distintas se van empregar. Podes usar os tipos predeterminados ou inserir letras alteradas. Tamén se poden engadir letras minúsculas.',
	'CAPTCHA_FONT_DEFAULT'					=> 'Predeterminada',
	'CAPTCHA_FONT_NEW'						=> 'Novos Tipos',
	'CAPTCHA_FONT_LOWER'					=> 'Empregar tamén minúsculas',
	'CAPTCHA_NO_GD'							=> 'Imaxe simple',
	'CAPTCHA_PREVIEW_MSG'					=> 'Non se gardaron os teus cambios, isto é só unha previsualización.',
	'CAPTCHA_PREVIEW_EXPLAIN'				=> 'O plug-in terá esta pinta coa túa configuración actual.',

	'CAPTCHA_SELECT'						=> 'Plug-ins instalados',
	'CAPTCHA_SELECT_EXPLAIN'				=> 'O desplegable contén os plug-ins recoñecidos polo sistema. As entradas en gris non están dispoñibles agora mesmo e pode que precisen axustes adicionáis antes de poder empregalos.',
	'CAPTCHA_CONFIGURE'						=> 'Configurar plug-ins',
	'CAPTCHA_CONFIGURE_EXPLAIN'				=> 'Muda a configuración para o plug-in seleccionado.',
	'CONFIGURE'								=> 'Configurar',
	'CAPTCHA_NO_OPTIONS'					=> 'Este plug-in non dispón de opcións de configuración.',

	'VISUAL_CONFIRM_POST'					=> 'Activar mecanismo anti-spam para as mensaxes dos convidados',
	'VISUAL_CONFIRM_POST_EXPLAIN'			=> 'Requirirá aos usuarios convidados (anónimos) que superen o desafío anti-spam para previr a publicación automatizada de mensaxes.',
	'VISUAL_CONFIRM_REG'					=> 'Habilitar mecanismo anti-spam para o rexistro de usuarios',
	'VISUAL_CONFIRM_REG_EXPLAIN'			=> 'Requirirá aos novos usuarios que superen o desafío anti-spam para evitar rexistros automatizados.',
	'VISUAL_CONFIRM_REFRESH'				=> 'Permitir aos usuarios xerar varias veces o desafío anti-spam',
	'VISUAL_CONFIRM_REFRESH_EXPLAIN'		=> 'Permitirá aos usuarios solicitar un novo desafío se ven que non son capaces de resolver o actual. Algúns plug-ins pode que non admitan esta opción.',
));

// Cookie Settings
$lang = array_merge($lang, array(
	'ACP_COOKIE_SETTINGS_EXPLAIN'		=> 'Estes elementos definen os datos usados para enviar cookies ao navegador. Na meirande parte dos casos os valores predeterminados deberían ser suficientes. Se precisas trocar algún, leva coidado, pois unha mala configuración impedir que os usuarios inicien sesión. Se notas problemas para que os usuarios manteñan a súa sesión, visita a <strong><a href="https://www.phpbb.com/support/go/cookie-settings">Base de Coñecemento de phpBB.com - Arranxando configuración de cookies</a></strong>.',

	'COOKIE_DOMAIN'				=> 'Dominio para cookies',
	'COOKIE_DOMAIN_EXPLAIN'		=> 'Na maioría dos casos, o dominio para cookies é opcional. Déixao en branco se non estás seguro.<br /><br />En caso de que o teu foro estexa integrado con outro software, ou teñas varios dominios, precisas facer o seguinte para determinar o teu dominio de cookies. Se tes algo tipo <i>exemplo.gl</i> e <i>foro.exemplo.gl</i>, ou quizáis <i>foro.exemplo.gl</i> and <i>blog.exemplo.gl</i>: elimina os subdominios ata que atopes o dominio en común e logo engade un punto ao comezo do dominio. Neste caso, o resultado sería ".exemplo.gl").',
	'COOKIE_NAME'				=> 'Nome da cookie',
	'COOKIE_NAME_EXPLAIN'		=> 'Isto pode ser o que queiras, sé orixinal! Se os axustes das cookies se cambia, deberías mudar o nome da cookie para evitar problemas coas sesións de usuario.',
	'COOKIE_NOTICE'				=> 'Aviso de cookie',
	'COOKIE_NOTICE_EXPLAIN'		=> 'Se se activa, amosarase un aviso de cookies aos usuarios que visiten o teu foro. Pode ser un requerimento legal dependendo do contido do teu foro e das extensións que teñas habilitadas.',
	'COOKIE_PATH'				=> 'Ruta da cookite',
	'COOKIE_PATH_EXPLAIN'		=> 'Normalmente será a mesma que a ruta á túa instalación de phpBB, ou simplemente unha barra / para que a cookie sexa accesible en todo o dominio.',
	'COOKIE_SECURE'				=> 'Cookies seguras',
	'COOKIE_SECURE_EXPLAIN'		=> 'Se o teu servidor vai sobre SSL/HTTPS debes activar esta opción, do contrario mantena desactivada. Se activas esta opción e non usas SSL/HTTPS, produciranse erros no servidor nas redireccións.',
	'ONLINE_LENGTH'				=> 'Tempo en liña',
	'ONLINE_LENGTH_EXPLAIN'		=> 'Minutos que deben pasar para que un usuario inactivo deixe de aparecer na lista de “Quen está conectado”. Canto máis alto, máis carga terá o servidor para calcular a lista.',
	'SESSION_LENGTH'			=> 'Tempo de sesión',
	'SESSION_LENGTH_EXPLAIN'	=> 'A sesión de usuario caducará tras pasar este tempo (en segundos).',
));

// Contact Settings
$lang = array_merge($lang, array(
	'ACP_CONTACT_SETTINGS_EXPLAIN'		=> 'Aquí podes activar ou desactivar a páxina de contacto, así como mudar o texto que se amosa en pantalla.',

	'CONTACT_US_ENABLE'				=> 'Activar páxina de contacto',
	'CONTACT_US_ENABLE_EXPLAIN'		=> 'Esta páxina permite enviar correos aos Administradores. Ten en conta que tamén debes ter activado o envío de correos a nivel xeral. Podes atopar esta opción en Xeral &gt; Comunicación co Cliente &gt; Axustes de Correo.',

	'CONTACT_US_INFO'				=> 'Información de contacto',
	'CONTACT_US_INFO_EXPLAIN'		=> 'A mensaxe que se amosa na páxina de contacto',
	'CONTACT_US_INFO_PREVIEW'		=> 'Información de contacto - Previsualización',
	'CONTACT_US_INFO_UPDATED'		=> 'Actualizouse a información de contacto.',
));

// Load Settings
$lang = array_merge($lang, array(
	'ACP_LOAD_SETTINGS_EXPLAIN'	=> 'Aquí podes activar e desactivar certas funcionalidades que permiten reducir a cantidade de procesamento requirida. Na maior parte dos servidores non hai necesidade de desactivar ningunha. En certos sistemas ou contornos de hosting compartido pode ser beneficioso desactivar capacidades que non precisas. Tamén podes especificar límites para a carga do sistema e sesións activas a partir dos cales o sistema se desconectará.',

	'ALLOW_CDN'						=> 'Permite o uso de redes de contido de terceiros (CDN)',
	'ALLOW_CDN_EXPLAIN'				=> 'Se se activa esta opción, algúns ficheiros cargaranse dende servidores de terceiros. Isto reduce o ancho de banda requerido no teu servidor, pero pode presentar algún problema de privacidade para algúns Adminsitradores. Por defecto, inclúese a carga de “jQuery” e a fonte “Open Sans” dende a rede de Google.',
	'ALLOW_LIVE_SEARCHES'			=> 'Permitir procuras en vivo (suxestións)',
	'ALLOW_LIVE_SEARCHES_EXPLAIN'	=> 'Se se activa esta opción, amosaranse suxestións cando os usuarios escriban en certos campos de texto.',
	'CUSTOM_PROFILE_FIELDS'			=> 'Campos personalizados no perfil',
	'LIMIT_LOAD'					=> 'Limitar a carga do sistema',
	'LIMIT_LOAD_EXPLAIN'			=> 'Se a carga do sistema durante o último minuto excede deste valor, este desconectarase automaticamente. Un valor de 1.0 é aproximadamente igual ao 100% de uso dun procesador. Esta opción só funciona en servidores baseados en UNIX, sempre e cando esta información estexa accesible. Este valor se resetea a 0 se phpBB non é capaz de determinar o límite de carga.',
	'LIMIT_SESSIONS'				=> 'Limitar sesións',
	'LIMIT_SESSIONS_EXPLAIN'		=> 'Se o número de sesións do último minuto excede este valor, o sistema desconectarase. Fixar en 0 para non ter límite.',
	'LOAD_CPF_MEMBERLIST'			=> 'Amosar campos personalizados do perfil na lista de membros.',
	'LOAD_CPF_PM'					=> 'Amosar campos personalizados do perfil nas mensaxes privadas',
	'LOAD_CPF_VIEWPROFILE'			=> 'Amosar campos personalizados do perfil nos perfís de usuario.',
	'LOAD_CPF_VIEWTOPIC'			=> 'Amosar campos personalizados do perfil nas páxinas dun tema.',
	'LOAD_USER_ACTIVITY'			=> 'Amosar a actividade dos usuarios',
	'LOAD_USER_ACTIVITY_EXPLAIN'	=> 'Amosar temas/foros activos nos perfís de usuario e no panel de contral. Recomendamos desactivalo en sistemas con con máis dun millón de mensaxes.',
	'LOAD_USER_ACTIVITY_LIMIT'		=> 'Límite de actividade de usuarios nas publicacións',
	'LOAD_USER_ACTIVITY_LIMIT_EXPLAIN'	=> 'O tema/foro non se amosará aos usuarios se se supera este número de mensaxes. Establecer a 0 para desactivar o límite.',
	'READ_NOTIFICATION_EXPIRE_DAYS'	=> 'Tempo de caducidade das notificacións',
	'READ_NOTIFICATION_EXPIRE_DAYS_EXPLAIN' => 'Días tras o cales unha notificación caducará e se eliminará automaticamente. Establecer a 0 para que as notificacións sexan permanentes.',
	'RECOMPILE_STYLES'				=> 'Recompilar compoñentes de estilo antigos',
	'RECOMPILE_STYLES_EXPLAIN'		=> 'Comproba se hai ficheiros de estilos actualizados no sistema de ficheiros, e nese caso os recompila.',
	'YES_ACCURATE_PM_BUTTON'			=> 'Activar botón de mensaxe privada nas páxinas do tema controlado por permisos',
	'YES_ACCURATE_PM_BUTTON_EXPLAIN'	=> 'Se se activa, só se engadirá o botón de "enviar MP" nos usuarios que teñen permisos para ler mensaxes privadas.',
	'YES_ANON_READ_MARKING'			=> 'Permitir marcado de de temas aos convidados',
	'YES_ANON_READ_MARKING_EXPLAIN'	=> 'Garda información do estado lido/sen ler para convidados. Se se desactiva, as mensaxes amosaranse sempre coma lidas para os convidados.',
	'YES_BIRTHDAYS'					=> 'Activar listado de aniversarios',
	'YES_BIRTHDAYS_EXPLAIN'			=> 'Se o desactivas non se amosará a listaxe de aniversarios. Para que este axuste teña efecto debe activarse tamén a opción que permite aos usuarios configurar o seu aniversario.',
	'YES_JUMPBOX'					=> 'Activar visualización da caixa de "Ir a..."',
	'YES_MODERATORS'				=> 'Activar visualización de moderadores',
	'YES_ONLINE'					=> 'Activar listaxes de usuarios conectados',
	'YES_ONLINE_EXPLAIN'			=> 'Amosar a información de usuarios conectados nas páxinas do índice, foro e tema.',
	'YES_ONLINE_GUESTS'				=> 'Activar listaxe de invitados conectados',
	'YES_ONLINE_GUESTS_EXPLAIN'		=> 'Permitir amosar información do usuario convidado conectado.',
	'YES_ONLINE_TRACK'				=> 'Permitir amosar a información do estado de conexión do usuario',
	'YES_ONLINE_TRACK_EXPLAIN'		=> 'Amosar información de usuario en liña nos perfís e ao amosar mensaxes dun tema.',
	'YES_POST_MARKING'				=> 'Activar as conversas marcadas',
	'YES_POST_MARKING_EXPLAIN'		=> 'Indica se o usuario respondeu a un tema.',
	'YES_READ_MARKING'				=> 'Activar marcado de temas do lado do servidor',
	'YES_READ_MARKING_EXPLAIN'		=> 'Almacenar información do estado lido/non lido na base de datos mellor que nunha cookie.',
	'YES_UNREAD_SEARCH'				=> 'Activar procura para mensaxes non lidas',
));

// Auth settings
$lang = array_merge($lang, array(
	'ACP_AUTH_SETTINGS_EXPLAIN'	=> 'phpBB permite plug-ins e módulos de autenticación. Estes permiten determinar como se autenticarán os usuarios cando inicien sesión. Por defecto existen catro plug-ins: base de datos, LDAP, Apache e OAuth. Non todos os métodos requiren información adicional, así que enche só os campos relevantes para o método escollido.',

	'AUTH_METHOD'				=> 'Escolle un método de autenticación',

	'AUTH_PROVIDER_OAUTH_ERROR_ELEMENT_MISSING'	=> 'Debe indicarse tanto a clave como o "secret" para cada servizo OAuth. Só se especificou un dos dous para polo menos un servizo OAuth.',
	'AUTH_PROVIDER_OAUTH_EXPLAIN'				=> 'Cada servizo OAuth require unha clave e un "secret" únicos para poder autenticar usuarios co servizo externo. Estes datos deberán ser proporcionados polo servizo OAuth no momento que rexistres o teu sitio en dito servizo, e deberán inserirse tal cual.<br>Calqueira servizo que non teña tanto a clave como o "secret" non poderá usarse. Ademáis, ten en conta que os usuarios poden seguir rexistrándose a través da autenticación por BD.',
	'AUTH_PROVIDER_OAUTH_KEY'					=> 'Clave',
	'AUTH_PROVIDER_OAUTH_TITLE'					=> 'OAuth',
	'AUTH_PROVIDER_OAUTH_SECRET'				=> 'Secret',

	'APACHE_SETUP_BEFORE_USE'	=> 'Tes que configurar a autenticación Apache antes de cambiar phpBB a este método de autenticación. Lembra que o nome de usuario que utilices para a autenticación Apache ten que ser o mesmo que o que uses para phpBB. Só se pode usar a autenticación Apache con mod_php (non coa versión CGI). ',

	'LDAP'							=> 'LDAP',
	'LDAP_DN'						=> '<var>dn</var> base no LDAP',
	'LDAP_DN_EXPLAIN'				=> 'Isto é o Nome Distinguido (DN), localizando a información do usuario, p.e. <samp>o=My Company,c=US</samp>',
	'LDAP_EMAIL'					=> 'Atributo para correo electrónico no LDAP',
	'LDAP_EMAIL_EXPLAIN'			=> 'Pon aquí o nome do atributo de correo electrónico para entrada de usuario (se existe) a fin de gardar automaticamente o enderezo de correo para novos usuarios. Deixándoo baleiro non se gardarán os enderezos de correo dos usuarios que inicien sesión por primeira vez.',
	'LDAP_INCORRECT_USER_PASSWORD'	=> 'Fallou a vinculación co servidor LDAP usando o nome de usuario e contrasinal especificados.',
	'LDAP_NO_EMAIL'					=> 'O atributo para correo electrónico especificado non existe',
	'LDAP_NO_IDENTITY'				=> 'Non se puido atopar unha identidade de inicio de sesión para %s',
	'LDAP_PASSWORD'					=> 'Contrasinal LDAP',
	'LDAP_PASSWORD_EXPLAIN'			=> 'Déixao en branco para conectar de xeito anónimo. Noutro caso escribe o contrasinal para o usuario de enriba. Requirido para servidores de Directorio Activo.<br /><em><strong>Ollo:</strong> Este contrasinal será gardado en texto plano na base de datos, sendo visible para calquera que teña acceso á mesma ou a esta páxina de configuración.</em>',
	'LDAP_PORT'						=> 'Porto do servidor LDAP',
	'LDAP_PORT_EXPLAIN'				=> 'De xeito opcional podes especificar un porto que se empregará para conectar co servidor LDAP no canto do porto por defecto 389.',
	'LDAP_SERVER'					=> 'Nome do servidor LDAP',
	'LDAP_SERVER_EXPLAIN'			=> 'Se usas LDAP este é o host ou IP do servidor LDAP. De xeito alternativo podes especificar unha URL coma ldap://host:porto/.',
	'LDAP_UID'						=> '<var>uid</var> no LDAP',
	'LDAP_UID_EXPLAIN'				=> 'Esta é a clave para procurar unha identidade de acceso, p.e <var>uid</var>, <var>sn</var> etc.',
	'LDAP_USER'						=> '<var>nd</var> do usuario LDAP',
	'LDAP_USER_EXPLAIN'				=> 'Déixao en branco para conectar de xeito anónimo. Se o enches, o phpBB empregará o nome especificado nas tentativas de inicio de sesión para atopar o usuario correcto, p.e. <samp>uid=Usuario,ou=Departamento,o=Empresa,c=GAL</samp>. Requirido para Servidores de Directorio Activo.',
	'LDAP_USER_FILTER'				=> 'Filtro de usuario LDAP',
	'LDAP_USER_FILTER_EXPLAIN'		=> 'De xeito opcional podes limitar aínda máis os obxectos procurados con filtros adicionais. Por exemplo <samp>objectClass=posixGroup</samp> resultará no uso de <samp>(&(uid=$username)(objectClass=posixGroup))</samp>',
));

// Server Settings
$lang = array_merge($lang, array(
	'ACP_SERVER_SETTINGS_EXPLAIN'	=> 'Aquí podes definir a configuración dependente do servidor e do dominio. Asegúrate de que os datos que introduces son correctos, calquera erro suporá o envío de correo electrónico con información trabucada. Lembra incluír o protocolo (https://...) ao inserir o nome do dominio. Muda o número do porto só se estás seguro de que o teu servidor utiliza un valor diferente (por defecto normalmente se usa o porto 80).',

	'ENABLE_GZIP'				=> 'Habilitar compresión GZip',
	'ENABLE_GZIP_EXPLAIN'		=> 'O contido xerado será comprimido denantes de ser enviado ao usuario. Isto pode reducir o tráfico da rede pero tamén pode incrementar o uso da CPU tanto no cliente coma no servidor. Require que a extensión zlib do PHP estea cargada.',
	'FORCE_SERVER_VARS'			=> 'Forzar configuracións URL do servidor',
	'FORCE_SERVER_VARS_EXPLAIN'	=> 'Se escolles Si as opcións de servidor definidas aquí serán usadas como valores determinados automaticamente.',
	'ICONS_PATH'				=> 'Ruta de almacenamento das iconas de mensaxe',
	'ICONS_PATH_EXPLAIN'		=> 'Ruta baixo o directorio raíz do teu phpBB, p.e. <samp>images/icons</samp>',
	'MOD_REWRITE_ENABLE'		=> 'Activar reescritura de URLs',
	'MOD_REWRITE_ENABLE_EXPLAIN' => 'Unha vez activo, as URLs que conteñan ’app.php’ reescribiranse para eliminar o nome deste ficheiro (por exemplo, "app.php/foo" pasará a ser "/foo"). <strong>Deberás ter habilitado o módulo Apache mod_rewrite para que isto funcione; sen el as URLs poden romperse.</strong>',
	'MOD_REWRITE_DISABLED'		=> 'O módulo <strong>mod_rewrite</strong> do teu servidor Apache está deshabilitado. Habilita o módulo ou contacta co deu proveedor de hospedaxe se queres activar esta funcionalidade.',
	'MOD_REWRITE_INFORMATION_UNAVAILABLE' => 'Non podemos saber se o teu servidor soporta a reescritura de URLs. Podes activar este axuste, pero se o módulo de reescritura non está habilitado, o sistema xerará URLs rotas. Contacta co teu proveedor de hospedaxe se non estás seguro de que podes activar esta funcionalidade.',
	'PATH_SETTINGS'				=> 'Configuración de rutas',
	'RANKS_PATH'				=> 'Ruta de almacenamento das imaxes de clasificación',
	'RANKS_PATH_EXPLAIN'		=> 'Ruta baixo o directorio raíz do teu phpBB, p.e.<samp>images/ranks</samp>.',
	'SCRIPT_PATH'				=> 'Ruta ao script phpBB',
	'SCRIPT_PATH_EXPLAIN'		=> 'A ruta de ubicación do phpBB relativa ao dominio, p.e. <samp>/phpBB3</samp>',
	'SERVER_NAME'				=> 'Nome do dominio',
	'SERVER_NAME_EXPLAIN'		=> 'O nome de dominio dende baixo o que se publica este sistema (por exemplo: <samp>www.example.com</samp>).',
	'SERVER_PORT'				=> 'Porto do servidor',
	'SERVER_PORT_EXPLAIN'		=> 'O porto no que o servidor web está a traballar, xeralmente o 80. Múdao só se é diferente',
	'SERVER_PROTOCOL'			=> 'Protocolo do servidor',
	'SERVER_PROTOCOL_EXPLAIN'	=> 'Isto úsase como protocolo do servidor se estas opcións son forzadas. Se están baleiras ou non forzadas o protocolo vén determinado polas opcións de seguridade da cookie (<samp>http://</samp> ou <samp>https://</samp>).',
	'SERVER_URL_SETTINGS'		=> 'Configuración da URL do servidor',
	'SMILIES_PATH'				=> 'Ruta ao almacenamento das emoticonas',
	'SMILIES_PATH_EXPLAIN'		=> 'Ruta baixo o directorio raíz do teu phpBB, p.e. <samp>images/smilies</samp>.',
	'UPLOAD_ICONS_PATH'			=> 'Ruta ao almacenamento as inconas dos grupos de extensión',
	'UPLOAD_ICONS_PATH_EXPLAIN'	=> 'Ruta baixo o directorio raíz do teu phpBB, p.e.<samp>images/upload_icons</samp>.',
	'USE_SYSTEM_CRON'		=> 'Lanza tarefas programadas (cron)',
	'USE_SYSTEM_CRON_EXPLAIN'		=> 'Se se desactiva, phpBB tratará de lanzar as tarefas periódicas automaticamente. Se se activa, phpBB non programará ningunha tarefa periódica, xa que esperará que un Administrador de Sistemas configure de xeito externo o comando <code>bin/phpbbcli.php cron:run</code> (por exemplo cada 5 minutos).',
));

// Security Settings
$lang = array_merge($lang, array(
	'ACP_SECURITY_SETTINGS_EXPLAIN'		=> 'Aquí estás habilitado para definir as propiedades de sesión e o seu inicio (login).',

	'ALL'							=> 'Todo',
	'ALLOW_AUTOLOGIN'				=> 'Permitir a opción "Recórdame"', 
	'ALLOW_AUTOLOGIN_EXPLAIN'		=> 'Determina se os usuarios poden iniciar sesión automaticamente ao acceder ao sistema.', 
	'ALLOW_PASSWORD_RESET'			=> 'Permitir reinicio de contrasináis ("Esquecín o meu contrasinal")',
	'ALLOW_PASSWORD_RESET_EXPLAIN'	=> 'Permitirase aos usuarios empregar a opción "Esquecín o meu contrasinal" na páxina de inicio de sesión para recuperar a súa conta. Se empregas un sistema de autenticación externo, quizáis prefiras desactivar esta opción.',
	'AUTOLOGIN_LENGTH'				=> 'Número de días que dura a opción "Recórdame"', 
	'AUTOLOGIN_LENGTH_EXPLAIN'		=> 'Número de días tras os cales as claves de identificación persistente se eliminarán. Por a 0 para desactivalo.', 
	'BROWSER_VALID'					=> 'Validar navegador',
	'BROWSER_VALID_EXPLAIN'			=> 'Activa a validación do navegador para cada sesión para mellorar a seguridade.',
	'CHECK_DNSBL'					=> 'Comprobar IP co DNS Blackhole List',
	'CHECK_DNSBL_EXPLAIN'			=> 'Se está activado, comprobarase (no rexistro e na publicación de mensaxes) a IP do usuario contra os seguintes servizos DNSBL: <a href="http://spamcop.net">spamcop.net</a> e <a href="http://www.spamhaus.org">www.spamhaus.org</a>. Esta comprobación pode levar algún tempo, dependendo da configuración dos servidores. Se se atrasa moito ou se obteñen moitos falsos positivos, recoméndase desactivar esta opción.',
	'CLASS_B'						=> 'A.B',
	'CLASS_C'						=> 'A.B.C',
	'EMAIL_CHECK_MX'				=> 'Comprobar dominio de correos electrónicos para validar rexistro MX',
	'EMAIL_CHECK_MX_EXPLAIN'		=> 'Se isto está activado, verificarase o dominio do enderezo de correo proporcionado no rexistro e nos cambios no perfil buscando un rexistro MX válido.',
	'FORCE_PASS_CHANGE'				=> 'Forzar troco de contrasinal',
	'FORCE_PASS_CHANGE_EXPLAIN'		=> 'Require ao usuario cambiar o seu contrasinal despois do número indicado de días ou 0 para desactivar.',
	'FORM_TIME_MAX'					=> 'Tempo máximo para enviar formularios',
	'FORM_TIME_MAX_EXPLAIN'			=> 'O tempo que se lle da a un usuario para enviar un formulario. Emprega -1 para desactivalo. Ten en conta que un formulario pode chegar a non ser válido se expira a sesión, independentemente do valor deste axuste.',
	'FORM_SID_GUESTS'				=> 'Ligar formularios ás sesións de convidado',
	'FORM_SID_GUESTS_EXPLAIN'		=> 'Se o activas, o token de formulario emitido a un convidado será exclusivo para cada sesión. Isto pode causar problemas con algúns ISPs.',
	'FORWARDED_FOR_VALID'			=> 'Validar cabeceira <var>X_FORWARDED_FOR</var>',
	'FORWARDED_FOR_VALID_EXPLAIN'	=> 'Manteranse as sesións só se a cabeceira <var>X_FORWARDED_FOR</var> enviada coincide coa recibida coa petición anterior. Comprobaranse tamén as prohibicións contra IPs en <var>X_FORWARDED_FOR</var>.',
	'IP_VALID'						=> 'Validación do IP da sesión',
	'IP_VALID_EXPLAIN'				=> 'Determina canto da IP do usuarios se utiliza para validar a sesión; <samp>Todos</samp> compara o enderezo completo, <samp>A.B.C</samp> os primeiros x.x.x, <samp>A.B</samp> os primeiros x.x, <samp>Ningún</samp> desactiva a verificación.',
	'IP_LOGIN_LIMIT_MAX'			=> 'Número máximo de intentos de inicio de sesión por enderezo IP',
	'IP_LOGIN_LIMIT_MAX_EXPLAIN'	=> 'Límite de intentos de inicio de sesión permitidos desde un enderezo IP antes de lanzar unha tarefa anti-spambot. Insire 0 para evitares lanzar as tarefas anti-spambot por enderezos IP.',
	'IP_LOGIN_LIMIT_TIME'			=> 'Tempo de expiración para os intentos de inicio de sesión dun enderezo IP',
	'IP_LOGIN_LIMIT_TIME_EXPLAIN'	=> 'As tentativas de inicio de sesión reinícianse tras deste período de tempo.',
	'IP_LOGIN_LIMIT_USE_FORWARDED'	=> 'Limitar tentativas de inicio de sesión pola cabeceira <var>X_FORWARDED_FOR</var>',
	'IP_LOGIN_LIMIT_USE_FORWARDED_EXPLAIN'	=> 'En vez de limitar as tentativas de inicio de sesión por enderezo IP, limitalos polos valores de <var>X_FORWARDED_FOR</var>. <br /><em><strong>Ollo:</strong> Activa isto só se estás a operar un servidor proxy que configure <var>X_FORWARDED_FOR</var> para valores confiables.</em>',
	'MAX_LOGIN_ATTEMPTS'			=> 'Número máximo de intentos de inicio de sesión',
	'MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> 'Despois deste número de intentos erróneos de entrada, o usuario terá que pasar un filtro anti-spam. Usa 0 para evitar que se active este mecanismo para diferentes contas.',
	'NO_IP_VALIDATION'				=> 'Ningún',
	'NO_REF_VALIDATION'				=> 'Ningunha',
	'PASSWORD_TYPE'					=> 'Complexidade do contrasinal',
	'PASSWORD_TYPE_EXPLAIN'			=> 'Determina o nivel de complexidade que teñen que ter os contrasinais cando se fixan por primeira vez ou se mudan. As derradeiras opcións inclúen ás anteriores.',
	'PASS_TYPE_ALPHA'				=> 'Debe conter alfanuméricos',
	'PASS_TYPE_ANY'					=> 'Sen requirimentos',
	'PASS_TYPE_CASE'				=> 'Debe mesturar maiúsculas con minúsculas',
	'PASS_TYPE_SYMBOL'				=> 'Debe conter símbolos',
	'REF_HOST'						=> 'Validar host só',
	'REF_PATH'						=> 'Validar tamén a ruta',
	'REFERRER_VALID'				=> 'Validar oa  Referrer',
	'REFERRER_VALID_EXPLAIN'		=> 'Se está activado, comprobarase a cabeceira Referrer das peticións POST contra a configuración de host/script. Isto pode causar problemas con sistemas que empreguen varios dominios ou inicios de sesión externos.',
	'TPL_ALLOW_PHP'					=> 'Permitir PHP nas plantillas',
	'TPL_ALLOW_PHP_EXPLAIN'			=> 'Se esta opción está activada, interpretaranse as sentenzas <code>PHP</code> e <code>INCLUDEPHP</code> nos modelos.',
	'UPLOAD_CERT_VALID'				=> 'Validar certificado de subidas remotas',
	'UPLOAD_CERT_VALID_EXPLAIN'		=> 'Se se activa, validaranse os certificados nas subidas remotas. Isto require que se defina un conxunto de CAs en <samp>openssl.cafile</samp> ou <samp>curl.cainfo</samp> no teu "php.ini".',
));

// Email Settings
$lang = array_merge($lang, array(
	'ACP_EMAIL_SETTINGS_EXPLAIN'	=> 'Esta información úsase cando o sistema envía correos aos seus usuarios. Asegúrate de que o enderezo do correo que especificas é correcto, xa que calquera correo devolto, rexeitado ou non entregado será enviado a este enderezo. Se o teu servidor non che ofrece un servizo de correo nativo (baseado en PHP), podes usar directamente STMP. Isto require un servidor axeitado (pregunta ó teu provedor se é necesario). Se o teu servidor require autenticación (e só se así é) insire un nome de usuario, contrasinal e método de autenticación.',

	'ADMIN_EMAIL'					=> 'Remitente do correo electrónico',
	'ADMIN_EMAIL_EXPLAIN'			=> 'Isto será usado como remitente en todos os correos electrónicos.',
	'BOARD_EMAIL_FORM'				=> 'Os usuarios poden enviar correos directamente dende o sistema.',
	'BOARD_EMAIL_FORM_EXPLAIN'		=> 'No canto de amosar os enderezos de correo, os usuarios poden enviar correos directamente dende a web.',
	'BOARD_HIDE_EMAILS'				=> 'Ocultar enderezos de correo',
	'BOARD_HIDE_EMAILS_EXPLAIN'		=> 'Esta función mantén en segredo os enderezos dos correos electrónicos.',
	'CONTACT_EMAIL'					=> 'Enderezo de correo de contacto',
	'CONTACT_EMAIL_EXPLAIN'			=> 'Este enderezo será usado cada vez que se precise un punto de contacto específico, p.e. spam, erro no envío etc. Usarase sempre como o remitente dos correos.',
	'CONTACT_EMAIL_NAME'			=> 'Nome de contacto',
	'CONTACT_EMAIL_NAME_EXPLAIN'	=> 'Será o nome do contacto que se amose aos receptores do correo. Se non quere ter un nome de contacto, déixao en branco.',
	'EMAIL_FORCE_SENDER'			=> 'Forzar o envío de correos',
	'EMAIL_FORCE_SENDER_EXPLAIN'	=> 'Isto establecerá o <samp>Return-Path</samp> no enderezo do remitente, en lugar de usar o usuario local e nome do servidor. Este axuste non se aplica cando se usa un servidor SMTP.<br><em><strong>Advertencia:</strong> Requírese que se indique un usuario válido no servidor de correo.</em>',
	'EMAIL_PACKAGE_SIZE'			=> 'Tamaño do paquete de correo',
	'EMAIL_PACKAGE_SIZE_EXPLAIN'	=> 'Isto refírese ao número máximo de correos enviados nun paquete. Este axuste aplícase á cola de mensaxes interna; configúrao a 0 se tes problemas con correos notificados como non entregados.',
	'EMAIL_MAX_CHUNK_SIZE'			=> 'Número máximo de destinatarios',
	'EMAIL_MAX_CHUNK_SIZE_EXPLAIN'	=> 'En caso de precisarse, configura isto para evitar que se supere o número máximo de destinatarios permitido para unha mensaxe.',
	'EMAIL_SIG'						=> 'Sinatura do correo',
	'EMAIL_SIG_EXPLAIN'				=> 'Este texto será incluído en todos os correos que se envíen dende o sistema.',
	'ENABLE_EMAIL'					=> 'Activar correos en todo o sitio',
	'ENABLE_EMAIL_EXPLAIN'			=> 'Se desactivas isto ningún correo será enviado polo sistema. <em>Ten en conta que a configuración da activación de contas polo usuario e polo administrador require que esta opción estea activada. Se actualmente estás a empregar activación de contas polo “usuario” ou “administrador” na configuración correspondente, desactivando esta opción farás que non se requira activación ningunha das novas contas creadas.</em>',
	'SEND_TEST_EMAIL'				=> 'Enviar un correo de proba',
	'SEND_TEST_EMAIL_EXPLAIN'		=> 'Isto enviará un correo de proba ao enderezo da túa conta.',
	'SMTP_ALLOW_SELF_SIGNED'		=> 'Permitir certificados SSL auto-firmados',
	'SMTP_ALLOW_SELF_SIGNED_EXPLAIN'=> 'Permitirá conexións ao servidor SMTP con certificados auto-firmados. <br><em><strong>Advertencia:</strong> Isto pode supor un risco de seguridade.</em>',
	'SMTP_AUTH_METHOD'				=> 'Método de autenticación para SMTP',
	'SMTP_AUTH_METHOD_EXPLAIN'		=> 'Só se usa se o usuario/contrasinal está configurado, se non estás seguro de que método usar pregunta ao teu provedor ',
	'SMTP_CRAM_MD5'					=> 'CRAM-MD5',
	'SMTP_DIGEST_MD5'				=> 'DIGEST-MD5',
	'SMTP_LOGIN'					=> 'ENTRAR',
	'SMTP_PASSWORD'					=> 'Contrasinal SMTP',
	'SMTP_PASSWORD_EXPLAIN'			=> 'Introduce o contrasinal só se é requirido polo servidor SMTP.<br /><em><strong>Ollo:</strong> Este contrasinal será gardado en formato de texto plano na base de datos e será visible para calqueira que teña acceso á mesmaou a esta páxina de configuración.</em>',
	'SMTP_PLAIN'					=> 'TEXTO PLANO',
	'SMTP_POP_BEFORE_SMTP'			=> 'POP-BEFORE-SMTP',
	'SMTP_PORT'						=> 'Porto do servidor SMTP',
	'SMTP_PORT_EXPLAIN'				=> 'Troca isto só se o teu servidor SMTP utiliza un porto diferente.',
	'SMTP_SERVER'					=> 'Enderezo do servidor SMTP',
	'SMTP_SERVER_EXPLAIN'			=> 'Non indiques un protocolo (<samp>ssl://</samp> ou <samp>tls://</samp>) a non ser que o teu servidor de correo o requira.',
	'SMTP_SETTINGS'					=> 'Configuración SMTP',
	'SMTP_USERNAME'					=> 'Nome de usuario SMTP',
	'SMTP_USERNAME_EXPLAIN'			=> 'Introduce o nome de usuario só se é solicitado polo servidor SMTP.',
	'SMTP_VERIFY_PEER'				=> 'Verificar certificado SSL',
	'SMTP_VERIFY_PEER_EXPLAIN'		=> 'Require a verificación do certificado SSL usado polo servidor SMTP. <br><em><strong>Advertencia:</strong> Conectar pares con certificados SSL sen verificar pode supor un risco de seguridade.</em>',
	'SMTP_VERIFY_PEER_NAME'			=> 'Verificar host SMTP',
	'SMTP_VERIFY_PEER_NAME_EXPLAIN'	=> 'Require a verificación do hostname do servidor SMTP que use conexións SSL/TLS. <br><em><strong>Advertencia:</strong> Conectar pares con certificados SSL sen verificar pode supor un risco de seguridade.</em>',
	'TEST_EMAIL_SENT'				=> 'Enviouse o correo de proba.<br>Se non o recibes, comproba a túa configuración de envío de correos.<br><br>Se aínda así precisas axuda, visita o <a href="https://www.phpbb.com/community/">foro de soporte de phpBB</a>.',

	'USE_SMTP'						=> 'Usar servidor SMTP para o correo-e',
	'USE_SMTP_EXPLAIN'				=> 'Escolle "Si" se queres ou tes que enviar email por un servidor nomeado no canto da función "mail" local.',
));

// Jabber settings
$lang = array_merge($lang, array(
	'ACP_JABBER_SETTINGS_EXPLAIN'	=> 'Aquí podes activar e controlar o Jabber para mensaxería instantánea e noticias do foro. Jabber é un protocolo de código aberto e polo tanto dispoñíbel para calquera usuario. Algúns servidores Jabber inclúen entradas ou transportes que permiten contactar con usuarios doutras redes. Non todos o servidores ofrecen todos os transportes e tamén trocos nos protocolos poden impedir o seu funcionamento. Asegúrate de inserir os pormenores dunha conta xa rexistrada - o phpBB empregará os pormenores tal e como os insiras aquí.',

	'JAB_ALLOW_SELF_SIGNED'			=> 'Permitir certificados SSL auto-firmados',
	'JAB_ALLOW_SELF_SIGNED_EXPLAIN'	=> 'Permitirá conexións ao servidor Jabber con certificados auto-firmados. <br><em><strong>Advertencia:</strong> Isto pode supor un risco de seguridade.</em>',
	'JAB_ENABLE'					=> 'Activar Jabber',
	'JAB_ENABLE_EXPLAIN'			=> 'Activa o uso da mensaxería e notificacións do Jabber',
	'JAB_GTALK_NOTE'				=> 'Ten en conta que o GTalk non funcionará, xa que non se atopou a función <samp>dns_get_record</samp>. Esta función non está dispoñíbel no PHP4, e non está implementada en plataformas Windows. Tampouco funciona actualmente en sistemas baseados en BSD, incluído o Mac OS.',
	'JAB_PACKAGE_SIZE'				=> 'Tamaño do paquete Jabber',
	'JAB_PACKAGE_SIZE_EXPLAIN'		=> 'Este é o número de mensaxes enviadas nun paquete. Se se indica 0 a mensaxe envíase inmediatamente sen poñela en cola para un envío posterior.',
	'JAB_PASSWORD'					=> 'Contrasinal do Jabber',
	'JAB_PASSWORD_EXPLAIN'			=> '<br /><em><strong>Ollo:</strong> Este contrasinal será gardado en formato de texto plano no banco de datos e será visíbel para todo o mundo que poida acceder ao mesmo ou para quen poida ver esta páxina de configuración.</em>',
	'JAB_PORT'						=> 'Porto do Jabber',
	'JAB_PORT_EXPLAIN'				=> 'Déixao en branco agás que saibas que non é 5222',
	'JAB_SERVER'					=> 'Servidor Jabber',
	'JAB_SERVER_EXPLAIN'			=> 'Bótalle un ollo a %sjabber.org%s para obter unha lista de servidores',
	'JAB_SETTINGS_CHANGED'			=> 'Configuración do Jabber actualizada correctamente.',
	'JAB_USE_SSL'					=> 'Empregar SSL para conectar',
	'JAB_USE_SSL_EXPLAIN'			=> 'Se o activas tentarase estabelecer unha conexión segura. O porto Jabber mudarase ao 5223 se se especifica o porto 5222.',
	'JAB_USERNAME'					=> 'Nome de usuario no Jabber',
	'JAB_USERNAME_EXPLAIN'			=> 'Especifica un nome de usuario rexistrado. Non se comprobará a validez do mesmo. Se só especificas un nome de usuario, entón o teu JID será o nome e usuario e o servidor que especificaches enriba. Para que isto non ocorra, especifica un JID válido, por exemplo: usuario@jabber.org.',
	'JAB_VERIFY_PEER'				=> 'Verificar certificado SSL',
	'JAB_VERIFY_PEER_EXPLAIN'		=> 'Require a verificación do certificado SSL usado polo servidor Jabber. <br><em><strong>Advertencia:</strong> Conectar pares con certificados SSL sen verificar pode supor un risco de seguridade.</em>',
	'JAB_VERIFY_PEER_NAME'			=> 'Verificar host Jabber',
	'JAB_VERIFY_PEER_NAME_EXPLAIN'	=> 'Require a verificación do hostname do servidor Jabber que use conexións SSL/TLS. <br><em><strong>Advertencia:</strong> Conectar pares con certificados SSL sen verificar pode supor un risco de seguridade.</em>',
));
