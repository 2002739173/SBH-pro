<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bakery;

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
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

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

        return response()->json([
            'recommended_bakeries' => $recommended,
            'all_bakeries' => $allBakeries,
        ]);
    }

    /**
     * عرض منتجات مخبز معين (واجهة Ahmad Bakeries Products).
     */
    public function showProducts(Bakery $bakery)
    {
        // جلب المنتجات المرتبطة بالمخبز
        $products = $bakery->products()->paginate(6);

        return response()->json([
            'bakery_name' => $bakery->name,
            'products' => $products
        ]);
    }
}
