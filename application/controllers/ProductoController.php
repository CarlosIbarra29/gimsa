<?php

class ProductoController extends Zend_Controller_Action{

    private $_producto;

    private $_catalogo;

    public function init(){

        $this->_producto = new Application_Model_ProductoModel;

        $this->_catalogo = new Application_Model_CatalogoModel;
    }

    public function indexAction(){

        $idTipo = $_GET['catId'];

        if( $idTipo == 1){

            $vista = 'producto/subestaciones?tpo=' . $idTipo . '';

        }elseif ( $idTipo == 2) {

            $vista = 'producto/plantasemergencia?tpo=' . $idTipo . '';
            
        }elseif ( $idTipo == 3) {

            $vista = 'producto/transformadores?tpo=' . $idTipo . '';
            
        }elseif ( $idTipo == 4) {

            $vista = 'producto/tableros?tpo=' . $idTipo . '';
            
        }elseif ( $idTipo == 5) {

            $vista = 'producto/bancocapacitor?tpo=' . $idTipo . '';
            
        }

        return $this-> _redirect( $vista );
        
    }

    public function subestacionesAction(){

        $aData = $this->_producto->GET_GIM_SUBERTACIONES();

        $aDataCatalogo = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['tpo'] );

        foreach ($aData as $k => $v) {

            $aData[$k]['CATALOGO_NOMBRE'] = $aDataCatalogo[0]['NOMBRE'];

        }

        if ( isset( $_GET['op'] ) ) {
            
            $idCatalogo =  $_GET['catId'];

            $table = "GIM_SUBESTACIONES";

            $wh = "ID_SUBESTACION";

            $fnDelete = $this->_producto->deleteAll( $idCatalogo, $table, $wh );

            return $this-> _redirect('/producto/subestaciones/?tpo=1&del=' . $fnDelete['status']. '');

        }

