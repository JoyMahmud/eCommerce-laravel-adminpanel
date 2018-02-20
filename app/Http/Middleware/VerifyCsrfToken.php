<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'product-sort','signup','signin',
        'admin/product/dialog.php','admin/product/execute.php','admin/product/upload.php','admin/product/success.php','admin/product/ajax_calls.php',
        'admin/slide/dialog.php','admin/slide/execute.php','admin/slide/upload.php','admin/slide/success.php','admin/slide/ajax_calls.php',
        'admin/settings/manufacture/dialog.php','admin/settings/manufacture/execute.php','admin/settings/manufacture/upload.php','admin/settings/manufacture/success.php','admin/settings/manufacture/ajax_calls.php',
        'admin/settings/common/dialog.php','admin/settings/common/execute.php','admin/settings/common/upload.php','admin/settings/common/success.php','admin/settings/common/ajax_calls.php',
        'user/pay-fail-back','user/pay-success-back','pay-pre-order-success-back','pay-pre-order-fail-back','charge-generate-city-list','charge-generate-area-list','pre-order-checkout/generate-charge'
    ];

}
