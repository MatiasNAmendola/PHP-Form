<?php 
class GenericInput extends FormElement implements htmlDisplayable {
    
    protected $_type = 'text';
    
    public function render() {
        return sprintf('<label for="%s">%s &nbsp;</label><input type="%s" %s />%s', 
                        $this->getAttribute('name') ?  $this->getAttribute('name') : '',
                        $this->getAttribute('label') ? $this->getAttribute('label') : ucfirst($this->getAttribute('name')),
                        $this->_type, 
                        $this->getFormattedAttributes(array('label')), 
                        Form::FORM_BREAKLINE
                );
    }
}
?>