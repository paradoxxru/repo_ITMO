<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 16.01.2019
 * Time: 22:18
 */


class CTextConfParser extends CConfParser
{
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