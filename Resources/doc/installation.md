SprainValidatorBundle
=====================

Installation
------------

Simply add this line `composer.json` and run `composer update sprain/validator-bundle`:

    {
        "require": {
            "sprain/validator-bundle": "dev-master"
        }
    }

Register the bundle in `app/AppKernel.php`:

    $bundles = array(
        new Sprain\ValidatorBundle\SprainValidatorBundle(),
    );
    
Usage
-----

After the bundle has been added to the project, its validators can be used just like every other Symfony2 validator:

### Usage with Annotations

    // src/Acme/DemoBundle/Entity/AcmeEntity.php
    use Symfony\Component\Validator\Constraints as Assert;
    use Sprain\ValidatorBundle\Validator\Constraints as SprainAssert;

    class AcmeEntity
    {
        // ...

        /**
         * @Assert\NotBlank
         * @SprainAssert\Iban()
         */
        protected $iban;

        // ...
    }


Find more examples for [usage in YAML, XML or PHP](usage.md).

For the usage of the different validators, see [validators list](doc.md#validators).