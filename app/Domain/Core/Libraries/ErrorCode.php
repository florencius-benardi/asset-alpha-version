<?php

namespace App\Domain\Core\Libraries;

$informationCode = [
    ## Notes ##
    /*
    * xr : Read Data
    * xc : Create Data
    * xu : Update Data
    */
    'x_info_code' => [
        'xr_not_found'              => 'Data %{name} not found!',
        'xc_data_success'           => '%{code} %{description} created successfully',
        'xc_document_success'       => 'Document %{module} %{code} created successfully',
        'xu_update_successfully'    => '%{name} updated successfully',
        'xd_deleted_successfully'   => '%{name} deleted successfully',
        'xu_request_submitted'      => 'Document %{code} has been submitted successfully',
        'xu_request_approved'       => 'Document %{code} has been approved.',
        'xu_request_uploaded'       => 'Document %{code} has been uploaded.',
        'xu_request_delivered'      => 'Document %{code} has been delivered.',
    ],
    'dataS' => [
        'x_not_found'               => '%{name} not found!',
        'x_created_successfully'    => '%{code} %{description} created successfully',
        'x_update_successfully'     => '%{name} updated successfully',
        'x_deleted_successfully'    => '%{name} deleted successfully',
        'x_request_submitted'       => '%{table} %{code} Code has been Submitted successfully',
    ],
];

return $informationCode;
