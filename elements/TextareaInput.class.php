<?php
class TextareaInput extends FormElement implements htmlDisplayable {
    
    public function __construct($name = '') {
        $this->setAttribute('value', '');
        $this->setAttribute('name', $name);
    }
    
    public function render() {
        return sprintf('%s<textarea %s>%s</textarea>', 
                            Form::FORM_BREAKLINE,
                            $this->getFormattedAttributes(array('label', 'value')), 
                            $this->getAttribute('value')
                );
    }
}