<?php
namespace app\product;

class WordGenerator
{
    const ALPHABET = "aeyuioqwrtpsdfghjklzxcvbnm";
    const ALPHABET_LEN = 26;
    const ALPHABET_VOWEL_LEN = 6;

    const ULP = 0b101; // Upper Lower Point - первая буква в верхнем регистре, остальные - в нижнем, в конце - точка.
    const LLP = 0b001; // Lower Lower Point - все буквы в нижнем регистре, в конце - точка.
    const UL = 0b100; // Upper Lower without Point - первая буква в верхнем регистре, остальные - в нижнем, в конце точка не ставится.
    const LL = 0b000; // Lower Lower without Point - все буквы в нижнем регистре, в конце точка не ставится.
    const U__ = 0b100;
    const _U_ = 0b010;
    const __P = 0b001;

    const ROOTS = [
        'багр', 'цеп', 'кон', 'бит', 'зор', 'круг', 'ор', 'вяз', 'оруд', 'цеп', 'вяд', 'худ', 'гор', 'мудр',
        'быт', 'треб', 'жар', 'стог', 'корм', 'кром', 'люб', 'голос', 'знак', 'волос', 'край', 'крест',
        'круп', 'клик', 'клин', 'клад', 'миг', 'лих', 'маш', 'авто', 'компьютер', 'ноутбук', 'боль',
        'больш', 'дерев', 'завтра', 'жи', 'взя', 'герой', 'лаг', 'лож', 'рос', 'раст', 'скак', 'скоч',
        'гар', 'гор', 'зар', 'зор', 'клан', 'клон', 'бир', 'бер', 'дир', 'дер', 'пир', 'пер', 'три',
        'тер', 'мир', 'мер', 'блист', 'блест', 'стил', 'стел', 'жиг', 'жег', 'чит', 'чет', 'кас', 'кос',
        'равн', 'ровн', 'мак', 'мок', 'плав', 'плов', 'твар', 'твор', 'ча', 'чин', 'мя', 'мин', 'жаржим',
        'ня', 'ним', 'кля'
    ];
    const PREFIXES = [
        'в', 'во', 'взо', 'вы', 'до', 'за', 'из', 'изо', 'к', 'на', 'над', 'не', 'недо', 'о', 'об', 'обо', 'от', 'ото', 'па', 'пере', 'по', 'под', 'подо', 'пра', 'пред', 'предо', 'про', 'разо', 'с', 'со', 'су', 'у',
        'без', 'бес', 'вз', 'вс', 'воз', 'вос', 'из', 'ис', 'низ', 'нис', 'раз', 'рас', 'роз', 'рос', 'через', 'черес', 'пре', 'при'

    ];
    const POSTFIXES = [
        'а', 'ам', 'ами', 'ас', 'ат', 'ах', 'ая', 'е', 'её', 'ей', 'ем', 'еми', 'емя', 'ех', 'ею', 'ёт', 'ёте',
        'ёх', 'ёшь', 'и', 'ие', 'ий', 'им', 'ими', 'ит', 'ите', 'их', 'ишь', 'ию', 'й', 'м', 'ми', 'мя', 'о',
        'ов', 'ого', 'ое', 'оё', 'ой', 'ом', 'ому', 'ою', 'ст', 'у', 'ум', 'умя', 'ут', 'ух', 'ую', 'шь'
    ];
    const PREP = [
        'без', 'безо', 'в', 'во', 'и', 'для', 'до', 'за', 'из', 'изо', 'к', 'ко', 'кроме', 'меж', 'между',
        'на', 'над', 'надо', 'о', 'об', 'от', 'ото', 'перед', 'передо', 'по', 'под', 'подо', 'при', 'про',
        'ради', 'через', 'из-за', 'из-под'
    ];
    private static $categories = false;
    public static function randomWord($n, $rule = self::UL) {
//        self::ALPHABET[1];
        if($n < 4) {
            $word = self::PREP[array_rand(self::PREP)];
        } else {
            $word = (rand(0, 3) == 0 ? self::PREFIXES[array_rand(self::PREFIXES)] : '')
                . self::ROOTS[array_rand(self::ROOTS)]
                . (rand(0, 5) == 0 ? self::POSTFIXES[array_rand(self::POSTFIXES)] : '');
        }
        return self::processRule($word, $rule);
    }
    public static function randomSentence($n, $rule = self::ULP) {
        $words = [];
        $min_length = 1;
        for($i = 0; $i < $n; $i++) {
            $word = self::randomWord(rand($min_length, 9), self::LL);
            $min_length = strlen($word) < 4 ? 4 : 1;
            $words[] = $word;
        }
        return self::processRule(implode(' ', $words), $rule);
    }
    public static function randomText($n, $rule = self::ULP) {
        $text = "";
        for($i = 0; $i < $n; $i++) {
            $text .= self::randomSentence(rand(3, 10), $rule). ' ';
        }
        // Отрезаем лишний пробел в конце и возвращаем значение
        return trim($text);
    }
    public static function initRandomCategories($count, $rule = self::UL, $words = 2)
    {
        self::$categories = [];
        for($i = 0; $i < $count; $i++) {
            self::$categories[] = self::randomSentence($words, $rule);
        }

    }
    public static function randomCategory($count = 5)
    {
        if(!self::$categories) self::initRandomCategories($count);
        return self::$categories[array_rand(self::$categories)];
    }
    private static function processRule($str, $rule) {
        if($rule & self::_U_) {
            $str = strtoupper($str);
        }
        if($rule & self::U__) {
            $str = self::my_mb_ucfirst($str);
        }
        if($rule & self::__P) {
            $str .= '.';
        }
        return $str;
    }
    private static function my_mb_ucfirst($str) {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }

}
