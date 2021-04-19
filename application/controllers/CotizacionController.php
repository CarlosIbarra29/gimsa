<?php
class CotizacionController extends Zend_Controller_Action{

	private $_season;
    private $_session;
    private $_user;
    private $_epp;
    private $_cot;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_cot = new Application_Model_CotizacionModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
    }//END INIT

    public function cotizacionesAction(){

    }

    public function crearcotizacionAction(){
        $table="gim_subestaciones";
        $this->view->subestaciones = $this->_season->GetAll($table);

        $table="gim_subestaciones_alcances";
        $this->view->subestaciones_alcances = $this->_season->GetAll($table);

        $table="gim_pruebas";
        $this->view->pruebas = $this->_season->GetAll($table);

    }//END INDEX


    public function requestaddcotizacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        var_dump($post);exit;
    }

}