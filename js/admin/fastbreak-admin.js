 jQuery(document).ready(function($) {
        $('#vw_fb_date').datepicker({changeYear:true,changeMonth:true});
        $('#vw_fb_date').datepicker( "option", "dateFormat", "yy-mm-dd" );
        $('#tutorial').draggable();
        
        function validate(){
            var err_message = '';
            // Validate name of theme
            if($('#vw_fb_theme').val().trim() == ''){
                err_message += 'Name of theme is empty\n';
            }
            if(/[^a-z ]+/i.test($('#vw_fb_theme').val().trim())){
                err_message += 'Name of theme does not match the specified format\n';
            }
            // Validate date
            if($('#vw_fb_date').val().trim() == ''){
                err_message += 'Date is empty\n';
            }
            if(!/^20[0-9]{2}-\d{2}-\d{2}$/.test($('#vw_fb_date').val().trim())){
                err_message += 'Date does not match the specified format\n';
            }
            // Validate review link
            if($('#vw_fb_review').val().trim() == ''){
                err_message += 'Review link is empty\n';
            }
            if(!/^(http:\/\/vibewire\.org\/\d{4}\/\d{2}\/[a-z1-9-]+\/)$/.test($('#vw_fb_review').val().trim())){
                err_message += 'Review link does not match the specified format\n';
            }
            // Validate names of speakers
            var speakers = $("input[name='vw_fb_speaker\\[\\]']");
            for (var i = 1; i <= speakers.length; i++) {
                var name = $(speakers[i-1]).val().trim();
                if(name == ''){
                    err_message += 'Speaker ' + i + ' name is empty\n';
                }
                if(/[^a-z ]+/i.test(name)){
                    err_message += 'Speaker ' + i + ' name can ONLY contain upper or lower case letters and white spaces\n';
                }
            }
            // Validate Youtube links of fastbreak videos
            var links = $("input[name='vw_fb_link\\[\\]']");
             for (var i = 1; i <= links.length; i++) {
                var link = $(links[i-1]).val().trim();
                if(link == ''){
                    err_message += 'Youtube link ' + i + ' is empty\n';
                }
                if(!/^(http:\/\/www\.youtube.com\/embed\/[a-zA-Z0-9_-]{11})$/i.test(link)){
                    err_message += 'Youtube link ' + i + ' does not match the specified format\n';
                }
            }
            return err_message;
        }

        $('#vw_fb_form').submit(function(event) {
            var err_message = validate();
            if (err_message == ''){
                return true;
            }else{
                alert(err_message);
                return false;
            }
        });

        $('#add_speaker').click(function(event) {
            $newdiv = $('<div>').hide().appendTo('#speakers');
            $('<input>').attr({
                type: 'text',
                name: 'vw_fb_speaker[]',
                size:'20',
                value:''
            }).before('Name: ').after('&nbsp;&nbsp;&nbsp;&nbsp;').appendTo($newdiv);
            $('<input>').attr({
                type: 'text',
                name: 'vw_fb_link[]',
                size:'40',
                value:'',
                class:'youtube_link'
            }).before('Youtube Link: ').appendTo($newdiv);
            $newdiv.fadeIn('slow');
        });

        $('div.wrap').on('click', '.how', function(event) {
            event.preventDefault();
            $('#tutorial').fadeIn('1000');
        });

        $('#close').click(function(event) {
            event.preventDefault();
            $('#tutorial').fadeOut('fast',function(){
                $('#image img').css('margin-left', '0px');
                $('#steps p').hide();
                $('#step1').show();
            });
        });

        $('a#prev').click(function(event) {
            event.preventDefault();
            if($(this).hasClass('active')){
                $image = $('#image img');
                if($image.css('margin-left') != "0px"){
                    $(this).removeClass('active');     
                    $image.animate({marginLeft: '+=650px'}, '1000',function(){$('a#prev').addClass('active');});
                    if ($image.css('margin-left') == "-650px") {
                        $('#steps p').hide();
                        $('#step1').show();
                    }else if($image.css('margin-left') == "-1300px"){
                        $('#steps p').hide();
                        $('#step2').show();
                    }
                }
            }
        });
        $('a#next').click(function(event) {
            event.preventDefault();
            if($(this).hasClass('active')){
                $image = $('#image img');
                if($image.css('margin-left') != "-1300px"){
                    $(this).removeClass('active');     
                    $image.animate({marginLeft: '-=650px'}, '1000',function(){$('a#next').addClass('active');});
                    if ($image.css('margin-left') == "0px") {
                        $('#steps p').hide();
                        $('#step2').show();
                    }else if($image.css('margin-left') == "-650px"){
                        $('#steps p').hide();
                        $('#step3').show();
                    }
                }
            }
        });
    });