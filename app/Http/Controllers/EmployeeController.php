<?php

namespace App\Http\Controllers;

use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    protected $companyRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employeeRepository->findAll();

        $data = [
            'employees' => $employees
        ];

        return view('employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $this->companyRepository->findAll();

        $data = [
            'companies' => $companies
        ];

        return view('employees.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email'
        ]);

        try {
            $this->employeeRepository->createAndReturnModel($request->all());

            return redirect()->back()->with('success', 'succesfully created');
        } catch (Exception $e) {
            return redirect()->back()->with('error;', 'something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employeeRepository->findOrFail($id);
        $companies = $this->companyRepository->findAll();

        $data = [
            'employee' => $employee,
            'companies' => $companies
        ];

        return view('employees.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email'
        ]);

        try {
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_id' => $request->company_id,
                'email' => $request->email,
                'phone' => $request->phone
            ];

            $this->employeeRepository->updateWithId($id, $data);

            return redirect()->back()->with('success', 'succesfully updated');
        } catch (Exception $e) {
            return redirect()->back()->with('error;', 'something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->employeeRepository->deleteById($id);

            return redirect()->back()->with('success', 'deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error;', 'something went wrong');
        }
    }
}
