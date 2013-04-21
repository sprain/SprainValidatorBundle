SprainValidatorBundle
=====================

## IBAN Validator (International Bank Account Number)

**THIS EXACT IBAN VALIDATOR HAS BEEN ADDED TO CORE IN SYMFONY 2.3**

### Definition

The International Bank Account Number (IBAN) is an internationally agreed means of identifying bank accounts across national borders ([Wikipedia](http://en.wikipedia.org/wiki/International_Bank_Account_Number))

**Examples:**

Country        | IBAN example
:--------------|:----------------------
Greece         | GR16 0110 1250 0000 0001 2300 695
United Kingdom | GB29 NWBK 6016 1331 9268 19
Saudi Arabia   | SA03 8000 0000 6080 1016 7519
Switzerland    | CH93 0076 2011 6238 5295 7
Israel         | IL62 0108 0000 0009 9999 999


### Basic Usage

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
    
#### Options
Option    | Type    | Default   | Description
:---------|:--------|:---------|:------------
message   | string  | This is not a valid International Bank Account Number (IBAN). | Error message if the value is invalid

#### Good to know
The validator accepts IBANs with or without spaces.