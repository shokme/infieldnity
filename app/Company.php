<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Algolia\AlgoliaSearch\SearchClient;

class Company extends Model
{
    use Searchable;

    public $timestamps = false;
    protected $fillable = ['value'];

    public function searchableAs()
    {
        return 'companies_index';
    }

    public function scopeAlgoliaSync()
    {
        $data = null;
        $company = $this->where('user_id', 1)->get();
        $company->each(function ($item) use (&$data) {
            $data[$item['name']] = $item['value'];
            return $data;
        });
        $data['companies_id'] = $data['user_id'] = $data['objectID'] = 1;

        $client = SearchClient::create(
            'QPA6WD3N3W',
            'c9c90f0e9f58417bae48f9129273aec5'
        );

        $index = $client->initIndex('companies_index');

        $index->saveObject($data);
    }
}
