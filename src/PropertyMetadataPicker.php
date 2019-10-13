<?php declare(strict_types=1);


namespace Beerline\PhpCustomAnnotations\Metadata;


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
     * PropertyMetadataPicker constructor.
     * @param Reader $reader
     */
    public function __construct( Reader $reader )
    {
        $this->reader = $reader;
    }

    /**
     * Return all properties with all metadata
     *
     * @param $entity
     * @return PropertyMetadata[]
     * @throws ReflectionException
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
     * Return all properties with certain annotated class
     *
     * @param $entity
     * @param string $metadataClassName
     *
     * @return PropertyCertainMetadata[]
     * @throws \ReflectionException
     *
     */
    public function findPropertyCertainMetadata( object $entity, string $metadataClassName ) : array
    {
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties();

        $propertiesMetadata = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( get_class($entity), $property->getName());
            $propAnnotation = $this->reader->getPropertyAnnotation( $reflectionProperty, $metadataClassName );

            if ( $propAnnotation instanceof $metadataClassName ) {
                $propertyCertainMetadata = new PropertyCertainMetadata($property->getName(), $propAnnotation );
                $propertiesMetadata[] = $propertyCertainMetadata;
            }
        }

        return $propertiesMetadata;
    }

    /**
     *
     *
     * @param string $className
     * @param string $metadataClassName
     * @return array
     * @throws ReflectionException
     */
    public function findPropertyCertainMetadataOfClass( string $className, string $metadataClassName ) : array
    {
        $reflection = new ReflectionClass($className);
        $properties = $reflection->getProperties();

        $propertiesMetadata = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( $className, $property->getName());
            $propAnnotation = $this->reader->getPropertyAnnotation( $reflectionProperty, $metadataClassName );

            if ( $propAnnotation instanceof $metadataClassName ) {
                $propertyCertainMetadata = new PropertyCertainMetadata($property->getName(), $propAnnotation );
                $propertiesMetadata[] = $propertyCertainMetadata;
            }
        }

        return $propertiesMetadata;
    }

    /**
     * @param string $className
     * @return array
     * @throws ReflectionException
     */
    public function findPropertiesAllMetadataOfClass( string $className ) : array
    {
        $reflection = new ReflectionClass($className);
        $properties = $reflection->getProperties();

        $propertiesMetadata = [];
        foreach ($properties as $property) {
            $reflectionProperty = new ReflectionProperty( $className, $property->getName());
            $propAnnotations = $this->reader->getPropertyAnnotations( $reflectionProperty );

            if ( count($propAnnotations) > 0 ) {
                $propertiesMetadata[] = new PropertyMetadata($property->getName(), $propAnnotations);
            }
        }

        return $propertiesMetadata;
    }
}