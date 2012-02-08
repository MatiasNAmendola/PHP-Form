<?php
class HtmlElement extends FormElement implements htmlDisplayable {

    public function __construct() {
        $this->_validating['required'] = false;
    }
    
    public function render() {
        return $this->getAttribute('value');
    }

}

?>
