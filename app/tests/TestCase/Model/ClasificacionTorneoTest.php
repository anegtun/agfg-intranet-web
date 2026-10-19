<?php
namespace App\Test\TestCase\Model;

use App\Model\ClasificacionTorneo;
use App\Model\Clasificacion;
use App\Model\Entity\Equipa;
use App\Model\Entity\Partido;
use Cake\TestSuite\TestCase;

class ClasificacionTorneoTest extends TestCase {

    public function testFactoryUsesManualClassificationForTournaments(): void {
        $competicion = new class {
            public function isTorneoOuEliminatoria() {
                return true;
            }

            public function isLiga() {
                return false;
            }
        };

        $this->assertInstanceOf(
            ClasificacionTorneo::class,
            Clasificacion::create($competicion, [], [], [])
        );
    }

    public function testFactoryUsesLeagueClassificationForLeaguePhaseInTournament(): void {
        $competicion = new class {
            public function isTorneoOuEliminatoria() {
                return true;
            }

            public function isLiga() {
                return false;
            }
        };

        $clasificacion = Clasificacion::create(
            $competicion,
            [],
            [],
            [],
            (object)['formato'=>\App\Model\FormatosFase::LIGA]
        );

        $this->assertInstanceOf(\App\Model\ClasificacionLiga::class, $clasificacion);
    }

