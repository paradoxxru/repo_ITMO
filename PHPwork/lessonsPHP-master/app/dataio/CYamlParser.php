<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.01.2019
 * Time: 18:21
 */
function e($str) {
        echo "<pre>" . $str . "</pre>";
    }

class CYamlParser extends CConfParser
{
    private $lines;
    private $i;
    private $total_lines;
    public function read()
    {
        $this->lines = file($this->source);
        $this->total_lines = count($this->lines);
        for($this->i = 0; $this->i < $this->total_lines; $this->i++) {
            $line = trim($this->lines[$this->i]);
            $vals = explode(':', $line);
            $this->setParam($vals[0], $this->getValue(trim($vals[1]), 0));
        }
    }
    private function getValue($val, $level)
    {
        if(empty($val)) {
            $val = [];
            for($this->i++;$this->i < $this->total_lines; $this->i++)
            {
                $line = $this->lines[$this->i];
                preg_match_all("/^([\t]*)/", $line, $matches);
                if(!isset($matches[0][0]) || strlen($matches[0][0]) <= $level) {
                    $this->i--;
                    return $val;
                }
                $vals = explode(':', trim($line));
                $new_level = $level + 1;
                $val[$vals[0]] = $this->getValue(trim($vals[1]), ($level + 1));
            }
            return $val;
        } else {
            return $val;
        }
    }
    public function write()
    {
        $this->lines = [];
        foreach($this->params as $key => $val) {
            $this->valueToYaml($key, $val);
        }
        $text = implode("\n", $this->lines);
        file_put_contents($this->source, trim($text));
    }
    private function valueToYaml($key, $val, $indent = "")
    {
        print_r($val);
        if(is_array($val) || is_object($val)) {
            $this->lines[] = $indent . $key . ":";
            foreach($val as $k => $v) {
                $this->valueToYaml($k, $v, ($indent . "\t"));
            }
        } else
        {
            $this->lines[] = $indent . $key . ": " . $val;
        }
    }
}