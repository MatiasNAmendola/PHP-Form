<?php 
class PasswordInput extends TextInput implements HtmlDisplayable {
    
    public function __construct() {
        $this->_textInputType = 'password';
    }
    
    public function render() {
        return '<input type="password" '.$this->getFormattedAttributes().' />';
    }
}
?>