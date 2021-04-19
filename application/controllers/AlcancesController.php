<?php

class AlcancesController extends Zend_Controller_Action{

    private $_alcances;

    public function init(){

        $this->_alcances = new Application_Model_AlcancesModel;
    }

    public function indexAction(){

        $aData = $this->_alcances->GIM_ALCANCES_ALL();

        $this->view->aData = $aData;

    }

    public function getinfoAction(){

        $aData = $this->_alcances->SET_GIM_CATALOGO_SERVICIOS_TIPO();

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_alcances->fnInsert( 'GIM_ALCANCES', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }
        
    }


    public function upalcancesAction(){

        $aData = $this->_alcances->GIM_ALCANCES_TIPO( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_ALCANCE'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_alcances->fnUpdate( 'GIM_ALCANCES', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_alcances->GIM_ALCANCES_TIPO( $fnUpdate['ID_ALCANCE'] );

            $this->view->aData = $aData;

        }
        
    }

    public function deleteAction(){

        $idCatalogo =  $_GET['catId'];
        
        $table="GIM_ALCANCES";
            
        $wh="ID_ALCANCE";

        $fnDelete = $this->_alcances->deleteAll( $idCatalogo, $table, $wh );
        
        $this->view->aResponse = $fnDelete;

        return $this-> _redirect('/alcances?del=' . $fnDelete['status']. '');

    }
    
}