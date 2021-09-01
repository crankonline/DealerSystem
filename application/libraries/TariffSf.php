<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TariffSf
{
    protected $tariffSf = array(
        array(
            'value' => 1,
            'name' => 'ОСН'
        ),
        array(
            'value' => 2,
            'name' => 'БЮД'
        ),
        array(
            'value' => 3,
            'name' => 'КОСГ'
        ),
        array(
            'value' => 4,
            'name' => 'ОБЩ'
        ),
        array(
            'value' => 5,
            'name' => 'ФЛСВ'
        ),
        array(
            'value' => 6,
            'name' => 'МЕЖП'
        ),
        array(
            'value' => 7,
            'name' => 'ФЗШП'
        ),
        array(
            'value' => 8,
            'name' => 'ПВТ'
        ),
        array(
            'value' => 9,
            'name' => 'СК по ПСП'
        ),
        array(
            'value' => 11,
            'name' => 'ЗАГР'
        ),
        array(
            'value' => 12,
            'name' => 'ЮЛШП'
        )
    );

    public function remapTariffSF($val){
        foreach ($this->tariffSf as $item) {
            if ($item['name'] == $val) {
                return $item['value'];
            }
        }
    }
}