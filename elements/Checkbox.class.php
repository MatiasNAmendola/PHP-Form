<?php
class Checkbox extends GenericInput {

    public function __construct() {
        $this->_type = 'checkbox';
    }
    
    public function render() {
        return sprintf('<input type="checkbox" %s />&nbsp;<label for="%s">%s</label>%s', 
                        $this->getFormattedAttributes(array('label')),
                        $this->getAttribute('name') ?  $this->getAttribute('name') : '',
                        $this->getAttribute('label') ? $this->getAttribute('label') : ucfirst($this->getAttribute('name')),
                        Form::FORM_BREAKLINE
                );
    }

}

?>
