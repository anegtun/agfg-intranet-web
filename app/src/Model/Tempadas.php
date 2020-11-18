<?php
namespace App\Model;

class Tempadas {
    
    public function getTempadas() {
        return array(
            '2012-13' => '2012/13',
            '2013-14' => '2013/14',
            '2014-15' => '2014/15',
            '2015-16' => '2015/16',
            '2016-17' => '2016/17',
            '2017-18' => '2017/18',
            '2018-19' => '2018/19',
            '2019-20' => '2019/20',
            '2020-21' => '2020/21'
        );
    }
    
    public function getTempadasWithEmpty() {
        return array_merge([''=>''], $this->getTempadas());
    }

    public function getTempada($key) {
        $list = $this->getTempadas();
        return $list[$key];
    }

}