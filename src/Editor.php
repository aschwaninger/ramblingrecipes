<?php

namespace Ramblin;

class Editor {
    private $url; // recipe site url we'll be curling to
    private $rawSiteContents; // the base html of the site
    private $dom; // DOMDocument of target site
    private $story; // the stripped output

    public function __construct($url) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $this->url = $url;
        } else {
            throw new \Exception("$url is not a valid url.");
        }

    }

    private function getSiteContents() {
        $get = curl_init();
        curl_setopt($get, CURLOPT_URL, $this->url);
        curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
        $page = curl_exec ($get);
        curl_close ($get);
        // $this->rawSiteContents = $page;
        $this->dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $this->dom->loadHTML($page, LIBXML_NOERROR);
        $this->dom->normalizeDocument();
        // $this->rawSiteContents = $this->dom->saveHTML();
    }

    public function getStory() {
        if (empty($this->rawSiteContents)) {
            // if we don't have our story go get it
            $this->getSiteContents();
        }
        $this->story = $this->siteToText();
        return $this->story;
    }

    /**
     * TIL how DOMDocument works?
     */
    private function siteToText() {
        // grab article? main?
        // $articles = $this->dom->getElementsByTagName("article");
        // while ($articles->length > 0) {
        //     $this->dom->saveHTML($articles->item(0));
        // }
        // return $new->saveHTML();
        $this->stripTagsOfType("link");
        $this->stripTagsOfType("meta");
        $this->stripTagsOfType("head");
        $this->stripTagsOfType("script");
        $this->stripTagsOfType("header");
        $this->stripTagsOfType("button");
        $this->stripTagsOfType("img");
        $this->stripTagsOfType("figure");
        $this->stripTagsOfType("ul");
        $this->stripTagsOfType("ol");
        return $this->dom->saveHTML();
    }

    private function stripTagsOfType($tag) {
        $tags = $this->dom->getElementsByTagName($tag);

        while ($tags->length > 0) {
            $t = $tags->item(0);
            $t->parentNode->removeChild($t);
        }
    }
}