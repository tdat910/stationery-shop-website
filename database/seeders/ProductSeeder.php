<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // --- Bút bi ---
            [
                'name' => 'Bút bi Thiên Long TL-027',
                'price' => 4500,
                'stock' => 10000,
                'description' => 'Mẫu bút bi truyền thống với đầu bi 0.5mm, viết trơn, mực ra đều và liên tục. Phù hợp cho học sinh và nhân viên văn phòng.',
                'image' => 'thien-long-tl027.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Bấm Pentel BK77 Superball',
                'price' => 15000,
                'stock' => 2500,
                'description' => 'Thân bút nhựa trong suốt có rãnh cầm chống trượt. Công nghệ mực không lem, đầu bi bằng thép không gỉ siêu bền.',
                'image' => 'pentel-bk77.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi nước Uni-ball Signo UM-151',
                'price' => 38000,
                'stock' => 1200,
                'description' => 'Dòng bút gel nổi tiếng từ Nhật Bản, mực sắc nét, chống nước và không phai màu theo thời gian.',
                'image' => 'uniball-signo-um151.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Parker Jotter Bond Street Black CT',
                'price' => 520000,
                'stock' => 80,
                'description' => 'Thiết kế cổ điển vượt thời gian. Thân bút làm bằng thép không gỉ kết hợp sơn mài đen bóng sang trọng. Thích hợp làm quà tặng.',
                'image' => 'parker-jotter-black.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Zebra Sarasa Clip 0.5',
                'price' => 28000,
                'stock' => 3000,
                'description' => 'Dòng bút gel có kẹp bướm tiện lợi, màu sắc mực đa dạng và cực kỳ mượt mà khi viết trên nhiều loại giấy.',
                'image' => 'zebra-sarasa-clip.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Pilot Frixion Ball Clicker 0.5',
                'price' => 75000,
                'stock' => 450,
                'description' => 'Bút bi bấm xóa được nhờ công nghệ mực nhiệt. Có thể viết và xóa sạch lỗi sai một cách dễ dàng mà không làm rách giấy.',
                'image' => 'pilot-frixion-clicker.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Muji Gel Ink Cap Type 0.38',
                'price' => 22000,
                'stock' => 1800,
                'description' => 'Thiết kế tối giản đặc trưng của Muji (Nhật Bản). Ngòi bút siêu nhỏ 0.38mm cho nét viết thanh mảnh, tinh tế.',
                'image' => 'muji-gel-038.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Schneider Slider Edge XB',
                'price' => 25000,
                'stock' => 600,
                'description' => 'Bút bi từ Đức với công nghệ Viscoglide giúp viết cực êm. Thân hình tam giác bọc cao su chống mỏi tay.',
                'image' => 'schneider-slider-edge.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Lamy Safari Ballpoint Pen',
                'price' => 650000,
                'stock' => 35,
                'description' => 'Dòng sản phẩm cao cấp, thiết kế công thái học giúp cầm bút chuẩn xác. Vỏ làm bằng nhựa ABS siêu bền, có kẹp sắt lớn chắc chắn.',
                'image' => 'lamy-safari-blue.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi 4 màu Deli S107',
                'price' => 12000,
                'stock' => 4000,
                'description' => 'Tích hợp 4 màu mực (Xanh, Đỏ, Đen, Tím) trong 1 cây bút duy nhất. Tiện lợi cho việc phân loại đầu mục khi ghi chép.',
                'image' => 'deli-4color-s107.jpg',
                'category_id' => 1,
            ],

            // --- Bút chì ---
            [
                'name' => 'Bút chì gỗ Staedtler Mars Lumograph 2B',
                'price' => 18000,
                'stock' => 2000,
                'description' => 'Bút chì Đức lõi mịn, chuyên cho phác thảo kỹ thuật.',
                'image' => 'staedtler-2b.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì kim Uni Kurutoga Advance',
                'price' => 145000,
                'stock' => 100,
                'description' => 'Công nghệ xoay ngòi tự động giúp nét vẽ luôn sắc mảnh.',
                'image' => 'uni-kurutoga.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì gỗ Thiên Long GP-01',
                'price' => 3500,
                'stock' => 8000,
                'description' => 'Bút chì học sinh thân lục giác, độ đậm 2B.',
                'image' => 'tl-gp01.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì kim Pentel GraphGear 1000',
                'price' => 200000,
                'stock' => 150,
                'description' => 'Bút chì kỹ thuật với ngòi kim loại, có thước đo độ dài trên thân bút.',
                'image' => 'pentel-graphgear.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì gỗ Faber-Castell Grip 2001 HB',
                'price' => 12000,
                'stock' => 5000,
                'description' => 'Bút chì Đức với thiết kế thân bọc cao su chống trượt, độ đậm HB.',
                'image' => 'faber-castell-hb.jpg',
                'category_id' => 2,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
