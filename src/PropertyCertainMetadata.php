<?php declare(strict_types=1);


namespace Metadata;


class PropertyCertainMetadata
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var object
     */
    private $metadataClass;

    /**
     * AnnotatedField constructor.
     * @param string $fieldName
     * @param object $metadataClass
     */
    public function __construct(string $fieldName, object $metadataClass)
    {
        $this->fieldName = $fieldName;
        $this->metadataClass = $metadataClass;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @return object
     */
    public function getMetadataClass() : object
    {
        return $this->metadataClass;
    }
}