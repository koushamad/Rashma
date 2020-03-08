<?php

namespace App\Services\Traits;

use Facade\FlareClient\Http\Exceptions\NotFound;

trait Addable
{
    /**
     * @param array $list
     * @return array
     */
    public function add(array $list): array
    {
        $result = collect($list)->map(
            function (array $item) {
                $item = collect($item);
                if (empty($item->get('id'))) {
                    if (!empty($item->get('name'))){
                        try {
                            return (int) collect($this->equal(strtolower($item->get('name'))))->get('id');
                        } catch (NotFound $exception) {
                            return (int) $this->create(['name' => strtolower($item->get('name'))])->get('id');
                        }
                    }
                }else{
                    return (int) $item->get('id');
                }
            }
        );
        return $result->toArray();
    }
}
