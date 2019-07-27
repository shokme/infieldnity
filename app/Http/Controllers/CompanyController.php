<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Field;
use Algolia\AlgoliaSearch\SearchClient;

class CompanyController extends Controller
{
    public function show($id)
    {
        return Company::search($id)->raw()['hits'][0];
    }

    public function store(Request $request)
    {
        $fields = Field::select('name')->where('created_user_id', 1)->get()->pluck('name');
        $validated = collect($request->properties)->filter(function ($item) use ($fields) {
            return in_array($item['name'], $fields->toArray());
        });

        $properties = collect($validated)->map(function ($item) {
            $item['user_id'] = 1;
            return $item;
        });

        if ($properties->isEmpty()) {
            return response(['errors' => 'no_entries'], 422);
        }

        $properties->map(function ($item) {
            $company = new Company();
            $company->name = $item['name'];
            $company->value = $item['value'];
            $company->user_id = $item['user_id'];
            $company->save();
        });

        return Company::where('user_id', 1)->get();
    }

    public function update(Request $request)
    {
        $fields = Field::select('name')->where('created_user_id', 1)->get()->pluck('name');
        $validated = collect($request->properties)->filter(function ($item) use ($fields) {
            return in_array($item['name'], $fields->toArray());
        });


        $validated->each(function ($item) {
            Company::where('user_id', 1)->where('name', $item['name'])->update(['value' => $item['value']]);
        });

        Company::algoliaSync();

        return Company::search(1)->get();
    }
}
