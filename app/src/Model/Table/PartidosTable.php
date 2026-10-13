<?php
namespace App\Model\Table;

use Cake\I18n\FrozenDate;
use Cake\Validation\Validator;

class PartidosTable extends AgfgTable {

    public function initialize(array $config): void {
        $this->setTable('agfg_partidos');
        $this->belongsTo('Fase', [
        	'className' => 'Fases',
            'foreignKey' => 'id_fase',
            'propertyName' => 'fase'
        ]);
        $this->belongsTo('Xornada', [
        	'className' => 'Xornadas',
            'foreignKey' => 'id_xornada',
            'propertyName' => 'xornada'
        ]);
        $this->belongsTo('Equipa1', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa1',
            'propertyName' => 'equipa1'
        ]);
        $this->belongsTo('Equipa2', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_equipa2',
            'propertyName' => 'equipa2'
        ]);
        $this->belongsTo('Campo', [
        	'className' => 'Campos',
            'foreignKey' => 'id_campo',
            'propertyName' => 'campo'
        ]);
        $this->belongsTo('Arbitro', [
        	'className' => 'Arbitros',
            'foreignKey' => 'id_arbitro',
            'propertyName' => 'arbitro'
        ]);
        $this->belongsTo('Umpire', [
        	'className' => 'Equipas',
            'foreignKey' => 'id_umpire',
            'propertyName' => 'umpire'
        ]);
    }

    public function validationDefault(Validator $validator): Validator {
        return $validator
            ->notEmptyString('id_fase', 'A fase da competición é obrigatoria')
            ->notEmptyString('id_equipa1', 'O equipo local é obrigatorio')
            ->notEmptyString('id_equipa2', 'O equipo visitante é obrigatorio');
    }

    public function getDetalle($id) {
        return $this->get($id, [ 'contain' => [
            'Xornada',
            'Fase' => 'Competicion',
            'Equipa1' => 'Clube',
            'Equipa2' => 'Clube'
        ]]);
    }

    public function findByDatas($inicio, $fin) {
        $inicioYMD = $inicio->i18nFormat('yyyy-MM-dd');
        $finYMD = $fin->i18nFormat('yyyy-MM-dd');
        return $this->find()
            ->contain(['Fase'=>'Competicion', 'Xornada', 'Equipa1'=>'Clube', 'Equipa2'=>'Clube', 'Campo', 'Arbitro', 'Umpire'=>'Clube'])
            ->where(['OR' => [
                ['Xornada.data >='=>$inicioYMD, 'Xornada.data <='=>$finYMD],
                ['Partidos.data_partido >='=>$inicioYMD, 'Partidos.data_partido <='=>$finYMD]
            ]])
            ->order(['-Partidos.data_partido DESC', 'Partidos.hora_partido']);
    }

    public function findDashboardMatchesBetween($inicio, $fin, $tempada) {
        $inicioYMD = $inicio->format('Y-m-d');
        $finYMD = $fin->format('Y-m-d');

        return $this->findDashboardMatches()
            ->where([
                'Competicion.tempada' => $tempada,
                'Partidos.cancelado' => 0,
                'OR' => [
                    [
                        'Partidos.data_partido >=' => $inicioYMD,
                        'Partidos.data_partido <=' => $finYMD,
                    ],
                    [
                        'Partidos.data_partido IS' => null,
                        'Xornada.data >=' => $inicioYMD,
                        'Xornada.data <=' => $finYMD,
                    ],
                ],
            ])
            ->order(['data_calendario' => 'ASC', 'Partidos.hora_partido' => 'ASC']);
    }

    public function findDashboardRecentMatches($inicio, $fin, $tempada) {
        $inicioYMD = $inicio->format('Y-m-d');
        $finYMD = $fin->format('Y-m-d');

        return $this->findDashboardMatches()
            ->where([
                'Competicion.tempada' => $tempada,
                'Partidos.cancelado' => 0,
                'OR' => [
                    [
                        'Partidos.data_partido IS NOT' => null,
                        'Partidos.data_partido >=' => $inicioYMD,
                        'Partidos.data_partido <=' => $finYMD,
                    ],
                    [
                        'Partidos.data_partido IS' => null,
                        'Partidos.adiado' => 0,
                        'Xornada.data >=' => $inicioYMD,
                        'Xornada.data <=' => $finYMD,
                    ],
                ],
            ])
            ->order(['data_calendario' => 'ASC', 'Partidos.hora_partido' => 'ASC']);
    }

    public function findPostponedWithoutDate($tempada) {
        return $this->findDashboardMatches()
            ->where([
                'Competicion.tempada' => $tempada,
                'Partidos.adiado' => 1,
                'Partidos.cancelado' => 0,
                'Partidos.data_partido IS' => null,
            ])
            ->order(['data_calendario' => 'ASC', 'Partidos.hora_partido' => 'ASC']);
    }

    private function findDashboardMatches() {
        return $this->find()
            ->contain(['Fase' => 'Competicion', 'Xornada', 'Equipa1' => 'Clube', 'Equipa2' => 'Clube', 'Campo', 'Arbitro', 'Umpire' => 'Clube'])
            ->select(['data_calendario' => 'COALESCE(Partidos.data_partido, Xornada.data)'])
            ->enableAutoFields(true)
            ->formatResults(function ($results) {
                return $results->map(function ($row) {
                    if (!empty($row['data_calendario'])) {
                        $row['data_calendario'] = FrozenDate::createFromFormat('Y-m-d', $row['data_calendario']);
                    }
                    return $row;
                });
            });
    }

}