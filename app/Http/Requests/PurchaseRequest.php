<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'purchase_date'     => ['required', 'date'],
            'vehicle_no'        => ['required', 'string', 'max:100'],
            'bilty_no'          => ['required', 'integer', 'min:0'],
            'prod_inv_no'       => ['required', 'string', 'max:100'],
            'account_id'        => ['required', 'string'],
            'item_id'           => ['required', 'string'],
            'company_weight'    => ['required', 'integer', 'min:0'],
            'party_weight'      => ['required', 'integer', 'min:0'],
            'weight_difference' => ['required', 'integer', 'min:0'],
            'posted_weight'     => ['required', 'integer', 'min:0'],
            'rate'              => ['required', 'integer', 'min:0'],
            'gross_ammount'     => ['required', 'integer', 'min:0'],
            'fare'              => ['required', 'integer', 'min:0'],
            'others_charges'    => ['required', 'integer', 'min:0'],
            'net_ammount'       => ['required', 'integer', 'min:0'],
            'remarks'           => ['nullable', 'string'],
        ];
    }
}
