<?php 
    include_once 'include/public_include.php';
    include_once 'include/front_include.php';
    include_once 'include/head.php';
    include_once 'include/header.php';
?>
<link rel="stylesheet" href="./css/page.css?<?=filemtime('./css/page.css')?>">
<script>
</script>
<main class="index"> 
    <div class="mainCenter">
        
        <div class="content">

            <div class="include_box partnerBox">
                <div class="line partner">
                    <ul>
                        <li class="shinhan">
                            <div class="img_box">
                                <img src="./img/shinhan_logo1.png" alt="">
                            </div>
                        </li>
                        <li class="hana">
                            <div class="img_box">
                                <img src="./img/hana_logo1.png" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="include_box contentBox">
                <div class="line topText">
                    <p>회원에게 수당을 카드로 지급!</p>
                </div>
                <div class="line logoLine">
                    <div class="img_box">
                        <img src="./img/win_logoBig1.png" alt="">
                    </div>
                </div>
                <div class="line cardPic">
                    <ul style="justify-content: center;">
                        <!-- <li>
                            <img src="./img/card_shinhan.png" alt="">
                        </li> -->
                        <li>
                            <img src="./img/card_hana.png" alt="">
                        </li>
                    </ul>
                </div>
                <div class="line menu">
                    <ul>
                        <li>
                            <a href="./whatIs.php">
                                <div class="img_box">
                                    <img src="./img/menu_list1.png" alt="">
                                </div>
                                <div class="text_box">
                                    <p>
                                        윈카드 란
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="./userManual.php">
                                <div class="img_box">
                                    <img src="./img/menu_list2.png" alt="">
                                </div>
                                <div class="text_box">
                                    <p>
                                        사용메뉴얼
                                    </p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="./inquiry.php">
                                <div class="img_box">
                                    <img src="./img/menu_list3.png" alt="">
                                </div>
                                <div class="text_box">
                                    <p>
                                        윈카드 문의
                                    </p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

    </div>
</main>

<?php
    include_once 'include/popupPackage.php';
    include_once 'include/footer.php';
    include_once 'include/foot.php';
?>

<script>

</script>

<style>
</style>