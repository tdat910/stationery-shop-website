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
                'image' => 'https://imgs.search.brave.com/inBU7YeJWXyPel1QAq0di8R2f2h9i4hFAcdosE8J19I/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9wcm9k/dWN0LmhzdGF0aWMu/bmV0LzEwMDAyMzAz/NDcvcHJvZHVjdC9h/cnRib2FyZF8yXzMx/ZmQ2ODc3Zjc3YjQ2/OGFiYjgyZDM0MGE3/MDg2MmRiLmpwZw',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Bấm Pentel BK77 Superball',
                'price' => 15000,
                'stock' => 2500,
                'description' => 'Thân bút nhựa trong suốt có rãnh cầm chống trượt. Công nghệ mực không lem, đầu bi bằng thép không gỉ siêu bền.',
                'image' => 'https://imgs.search.brave.com/RIcknxyHRmsv-STdCiyvgsqfjp_uus4R1JuZ2gZsxR8/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9wcm9k/dWN0LmhzdGF0aWMu/bmV0LzIwMDAwMDI0/MjYyOS9wcm9kdWN0/L2J1dF9iaV90b3Bi/YWxsXzhiODhhYzUz/NDViZTRmMWVhMjcy/Njk4MmZiMThhNzA2/XzUyN2Q1NjYyODlj/MDRiNGY5ZDBkNjI2/NmM4NWU4ZGRjX2xh/cmdlLmpwZw',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi nước Uni-ball Signo UM-151',
                'price' => 38000,
                'stock' => 1200,
                'description' => 'Dòng bút gel nổi tiếng từ Nhật Bản, mực sắc nét, chống nước và không phai màu theo thời gian.',
                'image' => 'https://imgs.search.brave.com/FWNTKP8rRAqtA4H9jOzCqcRkYVZafXyjiSKJrMg-dM8/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pNS53/YWxtYXJ0aW1hZ2Vz/LmNvbS9zZW8vVW5p/LWJhbGwtU2lnbm8t/VW0tMTUxLUdlbC1J/bmstUGVuLTAtMzgt/TW0tU2V0LW9mLTVj/b2xvcl9mNDFiMGE0/NC02MWMyLTQwOWYt/YmJjMC00MDA4NzQ5/NzMwYmUuZWViYjlj/ODU3NGI4ZDkwNjQz/ZDQ5ZjkzZTQyOWVh/ZDcuanBlZz9vZG5I/ZWlnaHQ9NjQwJm9k/bldpZHRoPTY0MCZv/ZG5CZz1GRkZGRkY',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Parker Jotter Bond Street Black CT',
                'price' => 520000,
                'stock' => 80,
                'description' => 'Thiết kế cổ điển vượt thời gian. Thân bút làm bằng thép không gỉ kết hợp sơn mài đen bóng sang trọng. Thích hợp làm quà tặng.',
                'image' => 'https://imgs.search.brave.com/24vQa1BxIykeu668BoN2PKm8sGyYat3C5LvqcMaR7tw/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9hbmgu/cXVhdHJ1Y3R1eWVu/LmNvbS9tZWRpYS9j/YXRhbG9nL3Byb2R1/Y3QvY2FjaGUvMS9z/bWFsbF9pbWFnZS8z/NzB4MzcwLzlkZjc4/ZWFiMzM1MjVkMDhk/NmU1ZmI4ZDI3MTM2/ZTk1L2IvdS9idXQt/cGFya2VyLXBhcmtl/ci1qb3R0ZXItYm9u/ZC1zdHJlZXQtYmxh/Y2stMTk1MzM0Nl8x/MC5qcGc',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Zebra Sarasa Clip 0.5',
                'price' => 28000,
                'stock' => 3000,
                'description' => 'Dòng bút gel có kẹp bướm tiện lợi, màu sắc mực đa dạng và cực kỳ mượt mà khi viết trên nhiều loại giấy.',
                'image' => 'https://imgs.search.brave.com/p4a3OoQ7YWnoiho1raUbWWj_2snfmhcYCBbfDyoeXCk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9iaXp3/ZWIuZGt0Y2RuLm5l/dC90aHVtYi9sYXJn/ZS8xMDAvMTQ2LzEx/Ni9wcm9kdWN0cy96/ZWJyYS1zYXJhc2Et/MDNtbS0xMHBjLWdl/bC1wZW4tc2V0LWxh/cmdlLTFmZjNmNmY1/LTRmNzYtNGRjMy05/MGU2LTc1MzZkZmU1/NjQzNS5qcGc_dj0x/NTc2MDUyNzkyMzk3',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Pilot Frixion Ball Clicker 0.5',
                'price' => 75000,
                'stock' => 450,
                'description' => 'Bút bi bấm xóa được nhờ công nghệ mực nhiệt. Có thể viết và xóa sạch lỗi sai một cách dễ dàng mà không làm rách giấy.',
                'image' => 'https://imgs.search.brave.com/BaYP8n74emJlUKcsHtqu9AkjmJJYjp-3ai4JruvK7Nk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZi5z/aG9wZWUudm4vZmls/ZS8xMzY3YWEyNDg0/MjhkMjM3MDA0MmI4/MTcyODhhN2YyMQ',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Muji Gel Ink Cap Type 0.38',
                'price' => 22000,
                'stock' => 1800,
                'description' => 'Thiết kế tối giản đặc trưng của Muji (Nhật Bản). Ngòi bút siêu nhỏ 0.38mm cho nét viết thanh mảnh, tinh tế.',
                'image' => 'https://imgs.search.brave.com/QIc_cuaMt6u1hvkBDGmztufLtDgxNTD1YkK86XxiQzY/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9hd2Vz/b21lcGVucy5jby51/ay93cC1jb250ZW50/L3VwbG9hZHMvMjAy/MC8wNC9NVUpJLUdl/bC1JbmstQmFsbHBv/aW50LVBlbi0wLjVt/bS0xLTMyNHgzMjQu/anBn',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Schneider Slider Edge XB',
                'price' => 25000,
                'stock' => 600,
                'description' => 'Bút bi từ Đức với công nghệ Viscoglide giúp viết cực êm. Thân hình tam giác bọc cao su chống mỏi tay.',
                'image' => 'https://imgs.search.brave.com/dBYP4NfoJKCtMKS8CNO-pGSmDFucydJIplX4rYf-3Hc/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9ob2Fu/Z3BodW9jLmNvbS9m/aWxlcy9zYW5waGFt/LzE4NTcvMTUwXzEv/anBnL3NjaG5laWRl/ci1idXQtYmktc2xp/ZGVyLWVkZ2UteGIt/OC1tYXVfMTUweDE1/MC5qcGc',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi Lamy Safari Ballpoint Pen',
                'price' => 650000,
                'stock' => 35,
                'description' => 'Dòng sản phẩm cao cấp, thiết kế công thái học giúp cầm bút chuẩn xác. Vỏ làm bằng nhựa ABS siêu bền, có kẹp sắt lớn chắc chắn.',
                'image' => 'https://imgs.search.brave.com/icOokMlD81iOONPK8Z1yBOnC1wwY3XPh7tAPDOLSK0w/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9nb2xk/c3BvdC5jb20vY2Ru/L3Nob3AvcHJvZHVj/dHMvbGFteS1zYWZh/cmktYmFsbHBvaW50/LXBlbi1pbi1jaGFy/Y29hbC1ibGFjay0x/OTQuanBnP3Y9MTcz/OTMwNzM4OSZ3aWR0/aD0xNDQ1',
                'category_id' => 1,
            ],
            [
                'name' => 'Bút bi 4 màu Deli S107',
                'price' => 12000,
                'stock' => 4000,
                'description' => 'Tích hợp 4 màu mực (Xanh, Đỏ, Đen, Tím) trong 1 cây bút duy nhất. Tiện lợi cho việc phân loại đầu mục khi ghi chép.',
                'image' => 'https://imgs.search.brave.com/4yssWTLh-weiibkBFAj20xsxsor4YZrgCyfTlU7D5Iw/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZG4x/LmZhaGFzYS5jb20v/bWVkaWEvY2F0YWxv/Zy9wcm9kdWN0LzYv/OS82OTQxNzk4NDIz/MzI2LmpwZw',
                'category_id' => 1,
            ],

            // --- Bút chì ---
            [
                'name' => 'Bút chì gỗ Staedtler Mars Lumograph 2B',
                'price' => 18000,
                'stock' => 2000,
                'description' => 'Bút chì Đức lõi mịn, chuyên cho phác thảo kỹ thuật.',
                'image' => 'https://imgs.search.brave.com/2fTv79dlh7AkBhOf8AIw3-o8jNQax_U3o1mSSfQlPdM/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9iZWJp/bmh2bi5jb20vc2l0/ZXMvZGVmYXVsdC9m/aWxlcy8yQl8wLmpw/Zw',
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
                'image' => 'https://imgs.search.brave.com/juBI9slpoExR1rjfOlh2naHrKJDSmOEsHmsjgAb3ukE/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZ3BoYW1iaW5o/ZHVvbmcuY29tLnZu/L3VwbG9hZHMvc291/cmNlL3Nhbi1waGFt/L2J1dC12aWV0LW11/Yy9wbTA0LmpwZw',
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

            //Bút lông dầu
            [
                'name' => 'Bút lông dầu Sharpie Permanent Marker',
                'price' => 35000,
                'stock' => 1200,
                'description' => 'Bút lông dầu Mỹ với mực không phai, chống nước và có thể viết trên nhiều bề mặt khác nhau.',
                'image' => 'sharpie-marker.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Artline Supreme',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Bút lông dầu Nhật Bản với đầu bút siêu bền, mực khô nhanh và không lem.',
                'image' => 'artline-supreme.jpg',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Staedtler Lumocolor Permanent',
                'price' => 30000,
                'stock' => 500,
                'description' => 'Bút lông dầu Đức có thể viết trên kính, kim loại và nhựa. Mực không phai và chống nước.',
                'image' => 'staedtler-lumocolor.jpg',
                'category_id' => 3,
            ],
            
            //Dao rọc giấy
            [
                'name' => 'Dao rọc giấy Olfa Cutter L-1',
                'price' => 150000,
                'stock' => 300,
                'description' => 'Dao rọc giấy Nhật Bản với lưỡi dao sắc bén, có thể thay thế khi mòn.',
                'image' => 'olfa-cutter.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley FatMax',
                'price' => 200000,
                'stock' => 150,
                'description' => 'Dao rọc giấy Mỹ với thiết kế chắc chắn, lưỡi dao bằng thép không gỉ.',
                'image' => 'stanley-fatmax.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy X-Acto Precision',
                'price' => 180000,
                'stock' => 200,
                'description' => 'Dao rọc giấy Mỹ với lưỡi dao siêu sắc, thích hợp cho công việc thủ công và nghệ thuật.',
                'image' => 'xacto-precision.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Olfa Pro L-2',
                'price' => 170000,
                'stock' => 250,
                'description' => 'Phiên bản nâng cấp của Olfa Cutter với thiết kế công thái học và lưỡi dao siêu bền.',
                'image' => 'olfa-pro.jpg',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley Quick-Change',
                'price' => 220000,
                'stock' => 100,
                'description' => 'Dao rọc giấy với cơ chế thay lưỡi nhanh chóng, thân bằng nhôm chắc chắn.',
                'image' => 'stanley-quickchange.jpg',
                'category_id' => 4,
            ],

            // Dụng cụ học sinh
            [
                'name' => 'Hồ nước Thiên Long G-08',
                'price' => 5000,
                'stock' => 1500,
                'description' => 'Keo dán dạng lỏng, độ dính cao, khô nhanh, không làm nhăn bề mặt giấy.',
                'image' => 'ho-nuoc-g08.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Hồ khô neon 8g ERAS E547-Chính hãng',
                'price' => 20000,
                'stock' => 1000,
                'description' => 'Keo dán dạng thỏi, tiện lợi, không gây bẩn tay, độ dính tốt trên giấy và bìa.',
                'image' => 'https://vanphong-pham.com/wp-content/uploads/2021/11/HO-KHO-NEON-400x400.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút sáp màu Colokit (12 màu)',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Sáp màu mịn, màu sắc tươi sáng, thành phần an toàn không độc hại cho trẻ.',
                'image' => 'sap-mau-12.jpg',
                'category_id' => 5,
            ],
                        [
                'name' => 'Bút sáp 18 màu WinQ CR-08',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Sáp màu mịn, màu sắc tươi sáng, thành phần an toàn không độc hại cho trẻ.',
                'image' => 'https://vanphong-pham.com/wp-content/uploads/2021/11/SAP-CR08-400x400.png',
                'category_id' => 5,
            ],
            [
                'name' => 'Xấp 10 nhãn vở Campus',
                'price' => 8000,
                'stock' => 3000,
                'description' => 'Thiết kế đa dạng, giấy decal cao cấp bám dính tốt trên bìa tập.',
                'image' => 'nhan-vo-campus.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Xấp 15 nhãn vở Future book Khủng Long (5 xấp)',
                'price' => 10000,
                'stock' => 2000,
                'description' => 'Thiết kế đa dạng, giấy decal cao cấp bám dính tốt trên bìa tập.',
                'image' => 'https://vanphong-pham.com/wp-content/uploads/2021/12/nhan-kl-1-400x400.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút dạ quang Thiên Long HL-03',
                'price' => 12000,
                'stock' => 2000,
                'description' => 'Màu highlight rực rỡ, giúp đánh dấu thông tin quan trọng mà không lem mực.',
                'image' => 'highlight-hl03.jpg',
                'category_id' => 5,
            ],
                        [
                'name' => 'Bút dạ quang M&G 24974 - Chính hãng',
                'price' => 10000,
                'stock' => 2000,
                'description' => 'Màu highlight rực rỡ, giúp đánh dấu thông tin quan trọng mà không lem mực.',
                'image' => 'https://vanphong-pham.com/wp-content/uploads/2021/12/24974-7-400x400.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Đất nặn Colokit 8 màu kèm khuôn',
                'price' => 35000,
                'stock' => 500,
                'description' => 'Mềm mịn, dễ nhào nặn và tạo hình, giúp trẻ phát triển khả năng sáng tạo.',
                'image' => 'dat-nan-8m.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Đất nặn WINQ D-11 kèm khuôn',
                'price' => 16000,
                'stock' => 600,
                'description' => 'Mềm mịn, dễ nhào nặn và tạo hình, giúp trẻ phát triển khả năng sáng tạo.',
                'image' => 'dat-nan-d11.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Ghim kẹp giấy Deli (Hộp 100 cái)',
                'price' => 15000,
                'stock' => 1200,
                'description' => 'Làm từ thép mạ niken bền đẹp, chống gỉ sét, kẹp chặt hồ sơ tài liệu.',
                'image' => 'kep-giay-deli.jpg',
                'category_id' => 5,
            ],
                        [
                'name' => 'Ghim kẹp giấy màu C62 - Toàn phát',
                'price' => 3000,
                'stock' => 1000,
                'description' => 'Làm từ thép mạ niken bền đẹp, chống gỉ sét, kẹp chặt hồ sơ tài liệu.',
                'image' => 'https://vanphong-pham.com/wp-content/uploads/2021/11/kep-giay-mau-400x400.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút xóa Thiên Long CP-02',
                'price' => 22000,
                'stock' => 900,
                'description' => 'Dung dịch xóa nhanh khô, độ che phủ cao, thân bút mềm dễ bóp mực.',
                'image' => 'but-xoa-cp02.jpg',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút xóa Officetex 10ml',
                'price' => 15000,
                'stock' => 1000,
                'description' => 'Dung dịch xóa nhanh khô, độ che phủ cao, thân bút mềm dễ bóp mực.',
                'image' => 'but-xoa-officetex.jpg',
                'category_id' => 5,
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
