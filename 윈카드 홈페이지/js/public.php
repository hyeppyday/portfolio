

<script>

    //?
    // !페이지 너비
    // setInterval(() => {
    //     console.log($(window).innerWidth());
    // }, 4000);

    // !페이지로드 로딩
    function WaitLoad(){
        window.onload = function(){ 
            $('#PageLoading').css('display','none') //로딩 객체 제거 
        }
    };
    WaitLoad();

	// !페이지 스크롤락
	function LockingScroll(){
		$('body').css('overflow', 'hidden');
	};

	// !페이지 스크롤언락
	function UnlockingScroll(){
		$('body').css('overflow', 'auto');
	};	

    // !숨김인풋 리드온리
    function InsteadInput(){
        $("input.insteadInput").attr("readonly", "true");
    }
    InsteadInput();

    // !정규식
    var expId       = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/;
    var expPw       = /^.{4,}$/;
    var expEamil    = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/;
    var expPhone    = /^[0-9]{2,3}[0-9]{3,4}[0-9]{4}/; //전화번호 유효성(자리수만체크(-미포함))

    // !기초함수
	// 콤마찍기
	function comma(str) {
		str = String(str);
		return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	}
	
	// 콤마제거 (숫자만남기기)
	function uncomma(str) {
		str = String(str);
		return str.replace(/[^\d]+/g, '');
	}

    // 전화번호 입력 
	function InputPhoneNum(target){
		target.val(target.val().replace(/[^0-9]/g, "")); //숫자만입력
		target.val(target.val().replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,"$1-$2-$3")); //전화번호 폼으로 변경
	};
    // 전화번호 폼 1. html
	function form_ph_type1(target){
		// target.text(target.text().replace(/[^0-9]/g, "")); //숫자만입력
		target.text(target.text().replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,"$1-$2-$3")); //전화번호 폼으로 변경
        return target;
	};
    // 전화번호 폼 2. 문자형변수
	function form_ph_type2(target){
		target      = target.replace(/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,"$1-$2-$3"); //전화번호 폼으로 변경
        return target;
	};
            
    // 인풋숫자만
    function onlyNumInput(target){
        target.on("change keydown keyup blur", function(){
            $(this).val($(this).val().replace(/[^0-9]/g, "")); // 숫자만입력
        })
    };

    //back쿼리주석구 막기
    function RejectInput(){
        $("input:not([type='file'])").on("change keydown keyup blur", function(){
            $(this).val($(this).val().replace(/\/\/|#|\/\*|\*\/|--|\'|\"|\;/g, ""));
        });
        $("textarea").on("change keydown keyup blur", function(){
            $(this).val($(this).val().replace(/\/\/|#|\/\*|\*\/|--|\'|\"|\;/g, ""));
        });
    };
    RejectInput()

    // 값검증
    function insID(text){
        let result      = !(expId.test(text));
        return result;
    };
    function insPW(text){
        let result      = !(expPw.test(text));
        return result;
    };
    function insEMAIL(text){
        let result      = !(expEamil.test(text));
        return result;
    };
    function insPH(text){
        let result      = !(expPhone.test(text));
        return result;
    };

    // !응용함수
	// 통합 입력값 숫자만 + 백단위콤마 + 왼쪽0막기
	function FormaterNum(target) {
		function InputNumComma(target) {
			var thisVal = target.val();
			thisVal = thisVal.replace(/[^0-9]/g, "");
			thisVal = comma(thisVal);
			target.val(thisVal);
		};
		function comma(str) {
			str = String(str);
			return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
		};
		function replLeftZero(target){
			target.val(target.val().replace(/(^0+)/, ""))
		};
		target.on("change keydown keyup blur", ()=>{
			InputNumComma(target);
			replLeftZero(target);
		});
	};

	// 통합 입력값 숫자만 + 백단위콤마 + 왼쪽0막기 + 기본값 0 + 값없으면 0
	function FormaterNum_B(target) {
        target.val(0);
		function InputNumComma(target) {
			var thisVal = target.val();
			thisVal = thisVal.replace(/[^0-9]/g, "");
			thisVal = comma(thisVal);
			target.val(thisVal);
		};
		function comma(str) {
			str = String(str);
			return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
		};
		function replLeftZero(target){
			target.val(target.val().replace(/(^0+)/, ""));
            if(target.val() == ""){target.val(0)}
		};
		target.on("change keydown keyup blur", ()=>{
			InputNumComma(target);
            replLeftZero(target);
		});
	};

    // plus/minus input control 숫자입력하는 인풋박스 컨트롤(더하기 빼기 버튼있는)
    // PMC($("dumy"), $("dumy"), I_pointAmt, 0, 100000); <- 이렇게 버튼으로 없는 값을 넣으면 단독 인풋만 컨트롤가능
    // PMC($("dumy"), $("dumy"), I_pointAmt, 0, 100000, 120000); <- 멀티 맥스
    function PMC(param_plus, param_minus, param_I_target, param_min, param_max, param_max2){
        let E_plus                  = param_plus;
        let E_minus                 = param_minus;
        let I_target                = param_I_target;
        let count                   = parseInt(uncomma(I_target.val()));
        let min                     = param_min;
        let max                     = param_max;
        let max2                    = param_max2;

        FormaterNum(I_target);

        E_plus.on("click", function(){
            PM("plus");
        });
        E_minus.on("click", function(){
            PM("minus");
        });

        // 
        function PM(param_func){
            count                   = parseInt(uncomma(I_target.val()));
            let func                = param_func;
            if(func == "minus"){
                count--;
                if(count <= 0){count = min;};
            } else if(func == "plus"){
                count++;
                if(count >= max){count = max;};
                if(count >= max2){count = max2;};
            }
            I_target.val(count);
            I_target.change();
        };

        // 통합 입력값 숫자만 + 백단위콤마 + 왼쪽0막기
        function FormaterNum(target) {
            target.on("change keydown keyup blur", ()=>{
                InputNumComma(target);
                replLeftZero(target);
                if(uncomma(target.val())<= 0){target.val(comma(min));};
                if(uncomma(target.val())>= max){target.val(comma(max));};
                if(uncomma(target.val())>= max2){target.val(comma(max2));};
            });
        };
        function InputNumComma(target) {
            var thisVal = target.val();
            thisVal = thisVal.replace(/[^0-9]/g, "");
            thisVal = comma(thisVal);
            target.val(thisVal);
        };
        function comma(str) {
            str = String(str);
            return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
        };
        function uncomma(str) {
            str = String(str);
            return str.replace(/[^\d]+/g, '');
        }
        function replLeftZero(target){
            target.val(target.val().replace(/(^0+)/, ""))
        };
    };

    // 체크박스 공용(개선 22.08.05)
    function CheckAll(all, list){ //CheckAll('#chkAll', '.chkList');  .chkList는 #allChk를 제외한 체크박스의 클래스        
        $(all).on("change", function (){ //전체 변경 시 리스트 전부 동일상태화
            for(let i=0; i<list.length; i++){
                $(list).eq(i).prop("checked", $(this).is(":checked"));
            };
        });
        $(list).on("change", function(){ //이외 변경 시 
            var listChk = 0;
            for(let i=0; i<list.length; i++){
                if($(list).eq(i).is(":checked")){ //체크 된 수량이
                    listChk++;
                };
                if($(list).length == listChk){ //이외 수량과 같다면
                    $(all).prop("checked", true); //전체는 체크
                } else { //이외 수량과 다르다면
                    $(all).prop("checked", false); //전체는 해제
                };
            };
        });
    };

    // !기능함수
    // 엔터제한   엘리먼트에 onkeypress="enterFalse();"
    function enterFalse(){
        if(event.keyCode==13){
            event.returnValue = false;
        }
    };
    // textarea높이값 자동조정하기  autosizeTextarea(타겟엘리먼트)
    // 입력이아닌 보여지기위한 textarea일경우 autosizeTextarea(타겟엘리먼트, 높이값 최소2)
    // 보여지기 위함일 시 keydown event한번 걸어주기 예) $("textarea").keydown();
    function autosizeTextarea(targetWrap, cusHeight){
        let _page               = targetWrap;
        let EL_textarea         = _page.find("textarea");
        EL_textarea.on(' keyup', function () {
            // console.log("keydown!");
            $(this).height(1).height( $(this).prop('scrollHeight')+22 );
            // console.log(cusHeight);
            if(cusHeight != undefined){
                $(this).height(1).height( $(this).prop('scrollHeight')+cusHeight );
            };	
        });
    };
    
    // target의 data-path에 따라 target에 background-image 넣어주는 함수
    function inputImgFromPath(page, target){
        let _page               = $("main."+page+"");
        let E_imgBox            = _page.find(""+target+"");
        let count               = 0;

        $.each(E_imgBox, function (idx, vlu) {
            // console.log($(vlu)); 
            if($(vlu).hasClass("already")){
                return true;
            }
            let path = $(vlu).attr("data-path");
            $(vlu).css({
                'background-image':'url("'+path+'")'
            });
            $(vlu).addClass("already");
            count++;
        });
        // console.log("pathImgCount : "+count);
    };

    // 월, 일 0 떼기 예) '02' -> '2'
    function outDateZero(target){
        let result        = target;
        if(target.substr("0", "1")==0){
            result = target.substr("1", "1");
        }
        return result;
    };

    // 날짜 자르기
    function substrDate(param_data){
        let data    = param_data;
        let result  = {};

        result.y      = data.substr(0, 4);
        result.m      = data.substr(4, 2);
        result.d      = data.substr(6, 2);

        return result;
    };
    // console.log(substrDate("11112233").y);

    // !제작함수
	// 라디오태그 선택기 
	// ex)$("input[name=tagName]").radioSelect('N'); -> value값이 'N'인것 선택.
	$.fn.radioSelect = function(val) {
		this.each(function() {
			var $this = $(this);
			if($this.val() == val)
			$this.attr('checked', true);
		});
		return this;
	};

    // 라디오태그 선택값가져오기
    function radioValue(param_name){
        let name        = param_name;
        return $('input[name="'+name+'"]:checked').val()
    };

    // 셀렉트박스 선택옵션가져오기
    function selectedOption(param_el){
        let el        = param_el;
        return el.find("option:selected");
    };

    // 데이터피커 생성포멧 (지갑)
    // <input type="text" name="I_sDate" id="I_sDate" class="I_sDate I_date" readonly>
    // <input type="text" name="I_eDate" id="I_eDate" class="I_eDate I_date" readonly>
    // datePic("#I_sDate1", "#I_eDate1", "s1", "e1");  => 시작엘리먼트, 종료엘리먼트, 시작파라미터이름, 종료파라미터이름
    // 어드민이 더 최신판입니다.
    function datePic(param_sDate, param_eDate, param_sParam, param_eParam){
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            // minDate: '2022-05-30', //오픈일 맞춰서 이전선택불가하게..
            maxDate: 0 //미래선택 막기
        });

        //데이터 가져와서 날짜 초기화
        var urlParams = new URLSearchParams(window.location.href)
        var SdateIs = urlParams.has(param_sParam)
        var EdateIs = urlParams.has(param_eParam)
        if(SdateIs&&EdateIs){
            var Sstr = urlParams.get(param_sParam);
            var Estr = urlParams.get(param_eParam);
        } else{
            var Sstr = "<?= $s_date?>";
            var Estr = "<?= $e_date?>";
        }

        
        if(SdateIs&&EdateIs){
            var Sdate = Sstr.substring(0,4)+", "+Sstr.substring(4,6)+", "+Sstr.substring(6);
            var Edate = Estr.substring(0,4)+", "+Estr.substring(4,6)+", "+Estr.substring(6);
        } else{
            var Sdate = Sstr.substring(0,4)+", "+Sstr.substring(5,7)+", "+Sstr.substring(8);
            var Edate = Estr.substring(0,4)+", "+Estr.substring(5,7)+", "+Estr.substring(8);
        }

        // console.log(Sdate)
        // console.log(Edate)

        Sdate = new Date(Sdate);
        Edate = new Date(Edate);

        $(param_sDate).datepicker().datepicker('setDate', Sdate);
        $(param_eDate).datepicker().datepicker('setDate', Edate);

        $(function() {
            $(param_sDate).datepicker();
            $(param_eDate).datepicker();
        });
    };

    function singleDatePic(param_date, param_resetDate){
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd',
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            // minDate: '2022-05-30', //오픈일 맞춰서 이전선택불가하게..
            maxDate: 0 //미래선택 막기
        });

        var Sstr = param_resetDate;

        var Sdate = Sstr.substring(0,4)+", "+Sstr.substring(4,6)+", "+Sstr.substring(6);

        // console.log(Sstr);
        // console.log(Sdate);

        Sdate = new Date(Sdate);

        $(param_date).datepicker().datepicker('setDate', Sdate);

        $(function() {
            $(param_date).datepicker();
        });

    };

    // 날짜 유효성검사
    function SenseDate(sDate, eDate){
        var sDateLine = uncomma(sDate.val());
        var eDateLine = uncomma(eDate.val());
        var result = true;


        if(sDateLine > eDateLine){
            alert("시작일이 종료일보다 클 수 없습니다.");
            result = false;
        };

        var rangeDate = 1000;
        var t1 = sDate.val().split("-");
        var t2 = eDate.val().split("-");
        var t1date = new Date(t1[0], t1[1], t1[2]);
        var t2date = new Date(t2[0], t2[1], t2[2]);
        var diff = t2date - t1date;
        var currDay = 24 * 60 * 60 * 1000;
        // console.log(" diff : "+diff+"\n t2date : "+t2date+"\n t1date : "+t1date);
        // var TTemp = parseInt(diff/currDay)+1;
        // alert(" diff : "+diff+"\n t2date : "+t2date+"\n t1date : "+t1date+"\n TTemp : "+TTemp);
        if(parseInt(diff/currDay)+1 > rangeDate){
            alert('검색 기간은 ' + rangeDate + '일을 초과할 수 없습니다.');
            result = false;
        }

        // console.log("result : "+result);
        return result;
    }; 

    // 셀렉트박스 연/월/일 표시기 (윤년적용)
    // ex) [HTML]<select class="year"></select> <select class="month"></select> <select class="day"></select> [script]setDateBox();
    function setDateBox() {
        var pr_years = "<?= $_GET["year"]?>"; //year
        var pr_month = "<?= $_GET["month"]?>"; //month
        var pr_day = "<?= $_GET["day"]?>"; //day
        var dt = new Date();
        var year = "";
        var com_year = dt.getFullYear();
        var com_month = dt.getMonth()+1;
        var com_day = dt.getDate();
        var start_year = "1900";
        var leap_year = false;
        if(com_month < 10){
            com_month = "0"+com_month+""
        }
        if(com_day < 10){
            com_day = "0"+com_day+""
        }
        //   console.log("com_year : "+com_year);

        // 미선택필요하면..
        $("select.year").append("<option value='0'>생년</option>");

        // 올해기준으로 2022년까지 뿌림
        for (var y = com_year; y >= start_year; y--) {
            $("select.year").append("<option value='" + y + "'>" + y + "</option>");
        }
        // 윤년체크+월일비활성화
        $("select.year").change(()=>{
            //날짜 기본값선택
            $("select.month").val("0");
            $("select.day").val("0");
            disabled(".day");
            var cho_year = $("select.year option:selected").val();

            if(cho_year%4 == 0){
                if(cho_year%400 !=0 && cho_year%100 == 0){
                    // console.log("평년");
                    leap_year = false;
                } else{
                    // console.log("윤년");
                    leap_year = true;
                }
            } else{
                // console.log("평년");
                leap_year = false;
            }
            abled(".month");
        });

        // 월 뿌려주기(1월부터 12월 고정)
        var month;
        // 미선택필요하면..
        $("select.month").append("<option value='0'>월</option>");
        for (var i = 1; i <= 12; i++) {
            if(i<10){
                var i2 = "0"+i+"";
                $("select.month").append("<option value='" + i2 + "'>" + i + "</option>");
            } else{
                $("select.month").append("<option value='" + i + "'>" + i + "</option>");
            }

        }
        $("select.month").change(()=>{
            var i = $("select.month option:selected").val();
            if(i==1 || i==3 || i==5 || i==7 || i==8 || i==10 || i==12){
                SprayDay(31);
            } else if(i==4 || i==6 || i==9 || i==11) {
                SprayDay(30);
            } else if(i==2) {
                if(leap_year){
                    SprayDay(29);
                } else {
                    SprayDay(28);
                }
            }
            abled(".day");
        });

        // 일 기본값
        $("select.day").append("<option value='0'>일</option>");
        
        function SprayDay(day){
            $("select.day").empty();
            $("select.day").append("<option value='0'>일</option>");
            // 일 뿌려주기
            for (var i = 1; i <= day; i++) {
                if(i<10){
                    var i2 = "0"+i+"";
                    $("select.day").append("<option value='" + i2 + "'>" + i + "</option>");
                } else{
                    $("select.day").append("<option value='" + i + "'>" + i + "</option>");
                }
            }
        };
       
        // 기본선택값넣기(주석시 미선택) ptr_은 파라미터로 값받을 시
        // if(pr_years != ""){
        //     $("select.year").val(pr_years).prop("selected", true);
        // } else{
        //     $("select.year").val(start_year).attr("selected", true);
        // }
        // if(pr_month != ""){
        //     $("select.month").val(pr_month).prop("selected", true);
        // } else{
        //     $("select.month").val(com_month).attr("selected", true);
        // }

        // 비활성화
        function abled(target){
            $("select"+target+"").css({"background-color":"var(--input_background)"}, {"":""});
            $("select"+target+"").attr("disabled", false);
        };
        function disabled(target){
            $("select"+target+"").css({"background-color":"var(--input_background)"}, {"":""});
            $("select"+target+"").val(0).prop("selected", true);
            $("select"+target+"").attr("disabled", true);
        };
        disabled(".month");
        disabled(".day");
    }
    setDateBox();

    // 페이지네이션 (class = "table_body-pagination")
    {
        function renderPagination(tableId, totalCnt, perPage, pageSize, current, changePage) {

            let $pagingHtml = $('#' + tableId).parent(); //append시킬 부모 요소

            if ($($pagingHtml).find('.pagination').length > 0) {
                $('.pagination').remove();
            }
            
            const pageCount = parseInt((totalCnt- 1) / perPage+ 1);// 전체 페이지 수
            const pageBlock = parseInt(pageCount / pageSize);// 생성될 페이지 블록 수

            let pages = [];
            let curBlockNum = parseInt((current- 1) / pageSize);

            if (totalCnt> 0) {
                let start = curBlockNum * pageSize;
                let end = pageCount >= start + pageSize- 1 ? start + pageSize- 1 : pageCount - 1;
                for (let i = start; i <= end; i++) {
                    pages.push(i);
                }
            }

            // if(curPAGE == "card_manage.php"){ //페이지별로 분기할것
            // 	var pr1 = '<?=$pr1?>';
                
            // }

            let html = '<div class="pagination">';
            
            if (current !== 1) {
                console.log(current);
                html += '<a href="#" id="first" class="btn">FIRST</a>';
                html += '<a href="#" id="prev" class="btn">PREV</a>';
            }

            if (pages.length > '0') {
                for (let i = 0; i < pages.length; i++) {
                    html += "<a href='javascript:void(0);' id=" + (pages[i] + 1) + ">" + (pages[i] + 1) + "</a>";
                    // html += "<a href='"+curPAGE+"?page="+(pages[i] + 1) +"' id="+(pages[i] + 1) + ">" + (pages[i] + 1) + "</a>";
                }
            }

            if (pageCount > 1 && current!== pageCount) {
                html += '<a href=# id="next" class="btn">NEXT</a>';
                html += '<a href=# id="last" class="btn">LAST</a>';
            }

            html += '</div>';
            $($pagingHtml).append(html);

            $(".pagination a").css("color", "black");
            $(".pagination a#" + current).css({ "text-decoration": "none", "background-color":"#c3954d", "color":"white" }); 


            $(".pagination a").on("click", function() {

                let $item = $(this);
                let $id = $item.attr("id");
                let selected= $item.text();

                if ($id === "next") selected= Number(current) + 1;
                else if ($id === "prev") selected= Number(current) - 1;
                else if ($id === "last") selected= Number(pageCount);
                else if ($id === "first") selected= 1;
                else selected= Number(selected);

                console.log("동일페이지선택시 이동안함");
                if (selected=== current) return;
                var temp = new URLSearchParams(window.location.search)
                temp.set("page", selected);
        
                window.location.href = window.location.pathname+"?"+temp;
                
                // changePage(selected);
                // renderPagination(tableId, totalCnt, perPage, pageSize, selected, changePage);
            });

            
        }
        
        // (param: append할 tableId, 전체데이터 수, 테이블에 나타낼 데이터 수, 화면에 나타날 페이지 수, 현재 페이지, 페이지바꾸고 호출할 함수)
        var totalCnt = 200; //문자열넣기 금지
        var curPage = 1; //문자열넣기 금지
        var limitCnt = 10;

        //파라미터 값 읽어와서 page있고 값이 1이 아니면 curPage에 대입
        var params = (new URL(document.location)).searchParams;
        if(params.has('page') && parseInt(params.get('page')) != 1){ 
            // console.log(parseInt(params.get('page')));
            curPage = parseInt(params.get('page'));
        };
        <?php if(isset($totalCnt) && isset($limit) && isset($curPage)){?>
            renderPagination("table_body", <?=$totalCnt?>, <?=$limit?>, 10, <?=$curPage?>, changePage);
        <?php }else { ?>
            renderPagination("table_body", totalCnt, limitCnt, 10, curPage, changePage);
        <?php } ?>

        //...table

        // change page => 재호출
        function changePage(item) {
                //curPage는 js 상단에 1로 초기화, 선언 되어 있음
            if (item === curPage) return;
            curPage = item;
            // getFaqList();
            // renderPagination("table_body", totalCnt, 10, 10, curPage, changePage);
        }
    }

    // 문자인증
    var AuthenTextFlag = true;  // 인증문자 중복발급 방지
    var certiFlag = false;  // 문자인증완료 flag
    var certiFinNum = "";   // 문자인증완료된 번호
    var timeOut = $('.timeOut'); //3분시간태그
    var interval = "";//clearInterval 위해 전역변수로 만듬.
    function AuthenText(hp, certiBox, page){
        console.log("page : "+page);
        let crtCase     = "3";
        if(page == "join"){crtCase     = "1";};
        if(page == "login"){crtCase    = "1";};

        if(!AuthenTextFlag){
            _alert1("이미 인증문자가 발송되었습니다.", "block", "확인", "_closeAlert1();");
            return false;
        }
        AuthenTextFlag = false;
        timeOut.show(); //타이머태그 보이기
        CheckTimeOut(certiBox); //3분후에 timeOut_check == false;하는 함수

        console.log(crtCase);
        console.log(hp);
        console.log(page);
        $.ajax({
            type: "post",
            url: "./back/send/certifiNumber.php",
            data: {
                crt_case            : crtCase,

                crt_hp              : hp,
                crt_source          : page,
            },
            success: function(data){
                data = data.trim();
                console.log(data);
                AuthenTextFlag = true;
                if(data == "false"){
                    _alert1("문자전송을 실패하였습니다.", "block", "확인", "_closeAlert1();");
                } else if(data == "true"){
                    certiFlag = false;
                    _alert1("인증문자가 발송되었습니다.", "none", "확인", "_closeAlert1();");
                    certiBox.css("height", "40px");
                    // if($("main").hasClass("wincardTransfer")){certiBox.css("height", "60px");}
                    CheckTimeOut(certiBox);
                } else{
                    _alert1("문자전송을 실패하였습니다.", "block", "확인", "_closeAlert1();");
                }
            },
            error: function(data){
                console.log(data);
                _alert1("문자전송을 실패하였습니다.", "block", "확인", "_closeAlert1();");
            }
        });
    };
    function VerifiCertiNum(hp, certi, page){
        // console.log("hp : "+hp);
        // console.log("certi : "+certi);
        // console.log("page : "+page);
        let crtCase     = "4";
        if(page == "join"){
            crtCase     = "2";
        };
        if(page == "login"){
            crtCase     = "2";
        };

        $.ajax({
            type: "post",
            url: "./back/send/certifiNumber.php",
            data: {
                crt_case        : crtCase,

                crt_hp          : hp,
                crt_source      : page,

                crt_num         : certi,
            },
            success: function(data){
                data = data.trim();
                console.log(data);
                if(data == "false"){
                    _alert1("인증번호가 잘못입력되었습니다.", "block", "확인", "_closeAlert1();");
                } else if(data == "true"){
                    _alert1("인증되었습니다.", "none", "확인", "_closeAlert1();");
                    certiFlag = true;
                    certiFinNum = hp;
                    clearInterval(interval); //타이머 클리어
                    timeOut.hide(); //타이머 숨기기
                    timeOut_check = true; //시간제한 해제
                } else{
                    _alert1("인증을 실패하였습니다.", "block", "확인", "_closeAlert1();");
                }
            },
            error: function(data){
                console.log(data);
                _alert1("인증을 실패하였습니다.", "block", "확인", "_closeAlert1();");
            }
        });

    };
    function CheckTimeOut(certiNum_box) { //시간제한 함수
        timeOut_check = true;
        var timer2 = "03:00";
		clearInterval(interval);

        // var timer2 = "00:10";
        interval = setInterval(() => {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) {
                // alert('타이머끝');
                clearInterval(interval);
                certiNum_box.css({'display':'none'});
                timeOut.hide();
                timeOut_check = false;
            };
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.timeOut').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
        }, 1000);
    };
    // 문자인증 실행함수
    // phCerti(번호입력태그, 전화번호보내기버튼태그, 인증번호입력태그, 인증번호보내기버튼, 인증번호전체감싸는태그); // certiFlag(인증완료 플래그), certiFinNum(인증완료된 전화번호)
    function phCerti(I_ph, I_phBtn, I_phChk, I_phChkBtn, EL_phChk){
        let page                = "noPageInfomation.";
        if($("main")){
            page                    = $("main").attr("class").split(" ");
            page                    = page[0];
            console.log(page);
        }
        
        // 인풋숫자만
        function onlyNumInput(target){
            target.on("change keydown keyup blur", function(){
                $(this).val($(this).val().replace(/[^0-9]/g, "")); // 숫자만입력
            })
        };

        onlyNumInput(I_ph);
        I_phBtn.click(()=>{
            if(I_ph.val().length < 11){
                _alert1("유효한 전화번호를 입력해 주세요.", "block", "확인", "_closeAlert1();");
                return false;
            }
            if(!expPhone.test(I_ph.val())){
                _alert1("유효한 전화번호를 입력해 주세요.", "block", "확인", "_closeAlert1();");
                return false;
            }
            // 인증번호전송
            AuthenText(I_ph.val(), EL_phChk, page);
        });
        // 문자인증 - 인증하기
        onlyNumInput(I_phChk);
        I_phChkBtn.click(()=>{
            VerifiCertiNum(I_ph.val(), I_phChk.val(), page);
        });
    }
    
    // 클립보드복사
    function copyToClipboard(textToCopy) {
        
        // console.log('http'); //http환경일경우 execCommand()사용.. 
        let textArea = document.createElement("textarea");
        let CopyText = document.querySelector(textToCopy).innerText;
        CopyText = CopyText.trim();
        textArea.value = CopyText;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
        });
            
    }
    var copyInterval = "";
    // textCopy(".copyTarget"(내부 텍스트가 복사됨), ".compCopy"(복사완료메시지 필요할경우 넣기))
    function textCopy(targetTag, msgTag){
        $(msgTag).show();
        clearInterval(copyInterval);
        copyInterval = setInterval(() => {
            $(msgTag).hide();
        }, 500);
        copyToClipboard(targetTag);
    };
    
    // 페이지 이동 함수
    function goLocation(target){
        location.href = target;
    };

    // 버블링 금지 함수 
    // 예시 ExcBubble(event, 함수());
    function ExcBubble(event, param_do){
        event.stopPropagation();
        // param_do();
    };

    // proImg2 href clickable 변경
    function headerProImgLocatioin(param_loca){
        $("header #proImg2 a.clickable").on("click", function(){
            location.href = param_loca;
        });
    };
    // 원하는 페이지에 입력 headerProImgLocatioin("./myInfo.php");


    // 이메일 *처리하는 함수
    function email_format_D(param_email){
        let email       = param_email;
        let tempArray;
        let frontText   = "";
        let backText    = "";

        let result      = "";

        if(!(email.includes('@'))){   // @가 없다면
            result = email.slice(0, 2)+add("*", 4)+email.slice(6);
        } else{                       // @가 있다면
            tempArray       = email.split("@");
            frontText       = tempArray[0];
            backText        = tempArray[1];
            if(frontText.length <= 2){
                result = frontText+"@"+backText;
            } else if(frontText.length > 7){
                result = frontText.slice(0, 2)+add("*", 4)+frontText.slice(6)+"@"+backText;
            } else{
                result = frontText.slice(0, 2)+add("*", (frontText.length)-3)+frontText.slice(-1)+"@"+backText;
            };
        };
        return result;

        function add(txt, num){
            let text    = "";
            for(let i=0; i < num; i++){
                text    += txt;
            };
            return text;
        };
    }

    // ios 뒤로가기 시 새로고침 안하는 이슈
    $(window).bind("pageshow", function(event) {
        //back 이벤트 일 경우
        if (event.originalEvent && event.originalEvent.persisted) {
            //todo
            location.reload();
            // console.log("ios");
        }
    });

    // 새로고침 감지(새로고침 후 열린페이지에서 실행됨.)
    if (performance.navigation.type == 1) {
        // console.log("ddd");
    }
    

    // 바닥감지 (바닥감지 시 실행함수와 세트)
    function touchBot(doFun){
        $(window).scroll(function(){
            let target1         = window.innerHeight;
            let target2         = $(document).height();
            let target3         = window.scrollY;
    
            let culcu1          = target2 - target1;
    
            // console.log("culcu1 : "+culcu1);
            // console.log("target2 : "+target2);
            // console.log("target3 : "+target3);
            if(culcu1 <= target3+1){
                // console.log("바닥입니다.");
                doFun();
            };
            // 92px
        });
    };
    // 페이지에서 아래 주석실행
    // function doBot(){
    //     console.log("실행함수");
    // };
    // touchBot(doBot);

    // 텍스트길이 제한
    function maxLength(param_el, param_limit){
        let el              = param_el;
        let limit           = param_limit;
        let length          = el.val().length;
        let tempSave        = "";
        el.attr("maxlength", limit);
        el.on("keydown change keyup blur", function(){
            length          = $(this).val().length;
            if(length == limit){
                tempSave    = $(this).val();
            }
            if(length >= limit){
                $(this).val(tempSave);
            }
        });
    }
    
    // 비속어 감지
    function senseSlang(param_type, param_slang){
        let type                = $(""+param_type+"");
        let slangList           = param_slang;
        let targetText          = "";
        // let detectedWord        = [];
        type.on("blur", function(){
            let detectedFlag        = false;
            targetText          = $(this).val();
            for(let i= 0; i<slangList.length; i++){
                if(targetText.indexOf(slangList[i]) != -1){
                    let temp    = $(this).val().replaceAll(slangList[i], "");
                    $(this).val(temp);
                    detectedFlag    = true;
                };
            };
            if(detectedFlag){
                console.log("비속어가 제외됩니다.");
            }
        });
    };
    let slang       = [
        "시발", "미친", "병신", "찐따", "또라이", "새끼","18아","18놈","18새끼","18뇬","18노","18것","18넘","개년","개놈","개뇬","개새","개색끼","개세끼","개세이","개쉐이","개쉑","개쉽","개시키","개자식","개좆","게색기","게색끼","광뇬","뇬","눈깔","뉘미럴","니귀미","니기미","니미","도촬","되질래","뒈져라","뒈진다","디져라","디진다","디질래","병쉰","병신","뻐큐","뻑큐","뽁큐","삐리넷","새꺄","쉬발","쉬밸","쉬팔","쉽알","스패킹","스팽","시벌","시부랄","시부럴","시부리","시불","시브랄","시팍","시팔","시펄","실밸","십8","십쌔","십창","싶알","쌉년","썅놈","쌔끼","쌩쑈","썅","써벌","썩을년","쎄꺄","쎄엑","쓰바","쓰발","쓰벌","쓰팔","씨8","씨댕","씨바","씨발","씨뱅","씨봉알","씨부랄","씨부럴","씨부렁","씨부리","씨불","씨브랄","씨빠","씨빨","씨뽀랄","씨팍","씨팔","씨펄","씹","아가리","아갈이","엄창","접년","잡놈","재랄","저주글","조까","조빠","조쟁이","조지냐","조진다","조질래","존나","존니","좀물","좁년","좃","좆","좇","쥐랄","쥐롤","쥬디","지랄","지럴","지롤","지미랄","쫍빱","凸","퍽큐","뻑큐","빠큐","ㅅㅂㄹㅁ"
    ];
    senseSlang("input", slang);
    senseSlang("textarea", slang);

    // 띄어쓰기 엔터 변환
    function transSpacing(target){
        let a = target.val();
        let b = a.replace(/\n/g,"<br>");
        let c = b.replace(/ /gi,"&nbsp");
        let d = c.replace(/\t/g,"&nbsp; &nbsp; &nbsp; &nbsp;");
        
        return d;
    };
    
    // 공백 문자 복호화
    function RTS(target){
        let a = target;
        let b = a.replace(/<br>/g,"\n");
        let c = b.replace(/&nbsp/gi," ");
        
        return c;
    };

    // ! 페이지작업 (필요 시)
    // ! 회원가입
    // ! index.php
    function FunIndex(){
    };
    FunIndex();

    // 프로필사진 클릭 인벤트 함수 - proImg2.php용 [#proImg2 a.clickable]
    // onclickProImg2(타겟아이디, 타겟타입, 목적이동페이지, 클릭될 엘리먼트(a.clickable))
    function clickProImg2(param_id, param_type, param_desti, param_target){
        let target          = param_target;
        // target              = $("#proImg2 a.clickable");

        let id              = "";
        let type            = "";
        let desti           = "";
        id              = param_id;
        type            = param_type;
        desti           = param_desti;

        target.off("click").on("click", function(){
            // console.log(id);
            // console.log(type);
            // console.log(desti);

            location.href = ""+desti+"?s_id="+id+"&s_type="+type+"";
        });
    };

    
    // 헤더 초기화 (h1:true/false, h2:true/false, h2Title:회원가입 구독..., h2Item:item2 item1Text)
    function controlHeader(h1, h2, h2Title, h2Item){
        let target = $("header");
        if(h1){
            target.addClass("mainH");
            target.find(".mainHeader").css("display", "block");
        };
        if(h2){
            target.addClass("subH");
            target.find(".subHeader").css("display", "block");
            target.find(".subHeader .title_box .title").text(h2Title);
            switch (h2Item) {
                case "item3": case "item2":
                    target.find(".subHeader .right_box ."+h2Item+"").css("display", "flex");
                    break;
                default:
                    target.find(".subHeader .right_box .item1").css("display", "flex");
                    target.find(".subHeader .right_box .item1 p").text(h2Item);
                    break;
            }

        };
    };
    // 풋터 초기화 (f:true/false, fHighlight:main gudok...)
    function controlFooter(f, fHighlight){
        let target          = $("footer");
        let footerUl        = target.find("ul.footerUl");
        let footerList      = target.find(".footerList");
        if(f){
            target.css("display", "block");

            $.each(footerList, function (idx, vlu) {
                let offUrl      = $(vlu).attr("data-off");
                let onUrl       = $(vlu).attr("data-on");
                if($(vlu).hasClass(fHighlight)){
                    $(this).find(".img_box").css("background-image", "url('../img/"+onUrl+"')");
                } else{
                    $(this).find(".img_box").css("background-image", "url('../img/"+offUrl+"')");
                };
            });
        };
    };
    // 풋터 여닫이
    let footerFlag  = true;
    function footertoggle(el){
        let footerEl    = $(el).parents("footer");
        let offUrl      = $(el).attr("data-off");
        let onUrl       = $(el).attr("data-on");
        if(footerFlag){
            footerEl.css("transform", "translate(-50%, calc(0px))");
            el.find(".img_box").css("background-image", "url('../img/"+onUrl+"')");
            footerEl.find(".tag").css("color", "white");
            footerFlag = false;
        } else{
            footerEl.css("transform", "translate(-50%, calc(100% - 50px)");
            el.find(".img_box").css("background-image", "url('../img/"+offUrl+"')");
            footerEl.find(".tag").css("color", "transparent");
            footerFlag = true;
        };
    };
    
    function headerHighlight(param_list, param_target){
        let E_list          = param_list;
        let target          = param_target;

        $.each(E_list, function(idx, vlu){ 
            if($(this).hasClass(target)){
                $(this).addClass("on");
            }  
        });
    };

    // 모바일 사이드 여닫이
    function m_open(){
        $(".sideBG").css("display", "block");
        // $(".m_util").css("display", "block");
        $(".m_util").addClass("on");
    };
    function m_close(){
        $(".sideBG").css("display", "none");
        // $(".m_util").css("display", "none");
        $(".m_util").removeClass("on");
    };
    $(window).on("resize", function(){
        if($(window).innerWidth() >= 800){
            m_close();
        } else{
            
        };
    })
    



    //?팝업

    // !팝업 리셋
    var popupGrandBG = $('#G_POPUP .popup_GrandBg');
    var popupBG = $('#G_POPUP .BackGround');
    var popupAllList = $('#G_POPUP > .popup');
    
    function resetPopup(){
        popupGrandBG.hide();
        popupBG.hide();
        popupAllList.hide();
    };
    resetPopup();

    // !팝업열기 [script]OpenPop('POP_class', '01~99:nth-(n2)');
    function OpenPop(target, popLevel){
        let targetPop       = $("#G_POPUP ."+target+"");
        let targetBg        = $("#G_POPUP .popup_GrandBg");

        targetPop.css("z-index", "3"+popLevel+"");
        targetPop.show();
        targetBg.css("z-index", "3"+popLevel-1+"");
        targetBg.show();
        LockingScroll();
    };
    
    // !팝업닫기 [script]ClosePop('POP_class', '01~99:nth-(n2)');
    function ClosePop(target, popLevel){
        let targetPop       = $("#G_POPUP ."+target+"");
        let targetBg        = $("#G_POPUP .popup_GrandBg");

        targetPop.find("input").val("");
        targetPop.hide();
        targetBg.hide();
        UnlockingScroll();
    };
    
    // !베이스 POP_base
    function base(){
    };
    base();

    function changePass(){
        let _pop                = $(".POP_changePass");
        let I_pastPass          = _pop.find("#I_passChange_pastPass");
        let I_newPass           = _pop.find("#I_passChange_newPass");
        let I_newPassChk        = _pop.find("#I_passChange_newPassChk");
        let btn_submit          = _pop.find("a.btn_submit");

        btn_submit.on("click", function(){
            if(I_pastPass.val() == ""){
                _alert1("기존 비밀번호를 입력해 주세요.", "block", "확인", "_closeAlert1(); I_pastPass.focus();");
                return false;
            };
            if(I_newPass.val() == ""){
                _alert1("새 비밀번호를 입력해 주세요.", "block", "확인", "_closeAlert1(); I_newPass.focus();");
                return false;
            };
            if(insPW(I_newPass.val())){
                _alert1("비밀번호는 최소 4자입니다.", "block", "확인", "_closeAlert1(); I_newPass.focus();");
                return false;
            };
            if(I_newPassChk.val() == ""){
                _alert1("새 비밀번호 확인을 입력해 주세요.", "block", "확인", "_closeAlert1(); I_newPassChk.focus();");
                return false;
            };
            if(I_newPass.val() != I_newPassChk.val()){
                _alert1("새 비밀번호가<br> 새 비밀번호 확인과 같지 않습니다.", "block", "확인", "_closeAlert1(); I_newPassChk.focus();");
                return false;
            };

            // console.log(I_pastPass.val());
            // console.log(I_newPass.val());
            // console.log(I_newPassChk.val());
            // return false;

            $.ajax({
                type: "post",
                url: "./back/member/update_passwd.php",
                data: {
                    user_passwd: I_pastPass.val(),
                    new_paswd: I_newPass.val()
                },
                success: function (data){
                    console.log(data);
                    if(data == "ERROR"){
                        _alert1("회원정보가 잘못 입력되었습니다.", "block", "확인", "_closeAlert1();");
                        return false;
                    } else if(data == "true"){
                        _alert1("비밀번호가 변경되었습니다.", "none", "확인", "location.reload();");
                    } else{
                        _alert1("오류가 발생하였습니다.<br>잠시후 다시 시도해 주세요.", "block", "확인", "location.reload();");
                        return false;
                    };
                },
                error: function (data){
                    console.log(data);
                    _alert1("오류가 발생하였습니다.<br>잠시후 다시 시도해 주세요.", "block", "확인", "location.reload();");
                    return false;
                },
            });
        });
    };
    changePass();
    

    // !최상위 알럿 컨트롤
    function _alert1(text, imgCss, btnText, btnFun){
        let targetBg        = $("#G_POPUP .popup_alert1Bg");
        let targetPop       = $("#G_POPUP .POP_alert1");

        targetPop.find(".line.text .text_box p").html(text);
        targetPop.find(".line.img").css("display", imgCss);
        targetPop.find(".line.btn .btn_box a").html(btnText);
        targetPop.find(".line.btn .btn_box a").attr("onclick", btnFun);

        targetBg.show();
        targetPop.show();
        LockingScroll();
    };
    function _closeAlert1(){
        let targetBg        = $("#G_POPUP .popup_alert1Bg");
        let targetPop       = $("#G_POPUP .POP_alert1");

        targetPop.hide();
        targetBg.hide();
        UnlockingScroll();
    };
    // _alert1("사용할 수 없는 아이디 입니다.", "block", "확인", "location.reload();");
    // _alert1("사용할 수 없는 아이디 입니다.", "block", "확인", "_closeAlert1();");


    // !카카오주소api 구동   SearchAddr("zonecode_kakao", "address_kakao");
    // 맵연동할경우         SearchAddr("zonecode_kakao", "address_kakao", "map1");
    // map1은 카카오맵api가 사용될 엘리먼트 ID
    function SearchAddr(zoneInputID, addrInputID, E_mapID){
        let temp            = `
        <div id="juso_wrap" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative;">
            <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;left:0px;top:40px;z-index:1; width:20px; height:20px;" alt="접기 버튼">
        </div>
        `;
        $("main").append(temp);
        $("#juso_wrap").css(
            {
                "position": "absolute", 
                "top": "0", 
                "left": "0", 
                "width": "100%", 
                "height": "100%", 
                "min-height": "100%", 
                "padding-top": "40px"
            },
        );
        $("#btnFoldWrap").css(
            {
                "top": "40", 
            },
        );
        $("#btnFoldWrap").on("click", function(){
            element_wrap.style.display = 'none';
        });
        // 우편번호 찾기 찾기 화면을 넣을 element
        var element_wrap = document.getElementById('juso_wrap');
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);



        if(E_mapID != ""){
            var geocoder = new daum.maps.services.Geocoder();
        };
        //카카오 주소검색 api 실행.
        new daum.Postcode({
            oncomplete: function(data) { //선택시 입력값 세팅
                document.getElementById(zoneInputID).value = data.zonecode; // 우편번호 넣기
                document.getElementById(addrInputID).value = data.address; // 주소 넣기

                if(E_mapID != ""){
                    geocoder.addressSearch(data.address, function(results, status) {
                        // 정상적으로 검색이 완료됐으면
                        if (status === daum.maps.services.Status.OK) {
                            var mapContainer = document.getElementById(''+E_mapID+''); // 지도를 표시할 div 

                            var result = results[0]; //첫번째 결과의 값을 활용
                            // console.log(result);
            
                            // 해당 주소에 대한 좌표를 받아서
                            var coords = new daum.maps.LatLng(result.y, result.x);
                            // 지도를 보여준다.
                            mapContainer.style.display = "block";
                            map.relayout();
                            // 지도 중심을 변경한다.
                            map.setCenter(coords);
                            // 마커를 결과값으로 받은 위치로 옮긴다.
                            marker.setPosition(coords)
                            
                            // 원을 결과값으로 받은 위치로 옮긴다.
                            circle.setPosition(coords)
                        }   
                    });         
                };

                // iframe을 넣은 element를 안보이게 한다.
                element_wrap.style.display = 'none';
                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        // }).open();
        }).embed(element_wrap);
        
        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    };

    // !카카오맵api 맵가져오기
    // 주소 기준으로 맵만 형성
    // BringMap(주소, 맵엘리먼트ID)
    function BringMap(data, E_mapID){
        let juso        = data;
        var geocoder    = new daum.maps.services.Geocoder();

        geocoder.addressSearch(juso, function(results, status) {
            // 정상적으로 검색이 완료됐으면
            if (status === daum.maps.services.Status.OK) {
                var mapContainer = document.getElementById(''+E_mapID+''); // 지도를 표시할 div 

                var result = results[0]; //첫번째 결과의 값을 활용
                // console.log(result);

                // 해당 주소에 대한 좌표를 받아서
                var coords = new daum.maps.LatLng(result.y, result.x);
                // 지도를 보여준다.
                mapContainer.style.display = "block";
                map.relayout();
                // 지도 중심을 변경한다.
                map.setCenter(coords);
                // 마커를 결과값으로 받은 위치로 옮긴다.
                marker.setPosition(coords)
                
                // 원을 결과값으로 받은 위치로 옮긴다.
                circle.setPosition(coords)
            }   
        });  
    };

    // ajax전역이벤트
    $(document).ajaxStart(()=>{
        $('#PageLoading').css('display','flex');
    });
    $(document).ajaxComplete(()=>{
        $('#PageLoading').css('display','none');
    });

    if(typeof(FunProimg1) == 'function'){
        FunProimg1();
    }
</script>