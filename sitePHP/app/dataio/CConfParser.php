<?php
// подключаем интерфейс парсера
require_once("IConfParser.php");


abstract class CConfParser implements IConfParser
{
    protected $source; // будет содержать путь до файла
    protected $params = array();
    public function __construct($source)
    {
        $this->source = $source;
    }
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->setParam($name, $value);
    }
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->getParam($name);
    }

    public function getParam($key) {
        return $this->params[$key];
    }
    public function getAllParams() {
        return $this->params;
    }
    public function setParam($key, $value) {
        $this->params[$key] = $value;
    }
    public function setAllParams($values) {
        foreach($values as $k => $val) {
            $this->params[$k] = $val;
        }
    }
    static public function getInstance($filename)
    {
        // TODO: Implement getInstance() method.
        if(preg_match('~\.xml$~i', $filename)) {
            return false;
        }
        if(preg_match('~\.yaml$~i', $filename)) {
            return new CYamlParser($filename);
        }
        return new CTextConfParser($filename);
    }
}
require_once("CTextConfParser.php");
require_once("CYamlParser.php");
