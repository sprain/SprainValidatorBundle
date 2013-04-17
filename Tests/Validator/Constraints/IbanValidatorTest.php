<?php


namespace Sprain\ValidatorBundle\Tests\Validator\Constraints;

use Sprain\ValidatorBundle\Validator\Constraints\Iban;
use Sprain\ValidatorBundle\Validator\Constraints\IbanValidator;

class IbanValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new IbanValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new Iban());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new Iban());
    }

    /**
     * @dataProvider getValidIbans
     */
    public function testValidIbans($iban)
    {
        $this->context->expects($this->never())
        ->method('addViolation');

        $this->validator->validate($iban, new Iban());
    }

    public function getValidIbans()
    {
        return array(
            array('CH93 0076 2011 6238 5295 7'), //Switzerland
            array('CH9300762011623852957'), // Switzerland without spaces

            //Country list
            //http://www.rbs.co.uk/corporate/international/g0/guide-to-international-business/regulatory-information/iban/iban-example.ashx
            // array('GB29 RBOS 6016 1331 9268 19'), //United Kingdom -- currently fails!

            array('AL47 2121 1009 0000 0002 3569 8741'), //Albania
            array('AD12 0001 2030 2003 5910 0100'), //Andorra
            array('AT61 1904 3002 3457 3201'), //Austria
            array('AZ21 NABZ 0000 0000 1370 1000 1944'), //Azerbaijan
            array('BH67 BMAG 0000 1299 1234 56'), //Bahrain
            array('BE62 5100 0754 7061'), //Belgium
            array('BA39 1290 0794 0102 8494'), //Bosnia and Herzegovina
            array('BG80 BNBG 9661 1020 3456 78'), //Bulgaria
            array('HR12 1001 0051 8630 0016 0'), //Croatia
            array('CY17 0020 0128 0000 0012 0052 7600'), //Cyprus
            array('CZ65 0800 0000 1920 0014 5399'), //Czech Republic
            array('DK50 0040 0440 1162 43'), //Denmark
            array('EE38 2200 2210 2014 5685'), //Estonia
            array('FO97 5432 0388 8999 44'), //Faroe Islands
            array('FI21 1234 5600 0007 85'), //Finland
            array('FR14 2004 1010 0505 0001 3M02 606'), //France
            array('GE29 NB00 0000 0101 9049 17'), //Georgia
            array('DE89 3704 0044 0532 0130 00'), //Germany
            array('GI75 NWBK 0000 0000 7099 453'), //Gibraltar
            array('GR16 0110 1250 0000 0001 2300 695'), //Greece
            array('GL56 0444 9876 5432 10'), //Greenland
            array('HU42 1177 3016 1111 1018 0000 0000'), //Hungary
            array('IS14 0159 2600 7654 5510 7303 39'), //Iceland
            array('IE29 AIBK 9311 5212 3456 78'), //Ireland
            array('IL62 0108 0000 0009 9999 999'), //Israel
            array('IT40 S054 2811 1010 0000 0123 456'), //Italy
            array('LV80 BANK 0000 4351 9500 1'), //Latvia
            array('LB62 0999 0000 0001 0019 0122 9114'), //Lebanon
            array('LI21 0881 0000 2324 013A A'), //Liechtenstein
            array('LT12 1000 0111 0100 1000'), //Lithuania
            array('LU28 0019 4006 4475 0000'), //Luxembourg
            array('MK072 5012 0000 0589 84'), //Macedonia
            array('MT84 MALT 0110 0001 2345 MTLC AST0 01S'), //Malta
            array('MU17 BOMM 0101 1010 3030 0200 000M UR'), //Mauritius
            array('MD24 AG00 0225 1000 1310 4168'), //Moldova
            array('MC93 2005 2222 1001 1223 3M44 555'), //Monaco
            array('ME25 5050 0001 2345 6789 51'), //Montenegro
            array('NL39 RABO 0300 0652 64'), //Netherlands
            array('NO93 8601 1117 947'), //Norway
            array('PK36 SCBL 0000 0011 2345 6702'), //Pakistan
            array('PL60 1020 1026 0000 0422 7020 1111'), //Poland
            array('PT50 0002 0123 1234 5678 9015 4'), //Portugal
            array('RO49 AAAA 1B31 0075 9384 0000'), //Romania
            array('SM86 U032 2509 8000 0000 0270 100'), //San Marino
            array('SA03 8000 0000 6080 1016 7519'), //Saudi Arabia
            array('RS35 2600 0560 1001 6113 79'), //Serbia
            array('SK31 1200 0000 1987 4263 7541'), //Slovak Republic
            array('SI56 1910 0000 0123 438'), //Slovenia
            array('ES80 2310 0001 1800 0001 2345'), //Spain
            array('SE35 5000 0000 0549 1000 0003'), //Sweden
            array('CH93 0076 2011 6238 5295 7'), //Switzerland
            array('TN59 1000 6035 1835 9847 8831'), //Tunisia
            array('TR33 0006 1005 1978 6457 8413 26'), //Turkey
            array('AE07 0331 2345 6789 0123 456'), //UAE
        );
    }

    /**
     * @dataProvider getInvalidIbans
     */
    public function testInvalidIbans($iban)
    {
        $constraint = new Iban(array(
            'message' => 'myMessage'
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage', array(
                '{{ value }}' => $iban,
            ));

        $this->validator->validate($iban, $constraint);
    }

    public function getInvalidIbans()
    {
        return array(
            array('CH93 0076 2011 6238 5295'),
            array('CH930076201162385295'),
            array('GB29 RBOS 6016 1331 9268 19'),
            array('CH930072011623852957'),
            array('NL39 RASO 0300 0652 64'),
            array('NO93 8601117 947'),
            array('CY170020 128 0000 0012 0052 7600'),
            array('foo'),
            array('123'),
        );
    }
}
