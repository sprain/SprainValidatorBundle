SprainValidatorBundle
=====================

## ISBN Validator (International Standard Book Number)

### Definition

The International Standard Book Number (ISBN) is a unique numeric commercial book identifier. There are two versions: ISBN-10 and ISBN-13. ([Wikipedia](http://en.wikipedia.org/wiki/International_Standard_Book_Number))


### Basic Usage

    // src/Acme/DemoBundle/Entity/AcmeEntity.php
    use Sprain\ValidatorBundle\Validator\Constraints as SprainAssert;

    class AcmeEntity
    {
        // ...

        /**
         * @SprainAssert\Isbn()
         */
        protected $isbn10orIsbn13;
        
        /**
         * @SprainAssert\Isbn('isbn10')
         */
        protected $isbn10;
        
        /**
         * @SprainAssert\Isbn('isbn13')
         */
        protected $isbn13;
        
        /**
         * @SprainAssert\Isbn(type="isbn13", message="My custom error message")
         */
        protected $isbn13;

        // ...
    }
    
#### Options
Option    | Type    | Default   | Description
:---------|:--------|:---------|:------------
type      | string  | null     | Can be `isbn10` or  `isbn13`. Empty value accepts both.
message   | string  | *(depends on type)* | Error message if the value is invalid

#### Good to know
The validator accepts ISBNs with or without dashes.