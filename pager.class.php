<?php

class Pager {

    function __construct($data, $page = 0){
        $this->limit();
        $this->page = (isset($_REQUEST['p']) && is_numeric($_REQUEST['p'])) ? $_REQUEST['p'] : $page;
        $this->data = $data;
        $this->output = '';
        $this->offset = 0;
    }

    public function limit($limit = 80){
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
    
        $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $pages = (int)floor(count($this->data) / $this->limit) -1 ;
    
        for($i = 0; $i <= $pages; $i++){
            if( $i === 0 ) {
                $this->paginator[$i]['anchor'] = 'Inizio';
            } elseif( $pages === $i  ) {
                $this->paginator[$i]['anchor'] = 'Fine';
            } else {
                $this->paginator[$i]['anchor'] = $i;
            }

            $this->paginator[$i]['link']   = $this->url_pagination( $currentUrl, "p", $i ); 
        }
        return $this->paginator;
    }

    public function url_pagination($url, $parameterName, $parameterValue ) {
        $url = parse_url($url);
        parse_str($url["query"],$parameters);
        unset($parameters[$parameterName]);
        $parameters[$parameterName]=$parameterValue;
        return sprintf("%s://%s%s?%s", 
            $url["scheme"],
            $url["host"],
            $url["path"],
            http_build_query($parameters));
    }
}
