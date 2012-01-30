<?php 
class PasswordInput extends FormElement implements htmlDisplayable {
    
    public function render() {
        return '<input type="password" '.$this->getFormattedAttributes().' />';
    }
}
?>