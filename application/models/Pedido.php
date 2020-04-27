<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Model
{
    function informacion($id = 0){
        $informacion    = $this 			-> db
									        //-> order_by("id_proyecto","DESC")
                                            -> where("id_cliente = $id")
							 				-> get('cliente');
		$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }

    function nuevo_pedido($data){
        $result = $this -> db -> insert("pedido", $data);
        return $this -> db -> insert_id();
    }

    function nuevo_vaso_pedido($data){
        $result = $this -> db -> insert("vaso_pedido", $data);
        return $this -> db -> insert_id();
    }

    function nuevo_sabor_pedido($data){
        $result = $this -> db -> insert("sabor_pedido", $data);
        return $this -> db -> insert_id();
    }

    function nuevo_topping_pedido($data){
        $result = $this -> db -> insert("topping_pedido", $data);
        return $this -> db -> insert_id();
    }

    function marcar_pedido($id){
        $data["realizado"]             = 1;
        $result = $this -> db       -> update("pedido", $data, "id = '{$id}'");
    }

    function total_pedido_actualizar($id, $valor){
        $data["valor"]             = $valor;
        $result = $this -> db       -> update("pedido", $data, "id = '{$id}'");
    }

    function todos(){
        $informacion    = $this 			-> db
                                            -> order_by("id","DESC")
							 				-> get('pedido');
		$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }

    function por_fecha($fecha){
        $informacion    = $this 			-> db
                                            -> where('fecha = "' . $fecha . '"')
                                            -> order_by("id","DESC")
    						 				-> get('pedido');
    	$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }

    function por_fecha_cuadre($fecha){
        $informacion    = $this 			-> db
                                            -> where('fecha = "' . $fecha . '" AND realizado = 1')
                                            -> order_by("id","DESC")
    						 				-> get('pedido');
    	$respuesta      = $informacion      -> result_array();
        return $respuesta;
    }
}
?>
