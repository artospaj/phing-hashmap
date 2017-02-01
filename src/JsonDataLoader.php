<?php
/**
 * Created by PhpStorm.
 * User: artos
 * Date: 31.01.17
 * Time: 21:27
 */

namespace Artospaj\PhingHashmap;


class JsonDataLoader extends \Task
{
    protected $dataset;
    protected $configfile;
    protected $config;
    protected $prefix;

    /**
     *  Called by the project to let the task do it's work. This method may be
     *  called more than once, if the task is invoked more than once. For
     *  example, if target1 and target2 both depend on target3, then running
     *  <em>phing target1 target2</em> will run all tasks in target3 twice.
     *
     *  Should throw a BuildException if someting goes wrong with the build
     *
     *  This is here. Must be overloaded by real tasks.
     */
    public function main()
    {
        if (empty($this->configfile)) {
            throw new \BuildException("Configfile is required!");
        }

        if (!file_exists($this->configfile)) {
            throw new \BuildException("Configfile '{$this->configfile}' doesn't exist.");
        }

        $jsonConfig = json_decode(file_get_contents($this->configfile), true);

        if ($jsonConfig === null) {
            throw new \BuildException("Configfile '{$this->configfile}' is not a valid JSON.");
        }

        $this->config = $this->recursiveBuildConfig($jsonConfig, $this->prefix);

        foreach($this->config as $key => $value) {
            ValueStorage::getInstance($this->dataset)->setValue($key, $value);
        }
    }

    public function init()
    {
        parent::init();

        $this->config = null;
        $this->configfile = null;
        $this->dataset = null;
        $this->prefix = null;
    }

    /**
     * @param string $configfile
     */
    public function setConfigfile($configfile)
    {
        $this->configfile = $configfile;
    }

    /**
     * @param mixed $dataset
     */
    public function setDataset($dataset)
    {
        $this->dataset = $dataset;
    }

    /**
     * @param mixed $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    private function recursiveBuildConfig($data, $key = null)
    {
        $output = [];

        if (is_array($data)) {
            foreach($data as $dataKey => $dataItem) {
                $output = array_replace(
                    $output,
                    $this->recursiveBuildConfig(
                        $dataItem,
                        implode('.', array_filter([$key, $dataKey], function ($val) { return $val !== null;}))
                    )
                );
            }
        } else if ($key) {
            $output[$key] = $data;
        }

        return $output;
    }
}
