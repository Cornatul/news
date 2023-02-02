<?php

namespace UnixDevil\NewsBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use Mockery;

use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\NewsInterface;

class NewsTest extends \UnixDevil\NewsBoat\Tests\TestCase
{

    /**
     * @throws \JsonException
     */
    public function testGetNews()
    {
       $mock = $this->getMockBuilder(NewsBoat::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class)])
            ->getMock();
        $mock
            ->method('getNews')
            ->with('business', 'us')
            ->willReturn(['articles' => []]);
        $this->assertInstanceOf(NewsInterface::class, $mock);
        $this->assertIsArray($mock->getNews('business', 'us'));

    }


    public function testGetTrendingTerms()
    {
            $mock = $this->getMockBuilder(NewsBoat::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class)])
            ->getMock();
        $mock
            ->method('getTrendingTerms')
            ->willReturn(['articles' => []]);
        $this->assertInstanceOf(NewsInterface::class, $mock);
        $this->assertIsArray($mock->getTrendingTerms()); }


}
