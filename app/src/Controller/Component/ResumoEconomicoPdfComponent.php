<?php
namespace App\Controller\Component;

use NumberFormatter;
use Cake\Controller\Component;
use Cake\Core\Configure;
use App\Controller\Component\ResumoEconomicoFPDF;

class ResumoEconomicoPdfComponent extends Component {

    public function generate($resumo, $tempadas, $request) {
        $pdf = new ResumoEconomicoFPDF();
        $pdf->resumo = $resumo;
        $pdf->tempadas = $tempadas;
        $pdf->request = $request;
        $pdf->fmt = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);

        $pdf->AliasNbPages();
        $pdf->SetTitle(utf8_decode('Resumo económico'));
        $pdf->AddPage();
        
        $pdf->Intro();
        
        $pdf->Resumo();

        return $pdf->Output('S');
    }

}