    public function testLeaguePhaseInTournamentCalculatesMatchStatistics(): void {
        $competicion = new class {
            public function isTorneoOuEliminatoria() {
                return true;
            }

            public function isLiga() {
                return false;
            }
        };
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1],
            (object)['id_fase'=>10, 'id_equipa'=>2]
        ];
        $partidos = [
            new Partido([
                'id_fase'=>10,
                'id_equipa1'=>1,
                'id_equipa2'=>2,
                'total_equipa1'=>2,
                'total_equipa2'=>1
            ])
        ];
        $clasificacion = Clasificacion::create(
            $competicion,
            $partidos,
            $equipasFase,
            $equipas,
            (object)['id'=>10, 'formato'=>\App\Model\FormatosFase::LIGA]
        );

        $clasificacion->build((object)['id'=>10]);

        $equipaGañadora = $clasificacion->getClasificacion()[0];
        $this->assertSame(1, $equipaGañadora->posicion);
        $this->assertSame(2, $equipaGañadora->puntos);
        $this->assertSame(2, $equipaGañadora->totalFavor);
        $this->assertSame(1, $equipaGañadora->totalContra);
        $this->assertSame(1, $equipaGañadora->partidosGanados);
    }

    public function testBuildUsesManualPositionsAndLeavesUnrankedTeamsLast(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia']),
            3 => new Equipa(['id'=>3, 'codigo'=>'ART', 'nome'=>'Artabros'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1, 'posicion'=>2, 'fase'=>(object)['id'=>10, 'final'=>true]],
            (object)['id_fase'=>10, 'id_equipa'=>2, 'posicion'=>1, 'fase'=>(object)['id'=>10, 'final'=>true]],
            (object)['id_fase'=>10, 'id_equipa'=>3, 'posicion'=>NULL, 'fase'=>(object)['id'=>10, 'final'=>true]]
        ];
        $clasificacion = new ClasificacionTorneo($equipasFase, $equipas);

        $clasificacion->build();

        $resultados = $clasificacion->getClasificacion();
        $this->assertSame([2, 1, 3], array_map(function ($equipa) {
            return $equipa->id;
        }, $resultados));
        $this->assertSame(1, $clasificacion->getClasificacionEquipa(2)->posicion);
        $this->assertNull($clasificacion->getClasificacionEquipa(3)->posicion);
    }

    public function testBuildCanLimitResultsToOnePhase(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1, 'posicion'=>1],
            (object)['id_fase'=>11, 'id_equipa'=>2, 'posicion'=>1]
        ];
        $clasificacion = new ClasificacionTorneo($equipasFase, $equipas);

        $clasificacion->build((object)['id'=>11]);

        $this->assertCount(1, $clasificacion->getClasificacion());
        $this->assertSame(2, $clasificacion->getClasificacion()[0]->id);
    }

    public function testCompetitionClassificationCanBeLimitedToFinalPhases(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia'])
        ];
        $equipasFase = [
            (object)[
                'id_fase'=>10,
                'id_equipa'=>1,
                'posicion'=>1,
                'fase'=>(object)['id'=>10, 'final'=>false]
            ],
            (object)[
                'id_fase'=>11,
                'id_equipa'=>2,
                'posicion'=>1,
                'fase'=>(object)['id'=>11, 'final'=>true]
            ]
        ];
        $clasificacion = new ClasificacionTorneo($equipasFase, $equipas);

        $clasificacion->build();

        $this->assertCount(1, $clasificacion->getClasificacion());
        $this->assertSame(2, $clasificacion->getClasificacion()[0]->id);
    }

    public function testGlobalClassificationOrdersFinalPhasesByPriority(): void {
        $equipas = [];
        for ($idEquipa = 1; $idEquipa <= 7; $idEquipa++) {
            $equipas[$idEquipa] = new Equipa([
                'id'=>$idEquipa,
                'codigo'=>'EQ'.$idEquipa,
                'nome'=>'Equipa '.$idEquipa
            ]);
        }
        $equipasFase = [
            (object)[
                'id_fase'=>12,
                'id_equipa'=>6,
                'posicion'=>1,
                'fase'=>(object)['id'=>12, 'final'=>true, 'prioridade'=>1]
            ],
            (object)[
                'id_fase'=>10,
                'id_equipa'=>3,
                'posicion'=>3,
                'fase'=>(object)['id'=>10, 'final'=>true, 'prioridade'=>3]
            ],
            (object)[
                'id_fase'=>11,
                'id_equipa'=>5,
                'posicion'=>2,
                'fase'=>(object)['id'=>11, 'final'=>true, 'prioridade'=>2]
            ],
            (object)[
                'id_fase'=>10,
                'id_equipa'=>1,
                'posicion'=>1,
                'fase'=>(object)['id'=>10, 'final'=>true, 'prioridade'=>3]
            ],
            (object)[
                'id_fase'=>12,
                'id_equipa'=>7,
                'posicion'=>2,
                'fase'=>(object)['id'=>12, 'final'=>true, 'prioridade'=>1]
            ],
            (object)[
                'id_fase'=>10,
                'id_equipa'=>2,
                'posicion'=>2,
                'fase'=>(object)['id'=>10, 'final'=>true, 'prioridade'=>3]
            ],
            (object)[
                'id_fase'=>11,
                'id_equipa'=>4,
                'posicion'=>1,
                'fase'=>(object)['id'=>11, 'final'=>true, 'prioridade'=>2]
            ]
        ];
        $clasificacion = new ClasificacionTorneo($equipasFase, $equipas);

        $clasificacion->build();

        $resultados = $clasificacion->getClasificacion();
        $this->assertSame([1, 2, 3, 4, 5, 6, 7], array_map(function ($equipa) {
            return $equipa->id;
        }, $resultados));
        $this->assertSame([1, 2, 3, 4, 5, 6, 7], array_map(function ($equipa) {
            return $equipa->posicion;
        }, $resultados));
    }

    public function testPhaseClassificationIncludesNonFinalPhases(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia'])
        ];
        $equipasFase = [
            (object)[
                'id_fase'=>10,
                'id_equipa'=>1,
                'posicion'=>1,
                'fase'=>(object)['id'=>10, 'final'=>false]
            ]
        ];
        $clasificacion = new ClasificacionTorneo($equipasFase, $equipas);

        $clasificacion->build((object)['id'=>10]);

        $this->assertCount(1, $clasificacion->getClasificacion());
        $this->assertSame(1, $clasificacion->getClasificacion()[0]->id);
    }
}
