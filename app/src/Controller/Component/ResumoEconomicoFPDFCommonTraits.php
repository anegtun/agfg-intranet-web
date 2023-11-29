<?php
namespace App\Controller\Component;

use Cake\Core\Configure;

trait ResumoEconomicoFPDFCommonTraits {

    public function H1($str) {
        $this->SetFont('Arial', 'B', 20);
        $this->SetBlueColor();
        $this->MultiCell(0, 10, utf8_decode($str), 0, 'C');
        $this->SetDefaultFont();
        $this->Ln(5);
    }

    public function H2($str) {
        $this->SetFont('Arial', 'B', 18);
        $this->MultiCell(0, 15, utf8_decode($str), 0, 'L');
        $this->SetDefaultFont();
        $this->Ln(5);
    }

    public function H3($str) {
        $this->SetFont('Arial', 'B', 14);
        $this->SetBlueColor();
        $this->Cell(0, 15, utf8_decode($str));
        $this->SetDefaultFont();
        $this->Ln(20);
    }

    public function Paragraph($text) {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 5, utf8_decode($text));
        $this->Ln(5);
    }

    public function SetDefaultFont() {
        $this->SetFont('Arial', '', 12);
        $this->SetDefaultColor();
    }

    public function SetDefaultColor() {
        $this->SetTextColor(0, 0, 0);
    }

    public function SetBlueColor() {
        $this->SetTextColor(29, 113, 184);
    }

    public function Table($rows, $config) {
        foreach($rows as $row) {
            if(!empty($config['marginLeft'])) {
                $this->SetX($config['marginLeft']);
            }
            $hasBgColor = !empty($row['bg']);
            if($hasBgColor) {
                $this->SetFillColor($row['bg'][0], $row['bg'][1], $row['bg'][2]);
            }
            $hasTextColor = !empty($row['color']);
            if($hasTextColor) {
                $this->SetTextColor($row['color'][0], $row['color'][1], $row['color'][2]);
            }
            if(!empty($config['font'])) {
                $this->SetFont($config['font'][0], $config['font'][1], $config['font'][2]);
            }
            if(!empty($row['font'])) {
                $this->SetFont($row['font'][0], $row['font'][1], $row['font'][2]);
            }
            foreach($config['width'] as $i => $w) {
                $align = 'C';
                if(!empty($config['align'][$i])) {
                    $align = $config['align'][$i];
                }
                if(!empty($row['align'][$i])) {
                    $align = $row['align'][$i];
                }
                if(is_array($row['values'][$i])) {
                    if($row['values'][$i]['type'] === 'img') {
                        $x = $this->GetX();
                        $y = $this->GetY();
                        $this->Image($row['values'][$i]['path'], $x+($w/2)-($row['values'][$i]['width']/2), $y+1, $row['values'][$i]['width']);
                        $this->Cell($w, $config['height'], '', 1);
                    }
                } else {
                    $this->Cell($w, $config['height'], utf8_decode($row['values'][$i]), 1, 0, $align, $hasBgColor);
                }
            }
            if($hasBgColor) {
                $this->SetFillColor(255, 255, 255);
            }
            if($hasTextColor) {
                $this->SetTextColor(0, 0, 0);
            }
            $this->Ln();
        }
    }

    function Photos($photos) {
        if(!empty($photos)) {
            $this->Ln(5);
            $y = $this->GetY();
            $rowMaxH = 0;
            foreach($photos as $i => $photo) {
                $path = WWW_ROOT . DS . $photo;
                $sizes = $this->CalculateImageSize($path);
                $newX = $this->GetX() + $sizes->trgW + 10;
                if($newX > 210) {
                    $this->Ln($rowMaxH + 10);
                    $rowMaxH = 0;
                    $newX = $this->GetX() + $sizes->trgW + 10;
                }
                $newY = $this->GetY() + $sizes->trgH + 10;
                if($newY > 290) {
                    $this->AddPage();
                }
                $this->Image(WWW_ROOT . DS . $photo, $this->GetX(), $this->GetY(), $sizes->trgW, $sizes->trgH);
                $this->SetX($newX);
                $rowMaxH = max($rowMaxH, $sizes->trgH);
            }
            $this->Ln($rowMaxH + 10);
        }
    }

}