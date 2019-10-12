<?php declare(strict_types=1);


namespace Metadata;


class AnnotatedField
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var array
     */
    private $annotationClasses;

    /**
     * AnnotatedField constructor.
     * @param string $fieldName
     * @param array $annotationClasses
     */
    public function __construct(string $fieldName, array $annotationClasses)
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
     * @return array
     */
    public function getAnnotationClasses(): array
    {
        return $this->annotationClasses;
    }
}