$(function(){
    //初期設定
    var menuWrap="#menu_wrap"
    var sideMenu="#sidemenu"
    var sidemenKey="#sidemenu_key"
    var main="main"
    var header=".head-logo, .nav-inner"
    var wid100=".wid100"
    var menuWidth="150"
    var menKey="80"
    var speed=300
    var windowWidth=$(window).width();

    //メニュー開閉 and メニューアイコン変換
    $(sidemenKey).click(function(){
        if($(menuWrap).hasClass("active")){
            $(menuWrap).stop().animate({left:windowWidth},speed).removeClass('active');
            $(sidemenKey).stop().animate({left:windowWidth-menKey},speed).removeClass('active');
            $(main).stop().animate({opacity: 1},speed);
            $(header).stop().animate({opacity: 1},speed);
            $(wid100).css('background','rgba(236,203,215,1)');
        }else{
            $(menuWrap).stop().animate({left:windowWidth-menuWidth},speed).addClass('active');
            $(sidemenKey).stop().animate({left:windowWidth-menuWidth-menKey},speed).addClass('active');
            $(main).stop().animate({opacity: 0.1},speed);
            $(header).stop().animate({opacity: 0.1},speed);
            $(wid100).css('background','rgba(236,203,215,0.3)');
        };
    });

    //メニューリサイズ
    var windowHeight=$(window).height();
    $(sideMenu).height(windowHeight);
    var timer=false;
    $(window).resize(function(){
        if(timer!==false){
            clearTimeout(timer);
        }
        timer=setTimeout(function(){
            windowWidth=$(window).width();
            if($(menuWrap).hasClass("active")){
                $(menuWrap).stop().animate({left:windowWidth-menuWidth},0);
                $(sidemenKey).stop().animate({left:windowWidth-menuWidth-menKey},0);
            }else{
                $(menuWrap).stop().animate({left:windowWidth},0);
                $(sidemenKey).stop().animate({left:windowWidth-menKey},0);
            };
            windowHeight=$(window).height();
            $(menuWrap).height(WindowHeight);
        },50);
    });
});

