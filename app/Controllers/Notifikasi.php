<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\MatkulModel;
use CodeIgniter\Controller;

class Notifikasi extends Controller
{
    private $telegramBotToken;
    private $telegramChatId;

    public function __construct()
    {
        // Mengambil konfigurasi dari environment
        $this->telegramBotToken = getenv('TELEGRAM_BOT_TOKEN');
        $this->telegramChatId = getenv('TELEGRAM_CHAT_ID');
    }

    public function index()
    {
        // Fungsi ini untuk mengetes pengiriman notifikasi
        $this->kirimNotifikasi("Perhatian: Dosen tidak masuk hari ini.");
        return "Notifikasi telah dikirim.";
    }

    public function dosenTidakMasuk($dosen_id)
    {
        return $this->kirimPesanDosen($dosen_id, "tidak masuk");
    }

    public function dosenMasuk($dosen_id)
    {
        return $this->kirimPesanDosen($dosen_id, "masuk");
    }

    private function kirimPesanDosen($dosen_id, $status)
    {
        $dosenModel = new DosenModel();
        $matkulModel = new MatkulModel();

        // Cari dosen berdasarkan ID
        $dosen = $dosenModel->find($dosen_id);

        // Periksa apakah dosen ditemukan
        if (!$dosen) {
            $message = "Dosen tidak ditemukan.";
            return view('index', ['message' => $message]);
        }

        // Cari mata kuliah berdasarkan ID mata kuliah dari dosen
        $matkul = $matkulModel->find($dosen['id_matkul']);

        // Periksa apakah mata kuliah ditemukan
        if (!$matkul) {
            $message = "Mata kuliah tidak ditemukan untuk dosen ini.";
            return view('index', ['message' => $message]);
        }

        // Format pesan notifikasi
        $message = "Perhatian: Dosen " . $dosen['nama'] . " untuk mata kuliah " . $matkul['matkul'] . " " . $status . " hari ini.";

        // Kirim notifikasi
        $this->kirimNotifikasi($message);

        echo '<script>alert("Notifikasi Terkirim");</script>';

        return redirect()->to('/');

    }

    private function kirimNotifikasi($message)
    {
        $telegramBotToken = $this->telegramBotToken;
        $telegramChatId = $this->telegramChatId;

        // URL untuk mengirim pesan ke API Telegram
        $url = "https://api.telegram.org/bot$telegramBotToken/sendMessage";

        // Data yang akan dikirim dalam body POST request
        $data = [
            'chat_id' => $telegramChatId,
            'text' => $message
        ];

        // Konfigurasi request
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data)
            ]
        ];

        // Buat context stream
        $context  = stream_context_create($options);

        // Kirim request ke API Telegram
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return "Gagal mengirim pesan.";
        } else {
            return "Notifikasi telah dikirim.";
        }
    }
}
