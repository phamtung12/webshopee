<?php
require_once('../db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "<script>alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.');window.location.href = document.referrer;</script>";
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id']; // Cột đúng là user_id
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: ../admin");
            } elseif ($user['role'] == 'seller') {
                header("Location: ../public/seller.php");
            } elseif ($user['role'] == 'customer') {
                // Truy vấn để lấy customer_id từ bảng customers
                $user_id = $user['user_id'];
                $customer_query = "SELECT customer_id FROM customers WHERE customer_id = $user_id";
                $cus_result = mysqli_query($conn, $customer_query);

                if ($cus = mysqli_fetch_assoc($cus_result)) {
                    $_SESSION['customer_id'] = $cus['customer_id'];
                    header("Location: ../public/user.php"); // Điều hướng đến trang khách
                    exit;
                } else {
                    echo "<script>alert('Không tìm thấy thông tin khách hàng.');window.location.href = document.referrer;</script>";
                    exit;
                }
            }
        } else {
            echo "<script>alert('Sai mật khẩu.');window.location.href = document.referrer;</script>";
            exit;
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại.');window.location.href = document.referrer;</script>";
        exit;
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Shopee</title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="navbar">
                    <div class="home-box">
                        <a href="/" class="shopee-home">
                            <svg viewBox="0 0 192 65" height="39px" width="190px">
                                <g fill-rule="evenodd">
                                    <path fill="#ee4d2d"
                                        d="M35.6717403 44.953764c-.3333497 2.7510509-2.0003116 4.9543414-4.5823845 6.0575984-1.4379707.6145919-3.36871.9463856-4.896954.8421628-2.3840266-.0911143-4.6237865-.6708937-6.6883352-1.7307424-.7375522-.3788551-1.8370513-1.1352759-2.6813095-1.8437757-.213839-.1790053-.239235-.2937577-.0977428-.4944671.0764015-.1151823.2172535-.3229831.5286218-.7791994.45158-.6616533.5079208-.7446018.5587128-.8221779.14448-.2217688.3792333-.2411091.6107855-.0588804.0243289.0189105.0243289.0189105.0426824.0333083.0379873.0294402.0379873.0294402.1276204.0990653.0907002.0706996.14448.1123887.166248.1287205 2.2265285 1.7438508 4.8196989 2.7495466 7.4376251 2.8501162 3.6423042-.0496401 6.2615109-1.6873341 6.7308041-4.2020035.5160305-2.7675977-1.6565047-5.1582742-5.9070334-6.4908212-1.329344-.4166762-4.6895175-1.7616869-5.3090528-2.1250697-2.9094471-1.7071043-4.2697358-3.9430584-4.0763845-6.7048539.296216-3.8283059 3.8501677-6.6835796 8.340785-6.702705 2.0082079-.004083 4.0121475.4132378 5.937338 1.2244562.6816382.2873109 1.8987274.9496089 2.3189359 1.2633517.2420093.1777159.2898136.384872.1510957.60836-.0774686.12958-.2055158.3350171-.4754821.7632974l-.0029878.0047276c-.3553311.5640922-.3664286.5817134-.447952.7136572-.140852.2144625-.3064598.2344475-.5604202.0732783-2.0600669-1.3839063-4.3437898-2.0801572-6.8554368-2.130442-3.126914.061889-5.4706057 1.9228561-5.6246892 4.4579402-.0409751 2.2896772 1.676352 3.9613243 5.3858811 5.2358503 7.529819 2.4196871 10.4113092 5.25648 9.869029 9.7292478M26.3725216 5.42669372c4.9022893 0 8.8982174 4.65220288 9.0851664 10.47578358H17.2875686c.186949-5.8235807 4.1828771-10.47578358 9.084953-10.47578358m25.370857 11.57065968c0-.6047069-.4870064-1.0948761-1.0875481-1.0948761h-11.77736c-.28896-7.68927544-5.7774923-13.82058185-12.5059489-13.82058185-6.7282432 0-12.2167755 6.13130641-12.5057355 13.82058185l-11.79421958.0002149c-.59136492.0107446-1.06748731.4968309-1.06748731 1.0946612 0 .0285807.00106706.0569465.00320118.0848825H.99995732l1.6812605 37.0613963c.00021341.1031483.00405483.2071562.01173767.3118087.00170729.0236381.003628.0470614.00554871.0704847l.00362801.0782207.00405483.004083c.25545428 2.5789222 2.12707837 4.6560709 4.67201764 4.7519129l.00576212.0055872h37.4122078c.0177132.0002149.0354264.0004298.0531396.0004298.0177132 0 .0354264-.0002149.0531396-.0004298h.0796027l.0017073-.0015043c2.589329-.0706995 4.6867431-2.1768587 4.9082648-4.787585l.0012805-.0012893.0017073-.0350275c.0021341-.0275062.0040548-.0547975.0057621-.0823037.0040548-.065757.0068292-.1312992.0078963-.1964115l1.8344904-37.207738h-.0012805c.001067-.0186956.0014939-.0376062.0014939-.0565167M176.465457 41.1518926c.720839-2.3512494 2.900423-3.9186779 5.443734-3.9186779 2.427686 0 4.739107 1.6486899 5.537598 3.9141989l.054826.1556978h-11.082664l.046506-.1512188zm13.50267 3.4063683c.014933.0006399.014933.0006399.036906.0008531.021973-.0002132.021973-.0002132.044372-.0008531.53055-.0243144.950595-.4766911.950595-1.0271786 0-.0266606-.000853-.0496953-.00256-.0865936.000427-.0068251.000427-.020262.000427-.0635588 0-5.1926268-4.070748-9.4007319-9.09145-9.4007319-5.020488 0-9.091235 4.2081051-9.091235 9.4007319 0 .3871116.022399.7731567.067838 1.1568557l.00256.0204753.01408.1013102c.250022 1.8683731 1.047233 3.5831812 2.306302 4.9708108-.00064-.0006399.00064.0006399.007253.0078915 1.396026 1.536289 3.291455 2.5833031 5.393601 2.9748936l.02752.0053321v-.0027727l.13653.0228215c.070186.0119439.144211.0236746.243409.039031 2.766879.332724 5.221231-.0661182 7.299484-1.1127057.511777-.2578611.971928-.5423827 1.37064-.8429007.128211-.0968312.243622-.1904632.34346-.2781231.051412-.0452164.092372-.083181.114131-.1051493.468898-.4830897.498124-.6543572.215249-1.0954297-.31146-.4956734-.586228-.9179769-.821744-1.2675504-.082345-.1224254-.154023-.2267215-.214396-.3133151-.033279-.0475624-.033279-.0475624-.054399-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.00256-.0038391c-.256208-.3188605-.431565-.3480805-.715933-.0970445-.030292.0268739-.131624.1051493-.14997.1245582-1.999321 1.775381-4.729508 2.3465571-7.455854 1.7760208-.507724-.1362888-.982595-.3094759-1.419919-.5184948-1.708127-.8565509-2.918343-2.3826022-3.267563-4.1490253l-.02752-.1394881h13.754612zM154.831964 41.1518926c.720831-2.3512494 2.900389-3.9186779 5.44367-3.9186779 2.427657 0 4.739052 1.6486899 5.537747 3.9141989l.054612.1556978h-11.082534l.046505-.1512188zm13.502512 3.4063683c.015146.0006399.015146.0006399.037118.0008531.02176-.0002132.02176-.0002132.044159-.0008531.530543-.0243144.950584-.4766911.950584-1.0271786 0-.0266606-.000854-.0496953-.00256-.0865936.000426-.0068251.000426-.020262.000426-.0635588 0-5.1926268-4.070699-9.4007319-9.091342-9.4007319-5.020217 0-9.091343 4.2081051-9.091343 9.4007319 0 .3871116.022826.7731567.068051 1.1568557l.00256.0204753.01408.1013102c.250019 1.8683731 1.04722 3.5831812 2.306274 4.9708108-.00064-.0006399.00064.0006399.007254.0078915 1.396009 1.536289 3.291417 2.5833031 5.393538 2.9748936l.027519.0053321v-.0027727l.136529.0228215c.070184.0119439.144209.0236746.243619.039031 2.766847.332724 5.22117-.0661182 7.299185-1.1127057.511771-.2578611.971917-.5423827 1.370624-.8429007.128209-.0968312.243619-.1904632.343456-.2781231.051412-.0452164.09237-.083181.11413-.1051493.468892-.4830897.498118-.6543572.215246-1.0954297-.311457-.4956734-.586221-.9179769-.821734-1.2675504-.082344-.1224254-.154022-.2267215-.21418-.3133151-.033492-.0475624-.033492-.0475624-.054612-.0776356-.008319-.0117306-.008319-.0117306-.013866-.0191956l-.002346-.0038391c-.256419-.3188605-.431774-.3480805-.716138-.0970445-.030292.0268739-.131623.1051493-.149969.1245582-1.999084 1.775381-4.729452 2.3465571-7.455767 1.7760208-.507717-.1362888-.982582-.3094759-1.419902-.5184948-1.708107-.8565509-2.918095-2.3826022-3.267311-4.1490253l-.027733-.1394881h13.754451zM138.32144123 49.7357905c-3.38129629 0-6.14681004-2.6808521-6.23169343-6.04042014v-.31621743c.08401943-3.35418649 2.85039714-6.03546919 6.23169343-6.03546919 3.44242097 0 6.23320537 2.7740599 6.23320537 6.1960534 0 3.42199346-2.7907844 6.19605336-6.23320537 6.19605336m.00172791-15.67913203c-2.21776751 0-4.33682838.7553485-6.03989586 2.140764l-.19352548.1573553V34.6208558c0-.4623792-.0993546-.56419733-.56740117-.56419733h-2.17651376c-.47409424 0-.56761716.09428403-.56761716.56419733v27.6400724c0 .4539841.10583425.5641973.56761716.5641973h2.17651376c.46351081 0 .56740117-.1078454.56740117-.5641973V50.734168l.19352548.1573553c1.70328347 1.3856307 3.82234434 2.1409792 6.03989586 2.1409792 5.27140956 0 9.54473746-4.2479474 9.54473746-9.48802964 0-5.239867-4.2733279-9.48781439-9.54473746-9.48781439M115.907646 49.5240292c-3.449458 0-6.245805-2.7496948-6.245805-6.1425854 0-3.3928907 2.79656-6.1427988 6.245805-6.1427988 3.448821 0 6.24538 2.7499081 6.24538 6.1427988 0 3.3926772-2.796346 6.1425854-6.24538 6.1425854m.001914-15.5438312c-5.28187 0-9.563025 4.2112903-9.563025 9.4059406 0 5.1944369 4.281155 9.4059406 9.563025 9.4059406 5.281657 0 9.562387-4.2115037 9.562387-9.4059406 0-5.1946503-4.280517-9.4059406-9.562387-9.4059406M94.5919049 34.1890939c-1.9281307 0-3.7938902.6198995-5.3417715 1.7656047l-.188189.1393105V23.2574169c0-.4254677-.1395825-.5643476-.5649971-.5643476h-2.2782698c-.4600414 0-.5652122.1100273-.5652122.5643476v29.2834155c0 .443339.1135587.5647782.5652122.5647782h2.2782698c.4226187 0 .5649971-.1457701.5649971-.5647782v-9.5648406c.023658-3.011002 2.4931278-5.4412923 5.5299605-5.4412923 3.0445753 0 5.516841 2.4421328 5.5297454 5.4630394v9.5430935c0 .4844647.0806524.5645628.5652122.5645628h2.2726775c.481764 0 .565212-.0824666.565212-.5645628v-9.5710848c-.018066-4.8280677-4.0440197-8.7806537-8.9328471-8.7806537M62.8459442 47.7938061l-.0053397.0081519c-.3248668.4921188-.4609221.6991347-.5369593.8179812-.2560916.3812097-.224267.551113.1668119.8816949.91266.7358184 2.0858968 1.508535 2.8774525 1.8955369 2.2023021 1.076912 4.5810275 1.646045 7.1017886 1.6975309 1.6283921.0821628 3.6734936-.3050536 5.1963734-.9842376 2.7569891-1.2298679 4.5131066-3.6269626 4.8208863-6.5794607.4985136-4.7841067-2.6143125-7.7747902-10.6321784-10.1849709l-.0021359-.0006435c-3.7356476-1.2047686-5.4904836-2.8064071-5.4911243-5.0426086.1099976-2.4715346 2.4015793-4.3179454 5.4932602-4.4331449 2.4904317.0062212 4.6923065.6675996 6.8557356 2.0598624.4562232.2767364.666607.2256796.9733188-.172263.035242-.0587797.1332787-.2012238.543367-.790093l.0012815-.0019308c.3829626-.5500403.5089793-.7336731.5403767-.7879478.258441-.4863266.2214903-.6738208-.244985-1.0046173-.459427-.3290803-1.7535544-1.0024722-2.4936356-1.2978721-2.0583439-.8211991-4.1863175-1.2199998-6.3042524-1.1788111-4.8198184.1046878-8.578747 3.2393171-8.8265087 7.3515337-.1572005 2.9703036 1.350301 5.3588174 4.5000778 7.124567.8829712.4661613 4.1115618 1.6865902 5.6184225 2.1278667 4.2847814 1.2547527 6.5186944 3.5630343 6.0571315 6.2864205-.4192725 2.4743234-3.0117991 4.1199394-6.6498372 4.2325647-2.6382344-.0549182-5.2963324-1.0217793-7.6043603-2.7562084-.0115337-.0083664-.0700567-.0519149-.1779185-.1323615-.1516472-.1130543-.1516472-.1130543-.1742875-.1300017-.4705335-.3247898-.7473431-.2977598-1.0346184.1302162-.0346012.0529875-.3919333.5963776-.5681431.8632459">
                                    </path>
                                </g>
                            </svg>
                        </a>
                        <div class="login-text">Đăng nhập</div>
                    </div>
                    <a href="" class="help-you">Bạn cần giúp đỡ?</a>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="login-box">
                <div class="container-heading">
                    <div class="login-title">
                        <div class="login-title-text">Đăng nhập</div>
                        <div class="login-qr">
                            <div class="login-qr-title">Đăng nhập với mã QR</div>
                            <a class="login-qr-link" href="">
                                <svg width="40" height="40" fill="none">
                                    <g clip-path="url(#clip0)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18 0H0v18h18V0zM3 15V3h12v12H3zM18 22H0v18h18V22zm-3 15H3V25h12v12zM40 0H22v18h18V0zm-3 15H25V3h12v12z"
                                            fill="#EE4D2D"></path>
                                        <path d="M37 37H22.5v3H40V22.5h-3V37z" fill="#EE4D2D"></path>
                                        <path
                                            d="M27.5 32v-8h-3v8h3zM33.5 32v-8h-3v8h3zM6 6h6v6H6zM6 28h6v6H6zM28 6h6v6h-6z"
                                            fill="#EE4D2D"></path>
                                        <path fill="#fff" d="M-4.3 4l44 43.9-22.8 22.7-43.9-44z"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <path fill="#fff" d="M0 0h40v40H0z"></path>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container-body">
                    <form method="POST">
                        <div class="position-input">
                            <div class="tag-input">
                                <input type="text" class="enter-input" placeholder="Tên đăng nhập" required name="username">
                            </div>
                        </div>
                        <div class="position-input">
                            <div class="tag-input">
                                <input id="pass" type="password" class="enter-input" placeholder="Mật khẩu" required name="password">
                                <div class="show-password" onclick="togglePassword()">
                                    <svg id="eye-icon" fill="none" viewBox="0 0 20 10" width="20px" height="16px">
                                        <path stroke="none" fill="#000" fill-opacity=".54"
                                            d="M19.834 1.15a.768.768 0 00-.142-1c-.322-.25-.75-.178-1 .143-.035.036-3.997 4.712-8.709 4.712-4.569 0-8.71-4.712-8.745-4.748a.724.724 0 00-1-.071.724.724 0 00-.07 1c.07.106.927 1.07 2.283 2.141L.631 5.219a.69.69 0 00.036 1c.071.142.25.213.428.213a.705.705 0 00.5-.214l1.963-2.034A13.91 13.91 0 006.806 5.86l-.75 2.535a.714.714 0 00.5.892h.214a.688.688 0 00.679-.535l.75-2.535a9.758 9.758 0 001.784.179c.607 0 1.213-.072 1.785-.179l.75 2.499c.07.321.392.535.677.535.072 0 .143 0 .179-.035a.714.714 0 00.5-.893l-.75-2.498a13.914 13.914 0 003.248-1.678L18.3 6.147a.705.705 0 00.5.214.705.705 0 00.499-.214.723.723 0 00.036-1l-1.82-1.891c1.463-1.071 2.32-2.106 2.32-2.106z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="position-button">
                            <input type="submit" class="button-login" value="Đăng Nhập">
                        </div>
                    </form>
                    <div class="container-help">
                        <a href="" class="help-title">Quên mật khẩu</a>
                        <a href="" class="help-title">Đăng nhập với SMS</a>
                    </div>

                    <div class="login-others">
                        <div class="login-others__separator"></div>
                        <span class="login-others__text">hoặc</span>
                        <div class="login-others__separator"></div>
                    </div>

                    <div class="position-loginothers-btn">
                        <a href="" class="loginothers-btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 256 256">
                                <path fill="#1877F2"
                                    d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.307 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.347-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.958 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                                <path fill="#FFF"
                                    d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165h29.825" />
                            </svg>
                            <div class="loginothers-btn-text">Facebook</div>
                        </a>
                        <a href="" class="loginothers-btn-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 128 128">
                                <path fill="#fff"
                                    d="M44.59 4.21a63.28 63.28 0 0 0 4.33 120.9a67.6 67.6 0 0 0 32.36.35a57.13 57.13 0 0 0 25.9-13.46a57.44 57.44 0 0 0 16-26.26a74.33 74.33 0 0 0 1.61-33.58H65.27v24.69h34.47a29.72 29.72 0 0 1-12.66 19.52a36.16 36.16 0 0 1-13.93 5.5a41.29 41.29 0 0 1-15.1 0A37.16 37.16 0 0 1 44 95.74a39.3 39.3 0 0 1-14.5-19.42a38.31 38.31 0 0 1 0-24.63a39.25 39.25 0 0 1 9.18-14.91A37.17 37.17 0 0 1 76.13 27a34.28 34.28 0 0 1 13.64 8q5.83-5.8 11.64-11.63c2-2.09 4.18-4.08 6.15-6.22A61.22 61.22 0 0 0 87.2 4.59a64 64 0 0 0-42.61-.38z" />
                                <path fill="#e33629"
                                    d="M44.59 4.21a64 64 0 0 1 42.61.37a61.22 61.22 0 0 1 20.35 12.62c-2 2.14-4.11 4.14-6.15 6.22Q95.58 29.23 89.77 35a34.28 34.28 0 0 0-13.64-8a37.17 37.17 0 0 0-37.46 9.74a39.25 39.25 0 0 0-9.18 14.91L8.76 35.6A63.53 63.53 0 0 1 44.59 4.21z" />
                                <path fill="#f8bd00"
                                    d="M3.26 51.5a62.93 62.93 0 0 1 5.5-15.9l20.73 16.09a38.31 38.31 0 0 0 0 24.63q-10.36 8-20.73 16.08a63.33 63.33 0 0 1-5.5-40.9z" />
                                <path fill="#587dbd"
                                    d="M65.27 52.15h59.52a74.33 74.33 0 0 1-1.61 33.58a57.44 57.44 0 0 1-16 26.26c-6.69-5.22-13.41-10.4-20.1-15.62a29.72 29.72 0 0 0 12.66-19.54H65.27c-.01-8.22 0-16.45 0-24.68z" />
                                <path fill="#319f43"
                                    d="M8.75 92.4q10.37-8 20.73-16.08A39.3 39.3 0 0 0 44 95.74a37.16 37.16 0 0 0 14.08 6.08a41.29 41.29 0 0 0 15.1 0a36.16 36.16 0 0 0 13.93-5.5c6.69 5.22 13.41 10.4 20.1 15.62a57.13 57.13 0 0 1-25.9 13.47a67.6 67.6 0 0 1-32.36-.35a63 63 0 0 1-23-11.59A63.73 63.73 0 0 1 8.75 92.4z" />
                            </svg>
                            <div class="loginothers-btn-text">Google</div>
                        </a>
                    </div>
                </div>

                <div class="container-botom">
                    <div class="container-botom-title">Bạn mới biết đến Shopee? </div>
                    <a href="" class="container-botom-link">Đăng ký</a>
                </div>
            </div>

        </div>
        <footer class="footer">
            <div class="grid">
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
                                <img src="../assets/img/visa.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/round.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/jcb.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/americae.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/cod.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/tragop.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/spay.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/slater.png" alt="" class="pay-item-img">
                            </li>
                        </ul>
                        <h3 class="footer__heading">ĐƠN VỊ VẬN CHUYỂN</h3>
                        <ul class="pay-list">
                            <li class="pay-item">
                                <img src="../assets/img/spx.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/ghn.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/viettel.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/vietpost.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/jt.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/grab.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/ninjavan.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/be.png" alt="" class="pay-item-img">
                            </li>
                            <li class="pay-item">
                                <img src="../assets/img/aha.png" alt="" class="pay-item-img">
                            </li>
                        </ul>
                    </div>
                    <div class="grid_col-2-4">
                        <h3 class="footer__heading">THEO DÕI SHOPEE</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <img src="../assets/img/facebook.png" alt="" class="footer-item__link-img">
                                    Facebook
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <img src="../assets/img/instargram.png" alt="" class="footer-item__link-img">
                                    Instagram
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <img src="../assets/img/linkIn.png" alt="" class="footer-item__link-img">
                                    LinkedIn
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid_col-2-4">
                        <h3 class="footer__heading">TẢI ỨNG DỤNG SHOPEE</h3>
                        <div class="footer__download">
                            <a href="https://shopee.vn/web" class="footer__download-qr-link">
                                <img src="../assets/img/qrft.png" alt="Download QR" class="footer__download-qr">
                            </a>
                            <div class="footer__download-apps">
                                <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                    <img src="../assets/img/asft.png" alt="Appstore" class="footer__download-apps-img">
                                </a>
                                <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                    <img src="../assets/img/ggpft.png" alt="Googleplay"
                                        class="footer__download-apps-img">
                                </a>
                                <a href="https://shopee.vn/web" class="footer__download-apps-link">
                                    <img src="../assets/img/apft.png" alt="Appgallery" class="footer__download-apps-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid">
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
                <div class="grid">
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
                            <img src="../assets/img/dadangky-Bo-Cong-Thuong.png" alt="" class="certification-link-img">
                        </a>
                        <a href="http://online.gov.vn/Home/AppDetails/29" class="certification-link">
                            <img src="../assets/img/logo-da-thong-bao-bo-cong-thuong.webp" alt=""
                                class="certification-link-img">
                        </a>
                        <a href="https://help.shopee.vn/portal/4" class="certification-link">
                            <img src="../assets/img/bct-hanggia.png" alt="" class="certification-link-img">
                        </a>
                    </div>

                    <h4 class="company-name">Công ty TNHH Shopee</h4>

                    <div class="location">
                        <div class="company-address">Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai,
                            Phường Ngọc Khánh, Quận Ba Đình, Thành phố Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 -
                            Email:
                            cskh@hotro.shopee.vn</div>
                        <div class="company-address">Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Bùi Anh Tuấn</div>
                        <div class="company-address">Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch & Đầu tư TP Hà Nội
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
<script src="../assets/js/login.js"></script>