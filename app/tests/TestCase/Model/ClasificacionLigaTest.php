<?php
namespace App\Test\TestCase\Model;

use App\Model\ClasificacionLiga;
use App\Model\Entity\Equipa;
use App\Model\Entity\Partido;
use Cake\TestSuite\TestCase;

class ClasificacionLigaTest extends TestCase {

    public function testCompetitionClassificationUsesOnlyFinalPhases(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1, 'fase'=>(object)['id'=>10, 'final'=>false]],
            (object)['id_fase'=>10, 'id_equipa'=>2, 'fase'=>(object)['id'=>10, 'final'=>false]],
            (object)['id_fase'=>11, 'id_equipa'=>1, 'fase'=>(object)['id'=>11, 'final'=>true]],
            (object)['id_fase'=>11, 'id_equipa'=>2, 'fase'=>(object)['id'=>11, 'final'=>true]]
        ];
        $partidos = [
            new Partido([
                'id_fase'=>10,
                'id_equipa1'=>1,
                'id_equipa2'=>2,
                'total_equipa1'=>2,
                'total_equipa2'=>1,
                'fase'=>(object)['final'=>false]
            ]),
            new Partido([
                'id_fase'=>11,
                'id_equipa1'=>2,
                'id_equipa2'=>1,
                'total_equipa1'=>2,
                'total_equipa2'=>1,
                'fase'=>(object)['final'=>true]
            ])
        ];
        $clasificacion = new ClasificacionLiga($partidos, $equipasFase, $equipas);

        $clasificacion->build();

        $resultados = $clasificacion->getClasificacion();
        $this->assertSame(2, $resultados[0]->id);
        $this->assertSame(2, $resultados[0]->puntos);
    }

    public function testPhaseClassificationIncludesNonFinalPhaseResults(): void {
        $equipas = [
            1 => new Equipa(['id'=>1, 'codigo'=>'TUR', 'nome'=>'Turonia']),
            2 => new Equipa(['id'=>2, 'codigo'=>'BRG', 'nome'=>'Brigantia'])
        ];
        $equipasFase = [
            (object)['id_fase'=>10, 'id_equipa'=>1, 'fase'=>(object)['id'=>10, 'final'=>false]],
            (object)['id_fase'=>10, 'id_equipa'=>2, 'fase'=>(object)['id'=>10, 'final'=>false]]
        ];
        $partidos = [
            new Partido([
                'id_fase'=>10,
                'id_equipa1'=>1,
                'id_equipa2'=>2,
                'total_equipa1'=>2,
                'total_equipa2'=>1,
                'fase'=>(object)['final'=>false]
            ])
        ];
        $clasificacion = new ClasificacionLiga($partidos, $equipasFase, $equipas);

        $clasificacion->build((object)['id'=>10]);

        $this->assertSame(1, $clasificacion->getClasificacion()[0]->id);
        $this->assertSame(2, $clasificacion->getClasificacion()[0]->puntos);
    }
}
