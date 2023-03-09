<?php

namespace App\Interfaces;

interface CompanyRepositoryInterface
{
    public function create($data);
    public function updateCompany($id, $data);
}