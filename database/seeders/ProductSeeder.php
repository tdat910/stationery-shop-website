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
                'image' => 'https://imgs.search.brave.com/BZvwC0kWdC5xlQ1Lbpka5ksTAt9cShAACr6xUSKnJ3M/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9wcm9k/dWN0LmhzdGF0aWMu/bmV0LzIwMDAwMDE0/MzE4OS9wcm9kdWN0/L21haW4taW1hZ2Ut/MV80OWFkN2YyOGUz/Mjk0MWYwYTQ1MDNj/YTVkNDEwOTMxZF9t/YXN0ZXIuanBlZw',
                'category_id' => 2,
            ],
            [
                'name' => 'Bút chì gỗ Thiên Long GP-01',
                'price' => 3500,
                'stock' => 8000,
                'description' => 'Bút chì học sinh thân lục giác, độ đậm 2B.',
                'image' => 'https://imgs.search.brave.com/5BNfAfDxrPr8HJjXmOk5u_l5BvzL7q4ipobCcTenzQA/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZ3BoYW0yNDcu/dm4vd3AtY29udGVu/dC91cGxvYWRzLzIw/MjEvMDUvQnV0LUNo/aS1Hby1UaGllbi1M/b25nLUdQLTA0LUhC/LTEtMS0zMDB4MjI1/LmpwZw',
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
                'image' => 'https://imgs.search.brave.com/blf68Lm5Zx85ndDfY1utYCwcSn65bv8G0yOZhYts3TU/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jdWx0/cGVucy5jb20vY2Ru/L3Nob3AvcHJvZHVj/dHMvRkMwMDAyOV9G/YWJlci1DYXN0ZWxs/LUdyaXAtMjAwMS1H/cmFwaGl0ZS1wZW5j/aWwtU2V0LW9mLTMt/SEItRXJhc2VyX1Ax/LmpwZz92PTE2Nzc2/ODU2NDAmd2lkdGg9/MTQwNg',
                'category_id' => 2,
            ],

            // Bút lông dầu
            [
                'name' => 'Bút lông dầu Sharpie Permanent Marker',
                'price' => 35000,
                'stock' => 1200,
                'description' => 'Bút lông dầu Mỹ với mực không phai, chống nước và có thể viết trên nhiều bề mặt khác nhau.',
                'image' => 'https://imgs.search.brave.com/ybkMGCvQM3B_O_nc-LamslD5QTUuCYRS5gOHuLzNfVE/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZi5z/aG9wZWUudm4vZmls/ZS9mNzk4ZmMyN2Y0/YjhkZTE0YzdlYzA5/ZGU1MDFlZTAyYg',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Artline Supreme',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Bút lông dầu Nhật Bản với đầu bút siêu bền, mực khô nhanh và không lem.',
                'image' => 'https://imgs.search.brave.com/XbYDDF9B3gWW3tX4XP235Na5hPIlW94lj-riulmrp7Q/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWcu/d2Vic29zYW5oLnZu/L3YxMC91c2Vycy9y/ZXZpZXcvaW1hZ2Vz/L3hianF1MW9zN2tl/MmkvY2FwdHVyZS04/LWUxNTQxNDExMTAz/NzIyLmpwZz9jb21w/cmVzcz04NSZ3aWR0/aD02NjA',
                'category_id' => 3,
            ],
            [
                'name' => 'Bút lông dầu Staedtler Lumocolor Permanent',
                'price' => 30000,
                'stock' => 500,
                'description' => 'Bút lông dầu Đức có thể viết trên kính, kim loại và nhựa. Mực không phai và chống nước.',
                'image' => 'https://imgs.search.brave.com/2W_es18ZL-CBNeyON5uD6zgZQtDQ4_wRm9571kLfgYY/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly93d3cu/YmViaW5odm4uY29t/L3NpdGVzL2RlZmF1/bHQvZmlsZXMvcHJv/ZHVjdHMvMjAxOS0w/OC9zdGFlZHRsZXJf/MzUyXy5qcGc',
                'category_id' => 3,
            ],
            
            // Dao rọc giấy
            [
                'name' => 'Dao rọc giấy Olfa Cutter L-1',
                'price' => 150000,
                'stock' => 300,
                'description' => 'Dao rọc giấy Nhật Bản với lưỡi dao sắc bén, có thể thay thế khi mòn.',
                'image' => 'https://imgs.search.brave.com/LpW5gvKghLgsdsi4JiKNfmy7uaAHXZNK5tOfAw0t_ys/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9iaXp3/ZWIuZGt0Y2RuLm5l/dC90aHVtYi9sYXJn/ZS8xMDAvMzc3Lzgy/NS9wcm9kdWN0cy9s/LTUucG5nP3Y9MTY0/NTA4NTM0OTk3Mw',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley FatMax',
                'price' => 200000,
                'stock' => 150,
                'description' => 'Dao rọc giấy Mỹ với thiết kế chắc chắn, lưỡi dao bằng thép không gỉ.',
                'image' => 'https://imgs.search.brave.com/B9dLzV-igCcFW4rdpD1IeoUnJ0xv-swZI0_uYpvTIWc/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWdz/LmRld2FsdHZpZXRu/YW0uY29tL3dwLWNv/bnRlbnQvdXBsb2Fk/cy8yMDIwLzA3L1NU/SFQxMDI2NC04LTI4/N3gzMDAuanBn',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy X-Acto Precision',
                'price' => 180000,
                'stock' => 200,
                'description' => 'Dao rọc giấy Mỹ với lưỡi dao siêu sắc, thích hợp cho công việc thủ công và nghệ thuật.',
                'image' => 'https://imgs.search.brave.com/_sKjExzceRno-cMYVeLo7pY16H86wSmv3pJv-TOXEo4/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9ibWEt/dmlldG5hbS5jb20v/dXBsb2FkL0RBTyUy/MEMlRTElQkElQUVU/JTIwWC1BQ1RPJTIw/LSUyMFolMjBTZXJp/ZXMlMjBOby4lMjAx/JTIwQk1BLVZJRVRO/QU0uQ09NLlZOXy0x/NjgwNDEzMjE3Lmpw/Zw',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Olfa Pro L-2',
                'price' => 170000,
                'stock' => 250,
                'description' => 'Phiên bản nâng cấp của Olfa Cutter với thiết kế công thái học và lưỡi dao siêu bền.',
                'image' => 'https://imgs.search.brave.com/HislLQAoMp4B3x2k27-i02t4wZ6kfuEsO2Oes7TxXBY/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9iaXp3/ZWIuZGt0Y2RuLm5l/dC90aHVtYi9sYXJn/ZS8xMDAvMzc3Lzgy/NS9wcm9kdWN0cy8x/N2NlOTUwNy04Y2U4/LTQxZWMtOWI5My03/NGViZWI1MTBkMWMu/anBnP3Y9MTU4NzAy/MDMwNzUyNw',
                'category_id' => 4,
            ],
            [
                'name' => 'Dao rọc giấy Stanley Quick-Change',
                'price' => 220000,
                'stock' => 100,
                'description' => 'Dao rọc giấy với cơ chế thay lưỡi nhanh chóng, thân bằng nhôm chắc chắn.',
                'image' => 'https://imgs.search.brave.com/PWqKgNEZsRh1a4zApy8Gt8p675Jk5Af6cyB6B5LVyP8/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWcu/d2Vic29zYW5oLnZu/L3YyL3VzZXJzL3dz/cy9pbWFnZXMvZGFv/LXJvYy1naWF5LXN0/YW5sZXkvNTFhOWVk/YzIyZmE5NC5qcGc_/Y29tcHJlc3M9ODUm/d2lkdGg9MjAw',
                'category_id' => 4,
            ],

            // Dụng cụ học sinh
            [
                'name' => 'Hồ nước Thiên Long G-08',
                'price' => 5000,
                'stock' => 1500,
                'description' => 'Keo dán dạng lỏng, độ dính cao, khô nhanh, không làm nhăn bề mặt giấy.',
                'image' => 'https://imgs.search.brave.com/y94RM7qkVxYla13IW_n1IBjCpL1pJCVkm9HHMNJt0tQ/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92cHBz/b25jYS52bi93cC1j/b250ZW50L3VwbG9h/ZHMvMjAxOS8xMi9I/by1udW9jLVRoaWVu/LUxvbmctRzA4XzEu/anBn',
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
                'image' => 'https://imgs.search.brave.com/NVWgJnYtsJKUdGNIQSuMMNyLVVUIXpMpYNQtxlRiRY4/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZG4x/LmZhaGFzYS5jb20v/bWVkaWEvY2F0YWxv/Zy9wcm9kdWN0Lzgv/OS84OTM1MzI0MDQw/MzUyLmpwZw',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút sáp 18 màu WinQ CR-08',
                'price' => 25000,
                'stock' => 800,
                'description' => 'Sáp màu mịn, màu sắc tươi sáng, thành phần an toàn không độc hại cho trẻ.',
                'image' => 'https://imgs.search.brave.com/Eh2ITeoMgXVhul1P6M1Z5SeidikOcvRuDNOikqAL7zM/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9ibG9n/Z2VyLmdvb2dsZXVz/ZXJjb250ZW50LmNv/bS9pbWcvYi9SMjl2/WjJ4bC9BVnZYc0Vp/M1hhNnRKbGVuSTRl/R1d4TFNPUHhOYXNu/VG5HMHpOZHM5aEpn/REJwdWMtcWF6WHdr/eldUUmstcjFLLV9I/X0N1eVNvR0xOTXdT/ZW9XMlY5MXdqQWdh/UC02VURQZ05CUGpm/bXYtUnVrOVgyVkM2/Z08wUnY3ZWpvSDE2/ZnBQb2J6Y3NpQU5Z/T3dudjFKT0FtL3M0/MDAvYnV0K3NhcCtt/YXUrd2lucStjci0w/OCsxOCttYXUuanBn',
                'category_id' => 5,
            ],
            [
                'name' => 'Xấp 10 nhãn vở Campus',
                'price' => 8000,
                'stock' => 3000,
                'description' => 'Thiết kế đa dạng, giấy decal cao cấp bám dính tốt trên bìa tập.',
                'image' => 'https://imgs.search.brave.com/CgROcyfQUb2ySTq_T6h0Dghlc_l2jqwcxPjNWfEQjkA/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZG4x/LmZhaGFzYS5jb20v/bWVkaWEvY2F0YWxv/Zy9wcm9kdWN0L2Mv/by9jb21iby0yXzJf/Ni5qcGc',
                'category_id' => 5,
            ],
            [
                'name' => 'Xấp 15 nhãn vở Future book Khủng Long (5 xấp)',
                'price' => 10000,
                'stock' => 2000,
                'description' => 'Thiết kế đa dạng, giấy decal cao cấp bám dính tốt trên bìa tập.',
                'image' => 'https://imgs.search.brave.com/06IpFx0sjXbf_6rOfm5_Fb25kzpSqRG2Be7_2baWKa4/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZy1waGFtLmNv/bS93cC1jb250ZW50/L3VwbG9hZHMvMjAy/MS8xMi9uaGFuLWts/LTEuanBn',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút dạ quang Thiên Long HL-03',
                'price' => 12000,
                'stock' => 2000,
                'description' => 'Màu highlight rực rỡ, giúp đánh dấu thông tin quan trọng mà không lem mực.',
                'image' => 'https://imgs.search.brave.com/Xc5mxnk45XW43ut6bHKDj97spxXlxSS3CIHp5-IC_80/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZ3BoYW1iYW5o/YXQuY29tLnZuL3dw/LWNvbnRlbnQvdXBs/b2Fkcy8yMDIwLzA2/L2J1dC1kYS1xdWFu/Zy1obC0wMy0yLmpw/Zw',
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
                'image' => 'https://imgs.search.brave.com/Jf3zKenrB59EO03WGUGGK7GmXd2YmPafdU0R05myg3w/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9ib25n/Ym9uZ2RlcC5jb20v/aW1hZ2VzLzIwMjEw/NS90aHVtYl9pbWcv/Ym8tZGF0LXNldC1u/YW4tOC1tYXUta2Vt/LWtodW9uLWtpZGR5/LWNsYXktdGhhaS1s/YW4tdGh1bWItRzQ0/MDEtMTYyMDUzODQ1/NTgzNC5qcGc',
                'category_id' => 5,
            ],
            [
                'name' => 'Đất nặn WINQ D-11 kèm khuôn',
                'price' => 16000,
                'stock' => 600,
                'description' => 'Mềm mịn, dễ nhào nặn và tạo hình, giúp trẻ phát triển khả năng sáng tạo.',
                'image' => 'https://imgs.search.brave.com/3Wji4H9P54KBBQMyoXwMbNDc7ErnC-NzkNGGgkxOkJU/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly93d3cu/dGhhbmh0aGFuaC5j/by9jZG4vc2hvcC9w/cm9kdWN0cy9EX3Rf/c2V0X25fbl8xMl9t/YXVfMTY1Z19rZW1f/a2h1b25fbl9uX0tp/ZGR5X0NsYXlfU1Qt/MTY1LTEyX2xhcmdl/LnBuZz92PTE1MjU2/NTU4MjA',
                'category_id' => 5,
            ],
            [
                'name' => 'Ghim kẹp giấy Deli (Hộp 100 cái)',
                'price' => 15000,
                'stock' => 1200,
                'description' => 'Làm từ thép mạ niken bền đẹp, chống gỉ sét, kẹp chặt hồ sơ tài liệu.',
                'image' => 'https://imgs.search.brave.com/qFGkTu254hGMZ3Sunrdqi4qyKmo9iJjjzHqXf4UQ42A/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9jZi5z/aG9wZWUudm4vZmls/ZS8yNTcxYjNhNDY2/ZWQ0MWVhZWZlYjc5/YTZiMjg3NDM0Mg',
                'category_id' => 5,
            ],
            [
                'name' => 'Ghim kẹp giấy màu C62 - Toàn phát',
                'price' => 3000,
                'stock' => 1000,
                'description' => 'Làm từ thép mạ niken bền đẹp, chống gỉ sét, kẹp chặt hồ sơ tài liệu.',
                'image' => 'https://imgs.search.brave.com/Z8HIw-lcpUVB7XbUMkOAc-zSIhi_4dghG86DDK6zWJk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZy1waGFtLmNv/bS93cC1jb250ZW50/L3VwbG9hZHMvMjAy/MS8xMS9rZXAtZ2lh/eS1tYXUtMS1yb3Rh/dGVkLmpwZw',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút xóa Thiên Long CP-02',
                'price' => 22000,
                'stock' => 900,
                'description' => 'Dung dịch xóa nhanh khô, độ che phủ cao, thân bút mềm dễ bóp mực.',
                'image' => 'https://imgs.search.brave.com/M6WBqNygi1do4mBqK0HYMuT0H12GsqhlcUKZmBTA-HQ/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZ3BoYW1taW5h/Y28uY29tL3dwLWNv/bnRlbnQvdXBsb2Fk/cy8yMDIzLzA2L0J1/dC14b2EtVGhpZW4t/TG9uZy1DUC0wMi0z/LndlYnA',
                'category_id' => 5,
            ],
            [
                'name' => 'Bút dạ quang Highlighter xanh lá Officetex',
                'price' => 15000,
                'stock' => 1000,
                'description' => 'Dung dịch xóa nhanh khô, độ che phủ cao, thân bút mềm dễ bóp mực.',
                'image' => 'https://imgs.search.brave.com/V32bQvgmU_ttdGKMXhgRK0U_rSX139Lf8Rokz9pyLoM/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly92YW5w/aG9uZ3BoYW1obC52/bi91cGxvYWRfaW1h/Z2VzL2ltYWdlcy8y/MDIzLzExLzEwL2J1/dC1kYS1xdWFuZy14/YW5oLWxhLW9mZmlj/ZXRleC5qcGc',
                'category_id' => 5,
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
