<?php
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
    private   $_layoutFile;
            
    const FORM_ELEMENTS_MAINCLASS           = 'FormElement';
    const FORM_ELEMENTS_RENDERHTMLMETHOD    = 'render';
    const FORM_LAYOUT_DEFAULT               = 'formLayout.html';
    const FORM_BREAKLINE                    = "\n<br />";
    
    public function __construct($parameters = array()) {
        $this->_name    = isset($parameters['name'])    ?   $parameters['name']      : null;
        $this->_action  = isset($parameters['action'])  ?   $parameters['action']    : null;
        $this->_method  = isset($parameters['method'])  ?   $parameters['method']    : 'GET';    
        $this->_elements = array();
        
        if(isset($parameters['layoutFile'])) {
            if(file_exists($parameters['layoutFile']) && is_readable($parameters['layoutFile'])) {
                $this->_layoutFile = $parameters['layoutFile'];
            }
        }
        else {
            $this->_layoutFile = dirname(__FILE__).'/'.self::FORM_LAYOUT_DEFAULT;
        }
    }
    
    public function add($elementObject) {
        $parentClass = get_parent_class($elementObject);
        if(($parentClass == self::FORM_ELEMENTS_MAINCLASS OR get_parent_class(new $parentClass) == self::FORM_ELEMENTS_MAINCLASS) && in_array('htmlDisplayable', class_implements($elementObject))) {
            $this->_elements[] = $elementObject;
        }
        return $elementObject;
    }
    
    public function render() {
        $htmlElements = '';
        foreach($this->_elements as $element) {
            if(method_exists($element, self::FORM_ELEMENTS_RENDERHTMLMETHOD)) {
                /*$name = $element->getAttribute('name') ? $element->getAttribute('name') : '';
                $label = $element->getAttribute('label') ? $element->getAttribute('label') : ucfirst($name);

                $htmlElements .= sprintf('<label for="%s">%s :&nbsp;</label>', $name, $label);*/
                $htmlElements .= $element->{self::FORM_ELEMENTS_RENDERHTMLMETHOD}();
                //$htmlElements .= self::FORM_BREAKLINE;
            }
        }
        $replacements = array(
            '{name}'    => $this->_name, 
            '{method}'  => $this->_method, 
            '{action}'  => $this->_action, 
            '{elements}'=> $htmlElements
        );
        return str_replace(array_keys($replacements), array_values($replacements), file_get_contents($this->_layoutFile));
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
