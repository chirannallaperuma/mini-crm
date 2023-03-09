<?php

namespace App\Http\Controllers;

use App\Interfaces\CompanyRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companyRepository->findAll();

        $data = [
            'companies' => $companies
        ];

        return view('companies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'company_name' => 'required',
            'email' => 'email',
            'website' => 'url'
        ]);

        try {
            $this->companyRepository->create($request->all());

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
        $company = $this->companyRepository->findOrFail($id);

        $data = [
            'company' => $company
        ];

        return view('companies.edit', $data);
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
            'company_name' => 'required',
            'email' => 'email',
            'website' => 'url'
        ]);

        try {
            $this->companyRepository->updateCompany($id, $request->all());

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
            $this->companyRepository->deleteById($id);

            return redirect()->back()->with('success', 'deleted');

        } catch (Exception $e) {
            return redirect()->back()->with('error;', 'something went wrong');
        }
    }
}
