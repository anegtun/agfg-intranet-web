<?php
namespace App\Test\TestCase\Model;

use App\Model\ClasificacionTorneo;
use App\Model\Clasificacion;
use App\Model\Entity\Equipa;
use Cake\TestSuite\TestCase;

class ClasificacionTorneoTest extends TestCase {

    public function testFactoryUsesManualClassificationForTournaments(): void {
        $competicion = new class {
            public function isTorneo() {
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

    public function testBuildUsesManualPositionsAndLeavesUnrankedTeamsLast(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia']),
            3 => new Equipa(['id'=>3, 'codigo'=>'ART', 'nome'=>'Artabros'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1, 'posicion'=>2],
            (object)['id_fase'=>10, 'id_equipa'=>2, 'posicion'=>1],
            (object)['id_fase'=>10, 'id_equipa'=>3, 'posicion'=>NULL]
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
}
