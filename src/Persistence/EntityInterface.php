<?php
namespace TimeCardMD\Persistence;

interface PersistenceInterface
{

     /**
     * Find registry
     *
     * @param array $options A list of options [conditions, fields, order, group]
     *
     * @access public
     * @return mixed
     */
    public function find($options = []);

    /**
     * Find a registry by its id
     *
     * @param integer $id registry identification
     *
     * @access public
     * @return Entity
     */
    public function findById($id);

    /**
     * Save a registry
     *
     * @param EntityInterface $entity a registry
     *
     * @access public
     * @return boolean
     */
    public function save(EntityInterface $entity);

    /**
     * Delete a registry
     *
     * @param EntityInterface $entity a registry
     *
     * @access public
     * @return boolean
     */
    public function delete(EntityInterface $entity);

    /**
     * Set a class entity to be used in finds method
     *
     * @access public
     * @param string $class entity class name
     */
    public function setEntityClass($class);
}