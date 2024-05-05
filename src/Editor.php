<?php

namespace Ramblin;

class Editor {
    private $url; // recipe site url we'll be curling to
    private $rawSiteContents; // the base html of the site
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
        $this->rawSiteContents = $page;
    }

    public function getStory() {
        if (empty($this->rawSiteContents)) {
            // if we don't have our story go get it
            $this->getSiteContents();
        }
        $this->story = $this->siteToText();
        // make something up for now
        $this->story = "Placeholder text about this time at grandma's house. Did you hear that? They've shut down the main reactor. We'll be destroyed for sure. This is madness! We're doomed! There'll be no escape for the Princess this time. What's that? Artoo! Artoo-Detoo, where are you? At last! Where have you been? They're heading in this direction.

        Don't play games with me, Your Highness. You weren't on any mercy mission this time. You passed directly through a restricted system. Several transmissions were beamed to this ship by Rebel spies. I want to know what happened to the plans they sent you. I don't know what you're talking about.
        
        I'm going to cut across the axis and try and draw their fire. Heavy fire, boss! Twenty-degrees. I see it. Stay low. This is Red Five, I'm going in! Luke, pull up! Are you all right? I got a little cooked, but I'm okay. We count thirty Rebel ships, Lord Vader.
        
        A small one-man fighter should be able to penetrate the outer defense. Pardon me for asking, sir, but what good are snub fighters going to be against that? Well, the Empire doesn't consider a small one-man fighter to be any threat, or they'd have a tighter defense. An analysis of the plans provided by Princess Leia has demonstrated a weakness in the battle station. The approach will not be easy. You are required to maneuver straight down this trench and skim the surface to this point. The target area is only two meters wide. It's a small thermal exhaust port, right below the main port.
        
        Your powers are weak, old man. You can't win, Darth. If you strike me down, I shall become more powerful than you can possibly imagine. Didn't we just leave this party? What kept you? We ran into some old friends.";
        return $this->story;
    }

    /**
     * uses html2text library to 
     */
    private function siteToText() {

    }
}