        $this->view->aData = $aData;

    }

    public function getinfoAction(){

        $aData = $this->_producto->GET_GIM_SUBESTACIONES_TIPO();

        $this->view->aDataCbo = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_producto->fnInsert( 'GIM_SUBESTACIONES', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }

    }

    public function upgetinfoAction(){

        $aData = $this->_producto->GET_GIM_SUBESTACIONES( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_SUBESTACION'] = $_POST['ID_SUBESTACION'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_producto->fnUpdateSubestacion( 'GIM_SUBESTACIONES', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_producto->GET_GIM_SUBESTACIONES( $fnUpdate['ID_SUBESTACION'] );

            $this->view->aData = $aData;

        }
        
    }

    public function plantasemergenciaAction(){

        $aData = $this->_producto->GET_GIM_PLANTAS_EMERGENCIA_ALL();

        $aDataCatalogo = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['tpo'] );

        foreach ($aData as $k => $v) {

            $aData[$k]['CATALOGO_NOMBRE'] = $aDataCatalogo[0]['NOMBRE'];

        }

        if ( isset( $_GET['op'] ) ) {
            
            $idCatalogo =  $_GET['catId'];

            $table = "GIM_PLANTAS_EMERGENCIA";

            $wh = "ID_PLANTA";

            $fnDelete = $this->_producto->deleteAll( $idCatalogo, $table, $wh );

            return $this-> _redirect('/producto/plantasemergencia/?tpo=2&del=' . $fnDelete['status']. '');

        }

        $this->view->aData = $aData;

    }

    public function getinfoplantaAction(){

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['PRECIO'] = $_POST['COSTO'];

            $aDataIn['CAPACIDAD'] = $_POST['CAPACIDAD'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_producto->fnInsert( 'GIM_PLANTAS_EMERGENCIA', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }

    }

    public function upgetinfoplantaAction(){

        $aData = $this->_producto->GET_GIM_PLANTAS_EMERGENCIA( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['CAPACIDAD'] = $_POST['CAPACIDAD'];

            $aDataIn['PRECIO'] = $_POST['COSTO'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $aDataIn['ID_PLANTA'] = $_POST['ID_UPDATE'];

            $fnUpdate =  $this->view->aResponse = $this->_producto->fnUpdatePlanta( 'GIM_PLANTAS_EMERGENCIA', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_producto->GET_GIM_PLANTAS_EMERGENCIA( $fnUpdate['ID_PLANTA'] );

            $this->view->aData = $aData;

        }
        
    }

    public function transformadoresAction(){

        $aDataCatalogo = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['tpo'] );

        $aData = $this->_producto->GET_GIM_TRANSFORMADORES_ALL();

        foreach ($aData as $k => $v) {

            $aData[$k]['CATALOGO_NOMBRE'] = $aDataCatalogo[0]['CATEGORIA'];

        }


        if ( isset( $_GET['op'] ) ) {
            
            $idCatalogo =  $_GET['catId'];

            $table = "GIM_TRANSFORMADORES";

            $wh = "ID_TRANSFORMADOR";

            $fnDelete = $this->_producto->deleteAll( $idCatalogo, $table, $wh );

            return $this-> _redirect('/producto/transformadores/?tpo=3&del=' . $fnDelete['status']. '');

        }

        $this->view->aData = $aData;

    }

    public function getinfotransfAction(){

        $aData = $this->_producto->GET_GIM_TRANSFORMADORES_TIPO();

        $this->view->aDataCbo = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TIPO'] = $_POST['ID_TIPO'];

            $aDataIn['CAPACIDAD_KVA'] = $_POST['CAPACIDAD_KVA'];

            $aDataIn['TENSION'] = $_POST['TENSION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_producto->fnInsert( 'GIM_TRANSFORMADORES', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }

    }

    public function upgetinfotransfAction(){

        $aData = $this->_producto->GET_GIM_TRANSFORMADORES( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['ID_TRANSFORMADOR'] = $_POST['ID_TRANSFORMADOR'];

            $aDataIn['CAPACIDAD_KVA'] = $_POST['CAPACIDAD_KVA'];

            $aDataIn['TENSION'] = $_POST['TENSION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnUpdate =  $this->view->aResponse = $this->_producto->fnUpdateTransformadores( 'GIM_TRANSFORMADORES', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_producto->GET_GIM_TRANSFORMADORES( $fnUpdate['ID_TRANSFORMADOR'] );

            $this->view->aData = $aData;

        }
        
    }

    public function tablerosAction(){

        $aDataCatalogo = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['tpo'] );

        $aData = $this->_producto->GIM_TABLERO_ALL();

        foreach ($aData as $k => $v) {

            $aData[$k]['CATALOGO_NOMBRE'] = $aDataCatalogo[0]['NOMBRE'];

        }

        if ( isset( $_GET['op'] ) ) {
            
            $idCatalogo =  $_GET['catId'];

            $table = "GIM_TABLERO";

            $wh = "ID_TABLERO";

            $fnDelete = $this->_producto->deleteAll( $idCatalogo, $table, $wh );

            return $this-> _redirect('/producto/tableros/?tpo=4&del=' . $fnDelete['status']. '');

        }

        $this->view->aData = $aData;

    }

    public function getinfotableroAction(){

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['SECCION'] = $_POST['SECCION'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_producto->fnInsert( 'GIM_TABLERO', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }

    }

    public function upgetinfotableroAction(){

        $aData = $this->_producto->GIM_TABLERO( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['SECCION'] = $_POST['SECCION'];

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $aDataIn['ID_TABLERO'] = $_POST['ID_UPDATE'];

            $fnUpdate =  $this->view->aResponse = $this->_producto->fnUpdateTablero( 'GIM_TABLERO', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_producto->GIM_TABLERO( $fnUpdate['ID_TABLERO'] );

            $this->view->aData = $aData;

        }
        
    }

    public function bancocapacitorAction(){

        $aDataCatalogo = $this->_catalogo->GET_GIM_CATALOGO_SERVICIOS_TIPO( $_GET['tpo'] );

        $aData = $this->_producto->GIM_BANCO_CAPACITORES_ALL();

        foreach ($aData as $k => $v) {

            $aData[$k]['CATALOGO_NOMBRE'] = $aDataCatalogo[0]['NOMBRE'];

        }

        if ( isset( $_GET['op'] ) ) {
            
            $idCatalogo =  $_GET['catId'];

            $table = "GIM_BANCO_CAPACITORES";

            $wh = "ID_BANCO";

            $fnDelete = $this->_producto->deleteAll( $idCatalogo, $table, $wh );

            return $this-> _redirect('/producto/bancocapacitor/?tpo=5&del=' . $fnDelete['status']. '');

        }

        $this->view->aData = $aData;

    }

    public function getinfobancoAction(){

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $fnInsert = $this->_producto->fnInsert( 'GIM_BANCO_CAPACITORES', $aDataIn );

            $this->view->aResponse = $fnInsert;

        }

    }

    public function upgetinfobancoAction(){

        $aData = $this->_producto->GIM_BANCO_CAPACITORES( $_GET['catId'] );

        $this->view->aData = $aData;

        $optReg = $_POST['optReg'];

        if ( $optReg == 'set' ) {

            $aDataIn['DESCRIPCION'] = $_POST['DESCRIPCION'];

            if( $_POST['ACTIVO'] == 'on' ){

                $aDataIn['ACTIVO'] = 1;

            }else{

                $aDataIn['ACTIVO'] = 0;

            }

            $aDataIn['ID_BANCO'] = $_POST['ID_UPDATE'];

            $fnUpdate =  $this->view->aResponse = $this->_producto->fnUpdateBanco( 'GIM_BANCO_CAPACITORES', $aDataIn );

            $this->view->aResponse = $fnUpdate;

            $aData = $this->_producto->GIM_BANCO_CAPACITORES( $fnUpdate['ID_BANCO'] );

            $this->view->aData = $aData;

        }
        
    }

   





    
}