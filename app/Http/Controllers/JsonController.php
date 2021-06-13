<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\CompanyModel;
use App\Models\IndustryModel;
use App\Models\PageModel;
use App\Models\ProvinceModel;
use App\Models\RegencyModel;
use App\Models\VacancyModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            $companies = CompanyModel::select(
                'id',
                'industry_id',
                'name',
                'slug as url',
                'size',
                'logo',
                'address',
                'description',
                )
            ->orderByDesc('id')
            ->paginate(400);
            foreach ($companies as $key => $value) {
                $companies[$key]->size_from = null;
                $companies[$key]->size_to = null;
                if(!empty($value->size)){
                    try{
                        $size = explode(' - ',$value->size);
                        $companies[$key]->size_from = (int) @$size[0];
                        $companies[$key]->size_to = (int) str_replace(" Pekerja","",@$size[1]);
                    }catch(Exception $e){

                    }
                }
                $companies[$key]->meta_description = Str::limit(strip_tags($value->description), 100, ' [info loker selengkapnya]');
                unset($companies[$key]->size);
            }
            return response()->json($companies);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function vacancy(){
        try{
            $vacancies = VacancyModel::select(
                'id',
                'company_id',
                'category_id',
                'regency_id',
                'title',
                'slug as url',
                'address',
                'description',
                'apply as apply_google',
                'published as is_published',
                'created_at as published_at',
                'deadline',
            )
            ->paginate(605);
            foreach ($vacancies as $key => $value) {
                $vacancies[$key]->meta_description = Str::limit(strip_tags($value->description), 100, ' [info loker selengkapnya]');
            }
            return response()->json($vacancies);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
