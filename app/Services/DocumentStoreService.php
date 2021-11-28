<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DocumentStoreService{
    public static function docStore($doc){
        $ext = strtolower($doc->getClientOriginalExtension());
        $docName = time().$ext.rand().'.'. $ext;
        $doc_url = $docName;
        $doc->move(public_path('jobimage'),$docName);
        return $doc_url;
    }
}
