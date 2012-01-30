<?php
class Select extends FormElement implements htmlDisplayable {

    public function __construct($options = array()) {
        $this->setAttribute('options', $options);
    }
    
    public function render() {
        $html = sprintf('<label for="%s">%s :&nbsp;</label>'."\n".'<select %s>', 
                    $this->getAttribute('name') ? $this->getAttribute('name') : '',
                    $this->getAttribute('label') ? $this->getAttribute('label') : ucfirst($this->getAttribute('name')),
                    $this->getFormattedAttributes(array('label', 'options', 'selected', 'checked'))
                );
        foreach($this->getAttribute('options') as $optionValue => $optionName) {
            $html .= "\n\t";
            if(is_array($optionName)) {
                $html .= sprintf('<optgroup label="%s">', $optionValue);
                $html .= "\n\t\t";
                foreach($optionName as $optionValue => $optionName) {
                    $html .= sprintf('<option value="%s" %s>%s</option>', 
                            $optionValue, 
                            $this->getAttribute('selected') == $optionValue ? 'selected' : '',
                            $optionName);
                }
                $html .= '</optgroup>';
            }
            else {
                $html .= sprintf('<option value="%s" %s>%s</option>', 
                            $optionValue, 
                            $this->getAttribute('selected') == $optionValue ? 'selected' : '',
                            $optionName);
            }
        }
        $html .= "\n</select>";
        return $html;
    }

}

?>
