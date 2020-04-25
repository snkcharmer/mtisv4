<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class pdf2 {
    
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';

        return new mPDF('utf-8', array(215.9,330.2),"","",10,10,10,10,6,3);
    }
	
	
	
}