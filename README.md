# Php custom annotation
Create and work with custom php annotation with pleasure.

To add metadata to field of your class:

1. Create metadata class.
2. Add annotation `@Annotation* and `@Annotation` to metadata class.
3. Annotate filed of your class by metadata class.
4. Use `\Metadata\PickerAnnotatedFields::findFieldsWithAllAnnotations( object $entity )` to get array of all annotation of all field given class.
5. Use `\Metadata\PickerAnnotatedFields::findFieldsWithAnnotation( object $entity, string $annotationClassName )` method  to get only fields with specific metadata class.
