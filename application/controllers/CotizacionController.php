<?php
class CotizacionController extends Zend_Controller_Action{

	private $_season;
    private $_session;
    private $_user;
    private $_epp;
    private $_cot;
    private $_transformador;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_cot = new Application_Model_CotizacionModel;
        $this->_transformador = new Application_Model_TransformadorModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
    }//END INIT

    public function cotizacionAction(){
        // $table="GIM_CATALOGO_SERVICIOS";
        // $this->view->servicios = $this->_season->GetAll($table);
    }

    public function cotizacionesAction(){

    }

    public function crearcotizacionAction(){
        $table="GIM_SUBESTACIONES";
        $this->view->subestaciones = $this->_season->GetAll($table);

        $table="GIM_ALCANCES";
        $this->view->subestaciones_alcances = $this->_season->GetAll($table);

        $table="GIM_PRUEBAS";
        $this->view->pruebas = $this->_season->GetAll($table);

    }//END INDEX

    public function crearcotizaciondosAction(){
        $table="GIM_PRUEBAS";
        $this->view->transformadores = $this->_transformador->Gettransformadores();
    }


    public function requestaddcotizacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        return $this-> _redirect('/cotizacion/crearcotizaciondos');

    }

    public function pdfcotizacionAction(){

    }

}