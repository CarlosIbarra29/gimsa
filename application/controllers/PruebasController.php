<?php

class PruebasController extends Zend_Controller_Action{

    private $_alcances;

    public function init(){

        $this->_pruebas = new Application_Model_PruebasModel;
    }

    public function indexAction(){

        $idTipo = $_GET['tpo'];

        $aData = $this->_pruebas->GIM_PRUEBAS_ALL( $idTipo );

        $this->view->aData = $aData;

    }

    public function getinfoAction(){

        $idTipo = $_GET['tpo'];

        $aData = $this->_pruebas->SET_GIM_CATALOGO_SERVICIOS_TIPO( $idTipo );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            $aDataIn['PRUEBA'] = $_POST['PRUEBA'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_pruebas->fnInsert( 'GIM_PRUEBAS', $aDataIn );

            $this->view->aResponse = $fnInsert;

            $this->view->aResponseTipo = $_POST['ID_TIPO'];

        }
        
    }


    public function updateAction(){

        $aData = $this->_pruebas->GIM_PRUEBAS_TIPO( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_PRUEBA'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            $aDataIn['PRUEBA'] = $_POST['PRUEBA'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_pruebas->fnUpdate( 'GIM_PRUEBAS', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_pruebas->GIM_PRUEBAS_TIPO( $fnUpdate['ID_PRUEBA'] );



            $this->view->aData = $aData;

        }
        
    }

    public function deleteAction(){

        $idCatalogo =  $_GET['catId'];
        
        $table="GIM_PRUEBAS";
            
        $wh="ID_PRUEBA";

        $fnDelete = $this->_pruebas->deleteAll( $idCatalogo, $table, $wh );
        
        $this->view->aResponse = $fnDelete;

        return $this-> _redirect('/pruebas/?tpo=' . $_GET['tpo'] . '&del=' . $fnDelete['status']. '');

    }
    
}