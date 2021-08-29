<?php

require_once dirname(__FILE__).'tcpdf/tcpdf.php';

class tcpdf_lib extends TCPDF {
    public function __construct(){
        parent :: __construct();
    }
}

?>