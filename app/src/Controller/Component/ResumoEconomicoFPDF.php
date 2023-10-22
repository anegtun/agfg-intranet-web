<?php
namespace App\Controller\Component;

require_once(ROOT . DS . 'vendor' . DS  . 'fpdf' . DS . 'fpdf.php');

define('EURO',chr(128));

use Cake\Core\Configure;
use FPDF;

class ResumoEconomicoFPDF extends FPDF {

    public $resumo;

    public $tempadas;

    public $request;

    public $fmt;

    use ResumoEconomicoFPDFCommonTraits;

    function Intro() {
        $this->Ln(10);
        
        if(!empty($this->request->getQuery('data_ini'))) {
            $this->H3("Data inicio: {$this->request->getQuery('data_ini')}");
        }
        if(!empty($this->request->getQuery('data_fin'))) {
            $this->H3("Data fin: {$this->request->getQuery('data_fin')}");
        }
        if(!empty($this->request->getQuery('tempada'))) {
            $this->H3("Tempada: {$this->tempadas[$this->request->getQuery('tempada')]}");
        }
    }

    function Resumo() {

        foreach($this->resumo->getAreas() as $area) {
            $total_area = $this->resumo->getTotalArea($area);
            
            $this->H2("{$area->partidaOrzamentaria->nome} - {$area->nome}");

            foreach($this->resumo->getSubareas($area) as $subarea) {
                $total_subarea = $this->resumo->getTotalSubarea($subarea);

                foreach($this->resumo->getConceptos($subarea) as $concepto) {
                    $total_concepto = $this->resumo->getTotalConcepto($subarea, $concepto);

                    $this->Cell(100, 7, $this->printTexto(empty($concepto) ? $subarea->nome : "$subarea->nome: $concepto", 40));
                    $this->Cell(25, 7, $this->printNumero($total_concepto->ingresos), 0, 0, 'R');
                    $this->Cell(25, 7, $this->printNumero($total_concepto->gastos), 0, 0, 'R');
                    $this->SetFont('Arial', 'B', 12);
                    $this->Cell(25, 7, $this->printNumero($total_concepto->balance), 0, 0, 'R');
                    $this->SetDefaultFont();
                    $this->Ln();
                    // $this->MultiCell(0, 5, utf8_decode($value->value));
                }
            }
        }
        $this->Ln(20);
    }

    function printTexto($str, $max) {
        $actual_str = strlen($str) > $max ? substr($str, 0, $max)."..." : $str;
        return utf8_decode(strip_tags($actual_str));
    }

    function printNumero($num) {
        $actual_num = empty($num) ? 0 : $num;
        return number_format($actual_num, 2, ',', '.') . " " . chr(128);
    }
}