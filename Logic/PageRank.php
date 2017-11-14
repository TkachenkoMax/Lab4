<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.11.17
 * Time: 21:48
 */
class PageRank
{
    private $siteTree;
    private $iterations;
    private $coefficient;

    /**
     * PageRank constructor.
     * @param SiteTree $siteTree
     * @param $iterations
     * @param $coefficient
     */
    public function __construct(SiteTree $siteTree, $iterations, $coefficient = 0.85)
    {
        $this->siteTree = $siteTree;
        $this->iterations = $iterations;
        $this->coefficient = $coefficient;
    }

    /**
     * Perform PageRank algorithm
     */
    public function algorithm()
    {
        for ($i = 0; $i < $this->iterations; $i++) {
            $newTree = clone $this->siteTree;
            foreach ($this->siteTree->getTree() as $siteNode) {
                $ratio = $siteNode->getValue() * $this->coefficient / count($siteNode->getRelations());

                foreach ($siteNode->getRelations() as $relation) {
                    $newNode = $newTree->getNode($relation);
                    $newNode->increaseValue($ratio);
                }
            }

            $this->siteTree = $newTree;
        }

        return $this;
    }

    /**
     * Generate array with answers 
     *
     * @return array
     */
    public function generateAnswer()
    {
        $answer = [];
        foreach ($this->siteTree->getTree() as $treeNode) {
            $answer[] = [
                'path' => $treeNode->getPath(),
                'rank' => $treeNode->getValue(),
                'number_of_links' => count ($treeNode->getRelations()),
            ];
        }
        
        return $answer;
    }
}