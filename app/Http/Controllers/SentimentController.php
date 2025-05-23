<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SentimentController extends Controller
{
    public function index(Request $request)
    {
        $dateRange = $request->input('date_range', '30'); 
        $sentiment = $request->input('sentiment');
        $service = $request->input('service');
        $search = $request->input('search');

        $query = Review::with('user')
            ->orderBy('created_at', 'desc');

        if ($dateRange && $dateRange !== 'all') {
            $query->where('created_at', '>=', Carbon::now()->subDays($dateRange));
        }

        if ($sentiment) {
            $query->where('sentiment', $sentiment);
        }

        if ($service) {
            $query->where('service', $service);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('review', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $reviews = $query->paginate(10);

        $totalReviews = Review::count();
        $positiveCount = Review::where('sentiment', 'positive')->count();
        $neutralCount = Review::where('sentiment', 'neutral')->count();
        $negativeCount = Review::where('sentiment', 'negative')->count();
        $averageRating = Review::avg('rating') ?? 0;

        $services = Review::distinct('service')->pluck('service')->filter()->values();

        $serviceAnalysis = DB::table('reviews')
            ->select('service',
                DB::raw('COUNT(*) as total'),
                DB::raw('AVG(rating) as avg_rating'),
                DB::raw('SUM(CASE WHEN sentiment = "positive" THEN 1 ELSE 0 END) as positive_count'),
                DB::raw('SUM(CASE WHEN sentiment = "neutral" THEN 1 ELSE 0 END) as neutral_count'),
                DB::raw('SUM(CASE WHEN sentiment = "negative" THEN 1 ELSE 0 END) as negative_count')
            )
            ->groupBy('service')
            ->get();

        $ratingDistribution = Review::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratingDistribution[$i])) {
                $ratingDistribution[$i] = 0;
            }
        }
        ksort($ratingDistribution);
        $ratingDistribution = array_values($ratingDistribution);

        $reviewsLastMonth = Review::whereBetween('created_at', [
            Carbon::now()->subMonths(2), Carbon::now()->subMonth()
        ])->count();
        
        $reviewsThisMonth = Review::whereBetween('created_at', [
            Carbon::now()->subMonth(), Carbon::now()
        ])->count();
        
        $reviewGrowth = $reviewsLastMonth > 0
            ? round((($reviewsThisMonth - $reviewsLastMonth) / $reviewsLastMonth) * 100)
            : 100;

        $satisfactionIndex = (($positiveCount * 10) + ($neutralCount * 5)) / max($totalReviews, 1);
        $satisfactionIndex = min(10, max(0, $satisfactionIndex));

        $chartData = $this->getChartData();
        
        $sentimentTrend = [
            'labels' => $chartData['labels'],
            'positive' => $chartData['positive'],
            'neutral' => $chartData['neutral'],
            'negative' => $chartData['negative']
        ];

        $sentimentStats = [
            'positive' => $positiveCount,
            'negative' => $negativeCount,
            'neutral' => $neutralCount,
        ];

        return view('admin.sentiment_analysis', compact(
            'reviews',
            'totalReviews',
            'positiveCount',
            'neutralCount',
            'negativeCount',
            'averageRating',
            'services',
            'chartData',
            'sentimentStats',
            'serviceAnalysis',
            'ratingDistribution',
            'reviewsThisMonth',
            'reviewGrowth',
            'satisfactionIndex',
            'sentimentTrend'  
        ));
    }

    private function getChartData()
    {
        $months = collect(range(0, 11))->map(function($i) {
            $date = Carbon::now()->subMonths($i);
            return [
                'month' => $date->format('M'),
                'year' => $date->format('Y'),
                'start' => $date->startOfMonth()->format('Y-m-d'),
                'end' => $date->endOfMonth()->format('Y-m-d'),
            ];
        })->reverse()->values();

        $labels = $months->map(fn($m) => $m['month'] . ' ' . $m['year'])->toArray();
        $positive = [];
        $neutral = [];
        $negative = [];
        $positiveCounts = [];
        $neutralCounts = [];
        $negativeCounts = [];

        foreach ($months as $month) {
            $total = Review::whereBetween('created_at', [$month['start'], $month['end']])->count();
            
            $positiveCount = Review::where('sentiment', 'positive')
                ->whereBetween('created_at', [$month['start'], $month['end']])
                ->count();
                
            $neutralCount = Review::where('sentiment', 'neutral')
                ->whereBetween('created_at', [$month['start'], $month['end']])
                ->count();
                
            $negativeCount = Review::where('sentiment', 'negative')
                ->whereBetween('created_at', [$month['start'], $month['end']])
                ->count();

            // Store actual counts
            $positiveCounts[] = $positiveCount;
            $neutralCounts[] = $neutralCount;
            $negativeCounts[] = $negativeCount;

            // Calculate percentages
            if ($total > 0) {
                $positive[] = round(($positiveCount / $total) * 100);
                $neutral[] = round(($neutralCount / $total) * 100);
                $negative[] = round(($negativeCount / $total) * 100);
            } else {
                $positive[] = 0;
                $neutral[] = 0;
                $negative[] = 0;
            }
        }

        return [
            'labels' => $labels,
            'positive' => $positive,
            'neutral' => $neutral,
            'negative' => $negative,
            'counts' => [
                'positive' => $positiveCounts,
                'neutral' => $neutralCounts,
                'negative' => $negativeCounts
            ]
        ];
    }
}