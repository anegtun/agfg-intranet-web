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
        if (!empty($factura->id) && !empty($file)) {
            $dir_path = $this->getFacturaDir($factura);
            $dir = new Folder($dir_path, true, 0755);
            $target_name = str_replace(" ", "_", $file->getClientFilename());
            $file->moveTo($dir_path . DS . $target_name);
        }
    }

    public function deleteAll($factura) {
        $dir = new Folder($this->getFacturaDir($factura));
        $dir->delete();
    }

    private function getFacturaDir($factura) {
        return $dir_path = ROOT . "/uploads/facturas/{$factura->id}";
    }

}
