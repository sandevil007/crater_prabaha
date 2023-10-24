<?php

namespace Crater\Http\Controllers\V1\PDF;

use Crater\Http\Controllers\Controller;
use Crater\Models\Customer;

class DownloadCustomerAttachmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Customer $customer
     * @param   string $hash
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Customer $customer)
    {
        $this->authorize('view', $customer);

        if ($customer) {
            $media = $customer->getFirstMedia('attachment');
            if ($media) {
                $imagePath = $media->getPath();
                $response = \Response::download($imagePath, $media->file_name);
                if (ob_get_contents()) {
                    ob_end_clean();
                }

                return $response;
            }
        }

        return response()->json([
            'error' => 'attachment_not_found',
        ]);
    }
}
