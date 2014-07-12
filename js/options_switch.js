<<<<<<< HEAD
jQuery(document).ready(function($){
    $('.yarpp_switch_button').click(function( e){
        e.preventDefault();
        var url = $(this).attr('href'),
            data = { go : $(this).data('go') };

=======
function yarppMakeTheSwitch($,data,url){
>>>>>>> 4.2.2
        $.get(
            url,
            data,
            function(resp){
                if(resp === 'ok'){
                    window.location.href = './options-general.php?page=yarpp';
                }
            }
        );
<<<<<<< HEAD
    });
/* MARK: API Setting override
    $('#yarpp_pro_api_settings_unlock').click(function(){
        $('#yarpp_pro_aid, #yarpp_pro_api_key, #yarpp_pro_settings_submit').attr('disabled',false);
        $('#yarpp_pro_aid').focus();
        $(this).attr('disabled',true);
    });

    $('#yarpp_pro_api_settings_unlock').click(function(){
        $('#yarpp_pro_aid, #yarpp_pro_api_key').attr('disabled',false);
        $('#yarpp_pro_aid').focus();
    });

    $('#yarpp_pro_api_settings').submit(function(e){
        $('#yarpp_pro_aid, #yarpp_pro_api_key').each(function (idx,obj){
            if ($(obj).val() === ''){
                var msg = 'This field is empty. Please be sure to fill-in the right data before proceeding.';
                $(obj).next('.yarpp_warning').html(msg).css('display','inline-block');
                e.preventDefault();
            }
        });
    });
*/
=======
}

jQuery(document).ready(function($){
    $('.yarpp_switch_button').on('click',function(e){
        e.preventDefault();
        var url = $(this).attr('href'),
            data = { go : $(this).data('go') };
            
        if(data.go === 'basic'){
            $('#wpwrap').after(
                    '<div id="yarpp_pro_disable_overlay">'+
                    '</div>'+
                    '<div id="yarpp_pro_disable_confirm">'+
                        '<p>'+
                            'Are you sure you would like to deactivate YARPP Pro?'+
                            '<br/>'+
                            'Doing so will remove all <strong>YARPP Pro</strong> '+
                            'content from your site, including sidebar widgets.'+
                        '</p>'+
                        '<br/>'+
                        '<a id="yarpp_proceed_deactivation" class="button">Deactivate YARPP Pro</a>'+
                        '&nbsp;&nbsp;&nbsp;&nbsp;'+
                        '<a id="yarpp_cancel_deactivation" class="button-primary">Cancel Deactivation</a>'+
                    '</div>'
                );
            $('#yarpp_proceed_deactivation').on('click',function(){
                yarppMakeTheSwitch($,data,url);
            });
            
            $('#yarpp_cancel_deactivation').on('click',function(){
                window.location.reload();
            });
            
        } else {
            yarppMakeTheSwitch($,data,url);
        }
    });

    $('#yarpp-display-mode-save').on('click',function(e){
        e.preventDefault();
        var url  = $(this).attr('href'),
            data = {ypsdt : true, types : []};

        $(this).after($('<span class="spinner"></span>'));

        $i = 0;
        $('input','#yarpp-display-mode').each(function(idx,val){
            if(val.checked) {
                data.types[$i] = val.value;
                $i++;
            }
        });

        $.get(url,data,function(resp){
            setTimeout(function(){
                if(resp === 'ok'){
                    $('.spinner','#yarpp-display-mode').remove();
                } else {
                    $('#yarpp-display-mode').append($('<span style="vertical-align: middle" class="error-message">Something went wrong saving your settings. Please refresh the page and try again.</span>'));
                }
            },1000);
        });
    });

>>>>>>> 4.2.2
});