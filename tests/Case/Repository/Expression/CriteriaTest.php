<?php
namespace TimeCardMD\Repository\Expression;

use TimeCardMD\Repository\Expression\Criteria;
use TimeCardMD\Repository\Expression\Restriction;
use TimeCardMD\Repository\Expression\Operator;

class CriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing add method. Just one restriction
     *
     * @access public
     * @return null
     */
    public function testAddJustOneRestriction()
    {

        $restriction = new Restriction('state', 'IN', array('SP', 'RJ', 'BH'));
        $expected = array(
            clone $restriction
        );
        $Criteria = new Criteria;
        $Criteria->add($restriction);

        $result = $Criteria->getExpressions();
        $this->assertEquals($expected, $result);

        $result = $Criteria->getOperator();
        $this->assertEquals('AND', $result);
    }

    /**
     * Testing add method. Many restriction
     *
     * @access public
     * @return null
     */
    public function testAddManyRestrictions()
    {
        $Criteria = new Criteria;
        $restriction1 = new Restriction('state', 'IN', array('SP', 'RJ'));
        $restriction2 = new Restriction('city', '=', 'Salvador');
        $restriction3 = new Restriction('id', '=', 10);
        $expected = array(
            clone $restriction1,
            clone $restriction2,
            clone $restriction3
        );

        $Criteria->setOperator(Operator::_AND);
        $Criteria->add($restriction1)->add($restriction2)->add($restriction3);

        $result = $Criteria->getExpressions();
        $this->assertEquals($expected, $result);

        $result = $Criteria->getOperator();
        $this->assertEquals('AND', $result);
    }

    /**
     * Testing add method. Default operator
     *
     * @access public
     * @return null
     */
    public function testAddOperatorDefault()
    {
        $Criteria = new Criteria;
        $restriction1 = new Restriction('state', 'IN', array('SP', 'RJ'));
        $restriction2 = new Restriction('city', '=', 'Salvador');
        $restriction3 = new Restriction('id', '=', 10);
        $expected = array(
            clone $restriction1,
            clone $restriction2,
            clone $restriction3
        );
        $Criteria->add($restriction1)->add($restriction2)->add($restriction3);

        $result = $Criteria->getExpressions();
        $this->assertEquals($expected, $result);

        $result = $Criteria->getOperator();
        $this->assertEquals('AND', $result);
    }

    /**
     * Testing add method. OR operator
     *
     * @access public
     * @return null
     */
    public function testAddOperatorOr()
    {
        $Criteria = new Criteria;
        $Criteria->setOperator(Operator::_OR);
        $restriction1 = new Restriction('state', 'IN', array('SP', 'RJ'));
        $restriction2 = new Restriction('city', '=', 'Salvador');
        $restriction3 = new Restriction('id', '=', 10);
        $expected = array(
            clone $restriction1,
            clone $restriction2,
            clone $restriction3
        );
        $Criteria->add($restriction1)->add($restriction2)->add($restriction3);

        $result = $Criteria->getExpressions();
        $this->assertEquals($expected, $result);

        $result = $Criteria->getOperator();
        $this->assertEquals('OR', $result);
    }

    /**
     * Testing add method. Add Criteria and restriction
     *
     * @access public
     * @return null
     */
    public function testAddMultipleType()
    {
        $Criteria = new Criteria;
        $Criteria->setOperator(Operator::_OR);
        $restriction1 = new Restriction('state', 'IN', array('SP', 'RJ'));
        $restriction2 = new Restriction('city', '=', 'Salvador');
        $restriction3 = new Restriction('id', '=', 10);

        $Criteria->add($restriction1, $restriction2);

        $expected = array(
            clone $restriction3,
            clone $Criteria
        );

        $Criteria2 = new Criteria;
        $Criteria2->add($restriction3)->add($Criteria);

        $result = $Criteria2->getExpressions();
        $this->assertEquals($expected, $result);

        $result = $Criteria2->getOperator();
        $this->assertEquals('AND', $result);
    }

    /**
     * Teste set / get limit
     *
     * @access public
     * @return null
     */
    public function testLimit()
    {
        $Criteria = new Criteria;
        $Criteria->setLimit('30');
        $expected = 30;
        $result = $Criteria->getLimit();
        $this->assertEqual($result, $expected);
    }

    /**
     * Teste set / get order
     *
     * @access public
     * @return null
     */
    public function testOrder()
    {
        $Criteria = new Criteria;
        $Criteria->setOrder(
            array(
                'name' => 'DESC',
                'age' => 'ASC'
            )
        );
        $expected = array('name' => 'DESC', 'age' => 'ASC');
        $result = $Criteria->getOrder();
        $this->assertSame($result, $expected);

        try {
            $Criteria->setOrder('name ASC');
        } catch ( \InvalidArgumentException $e) {
            $this->assertSame($result, $expected);
        }
        $this->fail('InvalidArgumentException esperado');
    }
}