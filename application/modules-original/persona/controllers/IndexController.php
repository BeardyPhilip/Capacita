<?php

class Persona_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction(){
        // action body
        $modPer     = new Persona_Model_DbTable_Persona();
        $modTpPer   = new Tipopersona_Model_DbTable_Tipopersona();
        $data       = $modPer->fetchAll();
        $arrDatos   = $data->toArray();
        
        for($i=0; $i<count($arrDatos); $i++){
            $dataTpPer  = $modTpPer->fetchRow('tppr_id = ' . $arrDatos[$i]['tppr_id']);
            $arrDatos[$i]['tppr_dsc']    = $dataTpPer->tppr_dsc;
        }
        
        $this->view->data = $arrDatos;
    }
    
    public function addAction(){
        
        $modTpPer   = new Tipopersona_Model_DbTable_Tipopersona();
        $dataTpPer   = $modTpPer->fetchAll();
        
        $arr_datos_form = array(
                                'dataTpPer'=>$dataTpPer
                                );
        
        
        $form = new Persona_Form_Persona($arr_datos_form);
        //print_r($form);
        $form->submit->setLabel('Agregar');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                
                $arr_data_per   =  array(
                                         'per_nombre'=>$form->getValue('per_nombre'),
                                         'per_apellido'=>$form->getValue('per_apellido'),
                                         'per_nrut'=>$form->getValue('per_nrut'),
                                         'per_drut'=>$form->getValue('per_drut'),
                                         'tppr_id'=>$form->getValue('tppr_id')
                                         );
                
                $modPer = new Persona_Model_DbTable_Persona();
                $modPer->addPersona($arr_data_per);
                
                $this->view->grabado=1;
                //$this->_helper->redirector('index');
            }else{
                $form->populate($formData);
            }
        }
    }
    
    public function editAction(){
        $id = $this->_getParam('per_id',0);
        
        $modPer = new Persona_Model_DbTable_Persona();
        
        $arrPer = $modPer->getRegistro($id);
        
        
        
        $modTpPer   = new Tipopersona_Model_DbTable_Tipopersona();
        $dataTpPer   = $modTpPer->fetchAll();
        $arr_datos_form = array(
                                'dataTpPer'=>$dataTpPer
                                );
        
        
        $form = new Persona_Form_Persona($arr_datos_form);
        //print_r($form);
        $form->submit->setLabel('Modificar');
        
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                
                $arr_data_per   =  array(
                                         'per_nombre'=>$form->getValue('per_nombre'),
                                         'per_apellido'=>$form->getValue('per_apellido'),
                                         'per_nrut'=>$form->getValue('per_nrut'),
                                         'per_drut'=>$form->getValue('per_drut'),
                                         'tppr_id'=>$form->getValue('tppr_id')
                                         );
                
                $modPer = new Persona_Model_DbTable_Persona();
                $modPer->updatePersona($arr_data_per);
                
                $this->view->grabado=1;
                //$this->_helper->redirector('index');
            }
            else{
                $form->populate($formData);
            }
        }
        else{
            
            $form->populate($arrPer);
        }
        
        $this->view->form = $form;
    }


}

