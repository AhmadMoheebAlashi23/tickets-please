<?php

namespace App\Traist;

trait ApiResponses {

    public function ok($message,$data=[]){
        return $this->success($message,$data,200);
    }


    protected function success($message,$data=[],$statusCode = 200){
        return response()->json([
            'data'=>$data,
            'message'=>$message,
            'status'=>$statusCode,
        ],$statusCode);
    }

    protected function error($message,$statusCode){
        return response()->json([
            'message'=>$message,
            'status'=>$statusCode,
        ],$statusCode);
    }
}