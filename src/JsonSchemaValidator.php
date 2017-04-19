<?php

namespace LeoUtils;
/**
 * Validates data according to a JSON schema.
 */
class JsonSchemaValidator
{
    /**
     * Path to JSON schema to be used.
     *
     * @var string
     */
    protected $schema;
    /**
     * Validation errors.
     *
     * @var array
     */
    protected $errors;
    /**
     * Schema resolver.
     *
     * @var object
     */
    protected $resolver;
    /**
     * Validator.
     *
     * @var object
     */
    protected $validator;
    /**
     * Constructor.
     *
     * @param string $schema Path to schema.
     */
    public function __construct($schema = null)
    {
        $this->resolver = new \JsonSchema\RefResolver(new \JsonSchema\Uri\UriRetriever(), new \JsonSchema\Uri\UriResolver());
        $this->validator = new \JsonSchema\Validator();
        $this->errors = [];

        if (strlen($schema) > 0) {
            $this->withSchema($schema);
        }
    }
    /**
     * Set JSON schema path.
     *
     * @param string $schema Path to schema.
     * @return \LeoUtils\JsonSchemaValidator
     */
    public function withSchema($schema)
    {
        $this->schema = $this->resolver->resolve('file://' . realpath($schema));
        return $this;
    }
    /**
     * Get validation errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    /**
     * Check if data respects the schema.
     *
     * @param object|array $data
     * @return boolean
     */
    public function check($data)
    {
        $this->validator->check($data, $schema);

        if ($this->validator->isValid()) {
            return true;
        }
        $this->errors = $this->validator->getErrors();
        return false;
    }
    /**
     * Validates data according to schema, throwing exception if any errors are found.
     *
     * @param object|array $data
     * @throws Exception
     * @return void
     */
    public function validate($data)
    {
        if ($this->check($data)) {
            return;
        }
        $ex = new Exception(LeoUtils\HttpCode::BAD_REQUEST, _('Incorrect JSON.'));
        $ex->withDetails($this->errors)->throw();
    }
}