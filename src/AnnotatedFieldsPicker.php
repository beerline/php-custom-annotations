<?php declare(strict_types=1);


namespace Metadata;


use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class AnnotatedFieldsPicker
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * TranslateFieldsPicker constructor.
     * @param Reader $reader
     */
    public function __construct( Reader $reader )
    {
        $this->reader = $reader;
    }

    /**
     * @param $entity
     * @throws ReflectionException
     *
     * @return AnnotatedField[]
     */
    public function findFieldsWithAllAnnotations( object $entity ) : array
    {
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        $annotatedFields = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( get_class($entity), $property->getName());
            $propAnnotations = $this->reader->getPropertyAnnotations( $reflectionProperty );

            if ( count($propAnnotations) > 0 ) {
                $annotatedFields[] = new AnnotatedField($property->getName(), $propAnnotations);
            }
        }

        return $annotatedFields;
    }

    /**
     * @param $entity
     * @param string $annotationClassName
     *
     * @throws \ReflectionException
     *
     * @return AnnotatedField[]
     */
    public function findFieldsWithAnnotation( object $entity, string $annotationClassName ) : array
    {
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        $annotatedFields = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( get_class($entity), $property->getName());
            $propAnnotation = $this->reader->getPropertyAnnotation( $reflectionProperty, $annotationClassName );

            if ( $propAnnotation instanceof $annotationClassName ) {
                $annotatedField = new AnnotatedField( $property->getName(), [$propAnnotation] );
                $annotatedFields[] = $annotatedField;
            }
        }

        return $annotatedFields;
    }
}