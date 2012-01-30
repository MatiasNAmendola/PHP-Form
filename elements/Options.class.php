<?php
class Options extends FormElement implements htmlDisplayable {

    
    public function __construct($options = array()) {
        $this->setAttribute('options', $options);
    }

    public function render() {
        $html = '';
        foreach($this->getAttribute('options') as $optionName => $optionValue) { // id = value
            $html .= sprintf('<input type="radio" value="%s" id="%s" %s %s /><label for="%s">%s</label>%s',
                          $optionName,
                          $optionName,
                          ($this->getAttribute('selected') == $optionName || $this->getAttribute('checked') == $optionName) ? 'checked' : '',
                          $this->getFormattedAttributes($except = array('label', 'id', 'value', 'options', 'selected')),
                          $optionName,
                          $optionValue,
                          Form::FORM_BREAKLINE
                    );
        }
        return $html;
    }
}

?>
