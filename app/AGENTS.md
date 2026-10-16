# Instrucións para axentes

## Proxecto

- Aplicación interna da Asociación Galega de Fútbol Gaélico, desenvolvida con CakePHP 4.5 e PHP >= 8.1. O espazo de nomes PSR-4 `App\` apunta a `src/`.
- Sigue o fluxo existente entre `config/routes.php`, `src/Controller/`, `src/Model/Table/`, as entidades e `templates/`. Non introduzas outra arquitectura para cambios locais.
- A estrutura HTML e os compoñentes da interface usan Bootstrap; segue os patróns e as clases Bootstrap xa presentes nos templates.
- Todos os textos visibles para as persoas usuarias deben estar sempre en galego; respecta tamén o idioma ao engadir etiquetas, mensaxes de validación e avisos.
- Nos controladores, declara no método `initialize()` as dependencias das clases de `App\Model` e as táboas obtidas con `TableRegistry`; gárdaas como propiedades e accede a elas mediante `$this->` nas accións. Non crees nin recuperes estas dependencias dentro das accións.
- Respecta `.editorconfig` e o estilo dos ficheiros próximos.

## Dominios funcionais

- Calendario e competición: eventos, tempadas, fases, partidos, resultados e clasificación. Comeza por [CalendarioController](src/Controller/CalendarioController.php), [CompeticionsController](src/Controller/CompeticionsController.php) e as táboas relacionadas en `src/Model/Table/`.
- Contabilidade: movementos bancarios, previsións, facturas, áreas e partidas. Comeza por [EconomicoController](src/Controller/EconomicoController.php) e polas clases `Economico*` de `src/Model/`.
- A tenda está en `Tenda*` e é un módulo en desuso; non a amplíes agás que a tarefa o pida expresamente.
- Antes de cambiar a persistencia, contrasta as asociacións e os nomes explícitos `agfg_*` das táboas CakePHP co [esquema SQL](../database/schema.sql). Os volcados SQL próximos poden ser históricos; `tests/schema.sql` non é un esquema completo.
- A base de datos é MySQL. Para cambios no esquema, non crees clases de migración: proporciona SQL compatible con MySQL para que a persoa usuaria o execute manualmente.

## Versión da aplicación

- En cada cambio solicitado que modifique a aplicación, revisa `config/agfg_info.php` e o historial Git antes de actualizar `agfg.version`.
- Para unha nova funcionalidade, incrementa a versión minor e pon a patch en `0`; para unha corrección de erro, incrementa só a patch.
- Non incrementes a versión se o valor actual de `agfg.version` aínda non está incluído nun commit. Excepción: se o único cambio local de versión é un incremento patch e se engade unha nova funcionalidade, incrementa a minor e reinicia a patch en `0`.
- Confirma no historial que o valor actual está committed antes de incrementalo; non deduzas que se pode actualizar só porque o número pareza antigo.

## Verificación e contorno

- A aplicación non ten probas automatizadas propias para a súa lóxica funcional. As probas existentes (`ApplicationTest.php` e `Controller/PagesControllerTest.php`) son as que trae o esqueleto de CakePHP e cobren a inicialización, o middleware e as páxinas de exemplo; non validan calendario, competicións nin contabilidade.
- Dende este directorio: `composer cs-check` executa PHPCS; `composer test` executa PHPUnit; `composer check` executa ambos.
- `tests/bootstrap.php` inicializa as migracións e pode reconstruír a base de datos de probas. Antes de executar PHPUnit, comproba que `DATABASE_TEST_URL` apunta a unha base de datos illada e prescindible, e revisa a configuración local; non uses nunca credenciais nin datos de produción.
- `phpstan.neon` configura PHPStan, pero PHPStan é unha dependencia opcional, non un script Composer garantido. Comproba que estea instalado antes de executalo.
- Non hai ningún paso de compilación configurado. Para o desenvolvemento local, o README do esqueleto documenta `bin/cake server -p 8765`; non deas por feito que describe a lóxica funcional de AGFG.