<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteItemModelTrait
{
    public function deleteItemTrait($id, $model)
    {
        try {
            $model->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $err) {
            Log::error('Error: ' . $err->getMessage() . 'Line: ' . $err->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
