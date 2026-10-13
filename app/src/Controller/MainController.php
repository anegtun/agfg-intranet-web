<?php
namespace App\Controller;

use App\Model\Contas;
use Cake\Event\EventInterface;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

class MainController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->Contas = new Contas();
        $this->Movementos = TableRegistry::get('EconomicoMovementos');
        $this->Partidos = TableRegistry::get('Partidos');
        $this->Tempadas = TableRegistry::get('Tempadas');
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index']);
    }

    public function index() {
        $user = $this->Authentication->getResult();
        if (!$user->isValid()) {
            return $this->redirect(['controller'=>'users', 'action'=>'login']);
        }

        $identity = $this->request->getAttribute('identity');
        if (in_array($identity['rol'], ['admin', 'tesour'], true)) {
            $contas = $this->Contas->getAll();
            $saldosPorConta = $this->Movementos->saldosActualesPorConta();
            $saldos = [];

            foreach ($contas as $codigo => $nome) {
                if (!isset($saldosPorConta[$codigo]) || empty($saldosPorConta[$codigo]['saldo'])) {
                    continue;
                }

                $saldos[] = [
                    'nome' => $nome,
                    'saldo' => $saldosPorConta[$codigo]['saldo'],
                    'data' => $saldosPorConta[$codigo]['data'],
                ];
            }

            $this->set(compact('saldos'));
        }

        if (in_array($identity['rol'], ['admin', 'comp', 'euro22'], true)) {
            $hoxe = FrozenDate::today();
            $tempadaActual = $this->Tempadas->findLast()->codigo;
            $partidosProximos = $this->Partidos
                ->findDashboardMatchesBetween($hoxe, $hoxe->modify('+6 days'), $tempadaActual)
                ->toArray();
            $partidosAplazadosSenData = $this->Partidos
                ->findPostponedWithoutDate($tempadaActual)
                ->toArray();

            $partidosUltimosSeteDias = $this->Partidos
                ->findDashboardRecentMatches($hoxe->modify('-6 days'), $hoxe, $tempadaActual)
                ->toArray();

            $this->set(compact('partidosProximos', 'partidosUltimosSeteDias', 'partidosAplazadosSenData'));
        }
    }
}