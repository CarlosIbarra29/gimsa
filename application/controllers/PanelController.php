<?php
class PanelController extends Zend_Controller_Action{

	private $_season;
    private $_session;
    private $_user;
    private $_epp;
    
    public function init(){
        $this->_season = new Application_Model_SeasonPanelModel;
        $this->_session = new Zend_Session_Namespace("current_session");
        $this->_user = new Application_Model_GpsUserModel;
        $this->_panel = new Application_Model_GpsPanelModel;

        if(empty($this->_session->id)){
            $this->redirect('/home/login');
        }
        $id=$this->_session->id;
        $wh="id";
        $table="usuario";
        $usr = $this->_season->GetSpecific($table,$wh,$id);
        foreach ($usr as $key) {
           $fk=$key['fkroles'];
        }
    }//END INIT

    // ----------------------   INDEX  --------------------------//

    public function indexAction(){

    }//END INDEX

    public function loginAction(){
        $table="usuario";
        $this->view->admin = $this->_season->GetAll($table);
    }// END LOGIN

    // ----------------------   USUARIOS  --------------------------//
    public function usuariosAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;

        $table="roles";
        $this->view->rol = $this->_season->GetAll($table);
        $table="usuario";
        $usuarios=$this->_season->GetAll($table);
        $count=count($usuarios);

        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        } else {
            $pagina= $this->view->pagina = 1;
        } 

        $no_of_records_per_page = 15;
        $offset = ($pagina-1) * $no_of_records_per_page; 
        $total_pages= $count;

        $this->view->totalpage = $total_pages;
        $this->view->total=ceil($total_pages/$no_of_records_per_page);
        $table="usuario";
        $sql= $this->view->paginator= $this->_user->Getpaginationuser($table,$offset,$no_of_records_per_page);
    }//usuariosAction

    public function usuarioseditAction(){
    	if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $this->view->usuarios = $this->_season->GetSpecific($table,$wh,$id);

            $table="roles";
            $this->view->rol = $this->_season->GetAll($table);
        }else {
            return $this-> _redirect('/');
        }
    }//END USUARIOS


    public function usuariodetailAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $this->view->usuarios = $this->_season->GetSpecific($table,$wh,$id);
            $this->view->id_personal=$id;
        }else {
            return $this-> _redirect('/');
        }
    }//END USUARIOS

    public function userrolAction(){
        $table="roles";
        $this->view->roles = $this->_season->GetAll($table);      
    }

    public function roleseditAction(){
        if($this->_hasParam('id')){
            $id = $this->_getParam('id');
            $table="roles";
            $wh="id";
            $this->view->roles = $this->_season->GetSpecific($table,$wh,$id);
        }else {
            return $this-> _redirect('/');
        }   
    }


    public function searchusuariosAction(){
        $actualpagina=$this->_getParam('pagina');
        $this->view->actpage=$actualpagina;
        if($this->_hasParam('nombre')){
            $user = $this->_getParam('nombre');
            $nombre = strstr($user, '?', true); 
            if($nombre == false){
                $name = $this->_getParam('nombre');
            }else{
                 $name = strstr($user, '?', true); 
            }

            $this->view->name_search=$name;
            $usuarios=$this->_user->usernombre($name);
            $count=count($usuarios); 
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            } else {
                $pagina= $this->view->pagina = 1;
            } 

            $no_of_records_per_page = 15;
            $offset = ($pagina-1) * $no_of_records_per_page; 
            $total_pages= $count;

            $this->view->totalpage = $total_pages;
            $this->view->total=ceil($total_pages/$no_of_records_per_page);
            $sql= $this->view->paginator= $this->_user->usuariocount($name,$offset,$no_of_records_per_page);
        }
    }

    // --------------   REQUEST ADD USER--------------------//

    public function requestadduserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();

            $id=$post["mail"];
            $table="usuario";
            $wh="correo";
            $usuario= $this->_season->GetSpecific($table,$wh,$id);

            if($usuario != null){
                return $this-> _redirect('/panel/errorusuario/correo/'.$post["mail"].' ');
            }

        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_user->insertUsr($post,$table);

            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }//END REQUEST ADD USER



 
 
    // -------------------   REQUEST EDIT USER----------------------------//

    public function requestupdateuserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        $id=$post["mail"];
        $table="usuario";
        $wh="correo";
        $usuario= $this->_season->GetSpecific($table,$wh,$id);

        if($this->getRequest()->getPost()){
            $table="usuario";
            $result = $this->_user->refreshUsr($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }//REUQUEST EDIT USER


    public function requestupdatenamerolAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();
        if($this->getRequest()->getPost()){
            $table="roles";
            $result = $this->_user->refresnamerol($post,$table);
            if ($result) {
                return $this-> _redirect('/panel/userrol');
            }else{
                print '<script language="JavaScript">'; 
                print 'alert("Ocurrio un error: Comprueba los datos.");'; 
                print '</script>'; 
            }
        }
    }//REUQUEST EDIT USER


    public function requestuodatepersonalAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $post = $this->getRequest()->getPost();  
        $id=$post["mail"];
    } 


    public function requestdeleteallAction(){
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $result = $this->_season->deleteAll($id,$table,$wh);
            if ($result) {
                return $this-> _redirect('/panel/usuarios');
            }
        } else {
            return $this-> _redirect('/panel');
        }    
    }//END REQUEST DELETE TODO


    public function requestdeletealluserAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_hasParam('id')){
            $id =  $this->_getParam('id');
            $table="usuario";
            $wh="id";
            $imagen=$this->_season->GetSpecific($table,$wh,$id);
            foreach ($imagen as $img => $val) {
                $url=$val['imagen'];
                
                if (file_exists($url)) {
                    unlink($url);
                    if (!empty($imagen)&&!empty($id)) {
                        $this->_season->deleteAll($id,$table,$wh);
                        return $this-> _redirect('/panel/usuarios');
                    }else {
                        return $this-> _redirect('/panel');
                    }   
                }else{
                    $this->_season->deleteAll($id,$table,$wh); 
                    return $this-> _redirect('/panel/error404');
                }               
            }   
        }
    }




    public function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
    }//END FUNCION DE TAMA??O DE IMAGEN
    
        public function randomnamebts(){

            $ran =  rand();
            return 'bts-wk1-'.$ran;

        }//fin de random WK 1

        public function randomnamebtswkdos(){

            $ran =  rand();
            return 'bts-wk2-'.$ran;

        }//fin de random WK 2

        public function randomnamebtswktres(){

            $ran =  rand();
            return 'bts-wk3-'.$ran;

        }//fin de random WK 3

        public function randomnamebtswkcuatro(){

            $ran =  rand();
            return 'bts-wk4-'.$ran;

        }//fin de random WK 4

}//FINAL DEL PANEL