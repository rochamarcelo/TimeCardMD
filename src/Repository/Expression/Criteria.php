<?php
namespace TimeCardMD\Repository\Expression;
class Criteria extends Expression
{
    /**
     * Field used in the criteria
     *
     * @var string
     */
    protected $expressions = array();

    /**
     * Operator used in multiple criteria
     *
     * @var string
     */
    protected $operator = 'AND';

    /**
     * Rows limit
     *
     * @var integer
     */
    protected $limit;

    /**
     * Rows order, normally used in find
     *
     * @var array
     */
    protected $order = array();

    /**
     * Add an expression
     *
     * @param mixed $expression Expression
     *
     * @return self
     */
    public function add(Expression $expression)
    {
        $this->expressions[] = $expression;
        return $this;
    }

    /**
     * Gets the Field used in the criteria.
     *
     * @return string
     */
    public function getExpressions()
    {
        return $this->expressions;
    }

    /**
     * Gets the Operator used in multiple criteria.
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Sets the Operator used in multiple criteria.
     *
     * @param string $operator the operator
     *
     * @return self
     */
    public function setOperator($operator)
    {
        $this->operator = trim($operator);

        return $this;
    }

    /**
     * Gets the Rows limit.
     *
     * @return integer
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Sets the Rows limit.
     *
     * @param integer $limit the limit
     *
     * @return self
     */
    public function setLimit($limit)
    {
        $this->limit = (int)$limit;

        return $this;
    }

    /**
     * Gets the Rows order, normally used in find.
     *
     * @return array
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Sets the Rows order, normally used in find.
     *
     * @param array $order the order
     *
     * @return self
     */
    public function setOrder(array $order)
    {
        $this->order = $order;

        return $this;
    }
}