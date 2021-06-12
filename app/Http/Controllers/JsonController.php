<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\IndustryModel;
use App\Models\PageModel;
use App\Models\ProvinceModel;
use App\Models\RegencyModel;
use Exception;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function category(){
        try {
            $categories = CategoryModel::select('id','name as category','slug as url','icon')
            ->get();
            return response()->json($categories);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function industry(){
        try {
            $industries = IndustryModel::select('id','name as industry','slug as url')
            ->get();
            return response()->json($industries);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function province(){
        try {
            $provinces = ProvinceModel::select('id','name as province','slug as url')
            ->get();
            return response()->json($provinces);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function regency(){
        try {
            $regencies = RegencyModel::select('id','province_id','name as regency','slug as url')
            ->get();
            return response()->json($regencies);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function pages(){
        try {
            $pages = PageModel::select('id','title','slug as url','content','published as is_published')
            ->get();
            return response()->json($pages);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function company(){
        try {
            $companies = CompanyModel::get();
            return response()->json($companies);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
