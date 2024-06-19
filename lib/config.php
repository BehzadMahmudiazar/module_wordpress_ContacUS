<?php

class Config
{


    public function create_table()
    {
        global $wpdb;
        $sql = "
        CREATE TABLE IF NOT EXISTS {$wpdb->prefix}shno_message_return (
            Id int NOT NULL AUTO_INCREMENT ,
            Name varchar(255),
            Email varchar(255),
            Mobile varchar(255),
            Topic varchar(255),
            discription varchar(255),
            Is_see int DEFAULT(0),
            User_id int,
            PRIMARY KEY (Id)
        ); 
        ";
        $wpdb->get_results($sql);
    }


    public function ShnoContacUS_register($request)
    {
        

       $this->save_message($this->filte_data($request->get_params()));
        wp_safe_redirect(site_url());
        wp_safe_redirect( $_SERVER['HTTP_REFERER']);
        exit();

    }
    public function ShnoContacUS_delete()
    {
        echo "delete";
    }


    public function all_Routers()
    {
        register_rest_route(
            'ShnoContacUS',
            '/register',
            array(
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => array($this, 'ShnoContacUS_register'),
            )
        );

        register_rest_route(
            'ShnoContacUS',
            '/delete',
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this, 'ShnoContacUS_delete'),
            )
        );
    }






    public function Check($file)
    {
        register_activation_hook($file, array($this, 'create_table'));
    }
    public function setRoute()
    {
        add_action('rest_api_init', array($this, 'all_Routers'));

    }



    public function getMessage()
    {
        global $wpdb;
        $sql = "
        select *  from {$wpdb->prefix}shno_message_return ";
        return $wpdb->get_results($sql);

    }
    public function save_message($arr)
    {
        global $wpdb;
        return $wpdb->insert("{$wpdb->prefix}shno_message_return"
        ,$arr);

    }


    public static function getUrlRegister()
    {
        return site_url() . "/wp-json/" . "ShnoContacUS/register";
    }


    public function filte_data($array_input){
        return
        [
        "Name"=>isset($array_input['Name'])?$array_input['Name']:'',
        "Email"=>isset($array_input['Email'])?$array_input['Email']:'',
        "Mobile"=>isset($array_input['Mobile'])?$array_input['Mobile']:'',
        "Topic"=>isset($array_input['Topic'])?$array_input['Topic']:'',
        "discription"=>isset($array_input['discription'])?$array_input['discription']:'',
        "Is_see"=>'0',
        "User_id"=>'2'
        ];

    }




}