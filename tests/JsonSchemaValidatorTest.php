<?php

namespace LeoUtils\Tests;

require_once __DIR__ . '/../vendor/autoload.php';
/**
 * @covers \LeoUtils\JsonSchemaValidator
 */
final class JsonSchemaValidatorTest extends \PHPUnit\Framework\TestCase
{
    const SCHEMA_PATH = '/tmp/schema.json';
    /**
     * Create the file with schema definition to be used by tests.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        $schema = '
            {
                "type":"object",
                "properties": {
                    "id": {"type": "integer"},
                    "description": {"type": "string"},
                    "amount": {"type": "number"},
                    "processed": {"type": "boolean"} 
                },
                "required":["id", "description", "amount"]
            }
        ';
        file_put_contents(self::SCHEMA_PATH, $schema);
    }
    /**
     * Test the check of a valid objects.
     *
     * @return void
     */
    public function testCheckValid()
    {
        $validator = new \LeoUtils\JsonSchemaValidator(self::SCHEMA_PATH);
        $data = (object)[
            'id'=>123,
            'description'=>'Some description',
            'amount'=>123.45,
            'processed'=>false
        ];
        $this->assertTrue($validator->check($data));

        $data = (object)[
            'id'=>321,
            'description'=>'Another description',
            'amount'=>54
        ];
        $this->assertTrue($validator->check($data));
    }
    /**
     * Test the check of invalid objects.
     *
     * @return void
     */
    public function testCheckInvalid()
    {
        $validator = new \LeoUtils\JsonSchemaValidator(self::SCHEMA_PATH);
        $data = (object)[
            'id'=>'123',
            'description'=>123,
            'amount'=>'123.45',
            'processed'=>'false'
        ];
        $this->assertFalse($validator->check($data));
        $this->assertTrue(count($validator->getErrors()) > 0);

        $data = (object)[
            'id'=>321,
            'description'=>'Another description'
        ];
        $this->assertFalse($validator->check($data));
        $this->assertTrue(count($validator->getErrors()) > 0);
    }
    /**
     * Test the validation of valid objects.
     *
     * @return void
     */
    public function testValidateValid()
    {
        $validator = new \LeoUtils\JsonSchemaValidator(self::SCHEMA_PATH);
        $data = (object)[
            'id'=>123,
            'description'=>'Some description',
            'amount'=>123.45,
            'processed'=>false
        ];
        $validator->validate($data);
        $this->assertCount(0, $validator->getErrors());

        $data = (object)[
            'id'=>321,
            'description'=>'Another description',
            'amount'=>54
        ];
        $validator->validate($data);
        $this->assertCount(0, $validator->getErrors());
    }
    /**
     * Test validation of an invalid object.
     *
     * @expectedException \LeoUtils\Exception
     */
    public function testValidateInvalid()
    {
        $validator = new \LeoUtils\JsonSchemaValidator(self::SCHEMA_PATH);
        $data = (object)[
            'id'=>123,
            'description'=>'Some description',
            'processed'=>false
        ];
        $validator->validate($data);
    }
    /**
     * Delete the created schema file.
     *
     * @return void
     */
    public static function tearDownAfterClass()
    {
        if (file_exists(self::SCHEMA_PATH)) {
            unlink(self::SCHEMA_PATH);
        }
    }
}