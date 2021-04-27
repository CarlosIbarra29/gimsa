<?php

class SeccionesController extends Zend_Controller_Action{

    private $_alcances;

    public function init(){

        $this->_secciones = new Application_Model_SeccionesModel;
    }

    public function indexAction(){

        $idTipo = $_GET['tpo'];

        $aData = $this->_secciones->GIM_SECCIONES_ALL( $idTipo );

        $this->view->aData = $aData;

    }

    public function getinfoAction(){

        $idTipo = $_GET['tpo'];

        $aData = $this->_secciones->SET_GIM_CATALOGO_SERVICIOS_TIPO( $idTipo );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            $aDataIn['PRECIO'] = $_POST['PRECIO'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_secciones->fnInsert( 'GIM_SECCIONES', $aDataIn );

            $this->view->aResponse = $fnInsert;

            $this->view->aResponseTipo = $_POST['ID_TIPO'];

        }
        
    }


    public function updateAction(){

        $aData = $this->_secciones->GIM_SECCIONES_TIPO( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_SECCION'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            $aDataIn['PRECIO'] = $_POST['PRECIO'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_secciones->fnUpdate( 'GIM_SECCIONES', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_secciones->GIM_SECCIONES_TIPO( $fnUpdate['ID_SECCION'] );

            $this->view->aData = $aData;

        }
        
    }

    public function deleteAction(){

        $idCatalogo =  $_GET['catId'];
        
        $table="GIM_SECCIONES";
            
        $wh="ID_SECCION";

        $fnDelete = $this->_secciones->deleteAll( $idCatalogo, $table, $wh );
        
        $this->view->aResponse = $fnDelete;

        return $this-> _redirect('/secciones/?tpo=' . $_GET['tpo'] . '&del=' . $fnDelete['status']. '');

    }
    
}