<?php
/**
 * Element class.
 *
 * @name Element
 * @author Christophe
 */
class Element {
    
    protected $_name;
    protected $_validators;
    
    public function __construct() {
        
    }
    
    public function __call($name, $arguments) {
        $callType = substr($name, 0, 3);
        if($callType == 'get') {
            $var = strtolower(substr($name, 3));
            if(isset($this->{'_'.$var})) {
                return $this->{'_'.$var};
            }
        }
        if($callType == 'set') {
            $var = strtolower(substr($name, 3));
            if(isset($this->{'_'.$var})) {
                $this->{'_'.$var} = $arguments[0];
            }
        }
    }

}

?>
