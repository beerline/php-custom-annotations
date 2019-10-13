<?php declare(strict_types=1);


namespace Metadata;


class PropertyMetadata
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var array
     */
    private $metadataClasses;

    /**
     * AnnotatedField constructor.
     * @param string $fieldName
     * @param array $metadtaClasses
     */
    public function __construct(string $fieldName, array $metadtaClasses)
    {
        $this->fieldName = $fieldName;
        $this->metadataClasses = $metadtaClasses;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @return array
     */
    public function getMetadataClasses(): array
    {
        return $this->metadataClasses;
    }
}