<?php
declare(strict_types=1);

namespace LeoUtils\Tests;
/**
 * @covers LeoUtils\Exception
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests if an exception is properly thrown
     *
     * @expectedException \LeoUtils\Exception
     * @expectedExceptionCode 1234
     * @expectedExceptionMessage Test exception
     */
    public function testCanBeThrown()
    {
        $exception = new \LeoUtils\Exception('Test exception', 1234);
        $exception->withDetails([
            'Details',
            'More details'
        ]);
        $this->assertCount(
            2,
            $exception->getDetails()
        );
        $exception->throw();
    }
}