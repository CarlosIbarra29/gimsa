<?php

class Application_Model_TransformadorModel extends Zend_Db_Table_Abstract{


    public function Gettransformadores(){
        try{
            $db = Zend_Db_Table::getDefaultAdapter();
            $qry = $db->query("SELECT gt.ID_TRANSFORMADOR, gt.ID_TIPO, gt.CAPACIDAD_KVA, gt.TENSION, gt.ACTIVO, tt.DESCRIPCION
					FROM GIM_TRANSFORMADORES gt
					INNER JOIN GIM_TRANSFORMADORES_TIPO tt on tt.ID_TIPO");
            $row = $qry->fetchAll();
            return $row;
            $db->closeConnection();
        }catch (Exception $e){
            echo $e;
        }
    }

}