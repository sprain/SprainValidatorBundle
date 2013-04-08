SprainValidatorBundle
=====================

### Usage with YAML

    # src/Acme/BlogBundle/Resources/config/validation.yml
    Acme\DemoBundle\Entity\AcmeEntity:
        properties:
            name:
                - NotBlank: ~
                - Sprain\ValidatorBundle\Validator\Constraints\Iban

### Usage with XML

    <!-- src/Acme/DemoBundle/Resources/config/validation.xml -->
    <?xml version="1.0" encoding="UTF-8" ?>
    <constraint-mapping xmlns="http://symfony.com/schema/dic/constraint-mapping"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://symfony.com/schema/dic/constraint-mapping http://symfony.com/schema/dic/constraint-mapping/constraint-mapping-1.0.xsd">

        <class name="Acme\DemoBundle\Entity\AcmeEntity">
            <property name="name">
                <constraint name="NotBlank" />
                <constraint name="Sprain\ValidatorBundle\Validator\Constraints\Iban">
                </constraint>
            </property>
        </class>
    </constraint-mapping>

### Usage with PHP

    // src/Acme/DemoBundle/Entity/AcmeEntity.php
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Sprain\ValidatorBundle\Validator\Constraints\Iban;

    class AcmeEntity
    {
        public $name;

        public static function loadValidatorMetadata(ClassMetadata $metadata)
        {
            $metadata->addPropertyConstraint('status', new NotBlank());
            $metadata->addPropertyConstraint('status', new Iban());
        }
    }