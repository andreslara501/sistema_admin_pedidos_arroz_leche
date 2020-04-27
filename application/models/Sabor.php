<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sabor extends CI_Model
{
    function todos(){
        $informacion    = $this 			-> db
                                            //-> order_by("topping","ASC")
							 				-> get('sabor');
		$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }
    function estado($id, $estado){
        $data["activo"]             = $estado;
        $result = $this -> db       -> update("sabor", $data, "id = '{$id}'");
        return "ok";
    }

    function actualizar_sabor($id, $descripcion){
        $data["descripcion"]         = $descripcion;
        $result = $this -> db       -> update("sabor", $data, "id = '{$id}'");
        return "ok";
    }

    function nuevo_sabor($descripcion){
        $data["descripcion"]         = $descripcion;
        $result = $this -> db -> insert("sabor", $data);
        return $this -> db -> insert_id();
    }

    function eliminar_sabor($id){
        $this->db->where('id', $id);
        $this->db->delete('sabor');
    }
}
?>
