<?php
/**
 * Created by PhpStorm.
 * User: artos
 * Date: 31.01.17
 * Time: 22:28
 */

namespace Artospaj\PhingHashmap;


class ValueStorage
{
    private static $instances = [];
    private $values;

    /**
     * @param $dataset
     * @return self
     */
    public static function getInstance($dataset)
    {
        if (!isset(self::$instances[$dataset])) {
            self::$instances[$dataset] = new self();
        }

        return self::$instances[$dataset];
    }

    public function setValue($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function getValue($key)
    {
        return isset($this->values[$key]) ? $this->values[$key] : '';
    }
}