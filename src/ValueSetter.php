<?php
/**
 * Created by PhpStorm.
 * User: artos
 * Date: 31.01.17
 * Time: 22:28
 */

namespace Artospaj\PhingHashmap;


class ValueSetter extends \Task
{
    private $dataset;
    private $value;
    private $key;

    public function main()
    {
        ValueStorage::getInstance($this->dataset)->setValue($this->key, $this->value);
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @param mixed $dataset
     */
    public function setDataset($dataset)
    {
        $this->dataset = $dataset;
    }


}