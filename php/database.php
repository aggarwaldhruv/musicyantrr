<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class db{
    
    public function connect($db_name,$db_username,$db_pass)
    {
        
        $link= new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8mb4",
                                            $db_username,
                                            $db_pass,
                                            array(
                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                PDO::ATTR_PERSISTENT => false)
                                        );
         return $link;
    }
    
    
    public function execute($link,$query,$bindings=NULL)
    {
        $handle=$link->prepare($query);
        $handle->execute($bindings);
        return $handle;
    }
}
