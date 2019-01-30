<?php

//require_once("IConfParser.php");
interface IConfParser
{
    static public function getInstance($filename);
    public function read();
    public function write();
    public function getParam($key);
    public function getAllParams();
    public function setParam($key, $value);
    public function setAllParams($values);
}