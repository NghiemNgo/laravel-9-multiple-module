<?php

namespace Modules\Mysql\Repositories\Interfaces;

/**
* Interface EloquentRepositoryInterface
* 
* @package Modules\Mysql\Repositories\Interfaces
*/

interface EmployeeRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  array $attributes
     * @return collection Employee
     */
    public function store($attributes);

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer $id
     * @return collection Employee
     */
    public function find($id);

    /**
     * update employee.
     *
     * @param integer $id 
     * @param  array $attributes
     * @return collection Employee
     */
    public function update($id, $attributes);

}
