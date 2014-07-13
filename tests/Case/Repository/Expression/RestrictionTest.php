<?php
namespace TimeCardMD\Repository\Expression;

use TimeCardMD\Repository\Expression\Restriction;

class RestrictionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Teste set and get, Not known operator
     *
     * @access public
     * @return null
     */
    public function testNotKnownOperator()
    {
        $invalido = 'DESCONHECIDO' . time();
        $Restriction = new Restriction('state', $invalido, array('SP', 'RJ', 'BH'));
        $field = 'state';
        $operator = $invalido;
        $value = array('SP', 'RJ', 'BH');
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }
    /**
     * Teste set and get, The value is an array
     *
     * @access public
     * @return null
     */
    public function testValueIsArray()
    {
        $Restriction = new Restriction('state', ' IN ', array('SP', 'RJ', 'BH'));
        $field = 'state';
        $operator = 'IN';
        $value = array('SP', 'RJ', 'BH');
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }

    /**
     * Teste set and get. The value is null
     *
     * @access public
     * @return null
     */
    public function testValueIsNull()
    {
        $Restriction = new Restriction('state', '=', null);
        $field = 'state';
        $operator = '=';
        $value = null;
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }

    /**
     * Teste set and get. The value is string
     *
     * @access public
     * @return null
     */
    public function testValueIsString()
    {
        $Restriction = new Restriction('country', '=', ' Brasil ');
        $field = 'country';
        $operator = '=';
        $value = ' Brasil ';
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }

    /**
     * Teste set and get. The value is boolean
     *
     * @access public
     * @return null
     */
    public function testValueIsBoolean()
    {
        $Restriction = new Restriction('active', '=', false);
        $field = 'active';
        $operator = '=';
        $value = false;
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());

        $Restriction = new Restriction('active', '=', true);
        $field = 'active';
        $operator = '=';
        $value = true;
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }

    /**
     * Teste set and get. The value is number
     *
     * @access public
     * @return null
     */
    public function testValueIsNumber()
    {
        $Restriction = new Restriction('age', '=', 1980);
        $field = 'age';
        $operator = '=';
        $value = 1980;
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());

        $Restriction = new Restriction('age', '=', '1980');
        $field = 'age';
        $operator = '=';
        $value = '1980';
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());

        $Restriction = new Restriction('price', '=', 1980.35);
        $field = 'price';
        $operator = '=';
        $value = 1980.35;
        $this->assertSame($field, $Restriction->getField());
        $this->assertSame($operator, $Restriction->getOperator());
        $this->assertSame($value, $Restriction->getValue());
    }
}