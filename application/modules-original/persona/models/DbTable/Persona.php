<?php

class Persona_Model_DbTable_Persona extends Zend_Db_Table_Abstract
{

    protected $_name = 'persona';

    public function addPersona($arr_data){
        
        $this->insert($arr_data);
    }
    
    public function getRegistro($id){
        $id = (int)$id;
		$row = $this->fetchRow('per_id = ' . $id);
		if (!$row) {
			throw new Exception("No se pudo encontrar la persona per_id = $id");
		}
		return $row->toArray();
    }
}

