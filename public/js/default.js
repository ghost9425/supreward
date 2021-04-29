$(".toggle-password").on("click",function(){$(this).find(".far").toggleClass("fa-eye fa-eye-slash");let e=$($(this).attr("toggle"));"password"==e.attr("type")?e.attr("type","text"):e.attr("type","password")});
// $(document).ready(function() {
//     // SideNav Initialization
//     $(".button-collapse").sideNav();
//     // SideNav Scrollbar Initialization
//     var sideNavScrollbar = document.querySelector('.custom-scrollbar');
//     var ps = new PerfectScrollbar(sideNavScrollbar);
//     $('.mdb-select').materialSelect();
//     responsive();
//     document.body.style.visibility = "visible";

//     $('.button-collapse').sideNav({
//         breakpoint: 1024
//     });
// })
// $( window ).resize(function() {
//     responsive();
// });

// $("#toggle").click(function(){
// let i = $(this).find("i");
// let slim = $( "#slide-out" ).hasClass( "slim" );
// if( slim ) {
// $("#slide-out").removeClass("slim");
// $(i).removeClass("fa-angle-double-right").addClass("fa-angle-double-left");
// } else {
// $("#slide-out").addClass("slim");
// $(i).removeClass("fa-angle-double-left").addClass("fa-angle-double-right");
// }

// });

function clsAlphaNoOnly(e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[a-zA-Z0-9_-]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}
function clsAlphaTHNoOnly(e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[ก-๏a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}

function clsPercentOnly(e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[()/0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}

function Comma(Num) { //function to add commas to textboxes

    if (Num != '' && Num != '-' && parseInt(Num) != 0) {
        Num = parseInt(Num);
        Num += '';
        Num = Num.replace(',', '');
        x = Num.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2 ;
    }
    else if (parseInt(Num) == 0 || Num=='-') {
        return "0";
    }
    else {
        return "0";
    }
}

function EnterPrice(Num) {
    if (Num == 0) {
        return "";
    }
    else {
        return Num;
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function moveCursorToEnd(el) {
    console.log(typeof el.selectionStart)
    if (typeof el.selectionStart == "number") {
        el.selectionStart = el.selectionEnd = el.value.length;
    } else if (typeof el.createTextRange != "undefined") {
        el.focus();
        var range = el.createTextRange();
        range.collapse(false);
        range.select();
    }
  }