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
                    <div class="row address-list">
                        <?php foreach ($address_list as $key => $value): ?>
                        <div class="col-md-6 address-item <?php if(@$value->default == 1){echo "address-default";} ?>">
                            <div class="address-item__body">
                                <h4><?php echo $value->title; ?></h4>
                                <p>
                                    <?php echo $value->name; ?> <?php echo $value->surname; ?><br>
                                    <?php echo $value->address; ?> <?php echo @get_town($value->town)['title']; ?> / <?php echo @get_city($value->city)['title']; ?><br>
                                    <?php echo $value->phone; ?>
                                </p>
                                <div class="address-item__actions">
                                    <a href="member/address_list_process/default/<?php echo $value->id; ?>" class="btn-unstyled">
                                        <svg class="icon icon-sm mr-1">
                                            <use xlink:href="#icon-check-square"></use>
                                        </svg>Varsayılan Yap
                                    </a>
                                    <a href="member/address_list_process/update/<?php echo $value->id; ?>" class="btn-unstyled">
                                        <svg class="icon icon-sm mr-1">
                                            <use xlink:href="#icon-edit"></use>
                                        </svg>Düzenle
                                    </a>
                                    <a href="member/address_list_process/delete/<?php echo $value->id; ?>" class="btn-unstyled">
                                        <svg class="icon icon-sm mr-1">
                                            <use xlink:href="#icon-close"></use>
                                        </svg>Sil
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                            <div class="col-12 col-md-6 address-item">
                                <a href="member/address_list_process/add" class="address-item__body">
                                    <svg class="icon icon-lg">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                    <span>YENİ ADRES EKLE</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->load->view('home/layout/footer'); ?>