<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

class EconomicoFacturaComponent extends Component {

    public function getPath($factura, $arquivo) {
        return $this->getFacturaDir($factura) . DS . $arquivo;
    }

    public function delete($factura, $arquivo) {
        $file = new File($this->getPath($factura, $arquivo));
        $file->delete();
    }

    public function list($factura) {
        $result = [];
        $dir = new Folder($this->getFacturaDir($factura));
        $files = $dir->read()[1];
        foreach($files as $f) {
            $result[] = $f;
        }
        return $result;
    }

    public function upload($factura, $file) {
        if (!empty($factura->id) && !empty($file['name'])) {
            $dir_path = $this->getFacturaDir($factura);
            $dir = new Folder($dir_path, true, 0755);
            move_uploaded_file($file['tmp_name'], $dir_path . DS . $file['name']);
        }
    }

    private function getFacturaDir($factura) {
        return $dir_path = ROOT . "/uploads/facturas/{$factura->id}";
    }

}
