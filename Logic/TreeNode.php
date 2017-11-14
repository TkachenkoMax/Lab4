<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 13.11.17
 * Time: 22:45
 */
class TreeNode
{
    private $path;
    private $relations;
    private $value;

    /**
     * TreeNode constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->value = 1;
    }

    /**
     * Add relation to site page
     *
     * @param $path
     */
    public function addRelation($path)
    {
        if ($path != $this->path) {
            $this->relations[$path] = $path;
        }
    }

    /**
     * Get site page's relations
     *
     * @return mixed
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * Add to value 
     *
     * @param $addition
     */
    public function increaseValue($addition) 
    {
        $this->value += $addition;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
}