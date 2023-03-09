<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\CompanyModel;
use App\Traits\UploadTrait;

class CompanyRepository extends BaseEloquentRepository implements CompanyRepositoryInterface
{
    use UploadTrait;

    protected $model;

    public function __construct(CompanyModel $model)
    {
        $this->model = $model;
    }

    public function create($request)
    {
        $company = new $this->model;

        $company->name = $request['company_name'];
        $company->email = $request['email'];
        $company->website = $request['website'];
        $company->save();

        if ($request['logo']) {
            $file = $request['logo'];

            $fileExtension = $file->extension();
            $fileName = time() . $request['company_name'] . '.' . $fileExtension;
            $company = $this->model->findOrFail($company->id);
            $company->logo = $fileName;
            $company->save();

            $destinationPath = 'logos';
            $file->move($destinationPath, $fileName);
        } 
        
        return $company;
    }

    public function updateCompany($id, $request)
    {
        $data['name'] =  $request['company_name'];
        $data['email'] =  $request['email'];
        $data['website'] =  $request['website'];

        if (!empty($request['logo'])) {
            $file = $request['logo'];

            $fileExtension = $file->extension();
            $fileName = time() . $request['company_name'] . '.' . $fileExtension;
            $data['logo'] = $fileName;

            $destinationPath = 'logos';
            $file->move($destinationPath, $fileName);
        }
      
        $this->updateWithId($id, $data);
    }
}
