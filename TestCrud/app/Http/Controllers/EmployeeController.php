<?php

namespace App\Http\Controllers;

use App\Repository\IEmployeeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{


    /**
     * @var IEmployeeRepository
     */
    private $employee;

    public function __construct(IEmployeeRepository $employee)
    {
        $this->employee = $employee;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->employee->getEmployees();
            $response = ["status" => 200, "message" => "Employee Data", "data" => $data];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'employee_name' => 'required|max:255',
            'employee_code' => 'required|unique:employees|max:255',
            'employee_department' => 'required|max:255',
            'company_code' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            $data = $request->all();
            $data = $this->employee->createEmployee($data);
            $response = ["status" => 200, "message" => "Employee created successfully", "data" => $data];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->employee->singleEmployee($id);
            $response = ["status" => 200, "message" => "Employee Details", "data" => $data];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'employee_name' => 'max:255',
            'employee_code' => 'unique:employees|max:255',
            'employee_department' => 'max:255',
            'company_code' => 'max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        try {
            $data = $request->all();
            $data = $this->employee->updateEmployee($id, $data);
            $response = ["status" => 200, "message" => "Employee Updated Details", "data" => $data];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id):JsonResponse
    {
        try {
            $data = $this->employee->removeEmployee($id);
            $response = ["status" => 200, "message" => "Employee Deleted"];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    /**
     * Return employee details with company data.
     *
     * @return \Illuminate\Http\Response
     */
    public function employCompanyData():JsonResponse
    {
        try {
            $data = $this->employee->getEmployeeCompanyData();
            $response = ["status" => 200, "message" => "Employee Company Data","data"=>$data];
            return response()->json($response);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
