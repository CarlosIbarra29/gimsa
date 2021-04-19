
<?php

class Application_Model_ProductoModel extends Zend_Db_Table_Abstract{

	public function GET_GIM_SUBERTACIONES(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, B.DESCRIPCION AS TIPO, C.DESCRIPCION AS ACTIVO

                    FROM GIM_SUBESTACIONES A

                    JOIN GIM_SUBESTACIONES_TIPO B ON A.ID_TIPO = B.ID_TIPO

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GET_GIM_SUBESTACIONES( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*

                    FROM GIM_SUBESTACIONES A

                    WHERE A.ID_SUBESTACION = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GET_GIM_SUBESTACIONES_TIPO(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.ID_TIPO AS TIPO , A.DESCRIPCION AS CBO_DESCRIPCION FROM GIM_SUBESTACIONES_TIPO A";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GET_GIM_SUBESTACIONES_TIPO_ID( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.ID_TIPO AS TIPO , A.DESCRIPCION AS CBO_DESCRIPCION 

                    FROM GIM_SUBESTACIONES_TIPO A

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


    public function fnUpdateSubestacion( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET DESCRIPCION = ?, ACTIVO = ?  WHERE ID_SUBESTACION = ?", array(

                $post['DESCRIPCION'],

                $post['ACTIVO'],

                $post['ID_SUBESTACION'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_SUBESTACION' => $post['ID_SUBESTACION'] , 'DESCRIPCION' => $post['DESCRIPCION'] );

            }else{

                $aResponse = array('status' => -1, 'ID_SUBESTACION' => $post['ID_SUBESTACION'], 'DESCRIPCION' => $post['DESCRIPCION'] );
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al actualizar');

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

    public function GET_GIM_PLANTAS_EMERGENCIA_ALL(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*,C.DESCRIPCION AS ACTIVO

                    FROM GIM_PLANTAS_EMERGENCIA A

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 


    public function GET_GIM_PLANTAS_EMERGENCIA( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*

                    FROM GIM_PLANTAS_EMERGENCIA A

                    WHERE A.ID_PLANTA = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function fnUpdatePlanta( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET CAPACIDAD = ? , PRECIO = ? , ACTIVO = ?  WHERE ID_PLANTA = ?", array(

                $post['CAPACIDAD'],

                $post['PRECIO'],

                $post['ACTIVO'],

                $post['ID_PLANTA'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_PLANTA' => $post['ID_PLANTA'] , 'CAPACIDAD' => $post['CAPACIDAD'], 'PRECIO' => $post['PRECIO']);

            }else{

                $aResponse = array('status' => -1, 'ID_PLANTA' => $post['ID_PLANTA'], 'CAPACIDAD' => $post['CAPACIDAD'], 'PRECIO' => $post['PRECIO']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al actualizar');

            return $aResponse;
        
        }

    }

    public function GET_GIM_TRANSFORMADORES_ALL(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, B.DESCRIPCION AS TIPO, C.DESCRIPCION AS ACTIVO

                    FROM GIM_TRANSFORMADORES A

                    JOIN GIM_TRANSFORMADORES_TIPO B ON A.ID_TIPO = B.ID_TIPO

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 


    public function GET_GIM_TRANSFORMADORES_TIPO(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.ID_TIPO AS TIPO , A.DESCRIPCION AS CBO_DESCRIPCION FROM GIM_TRANSFORMADORES_TIPO A";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 


    public function GET_GIM_TRANSFORMADORES( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT * FROM GIM_TRANSFORMADORES A WHERE A.ID_TRANSFORMADOR = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function fnUpdateTransformadores( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET CAPACIDAD_KVA = ?, TENSION = ? , ACTIVO = ?  WHERE ID_TRANSFORMADOR = ?", array(

                $post['CAPACIDAD_KVA'],

                $post['TENSION'],

                $post['ACTIVO'],

                $post['ID_TRANSFORMADOR'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_TRANSFORMADOR' => $post['ID_TRANSFORMADOR'] , 'CAPACIDAD_KVA' => $post['CAPACIDAD_KVA'] , 'TENSION' => $post['TENSION']);

            }else{

                $aResponse = array('status' => -1, 'ID_TRANSFORMADOR' => $post['ID_TRANSFORMADOR'], 'CAPACIDAD_KVA' => $post['CAPACIDAD_KVA'] , 'TENSION' => $post['TENSION']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al actualizar');

            return $aResponse;
        
        }

    }

    public function GIM_TABLERO_ALL(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, C.DESCRIPCION AS ACTIVO

                    FROM GIM_TABLERO A

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 


    public function GIM_TABLERO( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT * FROM GIM_TABLERO A WHERE A.ID_TABLERO = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 


    public function fnUpdateTablero( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET DESCRIPCION = ? , SECCION = ? , ACTIVO = ?  WHERE ID_TABLERO = ?", array(

                $post['DESCRIPCION'],

                $post['SECCION'],

                $post['ACTIVO'],

                $post['ID_TABLERO'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_TABLERO' => $post['ID_TABLERO'] , 'SECCION' => $post['SECCION'], 'DESCRIPCION' => $post['DESCRIPCION']);

            }else{

                $aResponse = array('status' => -1, 'ID_TABLERO' => $post['ID_TABLERO'], 'SECCION' => $post['SECCION'], 'DESCRIPCION' => $post['DESCRIPCION']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al actualizar');

            return $aResponse;
        
        }

    }

    public function GIM_BANCO_CAPACITORES_ALL(){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT A.*, C.DESCRIPCION AS ACTIVO

                    FROM GIM_BANCO_CAPACITORES A

                    JOIN GIM_CATALOGO_ESTATUS C ON A.ACTIVO = C.ID_ESTATUS;";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function GIM_BANCO_CAPACITORES( $idTipo ){  
    
        try{
    
            $db = Zend_Db_Table::getDefaultAdapter();

            $sql = "SELECT * FROM GIM_BANCO_CAPACITORES A WHERE A.ID_BANCO = '$idTipo'";
    
            $qry = $db->query( $sql );
    
            $row = $qry->fetchAll();
    
            return $row;
    
            $db->closeConnection();
    
        }catch (Exception $e){
    
            echo $e;
    
        }
    
    } 

    public function fnUpdateBanco( $table, $post ){
        
        try {

            $db = Zend_Db_Table::getDefaultAdapter();

            $result = $db->query("UPDATE $table SET DESCRIPCION = ? , ACTIVO = ?  WHERE ID_BANCO = ?", array(

                $post['DESCRIPCION'],

                $post['ACTIVO'],

                $post['ID_BANCO'],

            ));

            $db->closeConnection();               
            
            if ( $result ) {

                $aResponse = array('status' => 1, 'ID_BANCO' => $post['ID_BANCO'] , 'DESCRIPCION' => $post['DESCRIPCION']);

            }else{

                $aResponse = array('status' => -1, 'ID_BANCO' => $post['ID_BANCO'], 'DESCRIPCION' => $post['DESCRIPCION']);
                
            }

            return $aResponse;
        
        }catch (Exception $e) {
        
            $aResponse = array('status' => -1, 'msj' => 'Ocurrio un error al actualizar');

            return $aResponse;
        
        }

    }


}