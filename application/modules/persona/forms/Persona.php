<?php

class Persona_Form_Persona extends Zend_Form
{
    
    private $datos;
    
    public function __construct($arr){
        $this->datos    = $arr;
        parent::__construct();
    }

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        
        $this->setDisableLoadDefaultDecorators(true);
    	
    	$this->setDecorators(array(
    			array('ViewScript', array('viewScript' => 'frmPersona.phtml')),'Form'
    	));
        
        $this->setName('persona');
        
        $per_id = new Zend_Form_Element_Hidden('per_id');
        $per_id->addFilter('Int');
        
        $per_nrut = new Zend_Form_Element_Text('per_nrut');
        $per_nrut->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
               
        $per_drut = new Zend_Form_Element_Text('per_drut');
        $per_drut->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $per_nombre = new Zend_Form_Element_Text('per_nombre');
        $per_nombre->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $per_apellido = new Zend_Form_Element_Text('per_apellido');
        $per_apellido->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $arrOpcion  = $this->getOpcionesTpPer();
        
        $tppr_id = new Zend_Form_Element_Select('tppr_id');
        $tppr_id->setRequired(true)
               ->addMultiOptions($arrOpcion)
               ->addValidator('NotEmpty');
	       
        $per_email = new Zend_Form_Element_Text('per_email');
        $per_email->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
	       
	$per_direccion = new Zend_Form_Element_Text('per_direccion');
        $per_direccion->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
       
        $this->addElements(array($per_id, $per_nrut, $per_drut, $per_nombre, $per_apellido, $tppr_id, $per_email, $per_direccion, $submit));
    }
    
    private function getOpcionesTpPer(){
        $arrOpciones    = array();
        
        foreach ($this->datos['dataTpPer'] as $tpPer){
            $arrOpciones[$tpPer->tppr_id]   = $tpPer->tppr_dsc;
        }
        
        return $arrOpciones;
    }


}

