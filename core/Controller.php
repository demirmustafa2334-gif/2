<?php
namespace Core;

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
