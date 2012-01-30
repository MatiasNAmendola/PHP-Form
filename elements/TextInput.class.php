<?php 
class TextInput extends FormElement implements htmlDisplayable {
    
    public function render() {
        return '<input type="text" '.$this->getFormattedAttributes().' />';
    }
}
?>