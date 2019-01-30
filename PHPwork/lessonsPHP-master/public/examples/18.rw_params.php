<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 15.01.2019
 * Time: 18:48
 */


interface IConfParser {
    static public function getInstance($filename);
    public function read();
    public function write();
    public function getParam($key);
    public function getAllParams();
    public function setParam($key, $value);
    public function setAllParams($values);
}

abstract class CConfParser implements IConfParser {
    protected $source;
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
        return new CTextConfParser($filename);
    }
}


class CTextConfParser extends CConfParser {
    public function read()
    {
        // TODO: Implement read() method.
        // todo открыть файл
        // todo прочитать файл
        // todo разбить текст по строкам
        // todo итерировать массив
        // todo * разбить строку по символу ":"
        // todo * добавить в параметры новый элемент
        $lines = file($this->source);
        foreach($lines as $line) {
            $line = trim($line);
            $vals = explode(':', $line);
            $this->setParam($vals[0], $vals[1]);
        }
    }
    public function write()
    {
        // TODO: Implement write() method.
        // todo: Из массива параметров получить массив строк
        // todo: Строки объединить в текст
        // todo: Записать текст в файл
        $lines = array();
        foreach($this->params as $key => $val) {
            $lines[] = $key . ':' . $val;
        }
        $text = implode("\n", $lines);
        file_put_contents($this->source, trim($text));
    }
}