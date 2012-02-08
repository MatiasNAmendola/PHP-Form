<?php
class TextareaInput extends FormElement implements htmlDisplayable {
    
    public function __construct() {
        $this->setAttribute('value', '');
    }
    
    public function render() {
        return sprintf('<label for="%s">%s :&nbsp;</label>%s<textarea %s>%s</textarea>%s', 
                        $this->getAttribute('name') ?  $this->getAttribute('name') : '',
                        $this->getAttribute('label') ? $this->getAttribute('label') : ucfirst($this->getAttribute('name')),
                        Form::FORM_BREAKLINE,
                        $this->getFormattedAttributes(array('value', 'label')), 
                        $this->getAttribute('value') ?  $this->getAttribute('value') : '',
                        Form::FORM_BREAKLINE
                );
    }        
}