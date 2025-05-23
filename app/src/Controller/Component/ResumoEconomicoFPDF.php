<?php
namespace App\Controller\Component;

require_once(ROOT . DS . 'vendor' . DS  . 'fpdf' . DS . 'fpdf' . DS . 'src' . DS . 'Fpdf' . DS . 'Fpdf.php');

define('EURO',chr(128));

use Cake\Core\Configure;
use Fpdf\Fpdf;

class ResumoEconomicoFPDF extends Fpdf {

    public $resumo;

    public $tempadas;

    public $request;

    public $fmt;

    use ResumoEconomicoFPDFCommonTraits;

    function Header() {
        $this->SetTextColor(0, 0, 0);
        $this->Image(WWW_ROOT . DS . 'agfg' . DS . 'img' . DS . 'favicon' . DS . 'agfg-icon.png', 10, 8, 15);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, utf8_decode('Informe económico'), 0, 0, 'R');
        $this->Ln(5);
        $this->SetFont('Arial', '', 10);

        if(!empty($this->request->getQuery('data_ini'))) {
            $this->Cell(0, 5, "Data inicio: {$this->request->getQuery('data_ini')}", 0, 0, 'R');
            $this->Ln(5);
        }
        if(!empty($this->request->getQuery('data_fin'))) {
            $this->Cell(0, 5, "Data fin: {$this->request->getQuery('data_fin')}", 0, 0, 'R');
            $this->Ln(5);
        }
        if(!empty($this->request->getQuery('tempada'))) {
            $this->Cell(0, 5, "Tempada: {$this->tempadas[$this->request->getQuery('tempada')]}", 0, 0, 'R');
            $this->Ln(5);
        }

        $this->Ln(10);
    }

    function Resumo() {
        $count = 0;
        $partidasOrzamentarias = $this->resumo->getPartidasOrzanentarias();
        foreach($partidasOrzamentarias as $partidaOrzamentaria) {
            $total_po = $this->resumo->getTotalPartidaOrzamentaria($partidaOrzamentaria);

            $this->H1($partidaOrzamentaria->nome);
            $this->SetFont('Arial', 'B', 14);
            $this->SetBlueColor();
            $this->Cell(63, 7, "Ingresos", 0, 0, 'C');
            $this->Cell(63, 7, "Gastos", 0, 0, 'C');
            $this->Cell(63, 7, "Balance", 0, 0, 'C');
            $this->Ln(10);
            $this->SetFont('Arial', '', 14);
            $this->SetDefaultColor();
            $this->Cell(63, 7, $this->printNumero($total_po->ingresos), 0, 0, 'C');
            $this->Cell(63, 7, $this->printNumero($total_po->gastos + $total_po->comision), 0, 0, 'C');
            $this->Cell(63, 7, $this->printNumero($total_po->balance), 0, 0, 'C');

            if(!empty($total_po->ingresos_previstos) || !empty($total_po->gastos_previstos)) {
                $this->Ln(15);
                $this->SetFont('Arial', 'B', 12);
                $this->SetBlueColor();
                $this->Cell(63, 7, "Prev. Ingresos", 0, 0, 'C');
                $this->Cell(63, 7, "Prev. Gastos", 0, 0, 'C');
                $this->Cell(63, 7, "Prev. Total", 0, 0, 'C');
                $this->Ln(10);
                $this->SetFont('Arial', '', 12);
                $this->SetDefaultColor();
                $this->Cell(63, 7, $this->printNumero($total_po->ingresos_previstos), 0, 0, 'C');
                $this->Cell(63, 7, $this->printNumero($total_po->gastos_previstos), 0, 0, 'C');
                $this->Cell(63, 7, $this->printNumero($total_po->balance_previsto), 0, 0, 'C');
            }

            $this->Ln(20);

            foreach($this->resumo->getAreas($partidaOrzamentaria) as $area) {
                $total_area = $this->resumo->getTotalArea($area);
                
                $this->H2($area->nome);

                $con_prevision = [];
                foreach($this->resumo->getSubareas($area) as $subarea) {
                    $total_subarea = $this->resumo->getTotalSubarea($subarea);

                    foreach($this->resumo->getConceptos($subarea) as $concepto) {
                        $total_concepto = $this->resumo->getTotalConcepto($subarea, $concepto);
                        if(!empty($total_concepto->ingresos_previstos) || !empty($total_concepto->gastos_previstos)) {
                            $con_prevision[] = $concepto;
                        }

                        if(!empty($total_concepto->ingresos) || !empty($total_concepto->gastos)) {
                            $this->Cell(100, 7, $this->printTexto(empty($concepto) ? $subarea->nome : "$subarea->nome: $concepto", 40));
                            $this->Cell(25, 7, $this->printNumero($total_concepto->ingresos), 0, 0, 'R');
                            $this->Cell(25, 7, $this->printNumero($total_concepto->gastos + $total_concepto->comision), 0, 0, 'R');
                            $this->SetFont('Arial', 'B', 12);
                            $this->Cell(25, 7, $this->printNumero($total_concepto->balance), 0, 0, 'R');
                            $this->SetDefaultFont();
                            $this->Ln();
                        }
                    }
                }

                if (!empty($con_prevision)) {

                    $this->Ln();
                    $this->SetFont('Arial', 'I', 12);
                    $this->SetGreyColor();
                    $this->Cell(100, 7, $this->printTexto("Prevision", 40));
                    $this->Ln();
                
                    foreach($this->resumo->getSubareas($area) as $subarea) {
                        foreach($con_prevision as $concepto) {
                            $total_concepto = $this->resumo->getTotalConcepto($subarea, $concepto);

                            if(!empty($total_concepto->ingresos_previstos) || !empty($total_concepto->gastos_previstos)) {
                                $this->Cell(100, 7, $this->printTexto(empty($concepto) ? $subarea->nome : "$subarea->nome: $concepto", 40));
                                $this->Cell(25, 7, $this->printNumero($total_concepto->ingresos_previstos), 0, 0, 'R');
                                $this->Cell(25, 7, $this->printNumero($total_concepto->gastos_previstos), 0, 0, 'R');
                                $this->SetFont('Arial', 'B', 12);
                                $this->Cell(25, 7, $this->printNumero($total_concepto->balance_previsto), 0, 0, 'R');
                                $this->SetDefaultFont();
                                $this->SetGreyColor();
                                $this->Ln();
                            }
                        }
                    }
                    $this->SetDefaultColor();
                    $this->SetDefaultFont();
                }
                $this->Ln(10);
            }

            if (++$count < count($partidasOrzamentarias)) {
                $this->AddPage();
            }
        }
    }

    function Footer() {
        $this->SetDefaultColor();
        $this->SetY(-20);
        $this->SetFont('Arial', '', 10);
        $this->Ln();
        $this->Cell(95, 5, utf8_decode('Asociación Galega de Fútbol Gaélico'));
        $this->Cell(98, 5, utf8_decode('Páxina ').$this->PageNo().' de {nb}', 0, 0, 'R');
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