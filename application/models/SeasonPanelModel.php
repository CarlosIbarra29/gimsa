<?php

class Application_Model_SeasonPanelModel extends Zend_Db_Table_Abstract{
	
    public function insertProveedor($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'nombre_prov'=>$post['name'],
                'telefono'=>$post['phone'],
                'rfc'=>$post['rfc'],
                'datos_banco'=>$post['banco'],
                'cuenta'=>$post['cuenta'],
                'tarjeta'=>$post['tarjeta'],
                'titular'=>$post['titular'],
                'email'=>$post['email'],
                'periodo_pago'=>$post['periodo_pago']
            ); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT USER

    public function insertProyecto($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'nombre_proyecto'=>$post['name'],
                'descripcion'=>$post['desc']); 
            $res = $db->insert($table, $datasave);
            $db->closeConnection();               
            return $res;
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT USER

    public function insertsitio($post,$latitude,$longitude,$conversion_lat,$conversion_lon,$table){
            if($post['coordenada1'] == "s"){
                $lat= "-".$latitude;
            }else{
                $lat = $latitude;
            }

            if($post['coordenada2'] == "o"){
                $long = "-".$longitude;
            }else{
                $long = $longitude;
            }

        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $datasave = array(
                'id_cliente'=>$post['id_cliente'],
                'nombre'=>$post['name'],
                'cliente'=>$post['cliente'],
                'direccion'=>$post['direccion'],
                'ciudad'=>$post['ciudad'],
                'estado'=>$post['estado'],
                'region'=>$post['region'],
                'estructura'=>$post['estructura'],
                'edificio'=>$post['edificio'],
                'tipo_sitio'=>$post['tipo_sitio'],
                'altura'=>$post['altura'],
                'latitude'=>$lat,
                'coor_lat'=>$post['coordenada1'],
                'conv_lat'=>$conversion_lat,
                'conv_lon'=>$conversion_lon,
                'coor_lon'=>$post['coordenada2'],
                'longitude'=>$long); 
            $res = $db->insert($table, $datasave);
            $id=0;
            if($res)
            $id=$db->lastInsertId();
            $db->closeConnection();               
            return $id;
        } catch (Exception $e) {
            echo $e;
        }       
    }



    public function insertsitio_tipoproyecto($id,$wh,$table,$post){
        try {
            $res = 0;
            foreach ($post as $key=>$row) {
                
                if($key!='id_cliente' && $key!='name' && $key!='cliente' && $key!='ciudad' && $key!='estado'
                    && $key!='region' && $key!='estructura' && $key!='altura' && $key!='latitude' && $key!='longitude'){
                    $db = Zend_Db_Table::getDefaultAdapter();
                    $datasave = array(
                                   'id_sitio'=>$id,
                                   'id_tipoproyecto'=>$row);
                    $res = $db->insert($table, $datasave);
                    $db->closeConnection();                    
                }
            }
                    return $res;       
        } catch (Exception $e) {
            echo $e;
        }
    }// END INSERT SITIO



    public function refreshProveedor($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET nombre_prov = ?, telefono = ?,rfc = ?,datos_banco = ?,cuenta = ?, tarjeta =?, titular =?, email = ?, periodo_pago=? WHERE id = ?",array(
                $post['name'],
                $post['phone'],
                $post['rfc'],
                $post['datos_banco'],
                $post['cuenta'],
                $post['tarjeta'],
                $post['titular'],
                $post['email'],
                $post['periodo_pago'],
                $post["ids"]));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE USER

    public function refreshSitio($post,$longitude,$latitude,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET id_cliente = ?, nombre = ? , direccion = ?, cliente =?, ciudad = ? , estado = ?, region = ?, estructura = ?, edificio = ?, tipo_sitio = ? ,altura = ?, latitude = ?, longitude = ? WHERE id = ?",array(
                $post['id_cliente'],
                $post['nombre'],
                $post['direccion'],
                $post['cliente'],
                $post['ciudad'],
                $post['estado'],
                $post['region'],
                $post['estructura'],
                $post['edificio'],
                $post['tipo_sitio'],
                $post['altura'],
                $latitude,
                $longitude,
                $post["ids"]));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE USER


    public function refreshProyecto($post,$table){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET nombre_proyecto = ?, descripcion = ? WHERE id = ?",array(
                $post['name'],
                $post['desc'],
                $post["ids"]));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }// END UPDATE USER


    public function UpdateUsrSession($post,$table,$wh,$id){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("UPDATE $table SET nombre = ? , ap = ? , am = ? , direccion = ? , telefono = ? , correo = ? WHERE $wh = ?",array(
                $post['name'],
                $post['apa'],
                $post['ama'],
                $post['dir'],
                $post['phone'],
                $post['mail'],
                $id));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateUsrPassw($post,$table,$wh){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $cripted = openssl_digest($post['pword'],"sha512");
            $qry = $db->query("UPDATE $table SET passw = ? WHERE $wh = ?",array($cripted,$post['id']));
            $db->closeConnection();               
            return $qry;
        } 
        catch (Exception $e) {
            echo $e;
        }
    }
	
	// --------------------------------DELETS

	public function deleteAll($id,$table,$wh){
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $var =  $db->query ("DELETE from $table where $wh = ? ",array($id));
            $db->closeConnection();
            return $var;
        } catch (Exception $e) {
            echo $e;
        }
    }//deleteUsr

    // --------------------------------GET

	public function GetAll($table){
		 try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table");
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
	}

    public function GetSpecific($table,$wh,$id){
         try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT * FROM $table WHERE $wh = ?",array($id));
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }

    // --------------------------------Login

    public function Validar($post){

        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $p = openssl_digest($post["passw"],"sha512");
            $valiu = $db->query("SELECT * FROM usuario WHERE correo = ? and passw = ?",
        array(
            $post["mail"],
            $p));       
        $row = $valiu->fetchAll();             
                    $db->closeConnection();               
                    return $row;
        } catch (Exception $e) {
            echo $e;
        }//end try and catch
    }//fin de validar

    public function Correonet($table){
         try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT nombre,ap,correo FROM $table order by ID DESC limit 1");
            $row = $qry->fetchAll();
            $db->closeConnection();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    } 
}