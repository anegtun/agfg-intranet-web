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

$lang = array_merge($lang, array(
	'CAPTCHA_QA'				=> 'Q&amp;A',
	'CONFIRM_QUESTION_EXPLAIN'	=> 'Esta pregunta é un xeito de previr que os spam-bots envíen formularios de forma automática.',
	'CONFIRM_QUESTION_WRONG'	=> 'A resposta non é correcta.',
	'CONFIRM_QUESTION_MISSING'	=> 'Non se puideron obter preguntas para o captcha. Por favor contacta cun administrador.',

	'QUESTION_ANSWERS'			=> 'Respostas',
	'ANSWERS_EXPLAIN'			=> 'Por favor, introduce as respostas válidas, unha por liña.',
	'CONFIRM_QUESTION'			=> 'Pregunta',

	'ANSWER'					=> 'Resposta',
	'EDIT_QUESTION'				=> 'Editar pregunra',
	'QUESTIONS'					=> 'Preguntas',
	'QUESTIONS_EXPLAIN'			=> 'Para cada envío de formulario no que habilitaches o plugin "Q&amp;A", aos usuarios se lles fará unha das preguntas que indiques aquí. Para usar este plugin, debes especificar polo menos unha pregunta no idioma por defecto. Estas preguntas deberan ser fáciles de respostar para o teu público, pero imposibles de adiviñar para un bot. Só unha pregunta é obrigatoria. Se comezas a recibir un spam de novos rexistros, deberías cambiar a pregunta. Habilita a opción estricta se na túa pregunta son importantes as maiúsculas/minúsculas, os signos de puntuación ou os espazos en branco.',
	'QUESTION_DELETED'			=> 'Pregunta eliminada',
	'QUESTION_LANG'				=> 'Idioma',
	'QUESTION_LANG_EXPLAIN'		=> 'O idioma no que están escritas a pregunta e as respostas.',
	'QUESTION_STRICT'			=> 'Comprobación estricta',
	'QUESTION_STRICT_EXPLAIN'	=> 'Habilita esta opción para comprobar o uso de maiúsculas/minúsculas, signos de puntuación ou espazos en brancoespace.',

	'QUESTION_TEXT'				=> 'Pregunta',
	'QUESTION_TEXT_EXPLAIN'		=> 'A pregunta a amosar ao usuario.',

	'QA_ERROR_MSG'				=> 'Por favor, enche todos os campos e introduce polo menos unha resposta.',
	'QA_LAST_QUESTION'			=> 'Non podes eliminar todas as preguntas mentres o plugin estea activo.',
));
