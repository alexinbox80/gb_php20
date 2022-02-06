<?php

class UserController extends Controller
{
    function index($data){

        echo "UserController: <br>\n";

        var_dump($data['page']);

    }

}