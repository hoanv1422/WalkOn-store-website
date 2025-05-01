<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Phpml\Association\Apriori;

class ProductRecommendationService
{
    protected $minSupport = 0.1;
    protected $minConfidence = 0.5;

    public function generateRecommendations($productId)
    {
        $transactions = $this->getTransactionsData($productId);

        $associator = new Apriori($this->minSupport, $this->minConfidence);
        $associator->train($transactions, []);
        $rules = $associator->getRules();

        return $rules;
    }

    public function getRecommendedProducts($productId)
    {
        $rules = $this->generateRecommendations($productId);
        $recommendations = collect();

        foreach ($rules as $rule) {
            if (in_array((string) $productId, $rule['antecedent'])) {
                foreach ($rule['consequent'] as $recommendedProductId) {
                    $product = Product::find($recommendedProductId);
                    if ($product) {
                        $recommendations->push([
                            'product_id' => $recommendedProductId,
                            'confidence' => $rule['confidence'],
                            'product' => $product
                        ]);
                    }
                }
            }
        }

        $recommendations = $recommendations
            ->unique('product_id')             // Loại trùng product_id
            ->sortByDesc('confidence')         // Sắp xếp giảm dần theo confidence
            ->values();                        // Reset key về dạng tuần tự
        return $recommendations;
    }



    protected function getTransactionsData($productId)
    {


        $orders = Order::whereHas('orderItems.productVariant.product', function ($query) use ($productId) {
            $query->where('id', $productId);
        })->with('orderItems.productVariant.product')->has('orderItems', '>=', 2)->get();

        // dd($orders);


        $transactions = [];

        // Tạo danh sách giao dịch
        foreach ($orders as $order) {
            $transaction = [];
            foreach ($order->orderItems as $item) {
                $productId = (string) $item->productVariant->product_id; // Ép kiểu thành chuỗi
                if (!in_array($productId, $transaction)) { // Chỉ thêm product_id nếu chưa có
                    $transaction[] = $productId;
                }
            }

            if (!empty($transaction)) {
                $transactions[] = $transaction;
            }
        }
        // dd($transactions); // Kiểm tra kết quả

        return $transactions;
    }

    public function setMinSupport($value)
    {
        $this->minSupport = $value;
        return $this;
    }

    public function setMinConfidence($value)
    {
        $this->minConfidence = $value;
        return $this;
    }
}
