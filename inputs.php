<?php

class InputFile
{
    private static function splitstring($string)
    {
        $parts = explode(' ', $string);
        return $parts;
    }

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
            array (
                'warehouse_coord' => array(
                    array(
                        'row'=>0,
                        'col'=>0
                    )
                ),
                'warehouse_product_count' => array() //size = $input['products']
            )
        );

        //orders
        $input['orders'] = 0;
        $input['order_details'] = array(
            array (
                'delivery_coord' => array(
                    array(
                        'row'=>0,
                        'col'=>0
                    )
                ),
                'item_count' => 0,
                'product_types' => array() //size = item_count
            )
        );

        return $input;
    }

    public static function fromFile($path)
    {
        $input = array();

        $file = fopen($path, 'r');
        //simulation parameters
        $sim_pars = fgets($file);
        $sim_pars_parts = Self::splitstring($sim_pars);

        if (count($sim_pars_parts) == 5)
        {
            //simulation
            $input['rows'] = $sim_pars_parts[0];
            $input['cols'] = $sim_pars_parts[1];
            $input['drones'] =  $sim_pars_parts[2];
            $input['deadline'] =  $sim_pars_parts[3];
            $input['maxload'] =  $sim_pars_parts[4];
        }

        //products
        $input['products'] = fgets($file);
        $input['product_weights'] = Self::splitstring(fgets($file));

        //warehouses
        $input['warehouses'] = fgets($file);
        $input['warehouse_details'] = array();
        for ($i = 0; $i < $input['warehouses']; $i++)
        {
            $wh_coord_parts = Self::splitstring(fgets($file));
            $wh_product_count_parts = Self::splitstring(fgets($file));

            $input['warehouse_details'][] = 
                array (
                    'warehouse_coord' => array(
                        array(
                            'row'=>$wh_coord_parts[0],
                            'col'=>$wh_coord_parts[1]
                        )
                    ),
                    'warehouse_product_count' => $wh_product_count_parts //size = $input['products']
                );
        }

        //orders
        $input['orders'] = fgets($file);
        $input['order_details'] = array();
        for ($i = 0; $i < $input['orders']; $i++)
        {
            $order_coord_parts = Self::splitstring(fgets($file));
            $input['order_details'][] = 
                array (
                    'delivery_coord' => array(
                        array(
                            'row'=>$order_coord_parts[0],
                            'col'=>$order_coord_parts[1]
                        )
                    ),
                    'item_count' => fgets($file),
                    'product_types' => Self::splitstring(fgets($file))
                );
        }
        
        fclose($file);

        return $input;
    }

}


$structure = InputFile::fromFile('./cases/mother_of_all_warehouses.in');

var_dump(json_encode($structure));


/*var_dump(json_encode($structure['orders']));
var_dump(json_encode($structure['order_details']));*/

?>