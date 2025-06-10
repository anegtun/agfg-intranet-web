<?php
namespace App\Model;

class Tempadas {
    
    public function getTempadas() {
        return [
            '2025-26' => '2025/26',
            '2024-25' => '2024/25',
            '2023-24' => '2023/24',
            '2022-23' => '2022/23',
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
        ];
    }
    
    public function getTempadasWithEmpty() {
        return array_merge([''=>''], $this->getTempadas());
    }

    public function getTempada($key) {
        $list = $this->getTempadas();
        return $list[$key];
    }

}