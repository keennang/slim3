<?php

namespace Controllers;

class Controller
{
    protected $container;
    protected $view;
    protected $logger;
    protected $db;
    protected $mail;

    public function __construct($container) {
        $this->container = $container;
        $this->view = $container->get("view");
        $this->logger = $container->get("logger");
        $this->db = $container->get("db");
        $this->mail = $container->get("mail");
    }
}