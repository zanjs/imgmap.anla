;
(function() {

    D(function() {

        D("#url").focus();

        D("#nav li,#button").click(function(e) {

            var whatTab = D(this).index();
            var howFar = 80 * whatTab;
            var posX = D(this).offset().left,
                posY = D(this).offset().top,
                buttonWidth = D(this).width(),
                buttonHeight = D(this).height();

            D(this).prepend("<span class='ripple'></span>");

            if (buttonWidth >= buttonHeight) {
                buttonHeight = buttonWidth;
            } else {
                buttonWidth = buttonHeight;
            }

            var x = e.pageX - posX - buttonWidth / 2;
            var y = e.pageY - posY - buttonHeight / 2;

            D(".ripple").css({
                width: buttonWidth,
                height: buttonHeight,
                top: y + 'px',
                left: x + 'px'
            }).addClass("rippleEffect");

        });

        D("#get-edm").on("click", function() {



            if (isLoadOld()) {

                PL.open({
                    title: '',
                    content: '已经存在是否加载存档',
                    btn: ['加载', '重新输入'],
                    yes: function(index) {
                        loadEmd();
                    },
                    no: function() {
                        openFrom()
                    }
                });


            } else {
                openFrom()
            }


        });

        var clipboard = new Clipboard('.btn');

        clipboard.on('success', function(e) {
            PL.open({
                content: '复制成功',
                time: 2
            });
            console.log(e);
        });
        clipboard.on('error', function(e) {
            PL.open({
                content: '复制失败,请收到复制',
                time: 2
            });
        });


    })





})();