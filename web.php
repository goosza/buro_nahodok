<?php


use Illuminate\http\Request;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/getAll',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $items=App\Items::all();
    return $items;
    
});

Route::get('/found',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $items=App\Items::where('status',1)->get();
    return $items;
});

Route::get('/lost',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $items=App\Items::where('status',0)->get();
    return $items;
});
Route::get('/search',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $items=App\Items::where('title', 'like', '%' .$req->searching. '%')->orWhere('description', 'like', '%' . $req->searching . '%')->get();
    return $items;
});
Route::get('/insert',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $items=App\Items::create(['status' => $req->post_status,'title' => $req->post_title, 'description'=>$req->post_description,'contacts'=>$req->post_number,'completed'=>0]);
    return $items->id;
});
Route::get('/myposts',function(Request $req){
    header('Access-Control-Allow-Origin: *');
    $mas=[];
    $local_id=json_decode($req->id);
    for ($i=0;$i<count($local_id);$i++){
        $ids=App\Items::where('id',$local_id[$i])->get();
        array_push($mas,$ids);
    }
    return $mas;
    
});