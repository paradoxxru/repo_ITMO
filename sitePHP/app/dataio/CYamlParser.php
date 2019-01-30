<?php


function e($str) {
        echo "<pre>" . $str . "</pre>";
    }

class CYamlParser extends CConfParser
{
    private $lines; // массив строк
    private $i; // счетчик
    private $total_lines; //длина массива строк
    public function read()
    {
        //echo "читаем файл"; echo "<br>";
        $this->lines = file($this->source); // $this->source от родительского класса(это путь до файла)
        //то есть $lines это массив строк
        // echo "массив lines: "; echo "<br>";
        // echo "<pre>",
        // print_r($this->lines),
        // '</pre>';
        $this->total_lines = count($this->lines); // длина массива строк
        //echo "длина массива lines: ".$this->total_lines;
        for($this->i = 0; $this->i < $this->total_lines; $this->i++) {
            // echo "выводим счетчик i: ".$this->i;echo "<br>";
            $line = trim($this->lines[$this->i]); //каждой строке обрезаем пробелы(с конца и начала)
            // echo "вывод ".$this->i."-го элемента массива: ".$this->lines[$this->i];echo "<br>";
            // echo "строка массива lines: ";echo "<br>";
            // echo "<pre>",
            // print_r($line,true),
            // "</pre>";
            $vals = explode(':', $line);//разбивает строку на подстроки по символу($vals это массив с двумя значениями - до : и посте)
            // echo "вывод массива vals: ";echo "<br>";
            // echo "<pre>",
            // var_dump($vals),
            // "</pre>";
            $this->setParam($vals[0], $this->getValue(trim($vals[1]), 0));
            // setParam - метод, который заполняет массив $params(есть у этого класса от родительского) значениями
            // в данном случает $vals[0] - будет ключем, а $this->getValue(trim($vals[1]), 0) - его значением

            // в итоге поле params(массив $params), у объекта класса CYamlParser, будет массив - ключами будут каждая девятая строка из файла('0', '1', ...'49'), а значениями будут ассоц. массивы, состоящие из восьми элементов ( ["weight"]=>"4" , ["name"]=>"Подхуд над пер" , ["img"]=>"im5.svg" и тд )
        }
        // echo "массив params : ";echo "<br>";
        // echo "<pre>";
        // var_dump($this->params);
        // echo "</pre>";
    }
    //ф-ция 
    private function getValue($val, $level)
    {
        if(empty($val)) {
            $val = [];
            for($this->i++;$this->i < $this->total_lines; $this->i++)
            {
                $line = $this->lines[$this->i];
                preg_match_all("/^([\t]*)/", $line, $matches); // это "/^([\t]*)/" регулярное выражение
                // где / / границы выражения; ^ - означает искать с начала строки; скобки () -обозначают искомое множество, т.е. все найденные множества, соответствующие описанию в этих скобках, будут возвращены в качестве результата; [ ] - здесь указывается из чего множество может состоять, из каких символов; \t - знак табуляции; * - встречается 0 и более раз.
                // таким образом данное выражение значит - найти с начала строки все знак/знаки табуляции, которые могут встречаться 0 или более раз.
                // В двумерном массиве $matches будут: ????
                
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