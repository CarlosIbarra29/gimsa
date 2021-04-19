<?php

class Application_Model_SubestacionModel extends Zend_Db_Table_Abstract{

    public function insertsubestacion($post,$table){
        $activo = 1;
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'ID_TIPO'=>$post['tipo'],
                'DESCRIPCION'=>$post['descripcion'],
                'ACTIVO'=>$activo); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function inserttiposubestacion($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'DESCRIPCION'=>$post['descripcion']); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertalcance($post,$table){
        $activo = 1;
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'DESCRIPCION'=>$post['descripcion'],
                'ACTIVO'=>$activo
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    } 

    public function insertpruebas($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'DESCRIPCION'=>$post['descripcion'],
                'PRUEBA'=>$post['prueba']
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    } 

    public function insertsecciones($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'NOMBRE'=>$post['nombre'],
                'DESCRIPCION'=>$post['descripcion'],
                'MONTO'=>$post['monto'],
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertseccionesoption($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'ID_SECCION'=>$post['ids'],
                'DESCRIPCION'=>$post['descripcion']
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }   
    }

    public function Getpaginationsubestacion($table,$offset,$no_of_records_per_page){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT gs.ID_SUBESTACION, gs.ID_TIPO, gs.DESCRIPCION, gs.ACTIVO, gst.DESCRIPCION as TIPONAME
							FROM GIM_SUBESTACIONES gs
							LEFT JOIN GIM_SUBESTACIONES_TIPO gst on gst.ID_TIPO = gs.ID_TIPO LIMIT $offset,$no_of_records_per_page");
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

    public function Getallpaginator($table,$offset,$no_of_records_per_page){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table LIMIT $offset,$no_of_records_per_page");
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

    public function Getspecificpaginator($table,$wh,$id,$offset,$no_of_records_per_page){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table where $wh = ? LIMIT $offset,$no_of_records_per_page",array($id));
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

}