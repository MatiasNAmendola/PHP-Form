<?php 
class TextInput extends FormElement implements htmlDisplayable {
    
    protected $_textInputType = 'text';
    
    public function render() {
        return sprintf('<input type="%s" %s />', $this->_textInputType, $this->getFormattedAttributes());
    }
}
?>