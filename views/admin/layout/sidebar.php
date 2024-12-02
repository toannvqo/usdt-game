<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>
<div id="sidebar" class="app-sidebar">

    <div class="app-sidebar-content ps" data-scrollbar="true" data-height="100%" data-init="true" style="height: 100%;">

        <div class="menu">
            <div class="menu-header">Navigation</div>
            <div class="menu-item <?= active_sidebar(['']); ?>">
                <a href="/admin" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>
            <div class="menu-item <?= active_sidebar(['']); ?>">
                <a href="/admin/xemlichsu" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-cpu"></i></span>
                    <span class="menu-text">Xem Full Lich Sử Chơi</span>
                </a>
            </div>
            <div class="menu-item has-sub <?= active_sidebar(['bandsdt', 'billerr']); ?>">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <span class="menu-text">Dịch Vụ</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu" style="display: none;">
                    <div class="menu-item">
                        <a href="/admin/bandsdt" class="menu-link">
                            <span class="menu-text">Band Số</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="/admin/billerr" class="menu-link">
                            <span class="menu-text">Biul Lỗi</span>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger"><?=$tkuma->get_row("SELECT COUNT(id) FROM `lich_su_choi` WHERE `status` = ?  ",['Thất Bại'])['COUNT(id)'];?><span class="visually-hidden">unread messages</span></span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="/admin/giftcode" class="menu-link">
                            <span class="menu-text">Giftcode</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="/admin/settingcron" class="menu-link">
                            <span class="menu-text">Setting Cron</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item has-sub <?= active_sidebar(['bandsdt', 'billerr']); ?>">
                <a href="#" class="menu-link">
                    <span class="menu-icon">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <span class="menu-text">Cài Đặt Mini Game</span>
                    <span class="menu-caret"><b class="caret"></b></span>
                </a>
                <div class="menu-submenu" style="display: none;">
                    <div class="menu-item">
                        <a href="/admin/danhsachgame" class="menu-link">
                            <span class="menu-text">Danh Sách Game</span>
                        </a>
                    </div>

                    <?php foreach ($tkuma->get_list("SELECT * FROM `event` ") as $danhsachd) { ?>
                        <div class="menu-item">
                            <a href="/admin/even/<?= $danhsachd['id']; ?>" class="menu-link">
                                <span class="menu-text"><?= $danhsachd['game']; ?></span>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>


            <div class="menu-divider"></div>
            <div class="menu-header">Users</div>
            <div class="menu-item <?= active_sidebar(['users', 'user-edit']); ?>">
                <a href="/admin/users" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-people"></i></span>
                    <span class="menu-text">Thành Viên</span>
                </a>
            </div>
            <div class="menu-item <?= active_sidebar(['chuyentien']); ?>">
                <a href="/admin/chuyentien" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Chuyển tiền VCB</span>
                </a>
            </div>
            <div class="menu-item <?= active_sidebar(['chuyentienmb']); ?>">
                <a href="/admin/chuyentienmb" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Chuyển tiền Mbbank</span>
                </a>
            </div>
            <div class="menu-item <?= active_sidebar(['settingsbank']); ?>">
                <a href="/admin/settingsbank" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Settings Bank</span>
                </a>
            </div>
            <div class="menu-item <?= active_sidebar(['settings']); ?>">
                <a href="/admin/settings" class="menu-link">
                    <span class="menu-icon"><i class="bi bi-gear"></i></span>
                    <span class="menu-text">Settings</span>
                </a>
            </div>
        </div>

        <div class="p-3 px-4 mt-auto">
            <a href="https://seantheme.com/hud/index.html" target="_blank" class="btn d-block btn-outline-theme">
                <i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> Documentation
            </a>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>

</div>