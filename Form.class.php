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
        $this->_invalidElements = array();
        
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
                $htmlElement = $element->{self::FORM_ELEMENTS_RENDERHTMLMETHOD}();
                $htmlElements .= $element->mustBreakline() ? $htmlElement : substr($htmlElement, 0, strlen($htmlElement)-strlen(Form::FORM_BREAKLINE));
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
    
    public function get($key) {
        return isset($_POST[$key]) ? $_POST[$key] : false;
    }
    
    public function isValid($returnErrors = false) {    
        $invalidElements = array();
        foreach($this->_elements as $element) {
            $isValid = $element->isValid();
            if($isValid !== true) {
                $invalidElements[$element->getAttribute('label')] = $isValid;
            }
        }
        $this->_invalidElements = $invalidElements;
        return $returnErrors ? $invalidElements : empty($invalidElements);
    }
    
    public function getErrors() {
        return $this->_invalidElements;
    }
    
    public function hydrate($data) {
        foreach($this->_elements as $element) {
            if(isset($data[$element->getName()])) {
                if(get_class($element) == 'Select' || get_class($element) == 'Options') {
                    $element->selected($data[$element->getName()]);
                }
                else {
                    $element->value($data[$element->getName()]);
                }
            }

        }
    }
}

?>
