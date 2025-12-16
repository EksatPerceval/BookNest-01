<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'nama' => 'Admin BookNest',
            'email' => 'admin@booknest.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Create Sample User
        User::create([
            'nama' => 'User Demo',
            'email' => 'user@booknest.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        // Create Categories
        $categories = [
            'Fiksi',
            'Non-Fiksi',
            'Teknologi',
            'Bisnis',
            'Sejarah',
            'Sains',
            'Self-Help',
            'Novel',
            'Komik',
            'Pendidikan'
        ];

        foreach ($categories as $cat) {
            Category::create(['nama_kategori' => $cat]);
        }

        // Create Sample Books
        Book::create([
            'judul' => 'Belajar Laravel untuk Pemula',
            'penulis' => 'John Doe',
            'tahun' => 2024,
            'kategori' => 3,
            'deskripsi' => 'Panduan lengkap belajar Laravel dari nol hingga mahir untuk pemula yang ingin terjun ke dunia web development.',
            'isi_buku' => 'Bab 1: Pengenalan Laravel
Laravel adalah framework PHP yang powerful dan elegan untuk membangun aplikasi web modern. Framework ini mengikuti pola arsitektur MVC (Model-View-Controller) yang memudahkan developer dalam mengorganisir kode.

Bab 2: Instalasi dan Konfigurasi
Untuk memulai menggunakan Laravel, Anda perlu menginstall Composer terlebih dahulu. Composer adalah dependency manager untuk PHP...

Bab 3: Routing
Routing di Laravel sangat sederhana dan powerful. Anda dapat mendefinisikan route dengan berbagai HTTP method seperti GET, POST, PUT, DELETE...',
            'views' => 150
        ]);

        Book::create([
            'judul' => 'Cara Membangun Startup Sukses',
            'penulis' => 'Jane Smith',
            'tahun' => 2023,
            'kategori' => 4,
            'deskripsi' => 'Strategi dan tips praktis membangun startup dari nol hingga mencapai product-market fit dan skala bisnis.',
            'isi_buku' => 'Bab 1: Mindset Entrepreneur
Membangun startup bukan hanya tentang ide cemerlang, tetapi juga tentang eksekusi yang tepat dan ketekunan yang tinggi.

Bab 2: Validasi Ide
Sebelum mengembangkan produk, pastikan ide Anda memiliki market yang jelas. Lakukan riset pasar dan interview dengan calon customer...

Bab 3: MVP Development
Minimum Viable Product adalah versi paling sederhana dari produk Anda yang dapat memberikan value kepada customer...',
            'views' => 230
        ]);

        Book::create([
            'judul' => 'Sejarah Nusantara',
            'penulis' => 'Dr. Ahmad Setiawan',
            'tahun' => 2022,
            'kategori' => 5,
            'deskripsi' => 'Eksplorasi mendalam tentang sejarah kepulauan Nusantara dari zaman prasejarah hingga kemerdekaan Indonesia.',
            'isi_buku' => 'Bab 1: Masa Prasejarah
Nusantara telah dihuni manusia sejak ribuan tahun yang lalu. Bukti arkeologis menunjukkan keberadaan manusia purba di berbagai wilayah...

Bab 2: Kerajaan Hindu-Buddha
Masa kejayaan kerajaan-kerajaan besar seperti Sriwijaya dan Majapahit menandai periode emas peradaban Nusantara...

Bab 3: Masa Kolonialisme
Kedatangan bangsa Eropa membawa perubahan besar dalam tatanan sosial, ekonomi, dan politik di Nusantara...',
            'views' => 180
        ]);

        Book::create([
            'judul' => 'Atomic Habits Indonesia',
            'penulis' => 'James Clear (Terjemahan)',
            'tahun' => 2023,
            'kategori' => 7,
            'deskripsi' => 'Cara mudah dan terbukti untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk dalam kehidupan sehari-hari.',
            'isi_buku' => 'Bab 1: Kekuatan Habit
Kebiasaan kecil yang dilakukan secara konsisten dapat menghasilkan perubahan luar biasa dalam hidup Anda...

Bab 2: 4 Hukum Perubahan Perilaku
Make it Obvious, Make it Attractive, Make it Easy, Make it Satisfying - empat prinsip dasar pembentukan habit...

Bab 3: Identity-Based Habits
Fokus pada siapa Anda ingin menjadi, bukan apa yang ingin Anda capai...',
            'views' => 320
        ]);

        Book::create([
            'judul' => 'Fisika Quantum untuk Semua',
            'penulis' => 'Prof. Michael Chen',
            'tahun' => 2024,
            'kategori' => 6,
            'deskripsi' => 'Penjelasan sederhana tentang konsep-konsep fisika quantum yang kompleks untuk pembaca awam.',
            'isi_buku' => 'Bab 1: Pengenalan Dunia Quantum
Fisika quantum adalah cabang fisika yang mempelajari fenomena di tingkat atom dan subatom...

Bab 2: Prinsip Ketidakpastian Heisenberg
Salah satu prinsip paling terkenal dalam fisika quantum yang menyatakan bahwa kita tidak dapat mengetahui posisi dan momentum partikel secara bersamaan...

Bab 3: Superposisi dan Entanglement
Konsep-konsep yang tampak mustahil ini adalah kenyataan di dunia quantum...',
            'views' => 95
        ]);
    }
}
