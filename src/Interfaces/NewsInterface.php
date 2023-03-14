<?php

namespace Cornatul\News\Interfaces;


use Cornatul\News\DTO\NewsDTO;

interface NewsInterface
{
    /**

     * This will return a list of news from a specific category and country
     * category can be one of the following: business, entertainment, general, health, science, sports, technology
     * country can be one of the following: ae, ar, at, au, be, bg, br, ca, ch, cn, co, cu, cz, de, eg, fr, gb, gr, hk,
     * hu, id, ie, il, in, it, jp, kr, lt, lv, ma, mx, my, ng, nl, no, nz, ph, pl, pt, ro, rs, ru, sa, se, sg, si, sk,
     * th, tr, tw, ua, us, ve, za
     * @param string $topic
     * @return NewsDTO
     */
    public function allNews(string $topic):NewsDTO;

    public function headlines(string $topic):NewsDTO;

}
