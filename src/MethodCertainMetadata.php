<?php

namespace Beerline\PhpCustomAnnotations\Metadata;

class MethodCertainMetadata {

    /**
     * @var string
     */
    private $methodName;

    /**
     * @var object
     */
    private $metadataClass;

    /**
     * MethodCertainMetadata constructor.
     *
     * @param string $methodName
     * @param object $metadataClass
     */
    public function __construct(string $methodName, object $metadataClass)
    {
        $this->methodName    = $methodName;
        $this->metadataClass = $metadataClass;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @return object
     */
    public function getMetadataClass(): object
    {
        return $this->metadataClass;
    }
}