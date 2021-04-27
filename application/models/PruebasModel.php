<?php

class Application_Model_PruebasModel extends Zend_Db_Table_Abstract{

	public function GIM_PRUEBAS_ALL( $idAlcance ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, C.DESCRIPCION AS ACTIVO, B.DESCRIPCION AS SERVICIO

                    FROM GIM_PRUEBAS A 

                    JOIN GIM_CATALOGO_SERVICIOS_TIPO B ON A.ID_TIPO = B.ID_TIPO

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS

                    WHERE A.ID_TIPO = '$idAlcance';";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GIM_PRUEBAS_TIPO( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*

                    FROM GIM_PRUEBAS A

                    WHERE A.ID_PRUEBA = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function SET_GIM_CATALOGO_SERVICIOS_TIPO( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.ID_TIPO AS TIPO , A.DESCRIPCION AS CBO_DESCRIPCION 

                    FROM GIM_CATALOGO_SERVICIOS_TIPO A

                    WHERE A.ID_TIPO = '$idTipo'";
    
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

            $result = $db->query("UPDATE $table SET DESCRIPCION = ?, PRUEBA = ? , ACTIVO = ?  WHERE ID_PRUEBA = ?", array(

                $post['DESCRIPCION'],

                $post['PRUEBA'],

                $post['ACTIVO'],

                $post['ID_PRUEBA'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_PRUEBA' => $post['ID_PRUEBA'], 'DESCRIPCION' => $post['DESCRIPCION'], 'PRUEBA' => $post['PRUEBA']);

            }else{

                $aResponse = array('status' => -1, 'ID_PRUEBA' => $post['ID_PRUEBA'], 'DESCRIPCION' => $post['DESCRIPCION'], 'PRUEBA' => $post['PRUEBA']);
                
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