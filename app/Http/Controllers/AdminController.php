<?php

namespace App\Http\Controllers;

use App\Http\Requests\addCAtegory;
use App\Http\Requests\product;
use App\Http\Requests\updatePrd;
use App\Models\categorys;
use App\Models\Order;
use App\Models\prducts;
use App\Models\productCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    //

    public function index(){
        $data = prducts::limit(8)->get();
          $length = prducts::select('*')->count();


            if(Auth::check()){
                        if(Auth::user()->user_type == 'user'){
                        $count = productCart::where('user_id','=',Auth::id())->count();
                        
                         return view('home',['data' => $data,'length' =>$length , 'count' => $count ]);

                        }

              }


        return view('home',['data' => $data,'length' =>$length ]);
    }

    public function allProduct(){
        $data = prducts::all();

        $hidden = 'odhuhufufiu';
         if(Auth::check()){
                        if(Auth::user()->user_type == 'user'){
                        $count = productCart::where('user_id','=',Auth::id())->count();

                         return view('home',['data' => $data,'hidden' => $hidden  , 'count' => $count ]);

                        }

              }
        return view('home',['data' => $data,]);
    }



    public function test_admin(){
        return view('admin.test');
    }

    public function addCtg(){
        return view('admin.addCtg');
    }

    public function store_category(addCAtegory $request){
            $data = categorys::where('name','=',$request->name_category)->count();
            if($data>0){
                return redirect()->route('admin.addCategory')->with('error' , 'category already exists');
            }
            $res = new categorys();
            $res->name = $request->name_category;
            $res->save();
            return redirect()->route('admin.addCategory')->with('success' , 'category add successfully');
    }

    public function view_ctg(){
        $data = categorys::all();
        return view('admin.view_ctg',['data'=>$data]);
    }

    public function destroy_ctg($id){
        $data= categorys::find($id);
        if($data){
            $data->delete();
            return redirect()->route('admin.viewCategory')->with('success','data delete successfully');
        }
        return redirect()->route('admin.viewCategory')->with('error','Error on  delete  data');


    }

    public function update_category($id){
          $data= categorys::find($id);
        if($data){
            return view('admin.update_ctg',['data'=>$data]);
        }
        return redirect()->route('admin.viewCategory')->with('error','Error on  update  data');
    }

    public function storeUpdate(addCAtegory $request){
        $data = categorys::find($request->id_category);
        if($data){
            $data->name = $request->name_category;
            $data->save();
            return redirect()->route('admin.viewCategory')->with('success' , 'category update successfully');
        }
        return redirect()->route('admin.viewCategory')->with('error' , 'category not update successfully');
    }


    // stat product

       public function AddPrd(){
        $category = categorys::all();
        return view('admin.addPrd',['category' => $category]);
    }

     public function store_product(product $request){
            $data = prducts::where('name','=',$request->name)->where('id_category' , '=', $request->id_category)->count();
             $category = categorys::all();
            if($data>0){
                return redirect()->route('admin.addProduct')->with('error' , 'product already exists')->withInput();
            }
            $res = new prducts();
            $image = $request->product_image;
            if($image){
                $fileName = time().'.'.$image->getClientOriginalExtension();
                $res->product_image = $fileName;
            }
            $res->name = $request->name;
            $res->description = $request->description;
            $res->price = $request->price;
            $res->id_category = $request->id_category;
            $res->stock =  $request->stock;
            $res->save();

            if($image && $res->save()){
                 $image->move(public_path('uploads'), $fileName);
                // $res->product_image->move('uploads/',$fileName);
            }
            return redirect()->route('admin.addProduct')->with('success' , 'category add successfully');
    }

    public function ViewPrd(){
        $data = prducts::paginate(3);
        return view('admin.view_prd',['data' => $data]);
    }

    public function DeletePrd($id){
        $data = prducts::find($id);

        if($data){
            $data = prducts::find($id);
            $image_path = public_path('uploads/'.$data->product_image);
            if(file_exists($image_path)){
                unlink($image_path);
            }

            $data->delete();
            return redirect()->route('admin.view_product')->with('success','Product delete successfully');
        }else{
            return redirect()->route('admin.view_product')->with('error','Cannot find your product in database');
        }
    }

    public function updatePrd($id){

          $data = prducts::find($id);

        if($data){
            $category = categorys::all();
            return view('admin.update_prd',['data'=>$data,'category'=>$category]);
        }else{
            return redirect()->route('admin.view_product')->with('error','Cannot find your product in database');
        }
    }



    public function StoreUpdateProduct(updatePrd $request ,$id){
         $data = prducts::where('name','=',  $request->name )->where('id_category' , '=', $request->id_category)->where('id','!=',$id)->count();
             $category = categorys::all();
            if($data>0){
                  return back()->with('error', 'Product already exist')->withInput();
                }

                  $res = prducts::find($id);

            $image = $request->product_image;
            if($image){
                $fileName = time().'.'.$image->getClientOriginalExtension();
                $res->product_image = $fileName;
            }
            $res->name = $request->name;
            $res->description = $request->description;
            $res->id_category = $request->id_category;
            $res->stock =  $request->stock;
            $res->price = $request->price;
            $res->save();

            if($res->save()){
                if($image){
                     $image->move(public_path('uploads'), $fileName);
                }
            }
            return redirect()->route('admin.view_product')->with('success' , 'category Update successfully');
    }



      public function search_Prd(Request $request ){
        $search = $request->search;
        if($search != null){
             $data = prducts::where('name','like',  '%'.$search.'%' )->orWhere('description','like',  '%'.$search.'%')->paginate(2);
             return view('admin.view_prd',['data'=>$data]);
        }
              return view('admin.view_prd');
    }

      public function details($id){
          $data= prducts::find($id);
        if($data){
            return view('admin.details',['data'=>$data]);
        }
        return back()->withInput();
      }

       public function AllOrders(){
        $data = Order::paginate(3);
        foreach($data as $item){
            $item->name_p = prducts::where('id','=',$item->product_id)->value('name');
            $item->name_user = User::where('id','=',$item->user_id)->value('name');
        }
        return view('admin.view_Orders',['data' => $data]);
    }




    public function deleteOrder($id){
        $data= Order::findOrFail($id);
        if($data != null){
            $data->status = 'Rejected';
            $data->save();
            return redirect()->back()->with('success','Order Reject successfully');
        }
        return redirect()->back()->with('error','Error on  Reject  order');


    }


    public function acceptOrder($id){
        $data= Order::findOrFail($id);
        if($data != null){
            $data->status = 'Accept';
            $data->save();
            return redirect()->back()->with('success','Order Accept successfully');
        }
        return redirect()->back()->with('error','Error on  accept  order');


    }



    public function downloadPdf($id){
        $data= Order::findOrFail($id);
         $pdf = Pdf::loadView('admin.invoice', compact('data'));
        return $pdf->download('invoice'.time().'.pdf');
        //
        // if($data != null){
        //     $data->status = 'Accept';
        //     $data->save();
        //     return redirect()->back()->with('success','Order Accept successfully');
        // }
        // return redirect()->back()->with('error','Error on  accept  order');


    }
}
