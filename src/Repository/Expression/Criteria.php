<?php
namespace TimeCardMD\Repository\Expression;
class Criteria
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
     * Add an expression
     *
     * @param mixed $expression Expression
     *
     * @return self
     */
    public function add($expression)
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
        $this->operator = $operator;

        return $this;
    }
}