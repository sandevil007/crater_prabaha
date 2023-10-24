<?php

namespace Crater\Http\Controllers\V1\Admin\Customer;

use Crater\Http\Controllers\Controller;
use Crater\Http\Requests\UploadCustomerAttachmentRequest;
use Crater\Models\Customer;

class UploadAttachmentController extends Controller
{
    /**
     * Upload the customer attachment to storage.
     *
     * @param  \Crater\Http\Requests\UploadCustomerAttachmentRequest $request
     * @param  Customer $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UploadCustomerAttachmentRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $data = json_decode($request->attachment);

        if ($data) {
            if ($request->type === 'edit') {
                $customer->clearMediaCollection('attachment');
            }

            $customer->addMediaFromBase64($data->data)
                ->usingFileName($data->name)
                ->toMediaCollection('attachment');
        }

        return response()->json([
            'success' => 'Customer attachment uploaded successfully',
        ], 200);
    }
}
