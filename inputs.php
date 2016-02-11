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
        
        fclose($file);

        return $input;
    }

}

var_dump(InputFile::fromFile('./cases/mother_of_all_warehouses.in'));

?>