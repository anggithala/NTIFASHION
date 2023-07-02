@extends('layouts.app')

@section('title')
    FAQ
@endsection

@section('content')
    <!-- Page Content-->
    <div class="page-content page-faq mt-2">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h3>Frequently Asked Questions (FAQ)</h3>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="accordion accordion-flush" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Sejarah NTI Fashion
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        NTI Fashion berdiri sejak 1990. Owner NTI Fashion yang bernama
                                        bapak Nartoyo memulai karirnya sebagai penjahit dengan mengambil sekolah jahit
                                        di Brunei Darussalam. Saat itu saking banyaknya orang yang mengikuti
                                        sekolah jahit, owner memutuskan menandai kopernya dengan tulisan "NTI"
                                        yang artinya Nartoyo Indonesia. Saat ini NTI Fashion terdiri dari
                                        6 pegawai yang bekerja.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Cara melakukan pesanan custom melalui online
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Kalian Bisa Berdiskusi via whatsapp 0856-9454-5285.
                                        Pada diskusi melalui whatsapp kalian bisa menanyakan terkait
                                        custom jahit yang akan langsung dijawab oleh owner
                                        NTI Fashion.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        Kapan pesanan saya dikirim?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Tergantung jenis produk, jika produk jadi yang dipesan,
                                        kami akan proses pengiriman maks. 1 hari setelah melakukan pembayaran.
                                        Jika custom pesanan akan kami kirim setelah jahitan selesai.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                        aria-controls="flush-collapseFour">
                                        Apakah bisa mengambil baju langsung ke toko?
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        bisa, tetapi pastikan baju yang dipesan sudah ready (apabila custom),
                                        dan konfirmasi melalui whatsapp.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false"
                                        aria-controls="flush-collapseFive">
                                        Bagaimana syarat & ketentuan pengembalian barang?
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        - Wajib menyertakan bukti video unboxing tanpa terputus <br>
                                        - Batas pengembalian produk adalah 3 hari setelah barang diterima berdasarkan sistem
                                        <br>
                                        - Form Label pengiriman jangan hilang <br>
                                        - Untuk retur produk tidak boleh dalam keadaan rusak, kotor, atau telah dicuci <br>
                                        - Complain dan Retur hanya bisa diajukan jika ada kesalahan dari pihak kami
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSix" aria-expanded="false"
                                        aria-controls="flush-collapseSix">
                                        Kenapa saya sudah membayar tapi status masih pending?
                                    </button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Status pembayaran akan berubah menjadi success apabila sudah di validasi secara
                                        manual oleh pihak owner.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSeven">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSeven" aria-expanded="false"
                                        aria-controls="flush-collapseSix">
                                        Apakah saya bisa membatalkan pesanan saya?
                                    </button>
                                </h2>
                                <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        Pesanan tidak dapat dibatalkan apabila sudah masuk dalam proses status pengiriman.
                                        Apabila sudah melakukan pembayaran dan ingin melakukan pembatalan pesanan, harap
                                        menghubungi pihak NTI Fashion melalui whatsapp chat agar dapat di return.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
