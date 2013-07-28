<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Gallery extends ORM {
	
	protected $_table_name = 'plugin_gallery';
	
	public function rules()
    {
        return array(
            'name' => array(
                array('not_empty'),
                array('min_length', array(':value', 5)),
                array('max_length', array(':value', 50)),
            ),
            'url' => array(
                array('not_empty'),
                array('min_length', array(':value', 5)),
                array('max_length', array(':value', 50)),
            ),
        );
    }
} // End Gallery Model
