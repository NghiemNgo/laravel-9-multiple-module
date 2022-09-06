<?php

namespace Modules\Mysql\Repositories;


use Illuminate\Database\Eloquent\Model;
use Modules\Mysql\Entities\Employee;
use Modules\Mysql\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Str;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    /**      
     * @var Model
     */     
     protected $employee;

    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $employee
     */
    public function __construct(Employee $employee) {
        $this->employee = $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $attributes
     * @return collection Employee
     */
    public function store($attributes) {
        $employee = $this->employee->create($attributes);
        return $employee;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer $id
     * @return collection Employee
     */
    public function find($id) {
        $employee = $this->employee::find($id);
        return $employee;
    }

    /**
     * update employee.
     *
     * @param integer $id 
     * @param  array $attributes
     * @return collection Employee
     */
    public function update($id, $attributes) {
        $transaction = $this->employee::find($id)->update($attributes);
        return $transaction;
    }
}
