<?php $this->load->view('home/layout/header'); ?>
<?php $this->load->view('search/search'); ?>
<?php $this->load->helper('member/member'); ?>

<main id="main" class="main container">
    <h1 class="page-title subtitle">
        <?php echo $page["title"]; ?>
    </h1>
    <div class="row pt-3">
        <?php $this->load->view('member/modules/sidebar'); ?>
        <div class="col-12 col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title color-primary"><?php echo $page["title"]; ?></h4>
                </div>
                <div class="card-body">
                    <form action="javascript:;" method="post" id="formUpdateAccount" novalidate="novalidate">
                        <div class="order-table mb-3">
                            <div class="order-head">
                                <div class="order-no">Sipariş No</div>
                                <div class="order-date">Sipariş Tarihi</div>
                                <div class="order-status">Durum</div>
                                <div class="order-payment">Ödeme Tipi</div>
                                <div class="order-actions"></div>
                            </div>
                            <div class="order-body order-list">
                                <?php if ($orders): ?>
                                    <?php $i=0; foreach ($orders as $row): ?>
                                    <div class="order-item">
                                        <div class="order-item-inner" data-toggle="collapse" data-target="#orderDetail_<?php echo $i; ?>" role="button" aria-expanded="false">
                                            <div class="order-no"><?php echo $row->order_key; ?></div>
                                            <div class="order-date"><?php echo $row->date; ?></div>
                                            <div class="order-status"><?php echo $row->status; ?></div>
                                            <div class="order-payment"><?php echo $row->payment_status; ?></div>
                                            <div class="order-actions">
                                                <i class="icon-angle-up"></i>
                                            </div>
                                        </div>
                                        <div id="orderDetail_<?php echo $i; ?>" class="order-detail collapse" style="">
                                            <div class="order-box">
                                                <div class="row">
                                                    <?php foreach (json_decode($row->products) as $key => $value): ?>
                                                        <?php 
                                                        if ($value->list_img) {
                                                            $img = $value->list_img;
                                                        }elseif (file_exists('upload/product_images/'.$value->prod_code.'.jpg')) {
                                                            $img = 'upload/product_images/'.$value->prod_code.'.jpg';
                                                        }else{
                                                            $img = '';
                                                        }
                                                        ?>
                                                        <div class="col-12 col-md-6">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <a href="javascript:;">
                                                                        <img src="<?php echo $img ?>" alt="<?php echo $value->title; ?>">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="title">
                                                                        <a href="javascript:;"><?php echo $value->title; ?></a>
                                                                    </div>
                                                                    <p>
                                                                        <strong>Adet:</strong> <?php echo $value->qty; ?>
                                                                    </p>
                                                                    <p>
                                                                        <strong>Ürün Fiyatı:</strong> <?php echo $value->price; ?> TL
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-1">
                                                                <h5>AYRINTILAR</h5>
                                                                <span class="hsbmSpan">
                                                                    <strong>Sipariş Numarası</strong>
                                                                    <?php echo $row->order_key; ?>
                                                                </span>
                                                                <span class="hsbmSpan">
                                                                    <strong>Tarih</strong>
                                                                    <?php echo $row->date; ?>
                                                                </span>
                                                                <span class="hsbmSpan">
                                                                    <strong>Durum</strong>
                                                                    <?php echo $row->status; ?>
                                                                </span>
                                                                <span class="hsbmSpan">
                                                                    <strong>Ödeme Tipi</strong>
                                                                    <?php echo $row->payment_status; ?>
                                                                </span>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h5>SİPARİŞ ÖZETİ</h5>
                                                                <?php
                                                                $subtotal = $row->total;
                                                                if ($row->discount_price) {
                                                                    $subtotal = $subtotal + $row->discount_price;
                                                                }
                                                                ?>
                                                                <span class="hsbmTutar">
                                                                    Toptam Ara Tutar
                                                                    <strong><?php echo $subtotal; ?> TL</strong>
                                                                </span>
                                                                <?php if ($row->discount_price): ?>
                                                                    <span class="hsbmTutar">
                                                                        İndirim Tutarı
                                                                        <strong><?php echo $row->discount_price; ?> TL</strong>
                                                                    </span>
                                                                <?php endif ?>
                                                                <span class="hsbmTutar total">
                                                                    Toplam Tutar
                                                                    <strong class="text-primary"><?php echo $row->total; ?> TL</strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="order-box">
                                                        <?php $address = get_address($row->member_id,$row->address_id); ?>
                                                        <h5>TESLİMAT ADRESİ</h5>
                                                        <p>
                                                            <?php echo @$address["name"]." ".@$address["surname"]; ?><br>
                                                            <?php echo @$address["address"]; ?><br>
                                                            <?php echo get_town_title(@$address["town"])." / ".get_city_title(@$address["city"]); ?> <br>
                                                            <?php echo @$address["phone"]; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; endforeach ?>
                                    <?php else: ?>
                                        <p class="text-center py-3">Siparişiniz bulunmamaktadır.</p>
                                <?php endif ?>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</main> 

<?php $this->load->view('home/layout/footer'); ?>

