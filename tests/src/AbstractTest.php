<?php

namespace ByTIC\Omnipay\Librapay\Tests;

use ByTIC\Omnipay\Librapay\Tests\Traits\HasTestUtilMethods;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    use HasTestUtilMethods;

    protected $object;

    /**
     * @param $path
     * @return HttpRequest
     */
    public static function generateRequestFromFixtures($path)
    {
        $request = HttpRequest::createFromGlobals();
        $parameters = require $path;
        if ($parameters['request']) {
            $request->request->replace($parameters['request']);
        }

        if ($parameters['query']) {
            $request->query->replace($parameters['query']);
        }
        return $request;
    }
}
