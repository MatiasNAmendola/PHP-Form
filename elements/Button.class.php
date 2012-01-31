<?php
class Button extends FormElement implements htmlDisplayable {

    protected $_type = 'button';
    
    public function render() {
        return sprintf('<input type="%s" %s />%s', 
                        $this->_type, 
                        $this->getFormattedAttributes(array('label')), 
                        Form::FORM_BREAKLINE);
    }

}

?>
