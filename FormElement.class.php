<?php
/**
 * Element class.
 *
 * @name FormElement
 * @author Christophe
 */
class FormElement {
    
    protected $_validators;
    protected $_attributes;
    
    public function __construct($name = null) {
        if(!is_null($name)) {
            $this->_attributes['name'] = $name;
        }
    }
    
    public function __call($name, $arguments) {
        $this->_attributes[$name]=$arguments[0];
        return $this;
    }
    
    public function getAttribute($attributeName) {
        return isset($this->_attributes[$attributeName]) ? $this->_attributes[$attributeName] : false;
    }
    
    public function getFormattedAttributes($except = array('label')) {
        $formattedAttributes = '';
        foreach($this->_attributes as $attribute => $value) {
            if(!in_array($attribute, $except)) {
                $formattedAttributes .= sprintf('%s="%s" ', $attribute, $value);
            }
        }
        $formattedAttributes .= 'id="'.$this->getAttribute('name').'"';
        return $formattedAttributes;
    }

}

?>