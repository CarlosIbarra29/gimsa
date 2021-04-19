<?php

class Application_Model_CatalogoModel extends Zend_Db_Table_Abstract{

	public function GET_GIM_CATALOGO_SERVICIOS(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, C.DESCRIPCION AS ACTIVO

                    FROM GIM_CATALOGO_SERVICIOS A 

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GET_GIM_CATALOGO_SERVICIOS_TIPO( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, B.DESCRIPCION AS CATEGORIA FROM GIM_CATALOGO_SERVICIOS A

                    JOIN GIM_CATALOGO_SERVICIOS_TIPO B ON A.ID_TIPO = B.ID_TIPO

                    WHERE A.ID_TIPO = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function SET_GIM_CATALOGO_SERVICIOS_TIPO(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.ID_TIPO AS TIPO , A.DESCRIPCION AS CBO_DESCRIPCION FROM GIM_CATALOGO_SERVICIOS_TIPO A";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function fnInsert( $table, $post ) {

        try {
            
            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->insert($table, $post);

            $db->closeConnection();  

            if ( $result ) {

                $aResponse = array('status' => 1);

            }else{

                $aResponse = array('status' => -1);
                
            }

            return $aResponse;

        } catch (Exception $e) {

            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al insertar');

            return $aResponse;

        }

    }


    public function fnUpdate( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET NOMBRE = ? , DESCRIPCION = ? , ACTIVO = ?  WHERE ID_TIPO = ?", array(

                $post['NOMBRE'],

                $post['DESCRIPCION'],

                $post['ACTIVO'],

                $post['ID_TIPO'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_TIPO' => $post['ID_TIPO'], 'NOMBRE' =>  $post['NOMBRE'] , 'DESCRIPCION' => $post['DESCRIPCION']);

            }else{

                $aResponse = array('status' => -1, 'ID_TIPO' => $post['ID_TIPO'], 'NOMBRE' =>  $post['NOMBRE'] , 'DESCRIPCION' => $post['DESCRIPCION']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al insertar');

            return $aResponse;
        
        }

    }


    public function deleteAll( $id, $table, $wh ){

        try {

            $db = Zend_Db_Table::getDefaultAdapter();
            
            $result =  $db->query ("DELETE from $table where $wh = ? ",array($id));
            
            $db->closeConnection();

            if ( $result ) {

                $aResponse = array('status' => 1);

            }else{

                $aResponse = array('status' => -1);
                
            }
            
            return $aResponse;
        
        } catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error');

            return $aResponse;
        
        }
    
    }

}