<?php
/**
 * Created by PhpStorm.
 * User: artos
 * Date: 31.01.17
 * Time: 22:36
 */

namespace Artospaj\PhingHashmap;


class ValueGetter extends \Task
{
    private $dataset;
    private $outputVar;
    private $key;

    public function main()
    {
        $this->project->setProperty(
            $this->outputVar,
            ValueStorage::getInstance($this->dataset)->getValue($this->key)
        );
    }

    /**
     * @param mixed $outputVar
     */
    public function setOutputVar($outputVar)
    {
        $this->outputVar = $outputVar;
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