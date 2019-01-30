<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.01.2019
 * Time: 20:06
 */
require_once("16.product.class.php");

class FactoryProduct {
    const ALPHABET = "aeyuioqwrtpsdfghjklzxcvbnm";
    const ALPHABET_LEN = 26;
    const ALPHABET_VOWEL_LEN = 6;

    //todo Реализовать генерацию словаря случайных процессоров и брать процессоры из него случайным образом
    private static $cpus = [];
    //todo Реализовать генерацию словаря случайных производителей авто и брать производителя (vendoe) из него случайным образом
    private static $vendors = [];
    //todo Реализовать генерацию словаря случайных категорий и брать категории из него случайным образом
    private static $categories = [];
    // todo реализовать большее количество цветов в словаре и случайную выборку цветов из словаря
    private static $colors = ['белый', 'черный'];
    //todo Реализовать функцию генерации случайных слов
    // дополнительное задание: в словах не должны встречаться подряд болле 2 гласных или более двух согласных букв
    private static function randomWord($n) {
//        self::ALPHABET[1];
    }
    //todo Реализовать функцию генерации случайных предложений
    // дополнительное задание: в предложении не должны встречаться подряд два слова из менее, чем 4 букв
    private static function randomSentence($n) {
        for($i = 0; $i < $n; $i++) {

        }
    }
    private static function randomText($n) {
        $text = "";
        for($i = 0; $i < $n; $i++) {
            $sen = self::randomSentence(rand(3, 10));
            $text = $text . lcfirst($sen) . ". ";
        }
        // Отрезаем лишний пробел в конце и возвращаем значение
        return trim($text);
    }

    public static function getProduct() {
        $i = rand(0, 2);
        switch ($i) {
            case 0:
                return self::getProductCar();
            case 1:
                return self::getProductPC();
            default:
                return self::getParentProduct();
        }
    }
    public static function getParentProduct() {
        $product = new Product();
        self::generateProductProperty($product);
        return $product;
    }
    //todo Заполнить оставшиеся поля случайными значениями
    private static function generateProductProperty($pr) {
        $pr->category = "Category " . rand(1, 5);
        $pr->name = "Name " . rand(1, 1000);
        $pr->cost = (rand(1, 2) == 1)
            ? rand(1, 20) * 100
            : rand(3, 30) * 1000;
//         $pr->description
//         $pr->count
//         $pr->vogue
//         $pr->weight
    }
    //todo Заполнить оставшиеся поля случайными значениями
    public static function getProductCar() {
        $product = new ProductCar();
        self::generateProductProperty($product);
        $product->vendor;
        $product->color;
        $product->power;
        return $product;
    }
    //todo Заполнить оставшиеся поля случайными значениями
    public static function getProductPC() {
        $product = new ProductPC();
        self::generateProductProperty($product);
        $product->cpu;
        $product->ram;
        $product->hdd;
        return $product;
    }
}