<?php

require_once 'PageLoader.php';
require_once 'SiteTree.php';
require_once 'PageRank.php';

$mainPage = $_POST['link'];
$iterationsAmount = $_POST['iterations'];

$urlParse = parse_url($mainPage);

$mainPage = $urlParse['scheme'] . '://' . $urlParse['host'] . '/';

$linksToVisit[] = $mainPage;

$siteTree = new SiteTree();

while (count($linksToVisit) > 0){
    if (!$siteTree->containsNode($linksToVisit[0])) {
        if (strpos($linksToVisit[0], 'http') === false) {

        }
        $pageLoader = new PageLoader($linksToVisit[0]);

        $links = $pageLoader->parsePage()->getLinks($mainPage);

        $siteTree->addNode($linksToVisit[0])->addRelations($linksToVisit[0], $links);

        foreach ($links as $link) {
            if (!in_array($link, $linksToVisit)) {
                $linksToVisit[] = $link;
            }
        }
    }

    array_shift($linksToVisit);
}

$pageRank = new PageRank($siteTree, $iterationsAmount);
$answer = $pageRank->algorithm()->generateAnswer();

echo json_encode($answer);
