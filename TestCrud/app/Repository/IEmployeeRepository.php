<?php

namespace App\Repository;

interface IEmployeeRepository
{

    //get all employees
    public function getEmployees():object;

    //create employee
    public function createEmployee(array $data):object;

    //get single employee
    public function singleEmployee(int $id):object;
    //update employee
    public function updateEmployee(int $id,array $data):object;
    //delete employee
    public function removeEmployee(int $id):bool;

}
