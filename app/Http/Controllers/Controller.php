<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    public static function success($data = null , $message = 'Request completed successfully' , $status = 200){
        return response()->json([
            'status'=>'success' ,
            'message'=>$message,
            'data'=>$data
        ],$status);
    }
    public static function error($message = 'error occurred',$status = 400 , $errors = null){
        $response = [
            'status'=>'error',
            'message'=> $message
        ];
        if($errors){
            $response['errors'] = $errors ;
        }
        return response()->json($response, $status);
    }
    public static function paginate($paginator , $message = 'Data retrieved successfully',$status = 200){
        return response()->json([
            'status'=>true ,
            'message'=>$message,
            'data'=>$paginator->items(),
            'pagination'=>[
                'total'=>$paginator->total(),
                'per_page'=>$paginator->perPage(),
                'current_page'=>$paginator->currentPage(),
                'last_page'=>$paginator->lastPage(),
                'has_more'=>$paginator->hasMorePages(),
                'next_page_url'=>$paginator->nextPageUrl(),
                'prev_page_url'=>$paginator->previousPageUrl(),
            ]
        ],$status);
    }

}
