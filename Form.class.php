<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Main class
 * 
 * @name Form
 * @author Christophe
 */
class Form {
   
    protected $_name;
    protected $_action;
    protected $_method;  
    protected $_elements;
    
    const FORM_ELEMENTS_MAINCLASS           = 'Element';
    const FORM_ELEMENTS_RENDERHTMLMETHOD    = 'render';
    
    public function __construct($parameters = array()) {
        $this->_name    = isset($parameters['name'])    ?   $parameters['name']      : null;
        $this->_action  = isset($parameters['action'])  ?   $parameters['action']    : null;
        $this->_method  = isset($parameters['method'])  ?   $parameters['method']    : null;    
        $this->_elements = array();
    }
    
    public function add($elementObject) {
        if(get_class($elementObject) == FORM_ELEMENTS_MAINCLASS) {
            $this->_elements[] = $elementObject;
        }
        return $elementObject;
    }
    
    public function render() {
        $htmlRender = ''; /* To do, using a layout file */
        foreach($this->_elements as $element) {
            if(method_exists($element, FORM_ELEMENTS_RENDERHTMLMETHOD)) {
                $htmlRender .= $element->{FORM_ELEMENTS_RENDERHTMLMETHOD}();
            }
        }
        
        /* To do */
    }
    
    public function isValid() {
        $valid = true;
        foreach($this->_elements as $element) {
            if(!$element->validate()) {
                $valid = false;
                break 2;
            }
        }
        
        return $valid;
    }
    
}

?>
