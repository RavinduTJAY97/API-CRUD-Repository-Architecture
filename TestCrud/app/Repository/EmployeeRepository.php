<?php

namespace App\Repository;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements IEmployeeRepository
{

    public function getEmployees(): object
    {
        $employees = Employee::all();
        return $employees;
    }

    public function createEmployee(array $data): object
    {
        $employee = new Employee();
        $employee->employee_name    =$data['employee_name'];
        $employee->employee_code    =$data['employee_code'];
        $employee->employee_department = $data['employee_department'];
        $employee->company_code     =$data['company_code'];
        $employee->save();
        return $employee;
    }

    /**
     * @throws \Exception
     */
    public function singleEmployee(int $id):object
    {
        $employee = Employee::find($id);
        if (!$employee){
            throw new \Exception("Invalid id entered");
        }
        return $employee;
    }

    /**
     * @throws \Exception
     */
    public function updateEmployee(int $id, array $data): object
    {
        $employee = Employee::find($id);
        if (!$employee){
            throw new \Exception("Invalid id entered");
        }
        $employee->employee_name    =$data['employee_name'];
        $employee->employee_code    =$data['employee_code'];
        $employee->employee_department = $data['employee_department'];
        $employee->company_code     =$data['company_code'];
        $employee->save();
        return $employee;
    }

    public function removeEmployee(int $id): bool
    {
        $employee = Employee::find($id);
        if (!$employee){
            throw new \Exception("Invalid id entered");
        }
        return $employee->delete();
    }

    public function getEmployeeCompanyData(): object
    {
        $employees = DB::table('employees')
            ->leftJoin('companies','employees.company_code','=','companies.company_code')
            ->select('*')
            ->get();
        return $employees;
    }
}
