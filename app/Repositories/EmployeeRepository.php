<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\EmployeeModel;

class EmployeeRepository extends BaseEloquentRepository implements EmployeeRepositoryInterface
{
    public function __construct(EmployeeModel $employeeModel)
    {
        $this->model = $employeeModel;
    }
}
