<?php

namespace Beerline\PhpCustomAnnotations\Metadata;

use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class MethodMetadataPicker
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * PropertyMetadataPicker constructor.
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param object $entity
     * @param string $metadataClassName
     *
     * @return array
     */
    public function findMethodCertainMetadata(object $entity, string $metadataClassName): array
    {
        $reflection = new ReflectionClass($entity);
        $methodList = $reflection->getMethods();

        $methodListMetadata = [];
        foreach ($methodList as $method) {
            $reflectionMethod = new ReflectionMethod(get_class($entity), $method->getName());
            $methodAnnotation = $this->reader->getMethodAnnotation($reflectionMethod, $metadataClassName);

            if ($methodAnnotation instanceof $metadataClassName) {
                $methodCertainMetadata = new MethodCertainMetadata($method->getName(), $methodAnnotation);
                $methodListMetadata[]  = $methodCertainMetadata;
            }
        }

        return $methodListMetadata;
    }

    /**
     * @param string $className
     * @param string $metadataClassName
     *
     * @return array
     */
    public function findMethodCertainMetadataOfClass(string $className, string $metadataClassName): array
    {
        $reflection = new ReflectionClass($className);
        $methodList = $reflection->getMethods();

        $methodListMetadata = [];
        foreach ($methodList as $method) {
            $reflectionMethod = new ReflectionMethod($className, $method->getName());
            $methodAnnotation = $this->reader->getMethodAnnotation($reflectionMethod, $metadataClassName);

            if ($methodAnnotation instanceof $metadataClassName) {
                $methodCertainMetadata = new MethodCertainMetadata($method->getName(), $methodAnnotation);
                $methodListMetadata[]  = $methodCertainMetadata;
            }
        }

        return $methodListMetadata;
    }
}