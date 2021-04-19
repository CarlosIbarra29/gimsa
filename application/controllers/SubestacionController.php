<?php
class SubestacionController extends Zend_Controller_Action{
	private $_season;
    private $_session;
    private $_user;
    private $_subestacion;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_panel = new Application_Model_GpsPanelModel;
        $this->_subestacion = new Application_Model_SubestacionModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
    }//END INIT

    public function subestacionesAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="GIM_SUBESTACIONES_TIPO";
        $this->view->tipo_subestaciones= $this->_season->GetAll($table);


        $table="GIM_SUBESTACIONES";
        $subestaciones = $this->_season->GetAll($table);	
        $count=count($subestaciones);

        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
        $this->view->paginator= $this->_subestacion->Getpaginationsubestacion($table,$offset,$no_of_records_per_page);
    }

    public function tiposubestacionAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="GIM_SUBESTACIONES_TIPO";
        $subestaciones = $this->_season->GetAll($table);	
        $count=count($subestaciones);

        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
       	$this->view->paginator= $this->_subestacion->Getallpaginator($table,$offset,$no_of_records_per_page);
    }

    public function alcancessubesatcionAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="GIM_ALCANCES";
        $subestaciones = $this->_season->GetAll($table);	
        $count=count($subestaciones);

        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
       	$this->view->paginator= $this->_subestacion->Getallpaginator($table,$offset,$no_of_records_per_page);
    }

    public function pruebassubestacionAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="GIM_PRUEBAS";
        $subestaciones = $this->_season->GetAll($table);	
        $count=count($subestaciones);

        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
       	$this->view->paginator= $this->_subestacion->Getallpaginator($table,$offset,$no_of_records_per_page);
    }

    public function seccionessubestacionAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="gim_subestaciones_secciones";
        $subestaciones = $this->_season->GetAll($table);	
        $count=count($subestaciones);

        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
       	$this->view->paginator= $this->_subestacion->Getallpaginator($table,$offset,$no_of_records_per_page);
    }

    public function agregarcontenidoAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

    	$id=$this->_getParam('id');
    	$this->view->id_seccion=$id;
        $table="gim_subestaciones_secciones";
        $wh="ID_SECCION";
        $op =$this->view->seccion = $this->_season->GetSpecific($table,$wh,$id);

        $table="gim_subestaciones_seccionesop";
        $subestaciones = $this->_season->GetSpecific($table,$wh,$op[0]['ID_SECCION']);
        $count=count($subestaciones);


        if (isset($_GET['pagina'])) { $pagina = $_GET['pagina']; } else { $pagina= $this->view->pagina = 1; } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
       	$ver = $this->view->paginator= $this->_subestacion->Getspecificpaginator($table,$wh,$op[0]['ID_SECCION'],$offset,$no_of_records_per_page);   
    } 

    public function requestaddsubestacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        $table="GIM_SUBESTACIONES";
        $result = $this->_subestacion->insertsubestacion($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/subestaciones');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }
    }


    public function requestaddtiposubestacionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $table="GIM_SUBESTACIONES_TIPO";
        $result = $this->_subestacion->inserttiposubestacion($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/tiposubestacion');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }
    }    


    public function requestaddalcanceAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        
        $table="GIM_ALCANCES";
        $result = $this->_subestacion->insertalcance($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/alcancessubesatcion');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }
    }


    public function requestaddpruebasAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        $table="GIM_PRUEBAS";
        $result = $this->_subestacion->insertpruebas($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/pruebassubestacion');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }
    }

    public function requestaddseccionAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        $table ="gim_subestaciones_secciones";
        $result = $this->_subestacion->insertsecciones($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/seccionessubestacion');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }
    }

    public function requestaddopcionseccionAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

        $table ="gim_subestaciones_seccionesop";
        $result = $this->_subestacion->insertseccionesoption($post,$table);

        if ($result) {
            return $this-> _redirect('/subestacion/agregarcontenido/id/'.$post['ids'].'');
        }else{
            print '<script language="JavaScript">'; 
            print 'alert("Ocurrio un error: Comprueba los datos.");'; 
            print '</script>'; 
        }

    }

    public function requestdeletesubestacionAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

            $id =  $post['id'];
            $table = $post['table'];
            $wh = $post['where'];
            $result = $this->_season->deleteAll($id,$table,$wh);

        if ($result) {
            echo json_encode(array('status' => "1","message"=>"Se ha agregado correctamente", "data"=>$post));   
        }else{
            print '<script language="JavaScript">';
            print 'alert("Ocurrio un error: Comprueba los datos.");';
            print '</script>';
        }
  
    }//END REQUEST DELETE TODO


}