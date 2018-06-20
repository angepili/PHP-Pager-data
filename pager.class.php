<?php

class Pager {

    function __construct($data, $page = 0){
        $this->limit();
        $this->page = (isset($_REQUEST['p']) && is_numeric($_REQUEST['p'])) ? $_REQUEST['p'] : $page;
        $this->data = $data;
        $this->output = '';
        $this->offset = 0;
    }

    public function limit($limit = 10){
        $this->limit = $limit ? $limit : 10;
    }

    public function rows(){
        $this->offset = $this->limit * ($this->page - 1) + $this->limit;
        $values = array_slice($this->data,$this->offset,$this->limit);
        return $values;
    }

    public function headers(){
        foreach($this->data[0] as $key => $value){
            $this->headers[] = $key;
        }
        return $this->headers;
    }

    public function paginator(){
        $pages = floor(count($this->data) / $this->limit);
        for($i = 0; $i <= $pages; $i++){
            $this->paginator[$i]['anchor'] = $i + 1;
            $this->paginator[$i]['link']   = '?p='.$i; 
        }
        return $this->paginator;
    }

}