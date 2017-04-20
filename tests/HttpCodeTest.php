<?php
declare(strict_types=1);

namespace LeoUtils\Tests;
/**
 * @covers LeoUtils\HttpCode
 */
final class HttpCodeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test OK HTTP code.
     *
     * @return void
     */
    public function testOk()
    {
        $code = \LeoUtils\HttpCode::OK;

        $this->assertEquals(200, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('200 (OK)', $description);
    }
    /**
     * Test Created HTTP code.
     *
     * @return void
     */
    public function testCreated()
    {
        $code = \LeoUtils\HttpCode::CREATED;

        $this->assertEquals(201, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('201 (Created)', $description);
    }
    /**
     * Test No Content HTTP code.
     *
     * @return void
     */
    public function testNoContent()
    {
        $code = \LeoUtils\HttpCode::NO_CONTENT;

        $this->assertEquals(204, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('204 (No Content)', $description);
    }
    /**
     * Test Bad Request HTTP code.
     *
     * @return void
     */
    public function testBadRequest()
    {
        $code = \LeoUtils\HttpCode::BAD_REQUEST;

        $this->assertEquals(400, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('400 (Bad Request)', $description);
    }
    /**
     * Test Unauthorized HTTP code.
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $code = \LeoUtils\HttpCode::UNAUTHORIZED;

        $this->assertEquals(401, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('401 (Unauthorized)', $description);
    }
    /**
     * Test Forbidden HTTP code.
     *
     * @return void
     */
    public function testForbidden()
    {
        $code = \LeoUtils\HttpCode::FORBIDDEN;

        $this->assertEquals(403, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('403 (Forbidden)', $description);
    }
    /**
     * Test Not Found HTTP code.
     *
     * @return void
     */
    public function testNotFound()
    {
        $code = \LeoUtils\HttpCode::NOT_FOUND;

        $this->assertEquals(404, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('404 (Not Found)', $description);
    }
    /**
     * Test Internal Server Error HTTP code.
     *
     * @return void
     */
    public function testInternalServerError()
    {
        $code = \LeoUtils\HttpCode::INTERNAL_SERVER_ERROR;

        $this->assertEquals(500, $code);

        $description = \LeoUtils\HttpCode::getDescription($code);

        $this->assertEquals('500 (Internal Server Error)', $description);
    }
}