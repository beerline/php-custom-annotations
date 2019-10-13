<?php declare(strict_types=1);


namespace Beerline\PhpCustomAnnotations\Metadata;


class PropertyCertainMetadata
{
    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var object
     */
    private $metadataClass;

    /**
     * PropertyCertainMetadata constructor.
     * @param string $propertyName
     * @param object $metadataClass
     */
    public function __construct(string $propertyName, object $metadataClass)
    {
        $this->propertyName = $propertyName;
        $this->metadataClass = $metadataClass;
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @return object
     */
    public function getMetadataClass() : object
    {
        return $this->metadataClass;
    }
}