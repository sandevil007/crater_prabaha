<?php

namespace Crater\Http\Controllers\V1\Admin\Customer;

use Crater\Http\Controllers\Controller;
use Crater\Models\Customer;

class ShowAttachmentController extends Controller
{
    /**
     * Retrieve details of an customer attachment from storage.
     *
     * @param   \Crater\Models\Customer $customer
     * @return  \Illuminate\Http\JsonResponse
     */
    public function __invoke(Customer $customer)
    {
        $this->authorize('view', $customer);

        if ($customer) {
            $media = $customer->getFirstMedia('attachment');

            if ($media) {
                return response()->file($media->getPath());
            }

            return respondJson('attachment_does_not_exist', 'Attachment does not exist.');
        }
    }
}
