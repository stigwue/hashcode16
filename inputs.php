<?php

class InputFile
{

    public static function Initialise()
    {
        $input = array();

        //simulation
        $input['rows'] = 0;
        $input['cols'] = 0;
        $input['drones'] = 0;
        $input['deadline'] = 0;
        $input['maxload'] = 0;

        //products
        $input['products'] = 0;
        $input['product_weights'] = array();

        //warehouses
        $input['warehouses'] = 0; //2
        $input['warehouse_details'] = array(
            'warehouse_coord' => array(
                array(
                    'row'=>0,
                    'col'=>0
                )
            ),
            'warehouse_product_count' => array() //size = $input['products']
        }

        //orders
        $input['orders'] = 0;
        $input['order'] = 0;
    }

}

?>