<?php $this->load->view('home/layout/header'); ?>

<?php $this->load->view('search/search'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        Profilim
    </h1>
    <div class="row pt-3">
        <?php $this->load->view('member/modules/sidebar'); ?>
        <div class="col-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title color-primary">Siparişlerim</h4>
                </div>
                <div class="card-body">
                    <form action="javascript:;" method="post" id="formUpdateAccount" novalidate="novalidate">
                        <div class="order-table mb-3">
                            <div class="order-head">
                                <div class="order-no">Sipariş No</div>
                                <div class="order-title">Ürün Adı</div>
                                <div class="order-date">Sipariş Tarihi</div>
                                <div class="order-status">Durum</div>
                                <div class="order-payment">Ödeme Tipi</div>
                                <div class="order-actions"></div>
                            </div>
                            <div class="order-body order-list">
                                <div class="order-item">
                                    <div class="order-item-inner" data-toggle="collapse" data-target="#orderDetail_1" role="button" aria-expanded="false">
                                        <div class="order-no">714VH8911H</div>
                                        <div class="order-title">Karaorman Krokan</div>
                                        <div class="order-date">29-08-2012 10:10:53</div>
                                        <div class="order-status">Onaylandı</div>
                                        <div class="order-payment">Kredi kartı</div>
                                        <div class="order-actions">
                                            <i class="icon-angle-up"></i>
                                        </div>
                                    </div>
                                    <div id="orderDetail_1" class="order-detail collapse" style="">
                                        <div class="order-box">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="urun-detay.php">
                                                                <img src="upload/urun1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="title">
                                                                <a href="urun-detay.php">Karaorman Krokan</a>
                                                            </div>
                                                            <p>
                                                                <strong>Adet:</strong> 1
                                                            </p>
                                                            <p>
                                                                <strong>Ürün Fiyatı:</strong> 1.250 TL
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="urun-detay.php">
                                                                <img src="upload/urun1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="title">
                                                                <a href="urun-detay.php">Karaorman Krokan</a>
                                                            </div>
                                                            <p>
                                                                <strong>Adet:</strong> 1
                                                            </p>
                                                            <p>
                                                                <strong>Ürün Fiyatı:</strong> 1.250 TL
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <h5>AYRINTILAR</h5>
                                                            <span class="hsbmSpan">
                                                                <strong>Tarih</strong>
                                                                29-04-2019 10:10:53
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Durum</strong>
                                                                Kargoda
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Kargo Firma</strong>
                                                                MNG Kargo
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Kargo Takip No</strong>
                                                                <a href="javascript:;" target="_blank" class="text-underline text-primary">MG12DS242SA3</a>
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Ödeme Tipi</strong>
                                                                Kredi Kartı
                                                            </span>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h5>SİPARİŞ ÖZETİ</h5>
                                                            <span class="hsbmTutar">
                                                                Toptam Ara Tutar
                                                                <strong>22,90 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar">
                                                                Toplam Kdv
                                                                <strong>2,40 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar">
                                                                Kargo Tutarı
                                                                <strong>5,00 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar total">
                                                                Toplam Tutar
                                                                <strong class="text-primary">35,00 TL</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="order-box">
                                                    <h5>TESLİMAT ADRESİ</h5>
                                                    <p>
                                                        Ahmet Yılmaz<br>
                                                        Ankara Caddesi No: 119 Bayraklı / İZMİR<br>
                                                        Bayraklı / İZMİR <br>
                                                        90 123 123 12 12<br>
                                                        90 123 123 12 12
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="order-box">
                                                    <h5>FATURA ADRESİ</h5>
                                                    <p>
                                                        Ahmet Yılmaz<br>
                                                        Ankara Caddesi No: 119 Bayraklı / İZMİR<br>
                                                        Bayraklı / İZMİR <br>
                                                        90 123 123 12 12<br>
                                                        90 123 123 12 12
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-item">
                                    <div class="order-item-inner" data-toggle="collapse" data-target="#orderDetail_2" role="button" aria-expanded="false">
                                        <div class="order-no">714VH8911H</div>
                                        <div class="order-title">Karaorman Krokan</div>
                                        <div class="order-date">29-08-2012 10:10:53</div>
                                        <div class="order-status">Onaylandı</div>
                                        <div class="order-payment">Kredi kartı</div>
                                        <div class="order-actions">
                                            <i class="icon-angle-up"></i>
                                        </div>
                                    </div>
                                    <div id="orderDetail_2" class="order-detail collapse" style="">
                                        <div class="order-box">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="urun-detay.php">
                                                                <img src="upload/urun1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="title">
                                                                <a href="urun-detay.php">Karaorman Krokan</a>
                                                            </div>
                                                            <p>
                                                                <strong>Adet:</strong> 1
                                                            </p>
                                                            <p>
                                                                <strong>Ürün Fiyatı:</strong> 1.250 TL
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="urun-detay.php">
                                                                <img src="upload/urun1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="title">
                                                                <a href="urun-detay.php">Karaorman Krokan</a>
                                                            </div>
                                                            <p>
                                                                <strong>Adet:</strong> 1
                                                            </p>
                                                            <p>
                                                                <strong>Ürün Fiyatı:</strong> 1.250 TL
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <h5>AYRINTILAR</h5>
                                                            <span class="hsbmSpan">
                                                                <strong>Tarih</strong>
                                                                29-04-2019 10:10:53
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Durum</strong>
                                                                Kargoda
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Kargo Firma</strong>
                                                                MNG Kargo
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Kargo Takip No</strong>
                                                                <a href="javascript:;" target="_blank" class="text-underline text-primary">MG12DS242SA3</a>
                                                            </span>
                                                            <span class="hsbmSpan">
                                                                <strong>Ödeme Tipi</strong>
                                                                Kredi Kartı
                                                            </span>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <h5>SİPARİŞ ÖZETİ</h5>
                                                            <span class="hsbmTutar">
                                                                Toptam Ara Tutar
                                                                <strong>22,90 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar">
                                                                Toplam Kdv
                                                                <strong>2,40 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar">
                                                                Kargo Tutarı
                                                                <strong>5,00 TL</strong>
                                                            </span>
                                                            <span class="hsbmTutar total">
                                                                Toplam Tutar
                                                                <strong class="text-primary">35,00 TL</strong>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="order-box">
                                                    <h5>TESLİMAT ADRESİ</h5>
                                                    <p>
                                                        Ahmet Yılmaz<br>
                                                        Ankara Caddesi No: 119 Bayraklı / İZMİR<br>
                                                        Bayraklı / İZMİR <br>
                                                        90 123 123 12 12<br>
                                                        90 123 123 12 12
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="order-box">
                                                    <h5>FATURA ADRESİ</h5>
                                                    <p>
                                                        Ahmet Yılmaz<br>
                                                        Ankara Caddesi No: 119 Bayraklı / İZMİR<br>
                                                        Bayraklı / İZMİR <br>
                                                        90 123 123 12 12<br>
                                                        90 123 123 12 12
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</main> 

<?php $this->load->view('home/layout/footer'); ?>

