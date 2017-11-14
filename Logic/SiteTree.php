<?php

require_once 'TreeNode.php';

/**
 * Created by PhpStorm.
 * User: max
 * Date: 13.11.17
 * Time: 22:43
 */
class SiteTree
{
    private $tree;

    /**
     * SiteTree constructor.
     */
    public function __construct()
    {
        $this->tree = array();
    }

    /**
     * Add page to the site tree
     *
     * @param $page
     *
     * @return $this
     */
    public function addNode($page)
    {
        $this->tree[$page] = new TreeNode($page);
        return $this;
    }

    /**
     * Add relations to the page
     *
     * @param string $page
     * @param array $links
     */
    public function addRelations($page, array $links)
    {
        foreach ($links as $link) {
            $this->tree[$page]->addRelation($link);
        }
    }

    /**
     * Returns if this site page already exists in the site tree
     *
     * @param $page
     * @return bool
     */
    public function containsNode($page)
    {
        return isset($this->tree[$page]);
    }

    /**
     * Get site node 
     *
     * @param $page
     * @return mixed
     */
    public function getNode($page)
    {
        return $this->tree[$page];
    }

    /**
     * @return array
     */
    public function getTree()
    {
        return $this->tree;
    }
}