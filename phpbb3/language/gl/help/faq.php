<?php
/**
*
* help_faq [Galician]
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

$lang = array_merge($lang, array(
	'HELP_FAQ_ATTACHMENTS_ALLOWED_ANSWER'	=> 'Cada administrador de taboleiro pode permitir ou prohibir certos tipos de adxuntos. Se non estás certo dos tipos permitidos para subir, contacta co administrador do taboleiro e solicita información.',
	'HELP_FAQ_ATTACHMENTS_ALLOWED_QUESTION'	=> 'Que adxuntos se permiten neste taboleiro?',
	'HELP_FAQ_ATTACHMENTS_OWN_ANSWER'	=> 'Para atopar a lista de adxuntos que subiches, vai ao teu Panel de Control de Usuario e segue a ligazón deica a sección de adxuntos.',
	'HELP_FAQ_ATTACHMENTS_OWN_QUESTION'	=> 'Como podo atopar todos os meus adxuntos?',

	'HELP_FAQ_BLOCK_ATTACHMENTS'	=> 'Adxuntos',
	'HELP_FAQ_BLOCK_BOOKMARKS'	=> 'Subscricións a Temas e Favoritos',
	'HELP_FAQ_BLOCK_FORMATTING'	=> 'Formateo e tipos de temas',
	'HELP_FAQ_BLOCK_FRIENDS'	=> 'Amigos e Inimigos',
	'HELP_FAQ_BLOCK_GROUPS'	=> 'Niveis de usuario e grupos',
	'HELP_FAQ_BLOCK_ISSUES'	=> 'Cuestións sobre phpBB',
	'HELP_FAQ_BLOCK_LOGIN'	=> 'Rexistro e inicio de sesión',
	'HELP_FAQ_BLOCK_PMS'	=> 'Mensaxería privada',
	'HELP_FAQ_BLOCK_POSTING'	=> 'Publicación de mensaxes',
	'HELP_FAQ_BLOCK_SEARCH'	=> 'Procurando nos foros',
	'HELP_FAQ_BLOCK_USERSETTINGS'	=> 'Preferencias de usuario e configuracións',

	'HELP_FAQ_BOOKMARKS_DIFFERENCE_ANSWER'	=> 'Marcar como favorito no phpBB3 é moito máis que facelo no teu navegador web. Non serás avisado cando haxa unha actualización, pero poderás volver ao tema máis tarde. A subscrición, porén, notificarate cando haxa unha actualización no tema ou foro do taboleiro mediante o método ou métodos que prefiras.',
	'HELP_FAQ_BOOKMARKS_DIFFERENCE_QUESTION'	=> 'Cal é a diferenza entre marcar como favorito e subscribirse?',
	'HELP_FAQ_BOOKMARKS_FORUM_ANSWER'	=> 'Para subscribirte a un foro concreto, preme na ligazón “Subscribirse ao foro” logo de entrar no mesmo. ',
	'HELP_FAQ_BOOKMARKS_FORUM_QUESTION'	=> 'Como podo subscribirme a foros específicos?',
	'HELP_FAQ_BOOKMARKS_REMOVE_ANSWER'	=> 'Para eliminar as túas subscricións, vai ao teu Panel de Control de Usuario e segue as ligazóns deica as mesmas.',
	'HELP_FAQ_BOOKMARKS_REMOVE_QUESTION'	=> 'Como podo eliminar as miñas subscricións?',
	'HELP_FAQ_BOOKMARKS_TOPIC_ANSWER'	=> 'Para subscribirte a un tema, resposta ao mesmo coa caixa da opción de subscrición marcada ou preme na ligazón “Subscribirse ao tema” no propio tema.',
	'HELP_FAQ_BOOKMARKS_TOPIC_QUESTION'	=> 'Como podo subscribirme a temas específicos?',

	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_ANSWER'	=> 'Os anuncios adoitan conter información importante para o foro que estás a ver e deberías lelos sempre que che sexa posíbel. Os anuncios aparecen na parte superior de cada páxina do foro no que foron publicados. Do mesmo xeito que cos anuncios globais, os permisos para publicar anuncios son determinados polo administrador do taboleiro.',
	'HELP_FAQ_FORMATTING_ANNOUNCEMENT_QUESTION'	=> 'Que son os anuncios?',
	'HELP_FAQ_FORMATTING_BBOCDE_ANSWER'	=> 'O BBCode é unha linguaxe semellante a HTML, que ofrece un grande control de formato en determinados obxectos dunha mensaxe publicada. A posibilidade de usar o BBCode nas mensaxes publicadas nos foros é determinada polo administrador. Asemade, podes desactivar o BBCCode nunha mensaxe determinada a través do formulario de publicación da mesma. O BBCode é moi similar no estilo ao HTML, aínda que as etiquetas van entre corchetes [ e ] en troques de &lt; e &gt;.  Para máis información podes ver o manual de BBCode, na ligazón que aparece cada vez que vas publicar unha mensaxe.',
	'HELP_FAQ_FORMATTING_BBOCDE_QUESTION'	=> 'Que é o código BBCode?',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_ANSWER'	=> 'Os Anuncios Globais conteñen información importante e debes lelos sempre que sexa posíbel. Aparecerán na parte superior de todos os foros e tamén no teu Panel de Control de Usuario. Os permisos para publicar Anuncios Globais son determinados polo administrador do taboleiro.',
	'HELP_FAQ_FORMATTING_GLOBAL_ANNOUNCE_QUESTION'	=> 'Que son os Anuncios Globais?',
	'HELP_FAQ_FORMATTING_HTML_ANSWER'	=> 'Non. Non é posíbel publicar HTML neste taboleiro de xeito que sexa interpretado e amosado o seu resultado. A meirande parte dos formatos que se poden obter co HTML poden ser tamén acadados co uso do BBCode no seu lugar.',
	'HELP_FAQ_FORMATTING_HTML_QUESTION'	=> 'Podo usar HTML?',
	'HELP_FAQ_FORMATTING_ICONS_ANSWER'	=> 'As iconas de tema son imaxes escollidas polo autor asociadas coas mensaxes publicadas para indicar o seu contido. A posibilidade de usar iconas de tema depende dos permisos concedidos polo administrador do taboleiro.',
	'HELP_FAQ_FORMATTING_ICONS_QUESTION'	=> 'Que son as iconas de tema?',
	'HELP_FAQ_FORMATTING_IMAGES_ANSWER'	=> 'Si, pódense amosar imaxes nas túas mensaxes publicadas. Se o administrador habilitou a posibilidade de engadir adxuntos, pode que esteas autorizado a subir a imaxe ao taboleiro. Caso contrario, deberás ligar a unha imaxe almacenada nun servidor web accesíbel publicamente, é dicir, http://www.exemplo.com/a-minha-imaxe.gif. Non podes ligar a imaxes gardadas no teu propio PC (a menos que sexa un servidor accesíbel publicamente) nin a imaxes gardadas tras mecanismos de identificación como as caixas de correo de Hotmail ou Yahoo, sitios protexidos por contrasinal etc. Para amosar unha imaxe utiliza a etiqueta [img] do BBCode.',
	'HELP_FAQ_FORMATTING_IMAGES_QUESTION'	=> 'Podo publicar imaxes?',
	'HELP_FAQ_FORMATTING_LOCKED_ANSWER'	=> 'Nos temas pechados ou bloqueados os usuarios non poden xa publicar respostas e asemade calquera enquisa que conteñan é rematada de xeito automático. Os temas poden ser pechados por varias razóns e poden ser configurados neste xeito tanto polo moderador do foro coma polo administrador do taboleiro. Tamén é posíbel que poidas pechar os teus propios temas dependendo dos permisos que teñas asignados por parte do administrador do taboleiro.',
	'HELP_FAQ_FORMATTING_LOCKED_QUESTION'	=> 'Que son os temas pechados ou bloqueados?',
	'HELP_FAQ_FORMATTING_SMILIES_ANSWER'	=> 'Os Risoños, Smilies, ou Emoticonas, son pequenos gráficos que poden usarse para expresar emocións utilizando un pequeno código, por exemplo, :) significa ledo, namentres :( significa triste. A lista completa de risoños pode verse no formulario que aparece cando publicas unha mensaxe. Porén, tenta non abusar dos risoños, xa que poden de xeito doado converter unha mensaxe en ilexíbel e o moderador pode decidir editala ou borrala completamente. Tamén é posíbel que o administrador do taboleiro configurase a cantidade máxima de risoños que podes utilizar nunha mensaxe publicada.',
	'HELP_FAQ_FORMATTING_SMILIES_QUESTION'	=> 'Que son os risoños (smilies)?',
	'HELP_FAQ_FORMATTING_STICKIES_ANSWER'	=> 'Os temas destacados aparecen debaixo dos anuncios na vista do foro e só na primeira páxina. Adoitan ser importantes de abondo como para lelos sempre que che sexa posíbel. Do mesmo xeito que cos anuncios e anuncios globais, os permisos para publicar temas destacados son determinados polo administrador do taboleiro.',
	'HELP_FAQ_FORMATTING_STICKIES_QUESTION'	=> 'Que son os temas destacados?',

	'HELP_FAQ_FRIENDS_BASIC_ANSWER'	=> 'Podes utilizar estas listas para organizar aos outros membros do taboleiro. Os membros engadidos á túa lista de amigos serán amosados no teu Panel de Control de Usuario para que poidas coñecer de xeito doado o seu estado en liña e para poder enviarlles mensaxes privadas. Dependendo de que a sobreplanta o permita, as mensaxes destes usuarios poden aparecer tamén resaltadas. Se engades un usuario á túa lista de inimigos, calquera mensaxe publicada polo mesmo agocharase por defecto.',
	'HELP_FAQ_FRIENDS_BASIC_QUESTION'	=> 'Que son as miñas listas de Amigos e Inimigos?',
	'HELP_FAQ_FRIENDS_MANAGE_ANSWER'	=> 'Hai dous xeitos de engadir usuarios ás túas listas. No perfil de cada un dos usuarios hai senllas ligazóns para poder engadilos á túa lista de Amigos ou de Inimigos. De xeito alternativo, podes engadir usuarios inserindo o seu nome directamente no teu Panel de Control de Usuario. Podes tamén eliminar usuarios das túas listas utilizando a mesma páxina.',
	'HELP_FAQ_FRIENDS_MANAGE_QUESTION'	=> 'Como podo engadir ou eliminar usuarios das miñas listas de Amigos ou Inimigos?',

	'HELP_FAQ_GROUPS_ADMINISTRATORS_ANSWER'	=> 'Os Administradores son membros aos que se lles asignou o máis alto nivel de control sobre o taboleiro enteiro. Estes membros poden controlar todos os aspectos relativos ao funcionamento do mesmo incluíndo concesión de permisos, bloqueo ou prohibición de usuarios, creación de grupos de usuarios ou moderadores etc., dependendo do fundador do taboleiro e dos permisos que concedese aos outros administradores. Asemade teñen capacidade absoluta para actuar como moderadores en calquera dos foros, tamén en función da configuración estabelecida polo fundador do taboleiro.',
	'HELP_FAQ_GROUPS_ADMINISTRATORS_QUESTION'	=> 'Que son os Administradores?',
	'HELP_FAQ_GROUPS_COLORS_ANSWER'	=> 'O administrador do taboleiro pode asignar unha cor determinada aos membros dun grupo de usuarios para facilitar a identificación dos mesmos.',
	'HELP_FAQ_GROUPS_COLORS_QUESTION'	=> 'Por que algúns dos grupos de usuarios aparecen en distinta cor?',
	'HELP_FAQ_GROUPS_DEFAULT_ANSWER'	=> 'Se es membro de máis dun grupo de usuarios, o teu predeterminado será o que se use para definir a cor e rango de grupo que se amosará para ti por defecto. O administrador do taboleiro pode concederche permisos para mudar o teu grupo de usuarios predeterminado a través do teu Panel de Control de Usuario.',
	'HELP_FAQ_GROUPS_DEFAULT_QUESTION'	=> 'Que é un “Grupo de usuarios predeterminado”?',
	'HELP_FAQ_GROUPS_MODERATORS_ANSWER'	=> 'Os Moderadores son persoas (ou grupos de persoas) que teñen como tarefa vixiar os foros a diario. Teñen autoridade para editar ou borrar mensaxes publicadas e bloquear, desbloquear, mover, borrar e dividir temas no foro que moderan. Xeralmente os moderadores están presentes para previr que a xente publique mensaxes fóra do tema (off-topic) ou de contido abusivo ou ofensivo.',
	'HELP_FAQ_GROUPS_MODERATORS_QUESTION'	=> 'Que son os Moderadores?',
	'HELP_FAQ_GROUPS_TEAM_ANSWER'	=> 'Esta páxina ofréceche unha lista do persoal que administra o taboleiro, incluíndo os administradores do mesmo e os moderadores canda outros pormenores coma os foros que moderan.',
	'HELP_FAQ_GROUPS_TEAM_QUESTION'	=> 'Que é a ligazón “O equipo”?',
	'HELP_FAQ_GROUPS_USERGROUPS_ANSWER'	=> 'A comunidade está dividida en grupos de usuarios como seccións manexábeis da mesma de xeito que os administradores do taboleiro poden traballar con elas dun xeito máis doado. Cada usuario pode pertencer a varios grupos e a cada grupo pódenselle asignar dereitos de acceso individuais. Deste xeito facilítaselles aos administradores o troco de permisos a varios usuarios ao mesmo tempo, como no caso de mudar permisos de moderación, ou darlles acceso a un foro privado.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_ANSWER'	=> 'Podes ver un listado de todos os grupos de usuarios premendo na ligazón “Grupos de usuarios” do teu Panel de Control de Usuario. Se queres unirte a un deles, deberás premer no botón correspondente. Porén, non todos os grupos teñen acceso aberto, e algúns poden requirir aprobación para unirse a eles, outros poden ser restrinxidos e mesmo pode habelos ocultos. Se o grupo é aberto, podes, como xa dixemos, unirte ao mesmo premendo no botón apropiado. Se o grupo precisa aprobación previa á incorporación de usuarios podes solicitar a mesma premendo tamén no botón axeitado. O xefe do grupo de usuarios deberá aprobar a túa solicitude e pode ser que che pregunte polas túas razóns para querer incorporarte ao mesmo. Non fustrigues ao xefe do grupo no caso de que rexeite a túa petición; terá os seus motivos para facelo.',
	'HELP_FAQ_GROUPS_USERGROUPS_JOIN_QUESTION'	=> 'Onde están os grupos de usuarios e como podo unirme a un deles?',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_ANSWER'	=> 'Normalmente asígnase un xefe de grupo de usuarios cando este se crea inicialmente por parte dun administrador do taboleiro. Se estás interesado en crear un grupo de usuarios, o teu primeiro punto de contacto debe ser un dos administradores; proba a enviarlle unha mensaxe privada.',
	'HELP_FAQ_GROUPS_USERGROUPS_LEAD_QUESTION'	=> 'Como podo ser xefe dun grupo de usuarios?',
	'HELP_FAQ_GROUPS_USERGROUPS_QUESTION'	=> 'Que son os grupos de usuarios?',

	'HELP_FAQ_ISSUES_ADMIN_ANSWER'	=> 'Se a opción está habilitada, Todos os usuarios poden usar o formulario de “Contáctanos”.<br />Tamén se pode usar a ligazón de “O Equipo”.',
	'HELP_FAQ_ISSUES_ADMIN_QUESTION'	=> 'Como podo contactar cun adminsitrador?',
	'HELP_FAQ_ISSUES_FEATURE_ANSWER'	=> 'Este foro foi escrito e licenciado a través do phpBB Group. Se cres que debería incluír algunha nova funcionalidade, ou queres informar sobre un fallo, visita o sitio de phpBB en <a href="http://area51.phpbb.com/">Area51</a>, onde atoparás máis información ao respecto.',
	'HELP_FAQ_ISSUES_FEATURE_QUESTION'	=> 'Por que este foro non ten a característica X dispoñíbel?',
	'HELP_FAQ_ISSUES_LEGAL_ANSWER'	=> 'Calquera dos administradores listados na páxina “O equipo” pode ser un punto de contacto axeitado para amosarlle as túas queixas. Se aínda así segues sen obter resposta podes contactar co propietario do dominio (fai unha <a href="http://www.google.com/search?q=whois">procura whois</a>) ou, se se o sitio funciona nun servizo de balde (p.e. Yahoo!, free.fr, f2s.com etc.), co departamento de xestión ou abusos do mesmo. Ten en conta que o phpBB Group <strong>non ten xurisdición ningunha</strong> e non pode ser responsabilizado de xeito ningún sobre como, onde ou por quen sexa utilizado este taboleiro. É inútil contactar co phpBB Group en relación con calquera asunto legal (cese ou suspensión, responsabilidade, comentarios difamatorios etc.) <strong>non directamente relacionado</strong> co sitio web phpBB.com ou co software concreto do phpBB. Se envías un correo-e ao phpBB Group <strong>sobre calquera uso por unha terceira parte</strong> deste software recibirás unha resposta concisa ou non recibirás ningunha resposta.',
	'HELP_FAQ_ISSUES_LEGAL_QUESTION'	=> 'Con quen podo contactar sobre abusos e/ou asuntos legais relacionados con este taboleiro?',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_ANSWER'	=> 'Esta aplicación (na súa forma orixinal) é producida, ceibada e con dereitos de autor pertencentes ao <a href=\"http://www.phpbb.com/\" target=\"_blank\">phpBB Group</a>. Está feito baixo da GNU (Licenza Pública Xeral) e é de distribución ceibe. Preme na ligazón para coñecer os pormenores.',
	'HELP_FAQ_ISSUES_WHOIS_PHPBB_QUESTION'	=> 'Quen programou este foro?',

	'HELP_FAQ_LOGIN_AUTO_LOGOUT_ANSWER'	=> 'Se non activas a opción <em>Iniciar sesión automaticamente</em> cando inicias a mesma o foro manterá a túa sesión por un tempo predeterminado. Isto prevén que a túa conta poda ser usada por alguén máis. Para permanecer coa sesión activa, marca a opción ao entrar. NON é recomendábel se accedes ao foro desde un ordenador compartido, é dicir, dun café-internet, biblioteca, sala da universidade etc. Se non che aparece esta caixa de opción, significa que o administrador desactivou tal posibilidade.',
	'HELP_FAQ_LOGIN_AUTO_LOGOUT_QUESTION'	=> 'Por que a miña sesión de usuario expira automaticamente?',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANSWER'	=> 'Hai varias razóns polo que isto pode ocorrer. En primeiro lugar, asegúrate de que o teu nome de usuario e contrasinal son correctos. Se o son, contacta co xestor do taboleiro para estar certo de que no se che prohibiu o acceso. Tamén podería ser que o xestor do sitio web teña cometido un erro de configuración, que precisará solucionar.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_ANSWER'	=> 'Pode ser que algún administrador desactivase ou eliminase a túa conta por algún motivo. Do mesmo xeito, moitos foros eliminan periodicamente aqueles usuarios que non publicaron mensaxes nun prazo longo de tempo co fin de reducir o tamaño do banco de datos. Se foi o caso, tenta rexistrarte de novo e participa máis activamente nas discusións.',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_ANYMORE_QUESTION'	=> 'Hai un tempo rexistreime, pero agora non podo entrar!',
	'HELP_FAQ_LOGIN_CANNOT_LOGIN_QUESTION'	=> 'Por que non podo iniciar unha sesión?',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_ANSWER'	=> 'Pode ser que o xestor do sitio web prohibise o acceso do teu enderezo IP ou non permita o nome de usuario que estás tentando rexistrar. Tamén podería ser que o xestor do web teña desactivada a posibilidade de rexistro para evitar que se axunten novos visitantes. Contacta con algún administrador do taboleiro para obter axuda.',
	'HELP_FAQ_LOGIN_CANNOT_REGISTER_QUESTION'	=> 'Por que non me podo rexistrar?',
	'HELP_FAQ_LOGIN_COPPA_ANSWER'	=> 'O COPPA, ou o protocolo Child Online Privacy and Protection (Privacidade e Protección de Rapaces en liña) do 1998, é unha lei dos Estados Unidos que require que, os sitios web que potencialmente poidan recoller información de menores de 13 anos, deban dispoñer de consentimento por escrito dos pais ou calquera outro método de recoñecemento por parte do titor legal, permitindo esa recollida de información persoalmente identificábel dun menor de 13 anos. Se non estás certo da aplicación de isto na túa persoa no momento de tentar rexistrarte ou da aplicación ao sitio web no que tentas facelo, contacta con algún asesor legal para obter asistencia. Ten en conta que o phpBB Group non pode proporcionar esa asistencia legal nin é un punto de contacto para asuntos legais, agás dos que se bosquexan máis abaixo.',
	'HELP_FAQ_LOGIN_COPPA_QUESTION'	=> 'Que é o COPPA?',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_ANSWER'	=> 'Elimina as cookies creadas polo phpBB que te manteñen identificado e conectado no taboleiro. Tamén proporciona funcións como control de lecturas, se é que foron activadas polo xestor dos foros. Se estás a ter problemas de inicio ou remate de sesións, ás veces eliminar as cookies do taboleiro pode axudar.',
	'HELP_FAQ_LOGIN_DELETE_COOKIES_QUESTION'	=> 'Que fai a opción “Eliminar todas as cookies”?',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_ANSWER'	=> 'Acouga! Aínda que o teu contrasinal non pode ser recuperado podes reinicialo dun xeito doado. Para facelo diríxete á páxina de rexistro e preme en <em>Esquecín o meu contrasinal</em>. Segue as instrucións e poderás volver iniciar unha sesión en moi pouco tempo.',
	'HELP_FAQ_LOGIN_LOST_PASSWORD_QUESTION'	=> 'Perdín o meu contrasinal!',
	'HELP_FAQ_LOGIN_REGISTER_ANSWER'	=> 'Non estás obrigado a facelo, a decisión tómana os administradores e moderadores. Porén, estar rexistrado dáche moitas vantaxes que como usuario convidado non terías, como ter o teu gráfico personalizado (avatar), mensaxes privadas, enviar correos-e aos outros usuarios, subscrición a grupos de usuarios etc. Só che levará uns segundos, é moi recomendábel.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_ANSWER'	=> 'Primeiro verifica os teus datos de usuario e contrasinal. Se todo é correcto hai dúas posíbeis razóns: se o Sistema de Protección Infantil (COPPA) está activado e cando te rexistraches especificaches ser menor de 13 anos, entón terás que seguir as instrucións que se che deron. Algúns foros requirirán que todos os novos rexistros sexan activados, ben por ti mesmo ou polo administrador antes de que poidas iniciar a sesión; esta información amósase durante o proceso de rexistro. Se recibiches un correo-e segue as instrucións que se che indiquen. Se non recibiches correo-e ningún entón pode que o enderezo que subministraches sexa incorrecto ou a mensaxe fose rexeitada por algún filtro anti-spam. Se estás certo que o enderezo de correo-e que deches é válido tenta conectar co administrador do foro.',
	'HELP_FAQ_LOGIN_REGISTER_CONFIRM_QUESTION'	=> 'Rexistreime pero non podo entrar!',
	'HELP_FAQ_LOGIN_REGISTER_QUESTION'	=> 'Por que me teño que rexistrar para todo?',

	'HELP_FAQ_PMS_CANNOT_SEND_ANSWER'	=> 'Hai tres posíbeis razóns: Non estás rexistrado ou non iniciaches a sesión, o administrador desactivou o sistema de mensaxes privadas para todo o foro ou o administrador desactivou para ti individualmente a mensaxería privada. Contacta con algún administrador do taboleiro para obter máis información.',
	'HELP_FAQ_PMS_CANNOT_SEND_QUESTION'	=> 'Non podo enviar mensaxes privadas!',
	'HELP_FAQ_PMS_SPAM_ANSWER'	=> 'Sentimos moito ouvir isto. A característica de envío de correos-e deste foro inclúe procedementos que tentan controlar aos usuarios que efectúan tales envíos, polo que podes contactar co administrador do foro incluíndo unha copia completa do correo-e que recibiches tal e como viña, incluíndo cabeceiras (moi importante, xa que estas especifican os detalles do usuario remitente da mensaxe). O administrador do taboleiro poderá entón tomar as medidas precisas.',
	'HELP_FAQ_PMS_SPAM_QUESTION'	=> 'Recibín spam ou correos abusivos procedentes de alguén neste foro!',
	'HELP_FAQ_PMS_UNWANTED_ANSWER'	=> 'Podes bloquear o envío de mensaxes privadas por parte dun usuario concreto utilizando as regras de mensaxes que atoparás no teu Panel de Control de Usuario. Se estás a recibir mensaxes privadas abusivas por parte dun usuario determinado, informa a algún dos administradores do taboleiro; eles teñen a capacidade de evitar que o usuario en cuestión envíe mensaxes privadas.',
	'HELP_FAQ_PMS_UNWANTED_QUESTION'	=> 'Sigo a recibir mensaxes privadas non desexadas!',

	'HELP_FAQ_POSTING_BUMP_ANSWER'	=> 'Premendo na ligazón “Reactivar tema” cando a poidas ver, podes “reactivar” o tema de xeito que aparecerá enriba do foro, na súa primeira páxina. Porén, se non podes ver a ligazón, pode que a reactivación de temas estea desactivada ou que non se chegara aínda ao tempo mínimo entre reactivacións. Tamén é posíbel reactivar un tema sinxelamente engadíndolle unha resposta, aínda que deberás asegurarte de cumprir coas regras do taboleiro cando o fagas.',
	'HELP_FAQ_POSTING_BUMP_QUESTION'	=> 'Como podo reactivar o meu tema?',
	'HELP_FAQ_POSTING_CREATE_ANSWER'	=> 'Para publicar un novo tema nun foro, preme no botón correspondente das pantallas do foro ou dos temas. É posíbel que precises rexistrarte denantes que poidas publicar unha mensaxe. As posibilidades que tes dispoñíbeis aparecen listadas na parte inferior da pantalla dos foros e temas. Aquelo de: Podes publicar novos temas, Podes votar nas enquisas etc.',
	'HELP_FAQ_POSTING_CREATE_QUESTION'	=> 'Como podo publicar unha mensaxe nun foro?',
	'HELP_FAQ_POSTING_DRAFT_ANSWER'	=> 'Isto permitirache gardar anacos que queiras completar e enviar posteriormente. Para recargar un anaco gardado, visita o Panel de Control de Usuario.',
	'HELP_FAQ_POSTING_DRAFT_QUESTION'	=> 'Para que serve o botón “Gardar” que aparece na publicación de temas?',
	'HELP_FAQ_POSTING_EDIT_DELETE_ANSWER'	=> 'A menos que sexas o administrador ou moderador do foro só podes borrar ou editar as mensaxes que enviaches ti mesmo. Podes editar unha mensaxe (moitas veces só por un tempo limitado logo de ser publicada) premendo no botón de edición da mesma. Se alguén xa respondeu á mensaxe, atoparás un pequeno texto ao pé da corrección indicando o número de veces que foi modificada canda a data e a hora. Isto non aparecerá se non hai aínda respostas ou se foi un moderador ou o administrador quen a editou, aínda que poden deixar unha mensaxe aclaratoria de que alteraron e o porqué, se así o consideraren. Ten en conta que os usuarios normais non poden borrar unha mensaxe unha vez que esta foi respondida.',
	'HELP_FAQ_POSTING_EDIT_DELETE_QUESTION'	=> 'Como podo editar ou eliminar unha mensaxe?',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_ANSWER'	=> 'Algúns foros están limitados a certos grupos ou usuarios. Para velos, ler, publicar mensaxes, editar etc, pode que precises certas autorizacións, que só che pode dar un moderador ou administrador do foro, polo que deberás contactar con eles.',
	'HELP_FAQ_POSTING_FORUM_RESTRICTED_QUESTION'	=> 'Por que non podo acceder a algún foro?',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_ANSWER'	=> 'Os permisos para engadir adxuntos son adxudicados basicamente a foros, grupos ou usuarios. Pode que o administrador do taboleiro non permita o engadido de adxuntos non foro concreto no que estás a publicar mensaxes, ou ben é posíbel que só certos grupos teñan permitido a inclusión de adxuntos nas mensaxes publicadas. Contacta co administrador do taboleiro se non estás certo de por que non podes engadir adxuntos.',
	'HELP_FAQ_POSTING_NO_ATTACHMENTS_QUESTION'	=> 'Por que non podo engadir adxuntos?',
	'HELP_FAQ_POSTING_POLL_ADD_ANSWER'	=> 'O límite de opcións para unha enquisa determínao o administrador do taboleiro. Se pensas que precisas engadir máis opcións á túa enquisa das que están permitidas, contacta co administrador dos foros.',
	'HELP_FAQ_POSTING_POLL_ADD_QUESTION'	=> 'Por que non podo engadir máis opcións a unha enquisa?',
	'HELP_FAQ_POSTING_POLL_CREATE_ANSWER'	=> 'Cando inicies un novo tema ou edites a primeira mensaxe dun tema, preme na pestana “Crear unha enquisa” baixo do formulario principal de edición da mensaxe; se non a ves, o máis probábel é que non teñas permisos axeitados para crear enquisas. Insire un título e, polo menos, dúas opcións nos campos correspondentes, asegurándote de que cada opción está nunha liña distinta na área de texto. Tamén podes escoller o número de opcións que os usuarios poderán seleccionar durante a votación na sección “Opcións por usuario”, un tempo límite en días para a enquisa (insire 0 se queres que dure indefinidamente) e, por último, a opción para permitir aos usuarios corrixir os seus votos.',
	'HELP_FAQ_POSTING_POLL_CREATE_QUESTION'	=> 'Como podo crear unha enquisa?',
	'HELP_FAQ_POSTING_POLL_EDIT_ANSWER'	=> 'Do mesmo xeito que coas mensaxes, as enquisas só poden ser editadas por quen as publicou, un moderador, ou polo administrador do foro. Para editar unha enquisa preme na primeira mensaxe do tema, a cal terá sempre a enquisa asociada con ela. Se ninguén votou entón os usuarios poden borrar a enquisa ou editar calquera opción da mesma. Porén, se alguén efectuou xa o seu voto só os moderadores ou administradores poderán editala ou borrala. Isto faise para evitar que a xente ensarille as enquisas mudando as súas opcións no medio dun proceso de votación.',
	'HELP_FAQ_POSTING_POLL_EDIT_QUESTION'	=> 'Como podo editar ou borrar unha enquisa?',
	'HELP_FAQ_POSTING_QUEUE_ANSWER'	=> 'Pode ser que o administrador do taboleiro teña decidido que as mensaxes do foro no que estás a tentar publicar requiran unha revisión previa denantes da súa publicación. Tamén podería ser que pertenzas a un grupo de usuarios que precisan control previo das súas mensaxes antes de seren publicadas, e no que fuches ubicado polo administrador. Contacta co mesmo para obter máis información.',
	'HELP_FAQ_POSTING_QUEUE_QUESTION'	=> 'Por que a miña mensaxe ten que ser aprobada?',
	'HELP_FAQ_POSTING_REPORT_ANSWER'	=> 'Se o administrador do taboleiro habilitou a opción correspondente, poderás ver un botón para enviar informes de mensaxes a carón da mensaxe da que queres informar. Premendo nel, serás guiado a través dos chanzos precisos para emitir o informe verbo da mensaxe.',
	'HELP_FAQ_POSTING_REPORT_QUESTION'	=> 'Como podo facer informes dunha mensaxe para un moderador?',
	'HELP_FAQ_POSTING_SIGNATURE_ANSWER'	=> 'Para inserir unha sinatura na túa mensaxe primeiro debes crear unha mediante o teu Panel de Control de Usuario. Unha vez creada, podes activar a opción <em>Engadir sinatura</em> no formulario de redacción de mensaxes para engadila. Tamén podes facer que todas as túas novas mensaxes teñan a túa sinatura por defecto, activando a opción correspondente no teu perfil. Se fas tal cousa, tamén podes evitar que a túa sinatura sexa engadida en determinadas mensaxes desactivando a opción de engadir sinatura no formulario de publicación da mesma.',
	'HELP_FAQ_POSTING_SIGNATURE_QUESTION'	=> 'Como podo engadir unha sinatura á miña mensaxe?',
	'HELP_FAQ_POSTING_WARNING_ANSWER'	=> 'Cada administrador ten o seu propio conxunto de normas que rexerán no seu sitio. Se contraviñeches algunha delas, pode que recibas unha advertencia. Ten en conta que isto é unha decisión do administrador do taboleiro, polo que o phpBB Group non pode facer ren con respecto ás advertencias recibidas polo sitio en cuestión. Contacta co administrador do taboleiro se non estás certo do motivo polo que fuches advertido.',
	'HELP_FAQ_POSTING_WARNING_QUESTION'	=> 'Por que recibín unha advertencia?',

	'HELP_FAQ_SEARCH_BLANK_ANSWER'	=> 'A túa procura devolveu demasiados resultados e o servidor web non puido xestionalos. Utiliza a “Procura avanzada” e mira de ser máis específico cos termos inseridos e os foros nos que queres buscar.',
	'HELP_FAQ_SEARCH_BLANK_QUESTION'	=> 'Por que a miña procura amosa unha páxina en branco!?',
	'HELP_FAQ_SEARCH_FORUM_ANSWER'	=> 'Insire un termo de procura na caixa de busca ubicada no índice, foro ou páxinas de temas. Podes acceder á procura avanzada premendo na ligazón “Procura Avanzada” dispoñíbel en todas as páxinas do foro. O procedemento de acceso á procura pode depender do estilo utilizado.',
	'HELP_FAQ_SEARCH_FORUM_QUESTION'	=> 'Como podo procurar nun foro ou foros?',
	'HELP_FAQ_SEARCH_MEMBERS_ANSWER'	=> 'Vai á páxina de “Membros” e preme na ligazón “Procurar un membro”.',
	'HELP_FAQ_SEARCH_MEMBERS_QUESTION'	=> 'Como podo atopar membros?',
	'HELP_FAQ_SEARCH_NO_RESULT_ANSWER'	=> 'Pode que a túa procura fose indefinida de máis e incluíse varios termos comúns que o phpBB3 non indexa. Tenta ser máis específico e utiliza as opcións dispoñíbeis na Procura avanzada.',
	'HELP_FAQ_SEARCH_NO_RESULT_QUESTION'	=> 'Por que a miña procura non amosa resultados?',
	'HELP_FAQ_SEARCH_OWN_ANSWER'	=> 'Podes acceder ás túas mensaxes publicadas ben premendo na ligazón “Procurar mensaxes publicadas por un usuario” no Panel de Control de Usuario ou ben a través da páxina do teu perfil. Para procurar os teus temas, utiliza a páxina de Procura avanzada e enche as diversas opcións como sexa preciso.',
	'HELP_FAQ_SEARCH_OWN_QUESTION'	=> 'Como podo atopar os meus propios temas e mensaxes publicadas?',

	'HELP_FAQ_USERSETTINGS_AVATAR_ANSWER'	=> 'Hai dous tipos de imaxes que poden aparecer xunto dun nome de usuario cando se están a ver mensaxes. Un deles pode ser unha imaxe asociada co teu rango, xeralmente en forma de estrelas, bloques ou puntos, indicando a cantidade de mensaxes que publicaches ou o teu status no taboleiro. Outro, normalmente unha imaxe meirande, coñécese por avatar e adoita ser única ou persoal para cada usuario. A dispoñibilidade do uso de avatares decídea o administrador do foro así como a forma na que se poden usar. Se non podes usar avatares é logo por unha decisión do administrador e deberás contactar con el para coñecer as súas razóns.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_ANSWER'	=> 'No teu Panel de Control de Usuario, baixo “Perfil” podes engadir un avatar usando un dos seguintes métodos: Gravatar, Galería, Remoto ou Subir. Depende dos administradores habilitar os avatares e como facer que estexan dispoñiblesmade available. Se non podes usar un avatar, contacta cun administrador.',
	'HELP_FAQ_USERSETTINGS_AVATAR_DISPLAY_QUESTION'	=> 'Como podo amosar unha imaxe xunto do meu nome de usuario (avatar)?',
	'HELP_FAQ_USERSETTINGS_AVATAR_QUESTION'	=> 'Que son as imaxes que aparecen ao carón do meu nome de usuario?',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_ANSWER'	=> 'Se es un usuario rexistrado, toda a túa configuración esta gardada no banco de datos do taboleiro. Para modificala, Vai ao teu Panel de Control de Usuario; normalmente atoparás unha ligazón directa na parte superior das páxinas dos foros. Este sistema permitirache mudar todas as túas opcións e preferencias.',
	'HELP_FAQ_USERSETTINGS_CHANGE_SETTINGS_QUESTION'	=> 'Como podo mudar a miña configuración?',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_ANSWER'	=> 'Só os usuarios rexistrados poden enviar correo-e a outros usuarios a través do formulario integrado, e só se o administrador habilitou esa posibilidade. Isto faise para previr o uso malintencionado do sistema de correo-e por parte de usuarios anónimos.',
	'HELP_FAQ_USERSETTINGS_EMAIL_LOGIN_QUESTION'	=> 'Cando premo sobre a ligazón de correo-e dun usuario pídeme que inicie unha sesión de usuario?',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_ANSWER'	=> 'No teu Panel de Control de Usuario, embaixo de “Preferencias do taboleiro”, atoparás a opción <em>Ocultar o teu estado en liña</em>. Activa esta opción con <samp>Si</samp> e só aparecerás para os administradores, moderadores e ti mesmo. Contarás coma un usuario oculto.',
	'HELP_FAQ_USERSETTINGS_HIDE_ONLINE_QUESTION'	=> 'Como evito que apareza o meu nome de usuario nas listas de usuarios conectados?',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_ANSWER'	=> 'O máis habitual é que o administrador non instalara o paquete da túa lingua para o foro ou que ninguén creara unha tradución para a mesma. Proba a pedirlle ao administrador dos foros que instale o paquete de lingua que precisas ou, se non existe, síntete libre de facer unha tradución. Podes atopar máis información na web do phpBB Group (preme na ligazón que se atopa ao remate das páxinas).',
	'HELP_FAQ_USERSETTINGS_LANGUAGE_QUESTION'	=> 'O meu idioma non está na lista!',
	'HELP_FAQ_USERSETTINGS_RANK_ANSWER'	=> 'Os rangos, amosados embaixo do teu nome de usuario, indican a cantidade de mensaxes que publicaches ou identifican certos usuarios coma, p.e. moderadores e administradores. En xeral, non poderás modificar directamente rango ningún do taboleiro xa que son configurados polo administrador. Por favor, non abuses dos foros publicando mensaxes innecesarias só para aumentar o teu rango. A meirande parte dos taboleiros non tolerarán tal cousa e o moderador ou administrador sinxelamente reducirán o teu contador de mensaxes publicadas.',
	'HELP_FAQ_USERSETTINGS_RANK_QUESTION'	=> 'Que é o meu rango e como podo mudalo?',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_ANSWER'	=> 'Se estás certo de que seleccionaches correctamente a zona horaria e o horario de verán no seu caso, e a hora segue a aparecer de xeito incorrecto, logo é que a hora do reloxo do teu servidor está equivocada. Notifícallo aos administradores do mesmo para que poidan corrixilo.',
	'HELP_FAQ_USERSETTINGS_SERVERTIME_QUESTION'	=> 'Cambiei a zona horaria pero a hora segue a ser incorrecta!',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_ANSWER'	=> 'É posíbel que esteas vendo as horas correspondentes a outra zona horaria distinta da túa. Neste caso, vai ao teu Panel de Control de Usuario e muda a túa zona horaria de acordo á túa localización, p.e. Londres, Paris, Nova Iorque, Sidnei, Mondoñedo etc. Ten en conta que o troco de zona horaria, como moitas outras cousas, só pode ser levado a cabo por usuarios rexistrados. Por iso, se non te rexistraches aínda, xa é hora de facelo, dispensando o xogo de palabras.',
	'HELP_FAQ_USERSETTINGS_TIMEZONE_QUESTION'	=> 'A hora nos foros non é correcta!',
));