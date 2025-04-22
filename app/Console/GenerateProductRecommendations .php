<?php

namespace App\Console\Commands;

use App\Services\ProductRecommendationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateProductRecommendations extends Command
{
    protected $signature = 'recommendations:generate';
    protected $description = 'Generate product recommendations using Apriori algorithm';

    public function handle()
    {
        $this->info('Generating product recommendations...');

        $service = new ProductRecommendationService();
        $rules = $service->generateRecommendations(0);

        // Lưu rules vào cache
        Cache::put('product_recommendation_rules', $rules, now()->addDay());

        $this->info('Product recommendations generated: ' . count($rules) . ' rules');

        return Command::SUCCESS;
    }
}
