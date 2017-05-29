<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Git extends  MY_Controller {

    /**
     * @Author: Codeklerk
     * @Date  : 8th June 2016
     *
     *
     */

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
     
    }
    public function index()
    {
        echo "git";
            $repo = new Cz\Git\GitRepository('c:\xampp\htdocs\ADT');
            // $repo->getBranches();
            // $repo->pull('origin');
            // $repo->pull('origin', array('master'));
            $repo->push('origin', array('master'));


        // $this->home();
    }// developers / api
}
