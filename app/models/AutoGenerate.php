<?php

namespace App\models;

class AutoGenerate
{
    public function uniqueJobcode()
    {
        $product = Jobtype::select('id')->orderBy('id', 'Desc')->first();
        // $id = ''.str_pad($product->id + 1, 8, "0", STR_PAD_LEFT);
        $product = ($product) ? 'JOB_' . str_pad($product->id + 1, 8, "0", STR_PAD_LEFT) : 'JOB_' . str_pad(1, 8, "0", STR_PAD_LEFT);
        $validator = \Validator::make(['job_code' => $product], ['job_code' => 'unique:jobtypes,job_code']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $product;
    }

    public function randomId()
    {
        $id = str_random(10);
        $validator = \Validator::make(['sku_no' => $id], ['sku_no' => 'unique:products,sku_no']);
        if ($validator->fails()) {
            return $this->randomId();
        }
        return $id;
    }
}
