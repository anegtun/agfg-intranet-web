<?php
/**
*
* install [Galician]
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

// Common installer pages
$lang = array_merge($lang, array(
	'INSTALL_PANEL'	=> 'Panel de Instalación',
	'SELECT_LANG'	=> 'Seleccionar idioma',

	'STAGE_INSTALL'	=> 'Instalando phpBB',

	// Introduction page
	'INTRODUCTION_TITLE'	=> 'Introdución',
	'INTRODUCTION_BODY'		=> 'Benvido a phpBB3!<br /><br />phpBB® é a solución de foros de código aberto máis utilizada no mundo. phpBB3 é a derradeira entrega dunha liña que comezou no 2000. Ao igual que os seus predecesores, phpBB3 está cheo de funcionalidades, é amigable, e soportado polo Equipo phpBB. phpBB3 mellora en moito o que fixo popular a phpBB2, e engade moitas funcionalidades moi solicitadas que non estaban presentes en versións anteriores. Esperamos que exceda as túas expectativas.<br /><br />Este sistema de instalación guiarache a través da instalación de phpBB3, actualización á última versión, así como migrar a phpBB3 dende outros sistemas de foros (incluíndo phpBB2). Para máis información, animámosche a que leas <a href="../docs/INSTALL.html">a guía de instalación</a>.<br /><br />Para ler a licenza de phpBB3 ou aprender a como obter soporte, por favo selecciona as respectivas opcións no menú lateral. Para continuar, selecciona a lapela apropiada.',

	// Support page
	'SUPPORT_TITLE'		=> 'Soporte',
	'SUPPORT_BODY'		=> 'Darase soporte completo gratuito á entrega estable actual de phpBB3. Isot inclúe:</p><ul><li>instalación</li><li>configuración</li><li>preguntas técnicas</li><li>problemas relacionados con fallos potenciáis no software</li><li>actualización dende unha versión Release Candidate (RC) á versión estable actual</li><li>migrar de phpBB 2.0.x a phpBB3</li><li>migrar dende outro software de foros a phpBB3 (consulta os <a href="https://www.phpbb.com/community/viewforum.php?f=486">conversores</a>)</li></ul><p>Animamos aos usuarios que aínda usan versións beta de phpBB3 a substituír a súa instalación cunha copia limpa da última versión.</p><h2>Extensións / Estilos</h2><p>Para incidencias relacionadas con Extensións, por favor publica unha mensaxe no  <a href="https://www.phpbb.com/community/viewforum.php?f=451">Foro de Extensións</a> apropiado.<br />Para incidencias relacionadas cos estilos, plantillas e temas visuáis, por favor publica unha mensaxe no <a href="https://www.phpbb.com/community/viewforum.php?f=471">Foro de Estilos</a> apropiado.<br /><br />Se a túa pregunta está relacionada cun paquete concreto, por favor publica directamente no tema relacionado con dito paquete.</p><h2>Obter Soporte</h2><p><a href="https://www.phpbb.com/support/">Sección de Soporte</a><br /><a href="https://www.phpbb.com/support/docs/en/3.3/ug/quickstart/">Guía Rápida (Quick Start Guide)</a><br /><br />Para asegurarte de que estás ao día coas últimas novas e lanzamentos, síguenos en <a href="https://www.twitter.com/phpbb/">Twitter</a> e en <a href="https://www.facebook.com/phpbb/">Facebook</a><br /><br />',

	// License
	'LICENSE_TITLE'		=> 'General Public License',

	// Install page
	'INSTALL_INTRO'			=> 'Benvido á instalación',
	'INSTALL_INTRO_BODY'	=> 'Con esta opción, instalarás phpBB3 no teu servidor.</p><p>Para proceder, deberás ter a man a configuración da túa base de datos. Se non coñeces a configuración da túa base de datos, contacta co teu hospedaxe web e pregunta por ela. Non poderás continuar sen ela. Precisas:</p>

	<ul>
		<li>Tipo de base de datos - o xestor de base de datos que usas.</li>
		<li>Nome do servidor - o host ou dirección IP do servidor de base de datos.</li>
		<li>Porto - o porto no que corre o servidor de base de datos (normalmente non se precisa).</li>
		<li>Nome da base de datos - o nome da base de datos dentro do teu servidor de base de datos.</li>
		<li>Usuario e contrasinal - as credenciáis para acceder á base de datos.</li>
	</ul>

	<p><strong>Nota:</strong> se estás utilizando SQLite, deberás indicar a ruta completa ao teu ficheiro de base de datos dentro do campo DSN e deixar o usuario e contrasinal en branco. Por razóns de seguridade, deberías asegurarte de que o ficheiro da base de datos non se almacena en ningún lugar accesible dende a web.</p>

	<p>phpBB3 soporta os seguintes xestores de base de datos:</p>
	<ul>
		<li>MySQL 4.1.3 ou superior (requírese MySQLi)</li>
		<li>PostgreSQL 8.3+</li>
		<li>SQLite 3.6.15+</li>
		<li>MS SQL Server 2000 ou superior (directamente ou vía ODBC)</li>
		<li>MS SQL Server 2005 ou superior (nativo)</li>
		<li>Oracle</li>
	</ul>

	<p>Só se amosaran aquelas bases de datos soportadas polpo teu servidor.',

	'ACP_LINK'	=> 'Lévame ao <a href="%1$s">PCA</a>',

	'INSTALL_PHPBB_INSTALLED'		=> 'phpBB xa está instalado.',
	'INSTALL_PHPBB_NOT_INSTALLED'	=> 'phpBB aínda non está instalado.',
));

// Requirements translation
$lang = array_merge($lang, array(
	// Filesystem requirements
	'FILE_NOT_EXISTS'						=> 'O arquivo non existe',
	'FILE_NOT_EXISTS_EXPLAIN'				=> 'Para instalar phpBB, o ficheiro %1$s ten que existir.',
	'FILE_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Recoméndase que o ficheiro %1$s exista para ter unha mellor experiencia.',
	'FILE_NOT_WRITABLE'						=> 'Non se pode escribir no arquivo',
	'FILE_NOT_WRITABLE_EXPLAIN'				=> 'Para instalar, precísase que se poida escribir no ficheiro %1$s.',
	'FILE_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Recoméndase que se poida escribir no ficheiro %1$s para ter unha mellor experiencia.',

	'DIRECTORY_NOT_EXISTS'						=> 'O directorio non existe',
	'DIRECTORY_NOT_EXISTS_EXPLAIN'				=> 'Para instalar phpBB, o directorio %1$s ten que existir.',
	'DIRECTORY_NOT_EXISTS_EXPLAIN_OPTIONAL'		=> 'Recoméndase que exista o directorio %1$s para ter unha mellor experiencia.',
	'DIRECTORY_NOT_WRITABLE'					=> 'Non se pode escribir no directorio',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN'			=> 'Para instalar phpBB, debe poderse escribir no directorio %1$s.',
	'DIRECTORY_NOT_WRITABLE_EXPLAIN_OPTIONAL'	=> 'Recoméndase que se poida escribir no directorio %1$s para ter unha mellor experiencia.',

	// Server requirements
	'PHP_VERSION_REQD'					=> 'Versión PHP',
	'PHP_VERSION_REQD_EXPLAIN'			=> 'phpBB require a versión 7.1.3. de PHP ou superior.',
	'PHP_GETIMAGESIZE_SUPPORT'			=> 'Requírese a función PHP getimagesize()',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'	=> 'Para que phpBB funcione correctamente, precísase a función getimagesize().',
	'PCRE_UTF_SUPPORT'					=> 'Soporte PCRE UTF-8',
	'PCRE_UTF_SUPPORT_EXPLAIN'			=> 'phpBB non funcionará se a túa instalación de PHP non está compilada con soporte UTF-8 para a extensión PCRE (Perl Compatible Regular Expression).',
	'PHP_JSON_SUPPORT'					=> 'Soporte JSON para PHP',
	'PHP_JSON_SUPPORT_EXPLAIN'			=> 'Para que phpBB funcione correctamente, debes ter instalada a extensión JSON para PHP.',
	'PHP_XML_SUPPORT'					=> 'Soporte XML/DOM para PHP',
	'PHP_XML_SUPPORT_EXPLAIN'			=> 'Para que phpBB funcione correctamente, debes ter instalada a extensión XML/DOM para PHP.',
	'PHP_SUPPORTED_DB'					=> 'Bases de datos soportadas',
	'PHP_SUPPORTED_DB_EXPLAIN'			=> 'A túa instalación de PHP debe soportar polo menos un dos tipos de base de datos compatibles con phpBB. Se os módulos de base de datos non aparecen como dispoñibles, deberás contactar co teu proveedor de hospedaxe ou revisar a túa instalación de PHP.',

	'RETEST_REQUIREMENTS'	=> 'Volver a probar os requerimentos',

	'STAGE_REQUIREMENTS'	=> 'Comprobar requerimentos',
));

// General error messages
$lang = array_merge($lang, array(
	'INST_ERR_MISSING_DATA'		=> 'Debes cubrir todos os campos desta sección.',

	'TIMEOUT_DETECTED_TITLE'	=> 'O instalador detectou que unha petición caducou',
	'TIMEOUT_DETECTED_MESSAGE'	=> 'O instalador detectou que unha petición caducou. Podes tratar de refrescar a páxina, o cal pode provocar que os datos se corrompan. Suxerímosche que aumentes o tempo de caducidade ou trates de utilizar a liña de comandos.',
));

// Data obtaining translations
$lang = array_merge($lang, array(
	'STAGE_OBTAIN_DATA'	=> 'Establecer os datos da instalación',

	//
	// Admin data
	//
	'STAGE_ADMINISTRATOR'	=> 'Detalles do Administrador',

	// Form labels
	'ADMIN_CONFIG'				=> 'Configuración do Administrador',
	'ADMIN_PASSWORD'			=> 'Contrasinal do Administrador',
	'ADMIN_PASSWORD_CONFIRM'	=> 'Confirmación do contrasinal do Administrador',
	'ADMIN_PASSWORD_EXPLAIN'	=> 'Insire un contrasinal que teña entre 6 e 30 caracteres de lonxitude.',
	'ADMIN_USERNAME'			=> 'Nome de usuario do Administrador',
	'ADMIN_USERNAME_EXPLAIN'	=> 'Insire un nome de usuario de entre 3 e 20 caracteres.',

	// Errors
	'INST_ERR_EMAIL_INVALID'		=> 'O enderezo de correo electrónico é inválido.',
	'INST_ERR_PASSWORD_MISMATCH'	=> 'Os contrasináis que inseriches non coinciden.',
	'INST_ERR_PASSWORD_TOO_LONG'	=> 'O contrasinal que inseriches é moi longo. O máximo permitido son 30 caracteres.',
	'INST_ERR_PASSWORD_TOO_SHORT'	=> 'O contrasinal que inseriches é moi curto. O mínimo permitido son 6 caracteres.',
	'INST_ERR_USER_TOO_LONG'		=> 'O nome de usuario que inseriches é moi longo. O máximo permitido son 20 caracteres.',
	'INST_ERR_USER_TOO_SHORT'		=> 'O nome de usuario que inseriches é moi curto. O mínimo permitido son 3 caracteres.',

	//
	// Board data
	//
	// Form labels
	'BOARD_CONFIG'		=> 'Axustes do foro',
	'DEFAULT_LANGUAGE'	=> 'Idioma por defecto',
	'BOARD_NAME'		=> 'Título do foro',
	'BOARD_DESCRIPTION'	=> 'Descrición curta do foro',

	//
	// Database data
	//
	'STAGE_DATABASE'	=> 'Axustes da base de datos',

	// Form labels
	'DB_CONFIG'				=> 'Configuración da base de datos',
	'DBMS'					=> 'Tipo de base de datos',
	'DB_HOST'				=> 'Host ou DSN',
	'DB_HOST_EXPLAIN'		=> 'O "DSN" (Data Source Name) só é relevante para instalacións ODBC. En PostgreSQL, emprega "localhost" para conectarte ao servidor local vía socket UNIX e  127.0.0.1 para conectarte vía TCP. Para SQLite, insire a ruta completa ao teu ficheiro de base de datos.',
	'DB_PORT'				=> 'Porto',
	'DB_PORT_EXPLAIN'		=> 'Déixao en brando a non ser que o teu servidor opere nun porto non estándar.',
	'DB_PASSWORD'			=> 'Contrasinal',
	'DB_NAME'				=> 'Nome da base de datos',
	'DB_USERNAME'			=> 'Nome de usuario',
	'DATABASE_VERSION'		=> 'Versión da base de datos',
	'TABLE_PREFIX'			=> 'Prefixo para as táboas da base de datos',
	'TABLE_PREFIX_EXPLAIN'	=> 'O prefixo debe comezar cunha letra e debe conter só caracteres alfanuméricos ou guións baixos.',

	// Database options
	'DB_OPTION_MSSQL_ODBC'	=> 'MSSQL Server 2000+ vía ODBC',
	'DB_OPTION_MSSQLNATIVE'	=> 'MSSQL Server 2005+ [ Nativo ]',
	'DB_OPTION_MYSQLI'		=> 'MySQL con Extensión MySQLi',
	'DB_OPTION_ORACLE'		=> 'Oracle',
	'DB_OPTION_POSTGRES'	=> 'PostgreSQL',
	'DB_OPTION_SQLITE3'		=> 'SQLite 3',

	// Errors
	'INST_ERR_DB'					=> 'Erro na instalación da base de datos',
	'INST_ERR_NO_DB'				=> 'Non se pode cargar o módulo PHP do tipo de base de datos seleccionado.',
	'INST_ERR_DB_INVALID_PREFIX'	=> 'O prefixo inserido non é válido. Debe comezar cunha letra e conter só caracteres alfanuméricos ou guións baixos.',
	'INST_ERR_PREFIX_TOO_LONG'		=> 'Indicaches un prefixo moi longo. Debe ser como máximo de %d caracteres.',
	'INST_ERR_DB_NO_NAME'			=> 'Non se especificou unha base de datos.',
	'INST_ERR_DB_FORUM_PATH'		=> 'O ficheiro de base de datos está contido na estrutura de directorios do foro. Debes ubicar este ficheiro nunha ruta non accesible dende a web.',
	'INST_ERR_DB_CONNECT'			=> 'Non se pode conectar á base de datos, revisa a mensaxe de erro embaixo.',
	'INST_ERR_DB_NO_WRITABLE'		=> 'Tanto a base de datos como o directorio que a contén deben ter permisos de escritura.',
	'INST_ERR_DB_NO_ERROR'			=> 'Non se indicou mensaxe de erro.',
	'INST_ERR_PREFIX'				=> 'Xa existen táboas co prefixo indicado, por favor elixe outro.',
	'INST_ERR_DB_NO_MYSQLI'			=> 'A versión de MySQL instalada nesta máquina non é compatible coa opción “MySQL con Extensión MySQLi” que escolliches. Por favor proba coa opción “MySQL” no seu canto.',
	'INST_ERR_DB_NO_SQLITE3'		=> 'A versión da extensión de SQLite que instalaches é moi vella, debe ser polo menos a 3.6.15.',
	'INST_ERR_DB_NO_ORACLE'			=> 'A versión instalada de Oracle require que establezas o parámetro <var>NLS_CHARACTERSET</var> co valor <var>UTF8</var>. Actualiza a túa instalación á versión 9.2+ ou modifica este parámetro.',
	'INST_ERR_DB_NO_POSTGRES'		=> 'A base de datos que escolliches non se creou coa codificación <var>UNICODE</var> ou <var>UTF8</var>. Proba a instalar a base de datos coa coa codificación <var>UNICODE</var> ou <var>UTF8</var>.',
	'INST_SCHEMA_FILE_NOT_WRITABLE'	=> 'Non se pode escribir no ficheiro de esquema',

	//
	// Email data
	//
	'EMAIL_CONFIG'	=> 'Configuración do correo electrónico',

	// Package info
	'PACKAGE_VERSION'					=> 'Versión do paquete instalado',
	'UPDATE_INCOMPLETE'				=> 'Non se puido actualizar a túa instalación de phpBB.',
	'UPDATE_INCOMPLETE_MORE'		=> 'Por favor le a información de embaixo para corrixir este erro.',
	'UPDATE_INCOMPLETE_EXPLAIN'		=> '<h1>Actualización incompleta</h1>

		<p>Démonos conta de que non se completou a última actualización da túa instalación de phpBB. Visita o <a href="%1$s" title="%1$s">actualizador de base de datos</a>, asegúrate de que a opción <em>Actualizar só a base de datos</em> está seleccionada e preme en <strong>Enviar</strong>. Non esquezas eliminar o directorio "install" trala actualización.</p>',

	//
	// Server data
	//
	// Form labels
	'UPGRADE_INSTRUCTIONS'			=> 'Está dispoñible unha nova versión da funcionalidade <strong>%1$s</strong>. Por favor le <a href="%2$s" title="%2$s"><strong>o anuncio relacionado</strong></a> para saber que ten de novo, e como actualizar.',
	'SERVER_CONFIG'				=> 'Configuración do servidor',
	'SCRIPT_PATH'				=> 'Ruta ao script',
	'SCRIPT_PATH_EXPLAIN'		=> 'Ruta a onde está instalado phpBB, relativo ao nome do dominio, por exemplo <samp>/phpBB3</samp>.',
));

// Default database schema entries...
$lang = array_merge($lang, array(
	'CONFIG_BOARD_EMAIL_SIG'		=> 'Grazas, A Direción',
	'CONFIG_SITE_DESC'				=> 'Un texto curto para describir o teu foro',
	'CONFIG_SITENAME'				=> 'teudominio.com',

	'DEFAULT_INSTALL_POST'			=> 'Esta é unha publicación de exemplo na túa instalación de phpBB3. Todo parece que funciona.  Podes borrar esta mensaxe se queres e continuar configurando o teu foro. Durante o proceso de instalación asignáronse á túa primeira categoría e foro un conxunto de permisos para os grupos predefinidos (administradores, bots, moderadores globáis, convidados, usuarios rexistrados e usuarios menores rexistrados). Se tamén escolles eliminar esta primeira categoría e foro, non esquezas asignar permisos para todos estes grupos de usuario e todas as categorías que crees. Recomendámosche que renomees a túa primeira categoría e foro e copies os permisos destes a medida que crees novas categorías e foros. Pásao ben!',

	'FORUMS_FIRST_CATEGORY'			=> 'A túa primeira categoría',
	'FORUMS_TEST_FORUM_DESC'		=> 'Descrición do teu primeiro foro.',
	'FORUMS_TEST_FORUM_TITLE'		=> 'O teu primeiro foro',

	'RANKS_SITE_ADMIN_TITLE'		=> 'Administración do Sitio',
	'REPORT_WAREZ'					=> 'Esta mensaxe contén enlaces a software ilegal ou pirata.',
	'REPORT_SPAM'					=> 'A mensaxe denunciada ten como único propósito anunciar outra web ou produto.',
	'REPORT_OFF_TOPIC'				=> 'A mensaxe denunciada non ten relación co tema.',
	'REPORT_OTHER'					=> 'A mensaxe denunciada non encaixa en ningunha das categorías anteriores, por favor usa a caixa de información.',

	'SMILIES_ARROW'					=> 'Frecha',
	'SMILIES_CONFUSED'				=> 'Confundido',
	'SMILIES_COOL'					=> 'Guai',
	'SMILIES_CRYING'				=> 'Chorando ou Moi Triste',
	'SMILIES_EMARRASSED'			=> 'Avergoñado',
	'SMILIES_EVIL'					=> 'Malvado ou Moi Enfadado',
	'SMILIES_EXCLAMATION'			=> 'Exclamación',
	'SMILIES_GEEK'					=> 'Friki',
	'SMILIES_IDEA'					=> 'Idea',
	'SMILIES_LAUGHING'				=> 'Rindo',
	'SMILIES_MAD'					=> 'Enfadado',
	'SMILIES_MR_GREEN'				=> 'Señor Verde',
	'SMILIES_NEUTRAL'				=> 'Neutral',
	'SMILIES_QUESTION'				=> 'Pregunta',
	'SMILIES_RAZZ'					=> 'Vacilando',
	'SMILIES_ROLLING_EYES'			=> 'Desviando a Mirada',
	'SMILIES_SAD'					=> 'Triste',
	'SMILIES_SHOCKED'				=> 'Sorprendido',
	'SMILIES_SMILE'					=> 'Sorrindo',
	'SMILIES_SURPRISED'				=> 'Sorprendido',
	'SMILIES_TWISTED_EVIL'			=> 'Moi Malvado',
	'SMILIES_UBER_GEEK'				=> 'Super Friki',
	'SMILIES_VERY_HAPPY'			=> 'Moi Ledo',
	'SMILIES_WINK'					=> 'Guiño',

	'TOPICS_TOPIC_TITLE'			=> 'Benvido a phpBB3',
));

// Common navigation items' translation
$lang = array_merge($lang, array(
	'MENU_OVERVIEW'		=> 'Resumo',
	'MENU_INTRO'		=> 'Introdución',
	'MENU_LICENSE'		=> 'Licenza',
	'MENU_SUPPORT'		=> 'Soporte',
));

// Task names
$lang = array_merge($lang, array(
	// Install filesystem
	'TASK_CREATE_CONFIG_FILE'	=> 'Creando ficheiros de configuración',

	// Install database
	'TASK_ADD_CONFIG_SETTINGS'			=> 'Engadindo axustes de configuración',
	'TASK_ADD_DEFAULT_DATA'				=> 'Engadindo axutes predeterminados á basede de datos',
	'TASK_CREATE_DATABASE_SCHEMA_FILE'	=> 'Creando arquivo do esquema',
	'TASK_SETUP_DATABASE'				=> 'Instalando base de datos',
	'TASK_CREATE_TABLES'				=> 'Creando táboas',

	// Install data
	'TASK_ADD_BOTS'				=> 'Rexistrando bots',
	'TASK_ADD_LANGUAGES'		=> 'Instalando idiomas dispoñibles',
	'TASK_ADD_MODULES'			=> 'Instalando módulos',
	'TASK_CREATE_SEARCH_INDEX'	=> 'Creando índice de procuras',

	// Install finish tasks
	'TASK_INSTALL_EXTENSIONS'	=> 'Instalando paquetes de extesións',
	'TASK_NOTIFY_USER'			=> 'Enviando correos de notificación',
	'TASK_POPULATE_MIGRATIONS'	=> 'Poboar migracións',

	// Installer general progress messages
	'INSTALLER_FINISHED'	=> 'O instalador finalizou correctamente',
));

// Installer's general messages
$lang = array_merge($lang, array(
	'MODULE_NOT_FOUND'				=> 'Módulo non atopado',
	'MODULE_NOT_FOUND_DESCRIPTION'	=> 'Un módulo non se puido atopar porque o servizo, %s, non está definido.',

	'TASK_NOT_FOUND'				=> 'Tarefa non atopada',
	'TASK_NOT_FOUND_DESCRIPTION'	=> 'Unha tarefa non se puido atopar porque o servizo, %s, non está definido.',

	'SKIP_MODULE'	=> 'Saltarse o móudlo “%s”',
	'SKIP_TASK'		=> 'Saltarse a tarefa “%s”',

	'TASK_SERVICE_INSTALLER_MISSING'	=> 'Todos os servizos de tarefas de instalación deberan comezar con “installer”',
	'TASK_CLASS_NOT_FOUND'				=> 'A definición do servizo de tarefas de instalación é inválido. O nome do servizo é “%1$s”, mentres que se esperaba o espazo de nomes (namespace) “%2$s”. Para máis información, consulta a documentación asociada a "task_interface".',

	'INSTALLER_CONFIG_NOT_WRITABLE'	=> 'Non se pode escribir no ficheiro de configuración da instalación.',
));

// CLI messages
$lang = array_merge($lang, array(
	'CLI_INSTALL_BOARD'				=> 'Instalar phpBB',
	'CLI_UPDATE_BOARD'				=> 'Actualizar phpBB',
	'CLI_INSTALL_SHOW_CONFIG'		=> 'Amosa a configuración que se vai usar',
	'CLI_INSTALL_VALIDATE_CONFIG'	=> 'Valida o ficheiro de configuración',
	'CLI_CONFIG_FILE'				=> 'Ficheiro de configuración a empregar',
	'MISSING_FILE'					=> 'Non se puido acceder ao ficheiro de configuración %1$s',
	'MISSING_DATA'					=> 'Non se atopa o ficheiro de configuración ou contén axustes inválidos.',
	'INVALID_YAML_FILE'				=> 'Non se puido ler o ficheiro YAML %1$s',
	'CONFIGURATION_VALID'			=> 'O ficheiro de configuración é inválido',
));

// Common updater messages
$lang = array_merge($lang, array(
	'UPDATE_INSTALLATION'			=> 'Actualizar instalación phpBB',
	'UPDATE_INSTALLATION_EXPLAIN'	=> 'Con esta opción é posible actualizar a túa instalación de phpBB á última versión.<br />Durante o proceso, comprobarase a integridade de todos os teus ficheiros. Poderás ver todas as diferenzas e arquivos antes de proceder coa actualización.<br /><br />A actualización de arquivos propiamente dita pódese facer de dúas maneiras.</p><h2>Actualización Manual</h2><p>Con este sistema só descargas o conxunto de ficheiros que ti queres para asegurarte de que non perdes ningunha modificación que puideras ter feito sobre o código. Trala descarga do paquete, debes subir manualmente os arquivos á súa ruta baixo o directorio raíz de phpBB. Unha vez feito, podes lanzar de novo a comprobación para ver se subiches os ficheiros á ruta correcta.</p><h2>Actualización Automática co FTP</h2><p>Este método é similar ao primeiro pero sen necesidade de descargar os arquivos modificados e subilos pola túa conta. Faremos isto por ti. Para poder facelo, necesitaremos os detalles de conexión ao teu FTP. Unha vez rematado, redirixirémosche á comprobación de arquivos para asegurarnos de que a actualización foi correcta.<br /><br />',
	'UPDATE_INSTRUCTIONS'			=> '

		<h1>Anuncio de lanzamento</h1>

		<p>Por favor le o anuncio de lanzamento para a derradeira versión antes de continuar co proceso, xa que pode conter información útil. Tamén pode conter enlaces á descarga completa así como o rexistro de cambios (changelog).</p>

		<br />

		<h1>Como actualizar a túa instalación co Paquete Completo (Full Package)</h1>

		<p>O xeito recomendado para actualizar a túa instalación é empregando o paquete completo. Se os arquivos principáis (core) foron modificados na túa instalación, quiźais prefiras utilizar a actualización automática para asegurarte de que non perdes estes cambios. Tamén poderás actualizar a túa instalación empregando os outros métodos listados no documento INSTALL.html. Os pasos para actualizar phpBB3 empregando o paquete completo son:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li><strong class="error">Fai unha copia de seguridade de todos os arquivos do foro e base de datos.</strong></li>
			<li>Vai á <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">páxina de descargas de phpBB.com</a> e descarga o derradeiro arquivo "Full Package".</li>
			<li>Descomprime o arquivo.</li>
			<li>Elimina o ficheiro <code class="inline">config.php</code> e os directorios <code class="inline">/images</code>, <code class="inline">/store</code> e <code class="inline">/files</code> <em>do paquete</em> (non do teu sitio).</li>
			<li>Vai ao PCA (Panel de Control de Administración), Axustes do Foro, e asegúrate de que o estilo por defecto é "prosilver". Se non o é, faino.</li>
			<li>Elimina os directorios <code class="inline">/vendor</code> e <code class="inline">/cache</code> do dirtectorio raíz do teu foro.</li>
			<li>Sube os arquivos e directorios restantes vía FTP ou SSH (isto é, os restantes do directorio phpBB3) ao directorio raíz da túa instalación do foro no servidor, sobreescribindo os arquivos existentes. (Nota: cóidate de non eliminar ningunha extensión do teu directorio <code class="inline">/ext</code> cando subas os novos contidos de phpBB3.)</li>
			<li><strong><a href="%1$s" title="%1$s">Agora comeza o proceso de actualización apuntando o teu navegador ao directorio "/install"</a>.</strong></li>
			<li>Segue os pasos indicados para actualizar a base de datos e deixa que se complete a instalación.</li>
			<li>Elimina vía FTP ou SSH o directorio <code class="inline">/install</code> do directorio raíz da túa instalación.<br><br></li>
		</ol>

		<p>Agora tes o teu sistema á última, mantendo todos os teus usuarios e mensaxes. Outras tarefas que podes precisar a continuación:</p>
		<ul style="margin-left: 20px; font-size: 1.1em;">
			<li>Actualizar o teu paquete de idioma</li>
			<li>Actualizar o teu estilo/tema<br><br></li>
		</ul>

		<h1>Como actualizar a túa instalación usando o Paquete de Actualización Automático (Automatic Update Package)</h1>

		<p>O paquete de actualización automático só se recomenta no caso de que se modificaran arquivos clave (core) de phpBB na túa instalación. Tamén podes actualziar a túa instalación empregando os métodos listados no documento INSTALL.html. Os pasos para actualizar phpBB3 empregando o paquete de actualización automático son:</p>

		<ol style="margin-left: 20px; font-size: 1.1em;">
			<li>Ir á <a href="https://www.phpbb.com/downloads/" title="https://www.phpbb.com/downloads/">páxina de descargas de phpBB.com</a> e descargar o derradeiro arquivo "Automatic Update Package".</li>
			<li>Descomprimir o arquivo.</li>
			<li>Subir o directorios "install" e "vendor" (descromprimidos) ao raíz da túa instalación de phpBB (onde está o teu ficheiro config.php).<br><br></li>
		</ol>

		<p>Unha vez subido, o teu foro deixará de estar dispoñible para usuarios normáis ao estar presente o directorio "install".<br /><br />
		<strong><a href="%1$s" title="%1$s">Agora comeza o proceso de actualización apuntando o teu navegador ao directorio "/install"</a>.</strong><br />
		<br />
		Guiarémosche durante o proceso de actualización. Notificarémosche unha vez o proceso esté completo.
		</p>
	',
));

// Updater forms
$lang = array_merge($lang, array(
	// Updater types
	'UPDATE_TYPE'			=> 'Tipo de actualización',

	'UPDATE_TYPE_ALL'		=> 'Actualizar sistema de ficheiros e base de datos',
	'UPDATE_TYPE_DB_ONLY'	=> 'Actualizar só base de datos',

	// File updater methods
	'UPDATE_FILE_METHOD_TITLE'		=> 'Métodos de actualización de arquivos',

	'UPDATE_FILE_METHOD'			=> 'Método',
	'UPDATE_FILE_METHOD_DOWNLOAD'	=> 'Descargar ficheiros modificados nun arquivo',
	'UPDATE_FILE_METHOD_FTP'		=> 'Subir arquivos vía FTP (Automático)',
	'UPDATE_FILE_METHOD_FILESYSTEM'	=> 'Subir ficheiros vía acceso directo ao sistema de ficheiros (Automático)',

	// File updater archives
	'SELECT_DOWNLOAD_FORMAT'	=> 'Selecciona o formato de arquivo a descargar',

	// FTP settings
	'FTP_SETTINGS'			=> 'Axustes FTP',
));

// Requirements messages
$lang = array_merge($lang, array(
	'UPDATE_FILES_NOT_FOUND'	=> 'Non se atopou ningún directorio de actualización válido, asegúrate de que subiches os ficheiros axeitados.',

	'NO_UPDATE_FILES_UP_TO_DATE'	=> 'A túa versión está á última. Non é necesario lanzar a ferramenta de actualización. Se queres facer unha comprobación de integridade nos teus ficheiros, asegúrate de ter subidos os ficheiros de actualización axeitados.',
	'OLD_UPDATE_FILES'				=> 'Os ficheiros de actualización están desfasados. Os ficheiros de actualización atopatos son para actualizar da versión %1$s de phpBB á %2$s, pero a derradeira versión é a %3$s.',
	'INCOMPATIBLE_UPDATE_FILES'		=> 'Os ficheiros de actualización son incompatibles coa versión que tes instalada. Instalaches a versión %1$s e os ficheiros de actualización son para actualizar da versión %2$s de phpBB á %3$s.',
));

// Update files
$lang = array_merge($lang, array(
	'STAGE_UPDATE_FILES'		=> 'Arquivos de actualización',

	// Check files
	'UPDATE_CHECK_FILES'	=> 'Comproba os ficheiros a actualizar',

	// Update file differ
	'FILE_DIFFER_ERROR_FILE_CANNOT_BE_READ'	=> 'Non se puido abrir o arquivo de diferenzas %s.',

	'UPDATE_FILE_DIFF'		=> 'Actualizouse o arquivo de diferenzas',
	'ALL_FILES_DIFFED'		=> 'Todos os arquivos modificados foron comparados, os resultados están nos ficheiros de diferenzas.',

	// File status
	'UPDATE_CONTINUE_FILE_UPDATE'	=> 'Subir ficheiros',

	'DOWNLOAD'							=> 'Descargar',
	'DOWNLOAD_CONFLICTS'				=> 'Descarga o arquivo de conflictos de fusión (merge)',
	'DOWNLOAD_CONFLICTS_EXPLAIN'		=> 'Proura "&lt;&lt;&lt;" para ver os conflictos',
	'DOWNLOAD_UPDATE_METHOD'			=> 'Descarga o arquivo de ficheiros modificados',
	'DOWNLOAD_UPDATE_METHOD_EXPLAIN'	=> 'Unha vez descargado deberás descomprimilo. Atoparás os arquivos modificados que precisas subir ao directorio raíz da túa instalación de phpBB. Por favor sube os ficheiros ás súas respectivas rutas. Tras subir os arquivos, podes continuar co proceso de actualización.',

	'FILE_ALREADY_UP_TO_DATE'		=> 'O arquivo xa está ao día.',
	'FILE_DIFF_NOT_ALLOWED'			=> 'Non se poden comparar as diferenzas neste ficheiro.',
	'FILE_USED'						=> 'Información usada en',			// Single file
	'FILES_CONFLICT'				=> 'Ficheiros con conflictos',
	'FILES_CONFLICT_EXPLAIN'		=> 'Os seguintes ficheiros foron modificados e non representan os ficheiros orixináis da versión antiga. phpBB determinou que estes arquivos xerarán conflictos se se trata de fusionalos cos novos. Por favor analiza os conflictos e trata de resolvelos manualmente ou continúa a actualización escollendo a mellor forma de fusionalos. Se resolves os conflictos manualmente, marca outra vez os ficheiros tras modificalos. Tamén podes escoller entre o mellor método para fusionar cada ficheiro. O primeiro resultará nun arquivo onde as liñas en conflicto da versión antiga se perderán, e a outra resultará na perda do arquivo máis novo.',
	'FILES_DELETED'					=> 'Ficheiros eliminados',
	'FILES_DELETED_EXPLAIN'			=> 'Os seguintes ficheiros non existen na nova versión. Estes arquivos deberán eliminarse da túa instalación.',
	'FILES_MODIFIED'				=> 'Ficheiros modificados',
	'FILES_MODIFIED_EXPLAIN'		=> 'Os seguintes ficheiros foron modificados e non representan os ficheiros orixinal da versión antiga. O ficheiro actualizado será unha fusión entre as túas modificacións e o ficheiro novo.',
	'FILES_NEW'						=> 'Ficheiros novos',
	'FILES_NEW_EXPLAIN'				=> 'Os seguintes ficheiros non existen actualmente na túa instalación. Estes ficheiros engadiranse á túa instalación.',
	'FILES_NEW_CONFLICT'			=> 'Novos arquivos conflictivos',
	'FILES_NEW_CONFLICT_EXPLAIN'	=> 'Os seguintes ficheiros son novos na última versión pero determinouse que xa hai un arquivo co mesmo nome na mesma ruta. Este ficheiro sobreescribirase co novo contido.',
	'FILES_NOT_MODIFIED'			=> 'Ficheiros non modificados',
	'FILES_NOT_MODIFIED_EXPLAIN'	=> 'Os seguintes ficheiros non foron modificados e representan os orixináis da versión de phpBB a partir da cal queres actualizar.',
	'FILES_UP_TO_DATE'				=> 'Ficheiros xa actualizados',
	'FILES_UP_TO_DATE_EXPLAIN'		=> 'Os seguintes ficheiros xa están ao día e non precisan actualizarse.',
	'FILES_VERSION'					=> 'Versión dos ficheiros',
	'TOGGLE_DISPLAY'				=> 'Amosar/Ocultar a lista de ficheiros',

	// File updater
	'UPDATE_UPDATING_FILES'	=> 'Actualizando ficheiros',

	'UPDATE_FILE_UPDATER_HAS_FAILED'	=> 'O actualizador de ficheiros “%1$s“ fallou. O instalador tratará de usar “%2$s“ como alternativa.',
	'UPDATE_FILE_UPDATERS_HAVE_FAILED'	=> 'O actualizador de ficheiros fallou. Non hai máis métodos alternativos.',

	'UPDATE_CONTINUE_UPDATE_PROCESS'	=> 'Continuar o proceso de actualización',
	'UPDATE_RECHECK_UPDATE_FILES'		=> 'Comprobar ficheiros outra vez',
));

// Update database
$lang = array_merge($lang, array(
	'STAGE_UPDATE_DATABASE'		=> 'Actualizar base de datos',

	'INLINE_UPDATE_SUCCESSFUL'		=> 'A base de datos actualizouse correctamente.',

	'TASK_UPDATE_EXTENSIONS'	=> 'Actualizando extensións',
));

// Converter
$lang = array_merge($lang, array(
	// Common converter messages
	'CONVERT_NOT_EXIST'			=> 'A ferramenta de migración indicada non existe.',
	'DEV_NO_TEST_FILE'			=> 'Non se especificou ningún valor para a variable test_file na ferramenta de migración. Se eres un usuario desta ferramenta non deberías ver este erro, por favor informa ao autor da mesma. Se eres o autor da ferramenta, debes especificar o nome dun ficheiro que existe no foro orixe para poder validar que a ruta ao mesmo pode ser verificada.',
	'COULD_NOT_FIND_PATH'		=> 'Non se puido atopar a ruta ao teu foro antigo. Comproba os teus axustes e proba de novo.<br />» Especificouse "%s" como ruta orixe.',
	'CONFIG_PHPBB_EMPTY'		=> 'A variable de configuración “%s” de phpBB3 está baleira.',

	'MAKE_FOLDER_WRITABLE'		=> 'Por favor asegúrate de que este directorio existe e ten permisos de escritura no servidor, e volve a probar:<br />»<strong>%s</strong>.',
	'MAKE_FOLDERS_WRITABLE'		=> 'Por favor asegúrate de que estes directorios existen e teñen permisos de escritura no servidor, e volve a probar:<br />»<strong>%s</strong>.',

	'INSTALL_TEST'				=> 'Proba outra vez',

	'NO_TABLES_FOUND'			=> 'Non se atoparon táboas.',
	'TABLES_MISSING'			=> 'Non se puideron atopar estas táboas<br />» <strong>%s</strong>.',
	'CHECK_TABLE_PREFIX'		=> 'Por favor comproba o prefixo indicado para as táboas e proba outra vez.',

	// Conversion in progress
	'CONTINUE_CONVERT'			=> 'Continuar coa migración',
	'CONTINUE_CONVERT_BODY'		=> 'Atopouse un intento de migración anterior. Podes elexir entre comezar de novo ou continuar coa migración anterior.',
	'CONVERT_NEW_CONVERSION'	=> 'Comezar de novo',
	'CONTINUE_OLD_CONVERSION'	=> 'Continuar coa migración xa comezada',

	// Start conversion
	'SUB_INTRO'					=> 'Introdución',
	'CONVERT_INTRO'				=> 'Benvido ao Framework Unificado de Migración de phpBB',
	'CONVERT_INTRO_BODY'		=> 'Dende aquí podes importar datos de outro sistema de foros existente. A lista de embaixo amosa todos os módulos de migración dispoñibles. Se non atopas un módulo para o teu sistema de foros antigo, por favor consulta a nosa web xa que pode haber máis módulos para descargar.',
	'AVAILABLE_CONVERTORS'		=> 'Módulos de migración dispoñibles',
	'NO_CONVERTORS'				=> 'Non hai módulos dispoñibles.',
	'CONVERT_OPTIONS'			=> 'Opcións',
	'SOFTWARE'					=> 'Software de foros',
	'VERSION'					=> 'Versión',
	'CONVERT'					=> 'Ferramenta de migración',

	// Settings
	'STAGE_SETTINGS'			=> 'Axustes',
	'TABLE_PREFIX_SAME'			=> 'O prefixo para as táboas precisa ser o que se usa no software dende o cal estas migrando.<br />» O prefixo de táboas indicado foi %s.',
	'DEFAULT_PREFIX_IS'			=> 'A ferramenta de migración non puido atopar as táboas indicadas co prefixo. Asegúrate de ter indicado correctamente os detalles do foro dende o cal estaste migrando. O prefixo por defecto para %1$s é <strong>%2$s</strong>.',
	'SPECIFY_OPTIONS'			=> 'Especifica as opcións de migración',
	'FORUM_PATH'				=> 'Ruta ao foro',
	'FORUM_PATH_EXPLAIN'		=> 'Esta é a ruta <strong>relativa</strong> en disco ao teu foro antigo dende <strong>o directorio raíz desta instalación de phpBB3</strong>.',
	'REFRESH_PAGE'				=> 'Actualiza a páxina para continuar coa migración',
	'REFRESH_PAGE_EXPLAIN'		=> 'Se se indica "si", a ferramenta de migración actualizará a páxina para continuar coa migración unha vez finalizado o primeiro paso. Se esta é a túa primeira migración, de cara a probar e determinar se hai erros, suxerimos que o poñas a "Non".',

	// Conversion
	'STAGE_IN_PROGRESS'			=> 'Migración en proceso',

	'AUTHOR_NOTES'				=> 'Notas do autor<br />» %s',
	'STARTING_CONVERT'			=> 'Comezando proceso de migración',
	'CONFIG_CONVERT'			=> 'Migrando a configuración',
	'DONE'						=> 'Feito',
	'PREPROCESS_STEP'			=> 'Executando o pre-procesado de funcións e consultas',
	'FILLING_TABLE'				=> 'Enchendo a táboa <strong>%s</strong>',
	'FILLING_TABLES'			=> 'Enchendo táboas',
	'DB_ERR_INSERT'				=> 'Erro durante o procesado dunha consulta de tipo <code>INSERT</code>.',
	'DB_ERR_LAST'				=> 'Erro durante o procesado de <var>query_last</var>.',
	'DB_ERR_QUERY_FIRST'		=> 'Erro durante a execución de <var>query_first</var>.',
	'DB_ERR_QUERY_FIRST_TABLE'	=> 'Erro durante a execución de <var>query_first</var>, %s (“%s”).',
	'DB_ERR_SELECT'				=> 'Erro durante a execución dunha consulta de tipo <code>SELECT</code>.',
	'STEP_PERCENT_COMPLETED'	=> 'Paso <strong>%d</strong> de <strong>%d</strong>',
	'FINAL_STEP'				=> 'Paso final do proceso',
	'SYNC_FORUMS'				=> 'Comezando sincronización dos foros',
	'SYNC_POST_COUNT'			=> 'Sincronizando post_counts',
	'SYNC_POST_COUNT_ID'		=> 'Sincronizando post_counts dende o <var>entry</var> %1$s ao %2$s.',
	'SYNC_TOPICS'				=> 'Comezando sincronización de temas',
	'SYNC_TOPIC_ID'				=> 'Sincronizando temas dende o <var>topic_id</var> %1$s ao %2$s.',
	'PROCESS_LAST'					=> 'Procesando últimas sentenzas',
	'UPDATE_TOPICS_POSTED'		=> 'Xerando información publicada sobre temas',
	'UPDATE_TOPICS_POSTED_ERR'	=> 'Ocorreu un erro xerando a información publicada sobre os temas. Podes volver a intentalo no PCA (Pandel de Control do Administrador) unha vez remate o proceso de migración.',
	'CONTINUE_LAST'				=> 'Continuar coas últimas sentenzas',
	'CLEAN_VERIFY'				=> 'Limpando e verificando a estrutura final',
	'NOT_UNDERSTAND'			=> 'Non se puido entender %s #%d, táboa %s (“%s”)',
	'NAMING_CONFLICT'			=> 'Conflicto de nomeado: %s e %s son amboas álias<br /><br />%s',

	// Finish conversion
	'CONVERT_COMPLETE'			=> 'Migración finalizada',
	'CONVERT_COMPLETE_EXPLAIN'	=> 'Acabas de migrar correctamente o teu foro a phpBB 3.3. Agora podes identificarte e <a href="../">acceder ao teu novo foroa</a>. Asegúrate de que os axustes foron transferidos correctamente antes de habilitar o teu novo foro eliminando o directorio "install". Recorda que tes axuda dispoñible sobre como usar phpBB na <a href="https://www.phpbb.com/support/docs/en/3.3/ug/">Documentación</a> e no <a href="https://www.phpbb.com/community/viewforum.php?f=661">foro de soporte</a>.',

	'CONV_ERROR_ATTACH_FTP_DIR'			=> 'A subida por FTP de adxuntos está habilitada no foro antigo. Por favor deshabilita esta opción e asegúrate de que especificas un directorio de subida válido, logo copia todos os ficheiros adxuntos a este directorio. Unha vez feito, reinicia a migración.',
	'CONV_ERROR_CONFIG_EMPTY'			=> 'Non hai información de configuración dispoñible para esta ferramenta de migración.',
	'CONV_ERROR_FORUM_ACCESS'			=> 'Non se puido obter información de acceso ao foro.',
	'CONV_ERROR_GET_CATEGORIES'			=> 'Non se puideron obter as categorías.',
	'CONV_ERROR_GET_CONFIG'				=> 'Non se puido obter a configuración do teu foro.',
	'CONV_ERROR_COULD_NOT_READ'			=> 'Non se puido acceder/ler “%s”.',
	'CONV_ERROR_GROUP_ACCESS'			=> 'Non se puido obter o grupo de autenticación.',
	'CONV_ERROR_INCONSISTENT_GROUPS'	=> 'Hai inconsistencias na táboa de grupos en add_bots() - precisas engadir todos os grupos especiáis se o queres facer a man.',
	'CONV_ERROR_INSERT_BOT'				=> 'Non se pode inserir o bot na táboa de usuarios.',
	'CONV_ERROR_INSERT_BOTGROUP'		=> 'Non se puido inserir bot na táboa de bots.',
	'CONV_ERROR_INSERT_USER_GROUP'		=> 'Non se puido inserir ao usuario na táboa "user_group".',
	'CONV_ERROR_MESSAGE_PARSER'			=> 'Erro parseando mensaxe',
	'CONV_ERROR_NO_AVATAR_PATH'			=> 'Nota ao desenvolvedor: debes especificar $convertor[\'avatar_path\'] para usar %s.',
	'CONV_ERROR_NO_FORUM_PATH'			=> 'Non se especificou a ruta relativa ao foro orixe.',
	'CONV_ERROR_NO_GALLERY_PATH'		=> 'Nota ao desenvolvedor: debes especificar $convertor[\'avatar_gallery_path\'] para usar %s.',
	'CONV_ERROR_NO_GROUP'				=> 'Non se puido atopar o grupo “%1$s” en %2$s.',
	'CONV_ERROR_NO_RANKS_PATH'			=> 'Nota ao desenvolvedor: debes especificar $convertor[\'ranks_path\'] para usar %s.',
	'CONV_ERROR_NO_SMILIES_PATH'		=> 'Nota ao desenvolvedor: debes especificar $convertor[\'smilies_path\'] para usar %s.',
	'CONV_ERROR_NO_UPLOAD_DIR'			=> 'Nota ao desenvolvedor: debes especificar $convertor[\'upload_path\'] para usar %s.',
	'CONV_ERROR_PERM_SETTING'			=> 'Non se puido inserir/actualizar o axuste de permisos.',
	'CONV_ERROR_PM_COUNT'				=> 'Non se puido obter o número de mensaxes do cartafol.',
	'CONV_ERROR_REPLACE_CATEGORY'		=> 'Non se puido inserir o novo foro reemprazando a categoría antiga.',
	'CONV_ERROR_REPLACE_FORUM'			=> 'Non se puido inserir o novo foro reemprazando ao antigo.',
	'CONV_ERROR_USER_ACCESS'			=> 'Non se puido obter información da autenticación de usuarios.',
	'CONV_ERROR_WRONG_GROUP'			=> 'Grupo erróneo “%1$s” definido en %2$s.',
	'CONV_OPTIONS_BODY'					=> 'Esta páxina recolle a información requerida para acceder ao foro de orixe. Introduce os detalles da base de datos do teu foro antigo. A ferramenta de migración non modificará nada nesta base de datos. O foro orixinal deberá deshabilitarse para asegurarse de que a migración é consistente.',
	'CONV_SAVED_MESSAGES'				=> 'Mensaxes gardados',

	'PRE_CONVERT_COMPLETE'			=> 'Todos os pasos pre-migración foron completados correctamente. Podes comezar coa migración propiamente dita. Ten en conta que é posible que teñas que axustar varias cousas manualmente. Tras a migración, deberías revisar especialmente os permisos asignados, reconstruír o índice de procuras e asegurarte de que todos os ficheiros foron copiados correctamente, tal como avatares ou smilies.',
));
