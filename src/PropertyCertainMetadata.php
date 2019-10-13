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
    private $annotationClasses;

    /**
     * AnnotatedField constructor.
     * @param string $fieldName
     * @param object $annotationClasses
     */
    public function __construct(string $fieldName, object $annotationClasses)
    {
        $this->fieldName = $fieldName;
        $this->annotationClasses = $annotationClasses;
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
    public function getAnnotationClasses() : object
    {
        return $this->annotationClasses;
    }
}