<?php declare(strict_types=1);


namespace Metadata;


class PropertyMetadata
{
    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var array
     */
    private $metadataClasses;

    /**
     * PropertyMetadata constructor.
     * @param string $propertyName
     * @param array $metadataClasses
     */
    public function __construct(string $propertyName, array $metadataClasses)
    {
        $this->propertyName = $propertyName;
        $this->metadataClasses = $metadataClasses;
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @return array
     */
    public function getMetadataClasses(): array
    {
        return $this->metadataClasses;
    }
}