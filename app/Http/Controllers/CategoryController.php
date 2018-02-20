<?php

namespace App\Http\Controllers;

use App\Category;
use App\CateogryGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    function __construct()
    {
        $this->middleware('adminAuth');
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['page_title'] = 'Category';
        return view('admin.category.index',$data);
    }
    /*
     * New Category create form page view
     */
    public function create()
    {
        $data = [];
        $data['page_title'] = 'Category Create';
        return view('admin.category.create',$data);
    }
    /*
     * Store new category information in database
     *
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:categories'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->has('main_menu'))
        {
            $main_menu = $request->main_menu;
        }
        else{
            $main_menu = '0';
        }
        if($request->has('highlighted'))
        {
            $highlighted = $request->highlighted;
        }
        else{
            $highlighted = '0';
        }
        if($request->has('is_group_label'))
        {
            $is_group_label = $request->is_group_label;
        }
        else{
            $is_group_label = '0';
        }
        if($request->has('is_tabbed'))
        {
            $is_tabbed = $request->is_tabbed;
        }
        else{
            $is_tabbed = '0';
        }
        $data = [
            'title' => trim($request->title),
            'icon' => $request->icon,
            'root' => '0',
            'main_menu' => $main_menu,
            'highlighted' => $highlighted,
            'is_group_label' => $is_group_label,
            'is_tabbed' => $is_tabbed
        ];
        $insert_data = Category::create($data);
        if($insert_data)
        {
            return redirect(route('category'))->with('success','new category added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
    public function categoryData()
    {
        $categories = Category::where('root',0)->orderBy('row_order', 'asc')->select('id','title','icon','main_menu','highlighted','is_tabbed','created_at','deleted_at','row_order')->withTrashed();
        return \Datatables::of($categories)
            ->addColumn('SubCategory', function($SubCategory){
                $html = '
                <a href="'.route('sub_category', $SubCategory->id).'" class="btn bg-purple margin" target="_blank" ><i class="fa fa-pencil-square-o"></i>List</a>
                <a href="'.route('new_sub_category', $SubCategory->id).'" class="btn bg-navy btn-flat margin"><i class="fa fa-plus-square"></i> New</a>';
                return $html;
            })
            ->addColumn('Action', function($category){
                $html = '
                <a href="'.route('category_edit', $category->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>';
                if($category->deleted_at != '')
                    $html.= '<a href="'.route('category_soft_delete_restore', $category->id).'" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>';
                else
                    $html.= '<a href="'.route('category_soft_delete', $category->id).'" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>';
                return $html;
            })
            ->editColumn('icon',function($icon){
                if(empty($icon->icon))
                {
                    $html = ' ';
                }
                else
                {
                    $html = '<img src=" '.$icon->icon.' " width="70px"/>';
                }
                return $html;
            })
            ->editColumn('main_menu', function($main_menu){
                switch($main_menu->main_menu)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     *
                     */
                    case '0': return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class = "badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>';
                }
            })
            ->editColumn('highlighted', function($highlighted){
                switch($highlighted->highlighted)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     *
                     */
                    case '0': return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class = "badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>';
                }
            })
            ->editColumn('is_tabbed', function($highlighted){
                switch($highlighted->is_tabbed)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     *
                     */
                    case '0': return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class = "badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>';
                }
            })
            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->remove_column('deleted_at')
            ->make(true);
    }
    /*
     * New Sub Category create form page view
     */
    public function SubCategoryCreate($id)
    {
        $data = [];
        $data['page_title'] = 'Sub Category Create';
        $data['categoryDetails'] = Category::find($id);
        $data['groupDetails'] = CateogryGroup::where('category_id',$id)->get();
        return view('admin.sub_category.create',$data);
    }
    /*
     * Store new sub category information in database
     */
    public function SubCategoryStore(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|unique:categories',
            'categoryID' => 'required'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->has('group_title'))
        {
            $validator = Validator::make($request->all(),[
                'group_title' => 'required|unique:category_groups,title'
            ]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data=[
                'title' => strtolower(trim($request->group_title)),
                'category_id' => $request->categoryID
            ];
            $insert_data = CateogryGroup::create($data);
            $category_group_id = $insert_data->id;
        }
        else
        {
            if($request->has('category_group_id'))
            {
                $category_group_id = $request->category_group_id;
            }
            else
            {
                $category_group_id=0;
            }
        }
        if($request->has('highlighted'))
        {
            $highlighted = $request->highlighted;
        }
        else{
            $highlighted = '0';
        }
        $data = [
            'title' => trim($request->title),
            'root' => $request->categoryID,
            'category_group_id' => $category_group_id,
            'highlighted' => $highlighted
        ];
        $insert_data = Category::create($data);
        if($insert_data)
        {
            return redirect(route('sub_category',$request->categoryID))->with('success','new sub category added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again')->withInput();
        }
    }
    public function subIndex($id)
    {
        $data = [];
        $data['page_title'] = 'Sub Category';
        $data['categoryID'] = $id;
        return view('admin.sub_category.index',$data);
    }
    public function subCategoryData($id)
    {
        $categories = Category::where('root',$id)->orderBy('created_at', 'desc')->select('id','title','highlighted','created_at','deleted_at')->withTrashed();
        return \Datatables::of($categories)
            ->addColumn('Action', function($category){
                $html = '
                <a href="'.route('category_edit', $category->id).'" class="btn bg-olive margin"><i class="fa fa-pencil-square-o"></i>Update</a>';
                if($category->deleted_at != '')
                    $html .= '<a href="'.route('category_soft_delete_restore', $category->id).'" class="btn bg-olive margin"><i class="fa fa-fw fa-recycle"></i></i>Enable</a>';
                else
                    $html .= '<a href="'.route('category_soft_delete', $category->id).'" class="btn bg-navy margin"><i class="fa fa-times"></i></i>Disable</a>';
                return $html;
            })
            ->editColumn('created_at', function($creation){
                return $creation->created_at->format('F d, Y h:i A');
            })
            ->editColumn('highlighted', function($highlighted){
                switch($highlighted->highlighted)
                {
                    /*
                     * 0= women, 1 = men, 2=both
                     */
                    case '0': return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>'; break;
                    case '1': return '<span class = "badge bg-green"><i class="fa fa-check"></i></span>'; break;
                    default: return '<span class = "badge bg-red"><i class="fa fa-times-circle"></i></span>';
                }
            })
            ->remove_column('deleted_at')
            ->make(true);
    }
    public function edit($id)
    {
        $data = [];
        $getDetails = Category::findOrFail($id);
        if($getDetails)
        {
            $data['page_title'] = 'Category Update';
            $data['groupDetails'] = CateogryGroup::where('category_id',$getDetails->category_group_id)->get();
            $data['details'] = $getDetails;
            $categoryList = Category::all();
            $data['categoryList'] = $categoryList;
            if($getDetails->root == 0)
            {
                return view('admin.category.update',$data);
            }
            else
            {
                return view('admin.sub_category.update',$data);
            }
        }
        else
        {
            return redirect()->back()->with('error','something went wrong ,please try again');
        }
    }
    public function update(Request $request,$id)
    {
        if($request->root_status == 0)
        {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
            ]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $category = Category::find($id);
            if($request->has('title'))
            {
                $category->title = $request->title;
            }
            if($request->has('icon'))
            {
                $category->icon = $request->icon;
            }
            if($request->has('main_menu'))
            {
                $category->main_menu = $request->main_menu;
            }
            else
            {
                $category->main_menu=0;
            }
            if($request->has('highlighted'))
            {
                $category->highlighted = $request->highlighted;
            }
            else
            {
                $category->highlighted = 0;
            }
            if($request->has('is_group_label'))
            {
                $category->is_group_label = $request->is_group_label;
            }
            else
            {
                $category->main_menu = 0;
            }
            if($request->has('is_tabbed'))
            {
                $category->is_tabbed = $request->is_tabbed;
            }
            else{
                $category->is_tabbed = 0;
            }
            $category->save();
            return redirect(route('category'))->with('success','Category information updated successfully');
        }
        else
        {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'categoryID' => 'required'
            ]);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $category = Category::find($id);
            if($request->has('title'))
            {
                $category->title = $request->title;
            }
            if($request->has('categoryID'))
            {
                $category->root = $request->categoryID;
            }
            if($request->has('highlighted'))
            {
                $category->highlighted = $request->highlighted;
            }
            $category->save();
            return redirect(route('sub_category',$request->categoryID))->with('success','Category information updated successfully');
        }
    }
    public function softDelete($id)
    {
        $attribute = Category::find($id);
        $attribute->delete();
        return redirect(route('category'))->with('success','Category disabled successfully');
    }
    public function softDeleteRestore($id)
    {
        $attribute = Category::where('id', $id)->restore();
        return redirect(route('category'))->with('success','Category Enabled successfully');
    }
}