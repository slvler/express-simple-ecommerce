<div class="col-12 col-md-4 col-lg-3 mb-3">
    <div class="sticky">
        <div class="card card-profile ">
            <div class="card-header">
                <h4 class="card-title color-primary" data-toggle="collapse" data-target="#cllpsProfile">Hesabım</h4>
            </div>
            <div id="cllpsProfile" class="collapse card-body">
                <ul class="sidebar-menu mb-3">
                    <li class="<?php echo ($this->uri->segment(1) == 'profilim') ? 'active':''; ?>">
                        <a href="profilim">Profilim</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(1) == 'adreslerim') ? 'active':''; ?>">
                        <a href="adreslerim">Adreslerim</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(1) == 'siparislerim') ? 'active':''; ?>">
                        <a href="siparislerim">Siparişlerim</a>
                    </li>
                    <li class="<?php echo ($this->uri->segment(1) == 'sifre-degistir') ? 'active':''; ?>">
                        <a href="sifre-degistir">Şifre Değiştir</a>
                    </li>
                </ul>
                <a href="cikis-yap" class="btn btn-danger btn-block btn-logout">Çıkış Yap</a>
            </div>
        </div>
    </div>
</div>