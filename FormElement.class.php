<?php
/**
 * Element class.
 *
 * @name FormElement
 * @author Christophe
 */
class FormElement {
    
    protected $_attributes;
    protected $_breakline = true;
    protected $_validating = array();
    
    public function __construct($name = null) {
        if(!is_null($name)) {
            $this->_attributes['name'] = $name;
        }
        
    }
    
    public function __call($name, $arguments) {
        $this->_attributes[$name]=$arguments[0];
        return $this;
    }
    
    public function getAttribute($attribute) {
        return isset($this->_attributes[$attribute]) ? $this->_attributes[$attribute] : false;
    }
    
    protected function setAttribute($attribute, $value) {
        return $this->_attributes[$attribute] = $value;
    }
       
    public function disableBreakline() {
        $this->_breakline = false;
    }
    
    public function mustBreakline() {
        return $this->_breakline;
    }
    
    public function getFormattedAttributes(array $except) {
        $formattedAttributes = '';
        foreach($this->_attributes as $attribute => $value) {
            if(!in_array($attribute, $except)) {
                $formattedAttributes .= sprintf('%s="%s" ', $attribute, $value);
            }
        }
        if(!in_array('id', $except))
                $formattedAttributes .= 'id="'.$this->getAttribute('name').'"';
        
        return $formattedAttributes;
    }
    
    public function getName() {
        return $this->getAttribute('name') ? $this->getAttribute('name') : $this->getAttribute('id');
    }
    
    public function required($isRequired) {
        $this->_validating['required'] = (bool) $isRequired;
        return $this;
    }
    
    public function minlength($minlength) {
        $this->_validating['minlength'] = (int) $minlength;
        return $this;
    }
    
    public function maxlength($maxlength) {
        $this->_validating['maxlength'] = (int) $maxlength;
        return $this;
    }
    
    public function regex($regex) {
        $this->_validating['regex'] = $regex;
        return $this;
    }
            
    public function isValid() {
        if(get_class($this) == 'SubmitButton' || get_class($this) == 'Button')
            return true;
        
        $minlength = isset($this->_validating['minlength']) ? $this->_validating['minlength'] : false;
        $maxlength = isset($this->_validating['maxlength']) ? $this->_validating['maxlength'] : false;
        $regex     = isset($this->_validating['regex'])     ? $this->_validating['regex'] : false;
        $isRequired= isset($this->_validating['required'])  ? $this->_validating['required'] : true;
        $errors = array();
        
        $data = isset($_POST[$this->getName()]) ? $_POST[$this->getName()] : null;
        if($minlength && strlen($data) < $minlength) {
            $errors[] = 'minlength';
        }
        if($maxlength && strlen($data) > $maxlength) {
            $errors[] = 'maxlength';
        }
        if($regex && !preg_match($regex, $data)) {
            $errors[] = 'regex';
        }
        if($isRequired && (is_null($data) || empty($data))) {
            $errors[] = 'required';
        }
        
        if(empty($errors)) {
            return true;
        }
        
        $msgConfig = parse_ini_file(dirname(__FILE__).'/errors.lang.ini');
        $replacements = array(
            '%minlength%' => $minlength, 
            '%maxlength%' => $maxlength
        );
        
        return str_replace(array_keys($replacements), array_values($replacements), str_replace(array_keys($msgConfig), array_values($msgConfig), implode(', ', $errors)));
    }
}

?>
