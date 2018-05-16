<?php

namespace AppBundle\Factory;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author mathil <github.com/mathil>
 */
class DatatablesParametersFactory
{
    /**
     * @param Request $request
     * @return array
     */
    public function createParams(Request $request): array
    {
        return [
            'draw' => $request->get('draw'),
            'columns' => $request->get('columns'),
            'order' => $request->get('order'),
            'start' => $request->get('start'),
            'length' => $request->get('length'),
            'search' => $request->get('search'),
        ];
    }
}
