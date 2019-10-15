# Php custom annotation
Create and work with custom php annotation with pleasure.


## Installation

**Step 1: Download the Bundle**
Open a command console, enter your project directory and execute the following command to download the latest stable release for this bundle:
`$ composer require beerline/php-custom-annotations`

**Step 2: Enable the Bundle**
For Symfony declare new service at `config/services.yaml`

```yaml
    services:
      // Your services here
      Beerline\PhpCustomAnnotations\Metadata\PropertyMetadataPicker:
        class: 'Beerline\PhpCustomAnnotations\Metadata\PropertyMetadataPicker'
```

## How to use

To add metadata to property of your class:

1. Create metadata class.
2. Add annotation `@Annotation` and `@Annotation\Target("PROPERTY")` to metadata class.
3. Annotate property of your class by metadata class.
4. Use `Beerline\PhpCustomAnnotations\Metadata\PropertyMetadataPicker::findPropertiesAllMetadata( object $entity )` to get array of all annotation of all property of given class.
5. Use `Beerline\PhpCustomAnnotations\Metadata\PropertyMetadataPicker::findPropertyCertainMetadata( object $entity, string $metadataClassName  )` method to get only properties with specific metadata class. `$metadataClassName` is name of metadata class


## Examples

Imagine we have Product class.

```php
    class Product
    {
      /** @var int */
      private $id;
      
      /** @var \DateTime */
      private $dateProduction;
      
      /**
       * @var string
       * @Translate(translatable=true)
       */
      private $name;
      
      /**
       * @var string
       * @Translate(translatable=true)
       */
      private $description;
      
      public function __construct( string $name, DateTime $date, string $description)
      {
          $this->name = $name;
          $this->dateProduction = $date;
          $this->description = $description;
      }
    }
```

Some of it’s properties should be translated:

- name
- description

To specify which properties should be translated lets create metadata Class called `Translatable`

```php
    /**
     * @Annotation
     * @Annotation\Target("PROPERTY")
     */
    class Translatable
    {
      /**
       * @Required
       * @var boolean
       */
      public $translatable;
    }
```
Now mark properies `name` and `description` by metadata class

```php
    // ...
        /**
         * @var string
         * @Translatable(translatable=true)
         */
        private $name;
      
        /**
         * @var string
         * @Translatable(translatable=true)
         */  
        private $description
    // ...
```

**That all.** All you need now it is use `PropertyMetadataPicker` to get this properties

```php
    <?php
    use Doctrine\Common\Annotations\AnnotationReader;
    use Beerline\PhpCustomAnnotations\Metadata\PropertyMetadataPicker;
    
    $product = new Product( 'iPhone', now(), 'Designed by Apple in California' );
    $propertyMetadataPicker = new PropertyMetadataPicker( new AnnotationReader() );
    
    $propertiesMetadata = $propertyMetadataPicker->findPropertyCertainMetadata(
        $product,
        Translatable::class
    );
    
    foreach ($propertiesMetadata as $property) {
         foreach ($property->getMetadataClass() as $metadataClass){
             if ( $metadataClass instanceof Translate) {
                 echo  $property->getPropertyName() . ': ' . $metadataClass->translatable . "\n";
             }
         }
    }
```
    // result
    // name: 1
    // description: 1


