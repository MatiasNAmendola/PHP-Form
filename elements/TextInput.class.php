<?php 
class TextInput extends FormElement implements htmlDisplayable {
    
    protected $_type = 'text';
    
    public function render() {
        return sprintf('<input type="%s" %s />', $this->_type, $this->getFormattedAttributes());
    }
}
?>