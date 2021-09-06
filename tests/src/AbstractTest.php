<?php

namespace Paytic\Omnipay\Librapay\Tests;

use PHPUnit\Framework\TestCase;

use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    protected $object;


    /**
     * @param $path
     * @return HttpRequest
     */
    public static function generateRequestFromFixtures($path)
    {
        $request = HttpRequest::createFromGlobals();
        $parameters = require $path;
        if (isset($parameters['request'])) {
            $request->request->replace($parameters['request']);
        }

        if (isset($parameters['query'])) {
            $request->query->replace($parameters['query']);
        }

        if (isset($parameters['headers'])) {
            $request->headers->add($parameters['headers']);
        }
        return $request;
    }
}
