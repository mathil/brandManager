<?php

namespace AppBundle\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

class TestExtension extends Twig_Extension
{

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('showmsg', [$this, 'showMessage'])
        ];
    }

    public function showMessage(string $text)
    {
        return sprintf('hello %s!', $text);
    }


}