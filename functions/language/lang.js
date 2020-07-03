function lang_vn () {
        // alert('lang');
       var lang_current = document.getElementById('lang_current');
        if (lang_current) {
            if (lang_current.value != 'vn') {
                var url = document.getElementById('url_lang');
                if (url) {
                    vn(url.value);
                    // alert(url.value);
                    // window.location.href = '/'+url.value;
                } else {
                    vn('');
                    // location.reload();
                }
            }
        } else {
            vn('');
            // location.reload();
        }    
    }

    function lang_en () {
       var lang_current = document.getElementById('lang_current');
        if (lang_current) {
            if (lang_current.value != 'en') {
                var url = document.getElementById('url_lang');
                if (url) {
                    en(url.value)
                    // alert(url.value);  
                    // window.location.href = '/'+url.value;
                } else {
                    en('');
                    // location.reload();
                }   
            }
        } else {
            en('');
            // location.reload();
        } 
    }

    function vn (url) {
         $.get("/functions/ajax/lang_vn.php", function(){
            // alert("lang vn");
            if (url == '') {
                location.reload();
            } else {
                window.location.href = '/' + url;
            }
        });
    }

    function en (url) {
         $.get("/functions/ajax/lang_en.php", function(){   
            // alert("lang en");
            if (url == '') {
                location.reload();
            } else {
                window.location.href = '/' + url;
            }
        });
    }

    function langs (data) {
        // alert(data.value);
        var lang = data.value;
        if (lang == 'vn') {
            // $.get("/functions/ajax/lang_vn.php", function(){
            //     location.reload();
            // });
            lang_vn();
        } else if (lang == 'en') {
            // $.get("/functions/ajax/lang_en.php", function(){            
            //     location.reload();
            // });
            lang_en();
        }
    }