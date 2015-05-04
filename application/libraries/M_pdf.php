<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Dennis Simpson
 * @copyright 2015
 */


class M_pdf
{

    function __construct()
         {
             $CI = & get_instance();
             log_message('Debug', 'mPDF class is loaded.');
         }
     //function m_pdf()
     //{
         //$CI = & get_instance();
         //log_message('Debug', 'mPDF class is loaded.');
    // } 
    function load($param=NULL)
    {
        include_once 'mpdf60/mpdf.php';
        //print(APPPATH.'mpdf60/mpdf.php');
        //die;
         
        if ($params == NULL)
        {
            $param = '"","Letter","","",10,10,10,10,6,3,P';          
        }
         
        return new mPDF($param);
    }
}