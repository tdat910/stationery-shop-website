<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-001:generateContent';
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-lite-001:generateContent';
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-lite:generateContent';
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-lite:generateContent';
    // protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-live:generateContent';


    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function getRecommendations($userData, $productSelection)
    {
        // Câu lệnh (Prompt) cực kỳ nghiêm khắc
        $prompt = "Dựa trên lịch sử xem của khách hàng:\n{$userData}\n\n" .
            "Hãy chọn ra 4 ID sản phẩm phù hợp nhất từ danh sách sau:\n{$productSelection}\n\n" .
            "YÊU CẦU BẮT BUỘC:\n" .
            "1. Chỉ trả về các con số ID, cách nhau bằng dấu phẩy (ví dụ: 1,2,3,4).\n" .
            "2. Không được viết thêm bất kỳ chữ nào khác.\n" .
            "3. Ưu tiên các sản phẩm có tên tương tự hoặc cùng loại với sản phẩm khách xem nhiều nhất.";

        $response = Http::withOptions(['verify' => false])->post("{$this->baseUrl}?key={$this->apiKey}", [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        // // --- ĐẠT THÊM ĐOẠN NÀY VÀO ĐỂ BẮT BỆNH ---
        // if (!$response->successful()) {
        //     dd([
        //         'Trạng thái' => 'Lỗi kết nối API',
        //         'Mã lỗi' => $response->status(),
        //         'Chi tiết từ Google' => $response->json()
        //     ]);
        // }

        // $text = $response->json('candidates.0.content.parts.0.text');

        // dd([
        //     'Trạng thái' => 'Gọi API Thành công',
        //     'Câu trả lời thô của AI' => $text
        // ]);
        // // ------------------------------------------

        if ($response->successful()) {
            $text = $response->json('candidates.0.content.parts.0.text');

            // Dùng Regex để chỉ lọc lấy số và dấu phẩy, loại bỏ mọi chữ thừa
            $cleanText = preg_replace('/[^0-9,]/', '', $text);
            $ids = explode(',', trim($cleanText, ','));

            return array_filter($ids); // Loại bỏ các phần tử rỗng
        }

        return [];
    }
}
