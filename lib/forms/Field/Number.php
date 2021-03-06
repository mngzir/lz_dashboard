<?php

namespace Lib\Field;

use Lib\Useful;

class Number extends Text
{
	public $field_type = 'number';
	
    public function validate($val)
    {
        if (!empty($this->error)) {
            return false;
        }
        if (parent::validate($val)){
            if (Useful::stripper($val) !== false) {
                if (!filter_var($val, FILTER_VALIDATE_FLOAT)) {
                    $this->error[] = 'must be numeric';
                }
            } else {
            	$this->error[] = 'must be numeric';
            }
        }
        return !empty($this->error) ? false : true;
    }

    public function returnField($form_name, $name, $value = '', $group = '')
    {
        

        return parent::returnField($form_name, $name, $value, $group);
    }

}
