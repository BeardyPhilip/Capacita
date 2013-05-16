<?php

class Persona_Model_DbTable_Persona extends Zend_Db_Table_Abstract
{

    protected $_name = 'persona';

    public function insertar($arr_data){
        
        $this->insert($arr_data);
    }
    
    public function actualizar($per_id, $arr_update)
    {
        
        $this->update($arr_update, 'per_id = ' . (int)$per_id);
    }
    
    public function eliminar($id)
    {
	
	$this->delete('per_id = ' . (int)$id);
    }

    

    public function listar($per_id='', $per_nrut='',$per_nombre='',$per_apellido='',$tppr_id='',$per_email='')
    {
        
        $sql = $this->select();
        
        if($per_id!=''){
            $sql->where("per_id = ?", $per_id);
	    //$sql->where("per_id like %$per_id%");  <-- PARA FILTRAR EN CASO DE QUE SEA UNA CADENA DE CARACTERES
        }
        
        if($per_nrut!=''){
            $sql->where("per_nrut = ?", $per_nrut);
        }
        
	if($per_nombre!=''){
            $sql->where("per_nombre like %$per_nombre%");
        }
	
	if($per_apellido!=''){
            $sql->where("per_apellido like %$per_apellido%");
        }
	
	if($tppr_id!=''){
            $sql->where("tppr_id = ?",$tppr_id);
        }
	
	if($per_email!=''){
            $sql->where("per_email like %$per_email%");
        }
	
        $results    = $this->fetchAll($sql);
        
        return $results;
        
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

