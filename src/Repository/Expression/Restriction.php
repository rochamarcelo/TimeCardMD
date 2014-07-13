<?php
namespace TimeCardMD\Repository\Expression;
class Restriction
{
    /**
     * Field used in the restriction
     *
     * @var string
     */
    protected $field;

    /**
     * Operator used in the restriction
     *
     * @var string
     */
    protected $operator;

    /**
     * Restrictional value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Contructor
     *
     * @param string $field    Field name
     * @param string $operator Comparison operator
     * @param mixed  $value    values
     *
     * @access public
     * @return void
     */
    public function __construct($field, $operator, $value)
    {
        $this->field = (string)$field;
        $this->operator = trim($operator);
        $this->value = $value;
    }

    /**
     * Gets the Field used in the restriction.
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Gets the Operator used in the restriction.
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Gets the restrictional value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}