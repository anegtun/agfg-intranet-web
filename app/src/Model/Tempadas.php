<?php
namespace App\Model;

class Tempadas {
    
    public function getTempadas() {
        return array(
            '2021-22' => '2021/22',
            '2020-21' => '2020/21',
            '2019-20' => '2019/20',
            '2018-19' => '2018/19',
            '2017-18' => '2017/18',
            '2016-17' => '2016/17',
            '2015-16' => '2015/16',
            '2014-15' => '2014/15',
            '2013-14' => '2013/14',
            '2012-13' => '2012/13'
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