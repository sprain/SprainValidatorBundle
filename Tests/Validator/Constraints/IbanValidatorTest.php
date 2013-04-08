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
            array('CH93 0076 2011 6238 5295 7'),
            array('CH9300762011623852957'),
            array('NL39 RABO 0300 0652 64'),
            array('NO93 8601 1117 947'),
            array('CY17 0020 0128 0000 0012 0052 7600'),
            array('MT84 MALT 0110 0001 2345 MTLC AST0 01S'),
            array('RS35260005601001611379')
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
