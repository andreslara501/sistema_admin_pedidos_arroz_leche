<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topping extends CI_Model
{
    function todos(){
        $informacion    = $this 			-> db
                                            //-> order_by("topping","ASC")
							 				-> get('topping');
		$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }

    function estado($id, $estado){
        $data["activo"]             = $estado;
        $result = $this -> db       -> update("topping", $data, "id = '{$id}'");
        return "ok";
    }

    function actualizar_topping($id, $descripcion){
        $data["descripcion"]         = $descripcion;
        $result = $this -> db       -> update("topping", $data, "id = '{$id}'");
        return "ok";
    }

    function nuevo_topping($descripcion){
        $data["descripcion"]         = $descripcion;
        $result = $this -> db -> insert("topping", $data);
        return $this -> db -> insert_id();
    }

    function eliminar_topping($id){
        $this->db->where('id', $id);
        $this->db->delete('topping');
    }
}
?>
