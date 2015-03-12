<?php

class functions {

    public function createQuery($var1, $var2, $var3){

        $query = "SELECT * FROM room WHERE projector = $var1 AND whiteboard = $var2 AND roomsize = $var3";

        return $query;
    }
}