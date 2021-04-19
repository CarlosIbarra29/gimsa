<?php
class TransformadorController extends Zend_Controller_Action{
	private $_season;
    private $_session;
    private $_user;
    private $_subestacion;
    private $_trasnformador;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_trasnformador = new Application_Model_TransformadorModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
    }//END INIT

    public function transformadoresAction(){
        
    }

}