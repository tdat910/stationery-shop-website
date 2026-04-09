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
                'image' => 'https://product.hstatic.net/200000291759/product/bia_tl-027-do_94f2e7266e8b4a5fa3ce0e2265fc1a61_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Bấm Pentel BK77 Superball',
                'price' => 15000,
                'stock' => 2500,
                'description' => 'Thân bút nhựa trong suốt có rãnh cầm chống trượt. Công nghệ mực không lem, đầu bi bằng thép không gỉ siêu bền.',
                'image' => 'https://product.hstatic.net/200000348197/product/pentel-bk77_4ae1e87b0dc44850800099be0c75f3c3_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi nước Uni-ball Signo UM-151',
                'price' => 38000,
                'stock' => 1200,
                'description' => 'Dòng bút gel nổi tiếng từ Nhật Bản, mực sắc nét, chống nước và không phai màu theo thời gian.',
                'image' => 'https://product.hstatic.net/200000296943/product/uniball-signo-UM-151_17b8ac8f4c7141f0a5b0f8a44e2e20e8_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Parker Jotter Bond Street Black CT',
                'price' => 520000,
                'stock' => 80,
                'description' => 'Thiết kế cổ điển vượt thời gian. Thân bút làm bằng thép không gỉ kết hợp sơn mài đen bóng sang trọng. Thích hợp làm quà tặng.',
                'image' => 'https://images-static.asos-media.com/products/parker-jotter-prime-ballpoint-pen-in-black/50175848-1-black?$XXL$&wid=513&fit=constrain',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Zebra Sarasa Clip 0.5',
                'price' => 28000,
                'stock' => 3000,
                'description' => 'Dòng bút gel có kẹp bướm tiện lợi, màu sắc mực đa dạng và cực kỳ mượt mà khi viết trên nhiều loại giấy.',
                'image' => 'https://product.hstatic.net/200000348197/product/zebra-sarasa-clip-gel-pen-05mm_c1f4d7e9e0d04a0d9b6c5a8e7f3b2c1d_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Pilot Frixion Ball Clicker 0.5',
                'price' => 75000,
                'stock' => 450,
                'description' => 'Bút bi bấm xóa được nhờ công nghệ mực nhiệt. Có thể viết và xóa sạch lỗi sai một cách dễ dàng mà không làm rách giấy.',
                'image' => 'https://product.hstatic.net/200000348197/product/pilot-frixion-ball-clicker-05_d5e8c0a1b2f4g6h8i9j0k1l2m3n4o5p_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Muji Gel Ink Cap Type 0.38',
                'price' => 22000,
                'stock' => 1800,
                'description' => 'Thiết kế tối giản đặc trưng của Muji (Nhật Bản). Ngòi bút siêu nhỏ 0.38mm cho nét viết thanh mảnh, tinh tế.',
                'image' => 'https://images.muji.net/img/items/4549337282609_1260.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Schneider Slider Edge XB',
                'price' => 25000,
                'stock' => 600,
                'description' => 'Bút bi từ Đức với công nghệ Viscoglide giúp viết cực êm. Thân hình tam giác bọc cao su chống mỏi tay.',
                'image' => 'https://product.hstatic.net/200000348197/product/schneider-slider-edge_a1b2c3d4e5f6g7h8i9j0k1l2m3n4o_grande.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Lamy Safari Ballpoint Pen',
                'price' => 650000,
                'stock' => 35,
                'description' => 'Dòng sản phẩm cao cấp, thiết kế công thái học giúp cầm bút chuẩn xác. Vỏ làm bằng nhựa ABS siêu bền, có kẹp sắt lớn chắc chắn.',
                'image' => 'https://images.lamyusa.com/is/image/lamyusa/Lamy-Safari-Ballpoint',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi 4 màu Deli S107',
                'price' => 12000,
                'stock' => 4000,
                'description' => 'Tích hợp 4 màu mực (Xanh, Đỏ, Đen, Tím) trong 1 cây bút duy nhất. Tiện lợi cho việc phân loại đầu mục khi ghi chép.',
                'image' => 'https://product.hstatic.net/200000291759/product/but-4-mau-deli-s107_f5e4d3c2b1a0z9y8x7w6v5u4t3s2r_grande.jpg',
                'category_id' => 1,
            ],

            // --- Bút chì ---
            [
                'name' => 'Bút chì gỗ Staedtler Mars Lumograph 2B',
                'price' => 18000,
                'stock' => 2000,
                'description' => 'Bút chì Đức lõi mịn, chuyên cho phác thảo kỹ thuật.',
                'image' => 'https://product.hstatic.net/200000348197/product/staedtler-mars-lumograph-2b_g1h2i3j4k5l6m7n8o9p0q1r2s3t_grande.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì kim Uni Kurutoga Advance',
                'price' => 145000,
                'stock' => 100,
                'description' => 'Công nghệ xoay ngòi tự động giúp nét vẽ luôn sắc mảnh.',
                'image' => 'https://product.hstatic.net/200000348197/product/uni-kurutoga-advance_k2l3m4n5o6p7q8r9s0t1u2v3w4x_grande.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì gỗ Thiên Long GP-01',
                'price' => 3500,
                'stock' => 8000,
                'description' => 'Bút chì học sinh thân lục giác, độ đậm 2B.',
                'image' => 'https://product.hstatic.net/200000291759/product/but-chi-go-thien-long-gp01_m3n4o5p6q7r8s9t0u1v2w3x4y5z_grande.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì kim Pentel GraphGear 1000',
                'price' => 200000,
                'stock' => 150,
                'description' => 'Bút chì kỹ thuật với ngòi kim loại, có thước đo độ dài trên thân bút.',
                'image' => 'https://product.hstatic.net/200000348197/product/pentel-graphgear-1000_o5p6q7r8s9t0u1v2w3x4y5z6a7b_grande.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì gỗ Faber-Castell Grip 2001 HB',
                'price' => 12000,
                'stock' => 5000,
                'description' => 'Bút chì Đức với thiết kế thân bọc cao su chống trượt, độ đậm HB.',
                'image' => 'https://product.hstatic.net/200000348197/product/faber-castell-grip-2001-hb_q7r8s9t0u1v2w3x4y5z6a7b8c9d_grande.jpg',
                'category_id' => 2,
            ],

            // Bút lông dầu
            [
                'name' => 'Bút lông dầu Sharpie Permanent Marker',
                'price' => 35000,
                'stock' => 1200,
                'description' => 'Bút lông dầu Mỹ với mực không phai, chống nước và có thể viết trên nhiều bề mặt khác nhau.',
                'image' => 'https://product.hstatic.net/200000348197/product/sharpie-permanent-marker_s9t0u1v2w3x4y5z6a7b8c9d0e1f_grande.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Artline Supreme',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Bút lông dầu Nhật Bản với đầu bút siêu bền, mực khô nhanh và không lem.',
                'image' => 'https://product.hstatic.net/200000348197/product/artline-supreme_t0u1v2w3x4y5z6a7b8c9d0e1f2g_grande.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Staedtler Lumocolor Permanent',
                'price' => 30000,
                'stock' => 500,
                'description' => 'Bút lông dầu Đức có thể viết trên kính, kim loại và nhựa. Mực không phai và chống nước.',
                'image' => 'https://product.hstatic.net/200000348197/product/staedtler-lumocolor-permanent_u1v2w3x4y5z6a7b8c9d0e1f2g3h_grande.jpg',
                'category_id' => 3,
            ],
            
            // Dao rọc giấy
            [
                'name' => 'Dao rọc giấy Olfa Cutter L-1',
                'price' => 150000,
                'stock' => 300,
                'description' => 'Dao rọc giấy Nhật Bản với lưỡi dao sắc bén, có thể thay thế khi mòn.',
                'image' => 'https://product.hstatic.net/200000348197/product/olfa-cutter-l1_v2w3x4y5z6a7b8c9d0e1f2g3h4i_grande.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley FatMax',
                'price' => 200000,
                'stock' => 150,
                'description' => 'Dao rọc giấy Mỹ với thiết kế chắc chắn, lưỡi dao bằng thép không gỉ.',
                'image' => 'https://product.hstatic.net/200000348197/product/stanley-fatmax_w3x4y5z6a7b8c9d0e1f2g3h4i5j_grande.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy X-Acto Precision',
                'price' => 180000,
                'stock' => 200,
                'description' => 'Dao rọc giấy Mỹ với lưỡi dao siêu sắc, thích hợp cho công việc thủ công và nghệ thuật.',
                'image' => 'https://product.hstatic.net/200000348197/product/xacto-precision_x4y5z6a7b8c9d0e1f2g3h4i5j6k_grande.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Olfa Pro L-2',
                'price' => 170000,
                'stock' => 250,
                'description' => 'Phiên bản nâng cấp của Olfa Cutter với thiết kế công thái học và lưỡi dao siêu bền.',
                'image' => 'https://product.hstatic.net/200000348197/product/olfa-pro-l2_y5z6a7b8c9d0e1f2g3h4i5j6k7l_grande.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley Quick-Change',
                'price' => 220000,
                'stock' => 100,
                'description' => 'Dao rọc giấy với cơ chế thay lưỡi nhanh chóng, thân bằng nhôm chắc chắn.',
                'image' => 'https://product.hstatic.net/200000348197/product/stanley-quick-change_z6a7b8c9d0e1f2g3h4i5j6k7l8m_grande.jpg',
                'category_id' => 4,
            ],

            // Dụng cụ học sinh
            [
                'name' => 'Hồ nước Thiên Long G-08',
                'price' => 5000,
                'stock' => 1500,
                'description' => 'Keo dán dạng lỏng, độ dính cao, khô nhanh, không làm nhăn bề mặt giấy.',
                'image' => 'https://product.hstatic.net/200000291759/product/keo-dan-thien-long-g08_a7b8c9d0e1f2g3h4i5j6k7l8m9n_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút sáp màu Colokit (12 màu)',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Sáp màu mịn, màu sắc tươi sáng, thành phần an toàn không độc hại cho trẻ.',
                'image' => 'https://product.hstatic.net/200000348197/product/colokit-wax-crayon-12-colors_b8c9d0e1f2g3h4i5j6k7l8m9n0o_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Xấp 10 nhãn vở Campus',
                'price' => 8000,
                'stock' => 3000,
                'description' => 'Thiết kế đa dạng, giấy decal cao cấp bám dính tốt trên bìa tập.',
                'image' => 'https://product.hstatic.net/200000348197/product/nhan-vo-campus_c9d0e1f2g3h4i5j6k7l8m9n0o1p_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút dạ quang Thiên Long HL-03',
                'price' => 12000,
                'stock' => 2000,
                'description' => 'Màu highlight rực rỡ, giúp đánh dấu thông tin quan trọng mà không lem mực.',
                'image' => 'https://product.hstatic.net/200000291759/product/but-da-quang-thien-long-hl03_d0e1f2g3h4i5j6k7l8m9n0o1p2q_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Đất nặn Colokit 8 màu kèm khuôn',
                'price' => 35000,
                'stock' => 500,
                'description' => 'Mềm mịn, dễ nhào nặn và tạo hình, giúp trẻ phát triển khả năng sáng tạo.',
                'image' => 'https://product.hstatic.net/200000348197/product/colokit-modeling-clay-8-colors_e1f2g3h4i5j6k7l8m9n0o1p2q3r_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Ghim kẹp giấy Deli (Hộp 100 cái)',
                'price' => 15000,
                'stock' => 1200,
                'description' => 'Làm từ thép mạ niken bền đẹp, chống gỉ sét, kẹp chặt hồ sơ tài liệu.',
                'image' => 'https://product.hstatic.net/200000348197/product/ghim-kep-giay-deli_f2g3h4i5j6k7l8m9n0o1p2q3r4s_grande.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút xóa Thiên Long CP-02',
                'price' => 22000,
                'stock' => 900,
                'description' => 'Dung dịch xóa nhanh khô, độ che phủ cao, thân bút mềm dễ bóp mực.',
                'image' => 'https://product.hstatic.net/200000291759/product/but-xoa-thien-long-cp02_g3h4i5j6k7l8m9n0o1p2q3r4s5t_grande.jpg',
                'category_id' => 5,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
