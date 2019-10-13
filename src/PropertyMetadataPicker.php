<?php declare(strict_types=1);


namespace Metadata;


use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class PropertyMetadataPicker
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
     * @return PropertyMetadata[]
     *@throws ReflectionException
     *
     */
    public function findPropertiesAllMetadata( object $entity ) : array
    {
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        $propertiesMetadata = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( get_class($entity), $property->getName());
            $propAnnotations = $this->reader->getPropertyAnnotations( $reflectionProperty );

            if ( count($propAnnotations) > 0 ) {
                $propertiesMetadata[] = new PropertyMetadata($property->getName(), $propAnnotations);
            }
        }

        return $propertiesMetadata;
    }

    /**
     * @param $entity
     * @param string $metadataClassName
     *
     * @return PropertyMetadata[]
     *@throws \ReflectionException
     *
     */
    public function findPropertyWithMetadata( object $entity, string $metadataClassName ) : array
    {
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        $propertiesMetadata = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( get_class($entity), $property->getName());
            $propAnnotation = $this->reader->getPropertyAnnotation( $reflectionProperty, $metadataClassName );

            if ( $propAnnotation instanceof $metadataClassName ) {
                $annotatedField = new PropertyCertainMetadata($property->getName(), $propAnnotation );
                $propertiesMetadata[] = $annotatedField;
            }
        }

        return $propertiesMetadata;
    }
}