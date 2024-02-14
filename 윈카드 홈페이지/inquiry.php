<?php
include_once 'include/public_include.php';
include_once 'include/front_include.php';
include_once 'include/head.php';
include_once 'include/header.php';
?>
<link rel="stylesheet" href="./css/page.css?<?= filemtime('./css/page.css') ?>">
<script>
</script>
<main class="inquiry">
    <div class="mainCenter">

        <div class="content">

            <div class="include_box partnerBox">
                <div class="line partner">
                    <ul>
                        <li class="shinhan">
                            <div class="img_box">
                                <img src="./img/shinhan_logo2.png" alt="">
                            </div>
                        </li>
                        <li class="hana">
                            <div class="img_box">
                                <img src="./img/hana_logo2.png" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="include_box FAQ incBoxStyle2">
                <div class="line mainTitle">
                    <p>FAQ</p>
                </div>
                <div class="box list">
                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>윈카드는 신용카드 인가요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                윈카드는 충전식 체크카드 입니다.<br>
                                회원에게 수당을 카드로 충전하고 현금처럼 사용하실 수 있습니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>기업이 윈카드 가맹점에 등록 하려면 별도의 시스템을 구축해야 하나요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                그렇지 않습니다.<br>
                                윈카드 시스템에 기업의 정보와 충전 비율 등을 등록하면 대규모 시스템 구축없이 가맹점 등록이 가능하며 윈카드 시스템을 이용할 수 있습니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>회원에게 카드 충전은 어떻게 하나요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                윈카드 어드민을 통해 보유한 예치금 내에서 개별 카드에 충전할 금액을 입력하면 충전비율에 맞게 카드 잔고와 포인트로 분리되어 충전을 요청 합니다.<br>
                                본사의 승인 절차를 통해 충전 됩니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>윈카드에 예치금은 어떻게 충전 하나요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                원카드 가맹점 관리자 화면 왼쪽 하단에 표기 되어 있는 계좌로 예치금을 입금 합니다.<br>
                                입금 시 반듯이 보내는 사람 혹은 입금자명에 해당 가맹점의 코드를 입력 합니다.<br>
                                예치금은 설정한 카드예치금과 포인트 예치금으로 자동 분배되어 충전 됩니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>윈카드 앱 로그인에 사용된 비밀번호는 카드비밀 번호 인가요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                원카드 앱 로그인에만 사용되는 비밀번호이며 실물카드의 비밀 번호는 아닙니다.<br>
                                실물카드의 비밀번호는 설정 할 수 없습니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>윈카드는 인터넷 쇼핑이 가능한가요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                윈카드는 오프라인에서만 사용이 가능 합니다.<br>
                                추후 사용가능한 온라인 공간을 제공할 예정입니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>

                    <div class="line left flex">
                        <div class="img_box">
                            <img src="./img/icon_questioner.png" alt="">
                        </div>
                        <div class="text_box">
                            <p>윈카드 충전 시간이 있나요?</p>
                        </div>
                    </div>
                    <div class="line right flex">
                        <div class="text_box">
                            <p>
                                충전 요청은 24시간 이며 실 충전은 평일(월~금) 09:00, 11:30, 14:30, 17:00 시작됩니다.<br>
                                추후 실시간 충전 시스템을 준비중 입니다.
                            </p>
                        </div>
                        <div class="img_box">
                            <img src="./img/icon_answerer.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="include_box EMAIL incBoxStyle1">
                <div class="line mainTitle">
                    <p>윈카드 상담</p>
                </div>
                <div class="line mailImg">
                    <div class="img_box">
                        <a href="mailto:jh@wincard.kr">
                            <img src="./img/icon_email.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="line">
                    <a href="mailto:jh@wincard.kr">
                        <p>도입 이메일 문의</p>
                        <p>jh@wincard.kr</p>
                    </a>
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
    headerHighlight($("header .h_util a"), "inquiry");
</script>

<style>
</style>