<?php

declare(strict_types=1);

namespace LeoUtils\Tests;
/**
 * @covers LeoUtils\MediaType
 */
final class MediaTypeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetJsonMediaType()
    {
        $mt = \LeoUtils\MediaType::JSON;
        $this->assertEquals('application/json', $mt);
    }
}