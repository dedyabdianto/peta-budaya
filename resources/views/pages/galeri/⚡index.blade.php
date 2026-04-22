<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Kelola Galeri'])]
class extends Component {
    //
};
?>

<div>
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Kelola Galeri</h1>
                <p>Manajemen media foto dan dokumentasi warisan budaya.</p>
            </div>
            <button class="btn btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px">cloud_upload</span>
                Upload Media Baru
            </button>
        </div>
    </div>

    {{-- Upload Area --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-body">
            <div class="upload-zone" style="padding:50px 20px;">
                <span class="material-symbols-outlined" style="font-size:48px">add_photo_alternate</span>
                <h4>Seret &amp; Lepaskan Media di Sini</h4>
                <p>Atau klik untuk memilih file — mendukung beberapa file sekaligus (JPG, PNG, WebP, MP4)</p>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label>Judul Foto</label>
                    <input type="text" placeholder="Masukkan judul media" />
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label>Tautkan ke Situs/Wisata</label>
                    <select>
                        <option value="">Pilih situs terkait...</option>
                        <option>Pantai Payum</option>
                        <option>Tugu Pepera</option>
                        <option>Rumah Adat Gotad</option>
                        <option>Hutan Sakral Ndalir</option>
                        <option>Balai Adat Mbe</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Media Grid --}}
    <div class="media-grid">
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuT1iZ27SJFj3WIfCLGjLQ3YA-keDLC0cTQ-CjAKV4fX5VNwL6RMib6cLIf7d1_jdRmIqDDqjG3GV9-2ajI9NS_XxwJLAB2JQ08JzO3u6sJpNq-Ihke5-ndpy7-DKfx6BDEjNWTIDCPXlhQebs5pPkAMhmver3RSA6oxz6YSBdYYDLYgbsQUiWL_KyQTRhHZXMq_QIKWhTyyuteg_ahQA9AZF1LDQ6JlSwUOyeAERR_p8wdH1kryz5cWzHAi9Itgln6gTcb0Q2ka4" alt="Ukiran Malind" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Ukiran Kayu Tradisional</h5><p>Pantai Payum</p></div>
        </div>
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDly0jbkN2KbqyEXVIdZeBTbWDy5XK3Wlkxk65wwmkYpTAr-tpOHd0TmUBTm0jhkQmoXnkcRfXDhdFEAQPeLoBRjY9rLu9rEVARZ5WwE7sJgA0hbArB5jYJQ5nknl0AU-hhQvGwqDb5Y7Eosj2xeLSX_FCikdW9uCR8efioScbH_20IwCNLcH79rUFoU5aGvLvcuWGPl_MbBsDfcVgIkbbyPbF4C_VY8KYGRsSJjBUBo56rowWQ6ajxB-gCdbG3mSmYG8yBMXOs9Qs" alt="Gua Batu" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Situs Batu Ukir Sangas</h5><p>Kimaam</p></div>
        </div>
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqwDvOKwfGSgbhMp_k0bXUNSQjqcQpUhnHjtOOsxiQqUfcQDx0H7uYruixdouxFt5wzT-6pNQlnBppXbNds1pwpbKIkPVi9bC1YKusC0vHfnhZhWaPjszx06HDajiAXCQcT867-zhm9kJgPPKOhlfuBxzZNxHC_6LtbIWThpzNQN0JEtLddHLsYe5l-TPYnX7d0H8wHAO3TXRvDifHTxYXo22JFc9jSsAOZ_Xc51r5sDfmxjC7Iw4VT5m3uwLr5fpaxS1-_SVyc4Q" alt="Kampung Tradisional" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Kampung Tradisional Malind</h5><p>Okaba</p></div>
        </div>
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIe3If60CbOCRGXX3qG6i1UNTs1NcC6Oi572Eb2cJsD3aHhXWtUEWL62WYtv1VKDxjchLmfWsJrbI4tTwE7hUZLHoM22esZ0-1mT_JpyrruTBcpz1Q0x-MbbhM3VbP7I13U29dFR5v3mnRdOlbi7bGqiX9ORjtLja3qnPesku463OR-iZQKqeXN9oucym9fuCuA_uurPrSaUpszoGUxV0_FM6DZ40u_Pq0CRvPuFdckOHHtBCZu_Ra-z8NNQRtJOOVUzgNPVXCzX4" alt="Hiasan Kepala" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Hiasan Kepala Upacara</h5><p>Muting</p></div>
        </div>
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkRZhgxBDNyV-Wcjk6JaZpCrBRlpieLBaoMmKrAKCy4LT4IgFMZSZ8qLpr0GLWwHHRWA6aMreaNsThZj4Gkgh6Zih2B_3oAlxsmNvuMKkekv6carjjTPzz9Nvtx0YetxfUmRpVJAvbn9EoH8Ra7vMHi4R9RPx8vZU2IWncvxR2ItWIV7Gw9WpaM63C6Lj5oQDOGqMV6B3Z_4Z-4cZpE_MmTNhar8qD5hSqmWT-vYPyl7pyVmKLkwMdsIpdqAmHg-ZzgJjAnU3YQJs" alt="Hutan Sakral" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Panorama Hutan Sakral</h5><p>Ilwayab</p></div>
        </div>
        <div class="media-card">
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfVnmt2KinwZWLvIVasSlV1VdZdYFBd2FSHmuvrvZpWdjql8c3vGVHlpYyM0-eE3MTxgTqFh0qSaDv71DLDh9uEDZ9ZoUlN4ktzjv7BZyZqH2CCTvDf_9wCZ_dTCFlHvnFolSFQRQf4RKJjCR9pD8FSiFFw-gidYyQWna72CLcSARmOr3tzYkTbcZxTEKt8OCrYt6li6KZV0SzOia_v6_iEM3uh4eNZfjtseCnESYGz7ykN63CKCQgfun-ulUByWi9-7T7n9EAenc" alt="Cerita Api" />
            <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
            <div class="media-card-info"><h5>Tradisi Lisan Malam Hari</h5><p>Merauke</p></div>
        </div>
    </div>
</div>
