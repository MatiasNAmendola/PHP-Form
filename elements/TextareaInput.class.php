<?php
class TextareaInput extends FormElement implements htmlDisplayable {
    
    public function __construct() {
        $this->setAttribute('value', '');
    }
    
    public function render() {
        return sprintf('%s<textarea %s>%s</textarea>', 
                            Form::FORM_BREAKLINE,
                            $this->getFormattedAttributes($except = array('label', 'value')), 
                            $this->getAttribute('value')
                );
    }
}