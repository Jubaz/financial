<?php
namespace App\Search;

use App\Models\UserPayment;
use App\Search\Filters\TypeFilter;
use Illuminate\Http\Request;

class PaymentSearch
{

    private $typeFilter;

    public function __construct(TypeFilter $typeFilter)
    {
        $this->typeFilter = $typeFilter;
    }

    /**
     * search in user payments by filters
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function search(Request $request)
    {
        $query = (new UserPayment())->newQuery();

        // Search for a user payments based on their type.
        if ($request->has('type')) {
            $query = $this->typeFilter->apply($query,$request->input('type'));
        }

        // get the results and return them.
        return $query->get();
    }

}