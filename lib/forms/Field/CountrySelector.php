<?php
namespace Lib\Field;

require_once 'Select.php';

class CountrySelector extends Select
{
	protected $attrs;
	public $field_type = 'countryselector';
	
    public function __construct($label, array $attributes = array())
    {
    	$this->attrs = $attributes;
        parent::__construct($label, $attributes);
    }

    public function returnField($form_name, $name, $value = '', $group = '')
    {
    	$countrys = \Country::newInstance()->listAll();
    	foreach( $countrys as $country ){
    		$this->options[$country['pk_c_code']] = $country['s_name'];
    	}

        $field = sprintf('<select name="%2$s[%3$s][%1$s]" id="%2$s_%3$s_%1$s">', $name, $form_name,$group);
        foreach ($this->options as $key => $val) {
            $attributes = $this->getAttributeString($val);
            $field .= sprintf('<option value="%s" %s>%s</option>', $key, ((string) $key === (string) $value ? 'selected="selected"' : '') . $attributes['string'], $attributes['val']);
        }
        $field .= '</select>';
        
        $field .= sprintf('<label for="%s_%s_%s" class="%s">%s</label>', $form_name, $group, $name, $class, $this->label);
        
        
        
        
        
        
        
        $class = !empty($this->error) ? 'error choice_label' : 'choice_label';

        return array(
            'messages' => !empty($this->custom_error) && !empty($this->error) ? $this->custom_error : $this->error,
            'label' => $this->label == false ? false : sprintf('<label for="%s_%s_%s" class="%s">%s</label>', $form_name, $group, $name, $class, $this->label),
            'field' => $field,
            'html' => $this->html
        );
    }

}
