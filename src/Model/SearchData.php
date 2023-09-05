<?php

namespace App\Model;

class SearchData
{
    /** @var int */
    public $page = 1;

    /** @var string */
    public string $query = '';

    public function getQuery(){
        return $this->query;
    }
}
