# Php custom annotation
Create and work with custom php annotation with pleasure.


## Installation

**Step 1: Download the Bundle**
Open a command console, enter your project directory and execute the following command to download the latest stable release for this bundle:
`$ composer require beerline/php-custom-annotations`

**Step 2: Enable the Bundle**
For Symfony declare new service at `config/services.yaml`

    services:
      // Your services here
      Metadata\AnnotatedFieldsPicker:
        class: 'Metadata\AnnotatedFieldsPicker'


## How to use

To add metadata to field of your class:

1. Create metadata class.
2. Add annotation `@Annotation`  ******and `@Annotation` to metadata class.
3. Annotate filed of your class by metadata class.
4. Use `\Metadata\PickerAnnotatedFields::findFieldsWithAllAnnotations( object $entity )` to get array of all annotation of all field given class.
5. Use `\Metadata\PickerAnnotatedFields::findFieldsWithAnnotation( object $entity, string $annotationClassName )` method to get only fields with specific metadata class.


## Examples

Imagine we have Product class.

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

Some of it’s fields should be translated:

- name
- description

To specify which fields should be translated lets create metadata Class called `Translatable`

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

Now mark fields `name` and `description` by metadata class

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
    

**That all.** All you need now it is use `AnnotatedFieldsPicker` to get this fields

    <?php
    use Doctrine\Common\Annotations\AnnotationReader;
    use Metadata\AnnotatedFieldsPicker;
    
    $product = new Product( 'iPhone', now(), 'Designed by Apple in California' );
    $annotatedFieldPicker = new AnnotatedFieldsPicker( new AnnotationReader() );
    
    $anotatedFileds = $annotatedFieldPicker->findFieldsWithAnnotation(
        $product,
        Translatable::class
    );
    
    foreach ($fields as $field) {
         echo $field->getFieldName();
         foreach ($field->getAnnotationClasses() as $annotatedClass){
             if ( $annotatedClass instanceof Translate) {
                 echo ': ' . $annotatedClass->translatable . "\n";
             }
         }
    }
    
    // result
    // name: 1
    // description: 1
    

