<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bakery;
<<<<<<< HEAD
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BakeryController extends Controller
{

    public function index(Request $request)
    {
        $query = Bakery::query();
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm);
        }

=======

class BakeryController extends Controller
{
    /**
     * جلب جميع المخابز مع دعم البحث والفلترة (واجهة All Bakeries).
     */
    public function index(Request $request)
    {
        $query = Bakery::query();

        // 1. البحث (search bakeries...)
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
        }

        // 2. الفلترة حسب المدينة (Write City location...)
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

<<<<<<< HEAD

        if ($request->filled('price_sort') && $request->price_sort !== 'None') {

            if ($request->price_sort === 'high_rating') {
                $query->orderBy('rating_average', 'desc');
            }
        }

        $recommended = $query->clone()->where('rating_average', '>=', 4.5)->limit(3)->get();
        $allBakeries = $query->paginate(6);
=======
        // 3. الفلترة حسب السعر (Price filter - نفترض أنها فلترة للمخابز الأكثر تقييما أو الأعلى سعرا)
        if ($request->filled('price_sort') && $request->price_sort !== 'None') {
            // نفترض أن price_sort يمكن أن يكون 'high_rating'
            if ($request->price_sort === 'high_rating') {
                $query->orderBy('rating_average', 'desc');
            }
            // يمكن إضافة منطق فلترة حسب الأسعار المتوسطة للمنتجات لاحقًا.
        }

        // يمكن فصل المخابز الموصى بها (Recommended) بناءً على منطق محدد
        // هنا، سنعتبر أي مخابز بتقييم عالٍ (فوق 4.5) هي موصى بها كمثال
        $recommended = $query->clone()->where('rating_average', '>=', 4.5)->limit(3)->get();
        $allBakeries = $query->paginate(6); // 6 مخابز في الصفحة الواحدة كما يظهر في الواجهة
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60

        return response()->json([
            'recommended_bakeries' => $recommended,
            'all_bakeries' => $allBakeries,
        ]);
    }

<<<<<<< HEAD
    public function showProducts(Bakery $bakery)
    {
=======
    /**
     * عرض منتجات مخبز معين (واجهة Ahmad Bakeries Products).
     */
    public function showProducts(Bakery $bakery)
    {
        // جلب المنتجات المرتبطة بالمخبز
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
        $products = $bakery->products()->paginate(6);

        return response()->json([
            'bakery_name' => $bakery->name,
            'products' => $products
        ]);
    }
<<<<<<< HEAD

    private function getBakeryId(Request $request)
    {
       
        return $request->user()->bakery_id;
    }


    public function createBakery(Request $request)
    {

        if ($this->getBakeryId($request)) {
            return response()->json(['message' => 'Bakery already exists for this owner.'], 400);
        }


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:100',
            'image_url' => 'nullable|url',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',

        ]);


        $bakery = Bakery::create($validated);


        $request->user()->update(['bakery_id' => $bakery->id]);

        return response()->json(['message' => 'Bakery created successfully.', 'bakery' => $bakery], 201);
    }


    public function updateBakery(Request $request)
    {
        $bakeryId = $this->getBakeryId($request);
        if (!$bakeryId) {
            return response()->json(['message' => 'No bakery linked to this owner.'], 404);
        }

        $bakery = Bakery::findOrFail($bakeryId);


        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'city' => 'sometimes|string|max:100',
            'image_url' => 'sometimes|nullable|url',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
        ]);

        $bakery->update($validated);

        return response()->json(['message' => 'Bakery updated successfully.', 'bakery' => $bakery]);
    }


    public function deleteBakery(Request $request)
    {
        $bakeryId = $this->getBakeryId($request);
        if (!$bakeryId) {
            return response()->json(['message' => 'No bakery linked to this owner.'], 404);
        }


        DB::transaction(function () use ($request, $bakeryId) {

            Product::where('bakery_id', $bakeryId)->delete();


            Bakery::destroy($bakeryId);


            $request->user()->update(['bakery_id' => null]);
        });

        return response()->json(['message' => 'Bakery and all associated products deleted successfully.'], 200);
    }


    public function addProduct(Request $request)
    {
        $bakeryId = $this->getBakeryId($request);
        if (!$bakeryId) {
            return response()->json(['message' => 'Please create your bakery first.'], 400);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::create(array_merge($validated, [
            'bakery_id' => $bakeryId,
        ]));

        return response()->json(['message' => 'Product added successfully.', 'product' => $product], 201);
    }


    public function updateProduct(Request $request, Product $product)
    {
        $bakeryId = $this->getBakeryId($request);


        if ((int) $product->bakery_id !== (int) $bakeryId) {
            return response()->json(['message' => 'Unauthorized: This product does not belong to your bakery.'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|nullable|string',
            'image_url' => 'sometimes|nullable|url',
        ]);

        $product->update($validated);

        return response()->json(['message' => 'Product updated successfully.', 'product' => $product]);
    }

    public function deleteProduct(Request $request, Product $product)
    {
        $bakeryId = $this->getBakeryId($request);

        if ((int) $product->bakery_id !== (int) $bakeryId) {
            return response()->json(['message' => 'Unauthorized: This product does not belong to your bakery.'], 403);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.'], 200);
    }
=======
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
}
