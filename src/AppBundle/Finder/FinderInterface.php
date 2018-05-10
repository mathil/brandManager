<?php

namespace AppBundle\Finder;

/**
 * @author mathil <github.com/mathil>
 */
interface FinderInterface
{

    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * @param array $parameters
     * @return array
     */
    public function getData(array $parameters): array;

}