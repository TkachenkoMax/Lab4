<?php

/**
 * Created by PhpStorm.
 * User: max
 * Date: 13.11.17
 * Time: 22:24
 */
class PageLoader
{
    private $link;
    private $dom;

    /**
     * PageLoader constructor.
     * @param $link
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Parse page
     *
     * @return $this
     */
    public function parsePage()
    {
        $content = file_get_contents($this->link);
        $this->dom = new DOMDocument();
        $this->dom->loadHTML($content);
        return $this;
    }

    /**
     * Get array with hrefs of page's links
     *
     * @param string $mainPage 
     *
     * @return array
     */
    public function getLinks($mainPage)
    {
        $mainPageUrl = parse_url($mainPage);

        $node = $this->dom->getElementsByTagName('a');
        $hrefText = [];

        for ($i = 0; $i < $node->length; $i++) {
            $hrefText[] = $node->item($i)->getAttribute('href');	//вытаскиваем из тега атрибут href
        }

        $clearHrefs = [];

        foreach($hrefText as $hrefTextItem) {
            $url = parse_url($hrefTextItem);
            if (!isset($url['scheme'])) {
                $clearHrefs[] = $mainPage . $url['path'];
            } else {
                if ($url['scheme'] === 'http' || $url['scheme'] === 'https') {
                    if ($url['host'] === $mainPageUrl['url']) {
                        $clearHrefs[] = $hrefTextItem;
                    }
                }
            }
        }

        $clearHrefs = array_unique($clearHrefs);

        return $clearHrefs;
    }
}