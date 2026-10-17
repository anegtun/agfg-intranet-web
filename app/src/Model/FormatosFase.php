<?php
namespace App\Model;

class FormatosFase {

    public const LIGA = 'liga';
    public const ELIMINATORIA = 'eliminatoria';

    public function getFormatos() {
        return [
            self::LIGA => 'Liga',
            self::ELIMINATORIA => 'Eliminatoria'
        ];
    }

    public function getFormatosWithEmpty() {
        return array_merge(['' => ''], $this->getFormatos());
    }
}
