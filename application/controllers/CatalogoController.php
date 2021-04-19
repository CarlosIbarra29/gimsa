<?php

class CatalogoController extends Zend_Controller_Action{

    private $_catalogo;

    public function init(){

        $this->_catalogo = new Application_Model_CatalogoModel;
    }

    public function indexAction(){

        $aData = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS();

        $this->view->aData = $aData;

    }

    public function getinfoAction(){

        $aData = $this->_catalogo->SET_GIM_CATALOGO_SERVICIOS_TIPO();

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['NOMBRE'] = $_POST['NOMBRE'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_catalogo->fnInsert( 'GIM_CATALOGO_SERVICIOS', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }
        
    }


     public function upcatalogoAction(){

        $aData = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['NOMBRE'] = $_POST['NOMBRE'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_catalogo->fnUpdate( 'GIM_CATALOGO_SERVICIOS', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $fnUpdate['ID_TIPO'] );

            $this->view->aData = $aData;

        }
        
    }

    public function deleteAction(){

        $idCatalogo =  $_GET['catId'];
        
        $table="GIM_CATALOGO_SERVICIOS";
            
        $wh="ID_TIPO";

        $fnDelete = $this->_catalogo->deleteAll( $idCatalogo, $table, $wh );
        
        $this->view->aResponse = $fnDelete;

        return $this-> _redirect('/catalogo?del=' . $fnDelete['status']. '');

    }
    
}