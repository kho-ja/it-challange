<?php

namespace App\Http\Controllers;

use App\Models\YouTubeComment;
use Illuminate\Http\Request;

class YouTubeCommentController extends Controller
{
    public function sentimentAnalysis()
    {
        $totalComments = YouTubeComment::count();
        $positiveCount = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'positive')->count();
        $negativeCount = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'negative')->count();
        $neutralCount = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'neutral')->count();

        $positivePercentage = ($positiveCount * 100) / $totalComments;
        $negativePercentage = ($negativeCount * 100) / $totalComments;
        $neutralPercentage = ($neutralCount * 100) / $totalComments;

        return [
            'TotalComment' => $totalComments,
            'positiveCount' => $positiveCount,
            'negativeCount' => $negativeCount,
            'neutralCount' => $neutralCount,
            'positivePercentage' => $positivePercentage,
            'negativePercentage' => $negativePercentage,
            'neutralPercentage' => $neutralPercentage,
        ];
    }

    public function getCommentLineChart()
    {
        $result = YouTubeComment::selectRaw('
YEAR(publishedat) AS Year,
MONTH(publishedat) AS Month,
COALESCE(SUM(CASE WHEN sentiment = "negative" THEN 1 ELSE 0 END), 0) AS negativeCount,
COALESCE(SUM(CASE WHEN sentiment = "positive" THEN 1 ELSE 0 END), 0) AS positiveCount,
COALESCE(SUM(CASE WHEN sentiment = "neutral" THEN 1 ELSE 0 END), 0) AS neutralCount,
COALESCE(COUNT(*), 0) AS TotalCommentCount')
            ->groupByRaw('YEAR(publishedat), MONTH(publishedat)')
            ->orderByRaw('YEAR(publishedat), MONTH(publishedat)')
            ->get();

        return $result;
    }

    public function searchComments(Request $request)
    {
        $queryType = $request->query('q');
        $limit = 10;

        switch ($queryType) {
            case 0:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'positive')
                    ->orderBy('publishedAt', 'ASC')
                    ->limit($limit)
                    ->get();
                break;
            case 1:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'positive')
                    ->orderBy('publishedAt', 'DESC')
                    ->limit($limit)
                    ->get();
                break;
            case 2:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'negative')
                    ->orderBy('publishedAt', 'ASC')
                    ->limit($limit)
                    ->get();
                break;
            case 3:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'negative')
                    ->orderBy('publishedAt', 'DESC')
                    ->limit($limit)
                    ->get();
                break;
            case 4:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'neutral')
                    ->orderBy('publishedAt', 'ASC')
                    ->limit($limit)
                    ->get();
                break;
            case 5:
                $comments = YouTubeComment::select('textOriginal', 'sentiment', 'publishedAt')->where('sentiment', 'neutral')
                    ->orderBy('publishedAt', 'DESC')
                    ->limit($limit)
                    ->get();
                break;
            default:
                return "Please choose a correct filter";
        }

        return $comments;
    }
}
