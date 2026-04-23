<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email} {--name=Admin} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo hoặc nâng cấp user thành admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->option('name');
        $password = $this->option('password');

        // Kiểm tra nếu user đã tồn tại
        $user = User::where('email', $email)->first();

        if ($user) {
            // Nâng cấp user hiện tại thành admin
            $user->update(['role' => 1]);
            $this->info("✅ User '{$email}' đã được nâng cấp thành Admin!");
            return;
        }

        // Tạo user mới
        if (!$password) {
            $password = $this->secret('Nhập mật khẩu cho admin:');
        }

        $newAdmin = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 1,
            'email_verified_at' => now(),
        ]);

        $this->info("✅ Admin user '{$email}' đã được tạo thành công!");
        $this->line("📧 Email: {$newAdmin->email}");
        $this->line("🔑 Mật khẩu: {$password}");
    }
}
