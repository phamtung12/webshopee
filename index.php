<?php
require_once './db.php';
session_start();
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$is_searching = !empty($search_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee</title>
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.2-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./lib/normalize.css">
</head>

<body>
    <div class="app">
        <!-- Header -->
        <header class="header">
            <div class="grid wide">
                <!-- Nav -->
                <nav class="header__navbar hide-on-mobile-tablet">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--separate">
                            <a href="./public/seller.php" class="header__navbar-item-link">
                                Kênh Người Bán
                            </a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--separate">
                            <a href="./public/register.php" class="header__navbar-item-link">
                                Trở thành Người bán Shopee
                            </a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--has-qr header__navbar-item--separate">
                            <a href="https://shopee.vn/web" class="header__navbar-item-link">
                                Tải ứng dụng
                                <div class="header__qr">
                                    <img src="./assets/img/qrcodesp.png" alt="" class="header__qr-img">
                                    <div class="header__qr-apps">
                                        <img src="./assets/img/appstore.png" alt="App Store"
                                            class="header__qr-download-img">
                                        <img src="./assets/img/googleplay.png" alt="Google Play"
                                            class="header__qr-download-img">
                                    </div>
                                    <div class="header__qr-apps">
                                        <img src="./assets/img/appgallery.png" alt="Google Play"
                                            class="header__qr-download-img">
                                        <img src="./assets/img/" alt="" class="header__qr-download-img">
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nối</span>
                            <a href="https://www.facebook.com/ShopeeVN" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/Shopee_VN/" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-notify">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-bell"></i>
                                Thông báo
                            </a>
                            <div class="header__notify">
                                <header class="header__notify-header">
                                    <h3>Thông Báo Mới Nhận</h3>
                                </header>
                                <ul class="header__notify-list">
                                    <li class="header__notify-item">
                                        <a href="" class="header__notify-link">
                                            <img src="./assets/img/dale.png" alt="" class="header__notify-img">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name">Chấn động! Deal 1K nhưng được
                                                    baoship</span>
                                                <span class="header__notify-desciption">⭐ Thứ 6 gì cũng rẻ chỉ từ
                                                    1K🏠 Decor
                                                    nhà cửa, làm đẹp, phụ kiện 💝 Ngàn deal đồng giá 1K, 9K 🛒
                                                    Freeship
                                                    đơn từ 0Đ - Mua ngay!</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="header__notify-item">
                                        <a href="" class="header__notify-link">
                                            <img src="./assets/img/sale.png" alt="" class="header__notify-img">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name">Chỉ còn 3 tiếng chốt sale
                                                    #9.9</span>
                                                <span class="header__notify-desciption">🚛 Cơ hội cuối lưu mã
                                                    Freeship🌟 Lượt
                                                    cuối tung mã giảm đến 99K 💥 Xả hàng đồng giá từ 9K, 99K ☄️ Chớp
                                                    liền tay - Hết là tiếc!</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="header__notify-item">
                                        <a href="" class="header__notify-link">
                                            <img src="./assets/img/shopee.png" alt="" class="header__notify-img">
                                            <div class="header__notify-info">
                                                <span class="header__notify-name">
                                                    Shopee Pay tặng bạn 1 voucher mua hàng Shopee
                                                </span>
                                                <span class="header__notify-desciption">
                                                    Shopee Pay tặng bạn 1 voucher mua hàng Shopee. Hạn sử dụng:
                                                    23/03/2022 23H59.
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <footer class="header__notify-footer">
                                    <a href="" class="header__notify-footer-btn">Xem tất cả</a>
                                </footer>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <a href="https://help.shopee.vn/portal/4/vn/s" class="header__navbar-item-link">
                                <i class="header__navbar-icon far fa-question-circle"></i>
                                Hỗ trợ
                            </a>
                        </li>
                        <li class="header__navbar-item header__navbar-item--has-language">
                            <a href="#" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-globe"></i>
                                Tiếng Việt
                                <i class="header__navbar-icon fa fa-angle-down"></i>
                            </a>
                            <div class="header__language">
                                <ul class="header__language-list">
                                    <li class="header__language-item">
                                        <a href="#" class="header__language-link" data-lang="vi">Tiếng Việt</a>
                                    </li>
                                    <li class="header__language-item">
                                        <a href="#" class="header__language-link" data-lang="en">English</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header__navbar-item header__navbar-item--separate">
                            <a href="./public/register.php" class="header__navbar-item-link header__navbar-item-link--bold">
                                Đăng ký
                            </a>
                        </li>
                        <li class="header__navbar-item">
                            <a href="./public/login.php" class="header__navbar-item-link header__navbar-item-link--bold">
                                Đăng nhập
                            </a>
                        </li>

                        <!-- <li class="header__navbar-item header__navbar-user">
                            <div class="header__navbar-user-img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 512 512">
                                    <path fill="#c6c6c6"
                                        d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38c-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6M432 480H80a31 31 0 0 1-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75c1.94 10.73-.68 21.34-7.18 29.11A31 31 0 0 1 432 480" />
                                </svg>
                            </div>
                            <span class="header__navbar-user-name">PhạmTùng</span>

                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="">Tài Khoản Của Tôi</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Đơn Mua</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <a href="">Đăng Xuất</a>
                                </li>
                            </ul>
                        </li> -->

                    </ul>
                </nav>
                <!-- Header-with-search -->
                <div class="header-with-search hide-on-mobile">
                    <div class="header__logo">
                        <a href="index.php" class="header__logo-link">
                            <svg viewBox="0 0 192 65" class="header__logo-img">
                                <g fill-rule="evenodd">
                                    <path fill="#fff"
                                        d="M35.6717403 44.953764c-.3333497 2.7510509-2.0003116 4.9543414-4.5823845 6.0575984-1.4379707.6145919-3.36871.9463856-4.896954.8421628-2.3840266-.0911143-4.6237865-.6708937-6.6883352-1.7307424-.7375522-.3788551-1.8370513-1.1352759-2.6813095-1.8437757-.213839-.1790053-.239235-.2937577-.0977428-.4944671.0764015-.1151823.2172535-.3229831.5286218-.7791994.45158-.6616533.5079208-.7446018.5587128-.8221779.14448-.2217688.3792333-.2411091.6107855-.0588804.0243289.0189105.0243289.0189105.0426824.0333083.0379873.0294402.0379873.0294402.1276204.0990653.0907002.0706996.14448.1123887.166248.1287205 2.2265285 1.7438508 4.8196989 2.7495466 7.4376251 2.8501162 3.6423042-.0496401 6.2615109-1.6873341 6.7308041-4.2020035.5160305-2.7675977-1.6565047-5.1582742-5.9070334-6.4908212-1.329344-.4166762-4.6895175-1.7616869-5.3090528-2.1250697-2.9094471-1.7071043-4.2697358-3.9430584-4.0763845-6.7048539.296216-3.8283059 3.8501677-6.6835796 8.340785-6.702705 2.0082079-.004083 4.0121475.4132378 5.937338 1.2244562.6816382.2873109 1.8987274.9496089 2.3189359 1.2633517.2420093.1777159.2898136.384872.1510957.60836-.0774686.12958-.2055158.3350171-.4754821.7632974l-.0029878.0047276c-.3553311.5640922-.3664286.5817134-.447952.7136572-.140852.2144625-.3064598.2344475-.5604202.0732783-2.0600669-1.3839063-4.3437898-2.0801572-6.8554368-2.130442-3.126914.061889-5.4706057 1.9228561-5.6246892 4.4579402-.0409751 2.2896772 1.676352 3.9613243 5.3858811 5.2358503 7.529819 2.4196871 10.4113092 5.25648 9.869029 9.7292478M26.3725216 5.42669372c4.9022893 0 8.8982174 4.65220288 9.0851664 10.47578358H17.2875686c.186949-5.8235807 4.1828771-10.47578358 9.084953-10.47578358m25.370857 11.57065968c0-.6047069-.4870064-1.0948761-1.0875481-1.0948761h-11.77736c-.28896-7.68927544-5.7774923-13.82058185-12.5059489-13.82058185-6.7282432 0-12.2167755 6.13130641-12.5057355 13.82058185l-11.79421958.0002149c-.59136492.0107446-1.06748731.4968309-1.06748731 1.0946612 0 .0285807.00106706.0569465.00320118.0848825H.99995732l1.6812605 37.0613963c.00021341.1031483.00405483.2071562.01173767.3118087.00170729.0236381.003628.0470614.00554871.0704847l.00362801.0782207.00405483.004083c.25545428 2.5789222 2.12707837 4.6560709 4.67201764 4.7519129l.00576212.0055872h37.4122078c.0177132.0002149.0354264.0004298.0531396.0004298.0177132 0 .0354264-.0002149.0531396-.0004298h.0796027l.0017073-.0015043c2.589329-.0706995 4.6867431-2.1768587 4.9082648-4.787585l.0012805-.0012893.0017073-.0350275c.0021341-.0275062.0040548-.0547975.0057621-.0823037.0040548-.065757.0068292-.1312992.0078963-.1964115l1.8344904-37.207738h-.0012805c.001067-.0186956.0014939-.0376062.0014939-.0565167M176.465457 41.1518926c.720839-2.3512494 2.900423-3.9186779 5.443734-3.9186779 2.427686 0 4.739107 1.6486899 5.537598 3.9141989l.054826.1556978h-11.082664l.046506-.1512188zm13.50267 3.4063683c.014933.0006399.014933.0006399.036906.0008531.021973-.0002132.021973-.0002132.044372-.0008531.53055-.0243144.950595-.4766911.950595-1.0271786 0-.0266606-.000853-.0496953-.00256-.0865936.000427-.0068251.000427-.020262.000427-.0635588 0-5.1926268-4.070748-9.4007319-9.09145-9.4007319-5.020488 0-9.091235 4.2081051-9.091235 9.4007319 0 .3871116.022399.7731567.067838 1.1568557l.00256.0204753.01408.1013102c.250022 1.8683731 1.047233 3.5831812 2.306302 4.9708108-.00064-.0006399.00064.0006399.007253.0078915 1.396026 1.536289 3.291455 2.5833031 5.393601 2.9748936l.02752.0053321v-.0027727l.13653.0228215c.070186.0119439.144211.0236746.243409.039031 2.766879.332724 5.221231-.0661182 7.299484-1.1127057.511777-.2578611.971928-.5423827 1.37064-.8429007.128211-.0968312.243622-.1904632.34346-.2781231.051412-.0452164.092372-.083181.114131-.1051493.468898-.4830897.498124-.6543572.215249-1.0954297-.31146-.4956734-.586228-.9179769-.821744-1.2675504-.082345-.1224254-.154023-.2267215-.214396-.3133151-.033279-.0475624-.033279-.0475624-.054399-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.00256-.0038391c-.256208-.3188605-.431565-.3480805-.715933-.0970445-.030292.0268739-.131624.1051493-.14997.1245582-1.999321 1.775381-4.729508 2.3465571-7.455854 1.7760208-.507724-.1362888-.982595-.3094759-1.419919-.5184948-1.708127-.8565509-2.918343-2.3826022-3.267563-4.1490253l-.02752-.1394881h13.754612zM154.831964 41.1518926c.720831-2.3512494 2.900389-3.9186779 5.44367-3.9186779 2.427657 0 4.739052 1.6486899 5.537747 3.9141989l.054612.1556978h-11.082534l.046505-.1512188zm13.502512 3.4063683c.015146.0006399.015146.0006399.037118.0008531.02176-.0002132.02176-.0002132.044159-.0008531.530543-.0243144.950584-.4766911.950584-1.0271786 0-.0266606-.000854-.0496953-.00256-.0865936.000426-.0068251.000426-.020262.000426-.0635588 0-5.1926268-4.070699-9.4007319-9.091342-9.4007319-5.020217 0-9.091343 4.2081051-9.091343 9.4007319 0 .3871116.022826.7731567.068051 1.1568557l.00256.0204753.01408.1013102c.250019 1.8683731 1.04722 3.5831812 2.306274 4.9708108-.00064-.0006399.00064.0006399.007254.0078915 1.396009 1.536289 3.291417 2.5833031 5.393538 2.9748936l.027519.0053321v-.0027727l.136529.0228215c.070184.0119439.144209.0236746.243619.039031 2.766847.332724 5.22117-.0661182 7.299185-1.1127057.511771-.2578611.971917-.5423827 1.370624-.8429007.128209-.0968312.243619-.1904632.343456-.2781231.051412-.0452164.09237-.083181.11413-.1051493.468892-.4830897.498118-.6543572.215246-1.0954297-.311457-.4956734-.586221-.9179769-.821734-1.2675504-.082344-.1224254-.154022-.2267215-.21418-.3133151-.033492-.0475624-.033492-.0475624-.054612-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.002346-.0038391c-.256419-.3188605-.431774-.3480805-.716138-.0970445-.030292.0268739-.131623.1051493-.149969.1245582-1.999084 1.775381-4.729452 2.3465571-7.455767 1.7760208-.507717-.1362888-.982582-.3094759-1.419902-.5184948-1.708107-.8565509-2.918095-2.3826022-3.267311-4.1490253l-.027733-.1394881h13.754451zM138.32144123 49.7357905c-3.38129629 0-6.14681004-2.6808521-6.23169343-6.04042014v-.31621743c.08401943-3.35418649 2.85039714-6.03546919 6.23169343-6.03546919 3.44242097 0 6.23320537 2.7740599 6.23320537 6.1960534 0 3.42199346-2.7907844 6.19605336-6.23320537 6.19605336m.00172791-15.67913203c-2.21776751 0-4.33682838.7553485-6.03989586 2.140764l-.19352548.1573553V34.6208558c0-.4623792-.0993546-.56419733-.56740117-.56419733h-2.17651376c-.47409424 0-.56761716.09428403-.56761716.56419733v27.6400724c0 .4539841.10583425.5641973.56761716.5641973h2.17651376c.46351081 0 .56740117-.1078454.56740117-.5641973V50.734168l.19352548.1573553c1.70328347 1.3856307 3.82234434 2.1409792 6.03989586 2.1409792 5.27140956 0 9.54473746-4.2479474 9.54473746-9.48802964 0-5.239867-4.2733279-9.48781439-9.54473746-9.48781439M115.907646 49.5240292c-3.449458 0-6.245805-2.7496948-6.245805-6.1425854 0-3.3928907 2.79656-6.1427988 6.245805-6.1427988 3.448821 0 6.24538 2.7499081 6.24538 6.1427988 0 3.3926772-2.796346 6.1425854-6.24538 6.1425854m.001914-15.5438312c-5.28187 0-9.563025 4.2112903-9.563025 9.4059406 0 5.1944369 4.281155 9.4059406 9.563025 9.4059406 5.281657 0 9.562387-4.2115037 9.562387-9.4059406 0-5.1946503-4.280517-9.4059406-9.562387-9.4059406M94.5919049 34.1890939c-1.9281307 0-3.7938902.6198995-5.3417715 1.7656047l-.188189.1393105V23.2574169c0-.4254677-.1395825-.5643476-.5649971-.5643476h-2.2782698c-.4600414 0-.5652122.1100273-.5652122.5643476v29.2834155c0 .443339.1135587.5647782.5652122.5647782h2.2782698c.4226187 0 .5649971-.1457701.5649971-.5647782v-9.5648406c.023658-3.011002 2.4931278-5.4412923 5.5299605-5.4412923 3.0445753 0 5.516841 2.4421328 5.5297454 5.4630394v9.5430935c0 .4844647.0806524.5645628.5652122.5645628h2.2726775c.481764 0 .565212-.0824666.565212-.5645628v-9.5710848c-.018066-4.8280677-4.0440197-8.7806537-8.9328471-8.7806537M62.8459442 47.7938061l-.0053397.0081519c-.3248668.4921188-.4609221.6991347-.5369593.8179812-.2560916.3812097-.224267.551113.1668119.8816949.91266.7358184 2.0858968 1.508535 2.8774525 1.8955369 2.2023021 1.076912 4.5810275 1.646045 7.1017886 1.6975309 1.6283921.0821628 3.6734936-.3050536 5.1963734-.9842376 2.7569891-1.2298679 4.5131066-3.6269626 4.8208863-6.5794607.4985136-4.7841067-2.6143125-7.7747902-10.6321784-10.1849709l-.0021359-.0006435c-3.7356476-1.2047686-5.4904836-2.8064071-5.4911243-5.0426086.1099976-2.4715346 2.4015793-4.3179454 5.4932602-4.4331449 2.4904317.0062212 4.6923065.6675996 6.8557356 2.0598624.4562232.2767364.666607.2256796.9733188-.172263.035242-.0587797.1332787-.2012238.543367-.790093l.0012815-.0019308c.3829626-.5500403.5089793-.7336731.5403767-.7879478.258441-.4863266.2214903-.6738208-.244985-1.0046173-.459427-.3290803-1.7535544-1.0024722-2.4936356-1.2978721-2.0583439-.8211991-4.1863175-1.2199998-6.3042524-1.1788111-4.8198184.1046878-8.578747 3.2393171-8.8265087 7.3515337-.1572005 2.9703036 1.350301 5.3588174 4.5000778 7.124567.8829712.4661613 4.1115618 1.6865902 5.6184225 2.1278667 4.2847814 1.2547527 6.5186944 3.5630343 6.0571315 6.2864205-.4192725 2.4743234-3.0117991 4.1199394-6.6498372 4.2325647-2.6382344-.0549182-5.2963324-1.0217793-7.6043603-2.7562084-.0115337-.0083664-.0700567-.0519149-.1779185-.1323615-.1516472-.1130543-.1516472-.1130543-.1742875-.1300017-.4705335-.3247898-.7473431-.2977598-1.0346184.1302162-.0346012.0529875-.3919333.5963776-.5681431.8632459">
                                    </path>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <form class="header__search" method="GET" action="">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input"
                                placeholder="Shopee bao ship 0Đ - Đăng ký ngay!" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Tìm kiếm">

                            <!-- header history -->
                            <?php if ($search_query !== ''): ?>
                                <div class="header__search-history">
                                    <ul class="header__search-history-list">
                                        <li class="header__search-history-item">
                                            <a class="header__search-history-link" href="https://shopee.vn/welcome-package">
                                                <span class="history__text">Shopee bao ship 0Đ - Đăng ký ngay!</span>
                                                <img src="./assets/img/free.png" alt="" class="history__img">
                                            </a>
                                        </li>
                                        <li class="header__search-history-item">
                                            <a class="header__search-history-link" href="?search=<?= htmlspecialchars($search_query) ?>">
                                                <span class="history__text"><?= htmlspecialchars($search_query) ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button class="header__search-btn" type="submit">
                            <i class="header__search-btn-icon fa fa-search" aria-hidden="true"></i>
                        </button>

                        <!-- Product suggest -->
                        <ul class="product__suggest-list hide-on-mobile">
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">1k Điện Thoại</a>
                            </li>
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">Áo Khoác</a>
                            </li>
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">Gấu Bông Capybara Chảy Nước Mũi</a>
                            </li>
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">Bàn Phím Chơi Game Trên Điện Thoại</a>
                            </li>
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">Dép</a>
                            </li>
                            <li class="product__suggest-item">
                                <a href="" class="product__suggest-link">Ống Nhòm</a>
                            </li>
                        </ul>
                    </form>

                    <!-- Cart layout -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <i class="header__cart-icon fa fa-shopping-cart" aria-hidden="true"></i>

                            <!-- No cart :  header__cart-list--no-cart-->
                            <div class="header__cart-list header__cart-list--no-cart">
                                <img src="./assets/img/cart-empty.png" alt="" class="header__cart-no-cart-img">
                                <p class="header__cart-no-cart-description">Chưa Có Sản Phẩm</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </header>

        <div class="container">
            <!-- Slide -->
            <div class="grid wide">
                <!-- Slide -->
                <div class="container__slides">
                    <div class="container__slide-main">
                        <div class="container__slide-main--run">
                            <div class="container__slide-main-list">
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide1.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide2.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide3.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide4.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide5.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img//slide6.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide7.png" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide8.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide9.jpg" alt="" class="container__slide-main-img">
                                </div>
                                <div class="container__slide-main--iteam">
                                    <img src="./assets/img/slide10.jpg" alt="" class="container__slide-main-img">
                                </div>
                            </div>
                            <!-- Button prev and next -->
                            <div class="container__slide-main-buttons">
                                <button id="button-prev"><svg enable-background="new 0 0 13 20" viewBox="0 0 13 20"
                                        role="img" height="16" width="16">
                                        <path stroke="none" d="m4.2 10l7.9-7.9-2.1-2.2-9 9-1.1 1.1 1.1 1 9 9 2.1-2.1z"
                                            fill="#fff">
                                        </path>
                                    </svg></button>
                                <button id="button-next"><svg enable-background="new 0 0 13 21" viewBox="0 0 13 21"
                                        role="img" height="16" width="16">
                                        <path stroke="none" d="m11.1 9.9l-9-9-2.2 2.2 8 7.9-8 7.9 2.2 2.1 9-9 1-1z"
                                            fill="#fff"></path>
                                    </svg></button>
                            </div>
                            <!-- Dots -->
                            <ul class="container__slide-main-dots">
                                <li class="container__slide-main-dots--active"></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="container__slides-extra">
                        <img src="./assets/img/extra1.jpg" alt="" class="container__slides-extra-img">
                        <img src="./assets/img/extra2.jpg" alt="" class="container__slides-extra-img">
                    </div>
                </div>
            </div>
        </div>
        <!-- Category -->
        <div class="grid wide">
            <div class="grid__row content">
                <div class="grid__col">
                    <div class="product__suggest">
                        Gợi ý hôm nay
                    </div>
                    <?php if (!$is_searching): ?>
                        <div class="home-product">
                            <div class="grid__row">
                                <?php
                                $sql = "
                             SELECT p.*, pi.image_url,
                                 (SELECT COALESCE(AVG(rating), 0) FROM reviews r WHERE r.product_id = p.product_id) AS avg_rating
                             FROM products p
                             LEFT JOIN (
                                 SELECT product_id, MIN(image_url) AS image_url
                                 FROM product_images
                                 GROUP BY product_id
                             ) pi ON p.product_id = pi.product_id
                             WHERE p.status = 'approved'
                             ";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $price = number_format($row['price'], 0, '.', '.');
                                        $image = './assets/images/' . $row['image_url'];
                                        $discount = $row['discount']; // lấy từ CSDL giảm giá
                                        $rating = number_format($row['avg_rating'], 1); // lấy điểm đánh giá trung bình từ CSDL
                                        $sold = $row['sold'];  // Lấy số lượng đã bán từ cột `sold`
                                        echo '
                                            <!-- Product item -->
                                            <div class="grid__col-6">
                                                <a class="home-product-item">
                                                    <img src="' . $image . '" alt="" class="home-product-item__img">
                                                    <h4 class="home-product-item__name">
                                                        <img src="./assets/img/like0.png" alt="" class="home-product-item__likeimg">
                                                        ' . htmlspecialchars($name) . '
                                                    </h4>
                                                    <div class="home-product-item__price">
                                                        <span class="home-product-item__price-current">₫' . $price . '</span>
                                                        <span class="home-product-item__price-sale">-' . $discount . '%</span>
                                                    </div>
                                                    <div class="home-product-item__chip">Rẻ Vô Địch</div>
                                                    <div class="home-product-item__evaluate">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 12 12" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M5.99983 9.93762L2.76524 11.7208C2.54602 11.8417 2.28393 11.6567 2.32433 11.4097L2.94569 7.61076L0.300721 4.9072C0.129793 4.73248 0.228342 4.43764 0.469974 4.40083L4.11226 3.84584L5.72839 0.411994C5.83648 0.18233 6.16317 0.18233 6.27126 0.411995L7.88739 3.84584L11.5297 4.40083C11.7713 4.43764 11.8699 4.73248 11.6989 4.9072L9.05396 7.61076L9.67532 11.4097C9.71572 11.6567 9.45364 11.8417 9.23441 11.7208L5.99983 9.93762Z"
                                                                fill="url(#paint0_linear_1_7602)" />
                                                            <defs>
                                                                <linearGradient id="paint0_linear_1_7602" x1="0.299805" y1="0.29985"
                                                                    x2="0.299805" y2="11.6998" gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFCA11" />
                                                                    <stop offset="1" stop-color="#FFAD27" />
                                                                </linearGradient>
                                                            </defs>
                                                        </svg>
                                                        <div class="home-product-item__numstar">' . $rating . '</div>
                                                        <div class="home-product-item__sold">Đã bán ' . $sold . '</div>
                                                    </div>
                                                    <div class="home-product-item__freeship">
                                                        <img src="../assets/img/freeship.png" alt="" class="home-product-item__freeship-img">
                                                    </div>
                                                </a>
                                            </div>';
                                    }
                                } else {
                                    echo "<p>Chưa có sản phẩm nào được duyệt.</p>";
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Kết quả tìm kiếm -->
                    <?php if ($is_searching): ?>
                        <!-- Kết quả Tìm kiếm -->
                        <div class="search-results">
                            <?php
                            // Lấy từ khóa tìm kiếm từ form
                            $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                            // Truy vấn tìm kiếm sản phẩm theo tên hoặc mô tả
                            $sql = "
                                SELECT p.*, pi.image_url,
                                    (SELECT COALESCE(AVG(rating), 0) FROM reviews r WHERE r.product_id = p.product_id) AS avg_rating
                                FROM products p
                                LEFT JOIN (
                                    SELECT product_id, MIN(image_url) AS image_url
                                    FROM product_images
                                    GROUP BY product_id
                                ) pi ON p.product_id = pi.product_id
                                WHERE (p.name LIKE '%$search_query%' OR p.description LIKE '%$search_query%') AND p.status = 'approved'";


                            $result = mysqli_query($conn, $sql);

                            // Hiển thị kết quả tìm kiếm
                            if (mysqli_num_rows($result) > 0) {
                                // Hiển thị tiêu đề kết quả tìm kiếm
                                echo '<div class="search-title">';
                                echo '<svg viewBox="0 0 18 24" class="search-title__icon">
                                        <g transform="translate(-355 -149)">
                                            <g transform="translate(355 149)">
                                                <g fill-rule="nonzero" transform="translate(5.4 19.155556)">
                                                    <path d="m1.08489412 1.77777778h5.1879153c.51164401 0 .92641344-.39796911.92641344-.88888889s-.41476943-.88888889-.92641344-.88888889h-5.1879153c-.51164402 0-.92641345.39796911-.92641345.88888889s.41476943.88888889.92641345.88888889z"></path>
                                                    <g transform="translate(1.9 2.666667)">
                                                        <path d="m .75 1.77777778h2.1c.41421356 0 .75-.39796911.75-.88888889s-.33578644-.88888889-.75-.88888889h-2.1c-.41421356 0-.75.39796911-.75.88888889s.33578644.88888889.75.88888889z"></path>
                                                    </g>
                                                </g>
                                                <path d="m8.1 8.77777718v4.66666782c0 .4295545.40294373.7777772.9.7777772s.9-.3482227.9-.7777772v-4.66666782c0-.42955447-.40294373-.77777718-.9-.77777718s-.9.34822271-.9.77777718z" fill-rule="nonzero"></path>
                                                <path d="m8.1 5.33333333v.88889432c0 .49091978.40294373.88888889.9.88888889s.9-.39796911.9-.88888889v-.88889432c0-.49091977-.40294373-.88888889-.9-.88888889s-.9.39796912-.9.88888889z" fill-rule="nonzero"></path>
                                                <path d="m8.80092773 0c-4.86181776 0-8.80092773 3.97866667-8.80092773 8.88888889 0 1.69422221.47617651 3.26933331 1.295126 4.61333331l2.50316913 3.9768889c.30201078.4782222.84303623.7697778 1.42482388.7697778h7.17785139c.7077799 0 1.3618277-.368 1.7027479-.9617778l2.3252977-4.0213333c.7411308-1.2888889 1.1728395-2.7786667 1.1728395-4.37688891 0-4.91022222-3.9409628-8.88888889-8.80092777-8.88888889m0 1.77777778c3.82979317 0 6.94810087 3.18933333 6.94810087 7.11111111 0 1.24444441-.3168334 2.43022221-.9393833 3.51466671l-2.3252977 4.0213333c-.0166754.0284444-.0481735.0462222-.0833772.0462222h-7.07224026l-2.43461454-3.8648889c-.68184029-1.12-1.04128871-2.4053333-1.04128871-3.71733331 0-3.92177778 3.11645483-7.11111111 6.94810084-7.11111111"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    Kết quả tìm kiếm cho từ khóa : <strong>' . htmlspecialchars($search_query) . '</strong>';

                                echo '</div>';

                                echo '<div class="grid__row">';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $name = $row['name'];
                                    $price = number_format($row['price'], 0, '.', '.');
                                    $image = './assets/images/' . $row['image_url'];
                                    $discount = $row['discount'];
                                    $rating = number_format($row['avg_rating'], 1);
                                    $sold = $row['sold'];

                                    echo '
                                    <!-- Product item -->
                                    <div class="grid__col-6">
                                        <a class="home-product-item">
                                            <img src="' . $image . '" alt="" class="home-product-item__img">
                                            <h4 class="home-product-item__name">
                                                <img src="./assets/img/like0.png" alt="" class="home-product-item__likeimg">
                                                ' . htmlspecialchars($name) . '
                                            </h4>
                                            <div class="home-product-item__price">
                                                <span class="home-product-item__price-current">₫' . $price . '</span>
                                                <span class="home-product-item__price-sale">-' . $discount . '%</span>
                                            </div>
                                            <div class="home-product-item__chip">Rẻ Vô Địch</div>
                                            <div class="home-product-item__evaluate">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 12 12" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M5.99983 9.93762L2.76524 11.7208C2.54602 11.8417 2.28393 11.6567 2.32433 11.4097L2.94569 7.61076L0.300721 4.9072C0.129793 4.73248 0.228342 4.43764 0.469974 4.40083L4.11226 3.84584L5.72839 0.411994C5.83648 0.18233 6.16317 0.18233 6.27126 0.411995L7.88739 3.84584L11.5297 4.40083C11.7713 4.43764 11.8699 4.73248 11.6989 4.9072L9.05396 7.61076L9.67532 11.4097C9.71572 11.6567 9.45364 11.8417 9.23441 11.7208L5.99983 9.93762Z"
                                                        fill="url(#paint0_linear_1_7602)" />
                                                    <defs>
                                                        <linearGradient id="paint0_linear_1_7602" x1="0.299805" y1="0.29985"
                                                            x2="0.299805" y2="11.6998" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#FFCA11" />
                                                            <stop offset="1" stop-color="#FFAD27" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                                <div class="home-product-item__numstar">' . $rating . '</div>
                                                <div class="home-product-item__sold">Đã bán ' . $sold . '</div>
                                            </div>
                                            <div class="home-product-item__freeship">
                                                <img src="../assets/img/freeship.png" alt="" class="home-product-item__freeship-img">
                                            </div>
                                        </a>
                                    </div>';
                                }
                                echo '</div>'; // kết thúc grid__row
                            } else {
                                echo '<div class="no-result">Không tìm thấy sản phẩm nào phù hợp.</div>';
                            }

                            // Đóng kết nối
                            mysqli_close($conn);
                            ?>
                        </div>
                    <?php endif; ?>

                    <ul class="pagination home-product__pagination">
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" height="16"
                                    width="16">
                                    <g>
                                        <path fill="#939393"
                                            d="m8.5 11c-.1 0-.2 0-.3-.1l-6-5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4l6-5c .2-.2.5-.1.7.1s.1.5-.1.7l-5.5 4.6 5.5 4.6c.2.2.2.5.1.7-.1.1-.3.2-.4.2z">
                                        </path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li class="pagination-item pagination-item--active">
                            <a href="" class="pagination-item__link">
                                1
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                2
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                3
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                4
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                5
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                ...
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-item__link">
                                <svg enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" height="16"
                                    width="16">
                                    <path fill="#939393"
                                        d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <footer class="footer">
        <div class="grid wide">
            <div class="grid__row">
                <div class="grid_col-2-4">
                    <h3 class="footer__heading">DỊCH VỤ KHÁCH HÀNG</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Trung Tâm Trợ Giúp Shopee</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Shopee Blog</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Shopee Mall</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Hướng Dẫn Mua Hàng/Đặt Hàng</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Hướng Dẫn Bán Hàng</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Ví ShopeePay</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Shopee Xu</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Đơn Hàng</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Trả Hàng/Hoàn Tiền</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Liên Hệ Shopee</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Chính Sách Bảo Hành</a>
                        </li>
                    </ul>
                </div>
                <div class="grid_col-2-4">
                    <h3 class="footer__heading">SHOPEE VIỆT NAM</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Về Shopee</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Tuyển Dụng</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Điều Khoản Shopee</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Chính Sách Bảo Mật</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Shopee Mall</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Kênh Người Bán</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Flash Sale</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Tiếp Thị Liên Kết</a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">Liên Hệ Truyền Thông</a>
                        </li>
                    </ul>
                </div>
                <div class="grid_col-2-4">
                    <h3 class="footer__heading">THANH TOÁN</h3>
                    <ul class="pay-list">
                        <li class="pay-item">
                            <img src="./assets/img/visa.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/round.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/jcb.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/americae.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/cod.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/tragop.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/spay.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/slater.png" alt="" class="pay-item-img">
                        </li>
                    </ul>
                    <h3 class="footer__heading">ĐƠN VỊ VẬN CHUYỂN</h3>
                    <ul class="pay-list">
                        <li class="pay-item">
                            <img src="./assets/img/spx.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/ghn.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/viettel.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/vietpost.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/jt.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/grab.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/ninjavan.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/be.png" alt="" class="pay-item-img">
                        </li>
                        <li class="pay-item">
                            <img src="./assets/img/aha.png" alt="" class="pay-item-img">
                        </li>
                    </ul>
                </div>
                <div class="grid_col-2-4">
                    <h3 class="footer__heading">THEO DÕI SHOPEE</h3>
                    <ul class="footer-list">
                        <li class="footer-item">
                            <a href="" class="footer-item__link">
                                <img src="./assets/img/facebook.png" alt="" class="footer-item__link-img">
                                Facebook
                            </a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">
                                <img src="./assets/img/instargram.png" alt="" class="footer-item__link-img">
                                Instagram
                            </a>
                        </li>
                        <li class="footer-item">
                            <a href="" class="footer-item__link">
                                <img src="./assets/img/linkIn.png" alt="" class="footer-item__link-img">
                                LinkedIn
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="grid_col-2-4">
                    <h3 class="footer__heading">TẢI ỨNG DỤNG SHOPEE</h3>
                    <div class="footer__download">
                        <a href="https://shopee.vn/web" class="footer__download-qr-link">
                            <img src="./assets/img/qrft.png" alt="Download QR" class="footer__download-qr">
                        </a>
                        <div class="footer__download-apps">
                            <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                <img src="./assets/img/asft.png" alt="Appstore" class="footer__download-apps-img">
                            </a>
                            <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                <img src="./assets/img/ggpft.png" alt="Googleplay" class="footer__download-apps-img">
                            </a>
                            <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                <img src="./assets/img/apft.png" alt="Appgallery" class="footer__download-apps-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid wide">
            <div class="footer-mid">
                <p class="footer-mid-copyright">© 2025 Shopee. Tất cả các quyền được bảo lưu.</p>
                <ul class="country-list">
                    <div class="country-heading">Quốc gia & Khu vực:</div>
                    <li class="country-item">
                        <a href="https://shopee.sg/" class="country-item__link">Singapore</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.co.id/" class="country-item__link">Indonesia</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.co.th/" class="country-item__link">Thái Lan</a>
                    </li>
                    <li class="country-item">
                        <a href="http://shopee.com.my/" class="country-item__link">Malaysia</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.vn/" class="country-item__link">Việt Nam</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.ph/" class="country-item__link">Philippines</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.com.br/" class="country-item__link">Brazil</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.com.mx/" class="country-item__link">México</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.com.co/" class="country-item__link">Colombia</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.cl/" class="country-item__link">Chile</a>
                    </li>
                    <li class="country-item">
                        <a href="https://shopee.tw/" class="country-item__link">Đài Loan</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="grid wide">
                <ul class="security-list">
                    <li class="security-item">
                        <a href="" class="security-item__link">Chính sách bảo mật</a>
                    </li>
                    <li class="security-item">
                        <a href="" class="security-item__link">Quy chế hoạt động</a>
                    </li>
                    <li class="security-item">
                        <a href="" class="security-item__link">Chính sách vận chuyển</a>
                    </li>
                    <li class="security-item">
                        <a href="" class="security-item__link">Chính Sách Trả Hàng Và Hoàn Tiền</a>
                    </li>
                </ul>

                <div class="certification-list">
                    <a href="http://online.gov.vn/Home/WebDetails/18367" class="certification-link">
                        <img src="./assets/img/dadangky-Bo-Cong-Thuong.png" alt="" class="certification-link-img">
                    </a>
                    <a href="http://online.gov.vn/Home/AppDetails/29" class="certification-link">
                        <img src="./assets/img/logo-da-thong-bao-bo-cong-thuong.webp" alt=""
                            class="certification-link-img">
                    </a>
                    <a href="https://help.shopee.vn/portal/4" class="certification-link">
                        <img src="./assets/img/bct-hanggia.png" alt="" class="certification-link-img">
                    </a>
                </div>

                <h4 class="company-name">Công ty TNHH Shopee</h4>

                <div class="location">
                    <div class="company-address">Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu
                        Giai,
                        Phường Ngọc Khánh, Quận Ba Đình, Thành phố Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 -
                        Email:
                        cskh@hotro.shopee.vn</div>
                    <div class="company-address">Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Bùi Anh Tuấn</div>
                    <div class="company-address">Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà
                        Nội
                        cấp
                        lần
                        đầu ngày 10/02/2015</div>
                    <div class="company-address">© 2015 - Bản quyền thuộc về Công ty TNHH Shopee</div>
                </div>
            </div>
        </div>

    </footer>
    </div>


</body>

</html>
<script src="./assets/js/main.js"></script>