
var cUsMC_myjq = jQuery.noConflict();

cUsMC_myjq(window).error(function(e){
    e.preventDefault();
});

cUsMC_myjq(document).ready(function($) {

    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o ) ) ) {
            return false;
        } else {
            return true;
        }
    }
    
    try{
        cUsMC_myjq( "#cUs_tabs" ).tabs({active: false});
        cUsMC_myjq( "#cUs_exampletabs" ).tabs({active: false});

        cUsMC_myjq( '.options' ).buttonset();
        cUsMC_myjq( '#inlineradio' ).buttonset();

        cUsMC_myjq( "#terminology" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: false,
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsMC_myjq( "#form_examples, #tab_examples" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
       
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
    }
    
    
    try{
        //cUsMC_myjq( '.examples_gallery, .ui-state-default, .page_title' ).tooltip({
           //track: true
        //});
        cUsMC_myjq("#selectable").selectable({
            selected: function(event, ui) { 
                cUsMC_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
            }                   
        });
        
    }catch(err){
        console.log('Please upadate you WP version. ['+ err +']');
    }
    
    
    //SEND API KEY AJAX CALL /////// STEP 1
    try{ 
       cUsMC_myjq('.cUsMC_sendapikey').click(function() {
           
           var mcApiKey = cUsMC_myjq('#apikey').val();
           var mcFname = cUsMC_myjq('#cUsMC_first_name').val();
           var mcLname = cUsMC_myjq('#cUsMC_last_name').val();
           var postData = {};
           cUsMC_myjq('.advice_notice').hide();
           
           if(!mcApiKey.length){
               cUsMC_myjq('.advice_notice').html('MailChimp API Key is a required field!').slideToggle().delay(3000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else{
               
                cUsMC_myjq('.cUsMC_sendapikey').val('Loading . . .').attr({disabled:'disabled'});
                cUsMC_myjq('.loadingMessage').show();
                
                
                postData = {action: 'cUsMC_checkMCapikey', apikey:mcApiKey};
                
                
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: postData,
                    success: function(data) {
                        
                        switch(data){
                            case '1':
                                message = 'You are already logged into you MailChimp account, please continue with next steps.';
                                cUsMC_myjq('.cUsMC_sendapikey').val('Connected . . .');
                                setTimeout(function(){
                                    cUsMC_getMClist(mcApiKey);
                                },2000)
                            break;
                            case '2':
                                message = 'There something wrong with your MailChimp API Key, please try again!';
                                cUsMC_myjq('#apikey').focus();
                                cUsMC_myjq('.advice_notice').html(message).show().delay(2300).fadeOut(800);
                                cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 2').removeAttr('disabled');
                            break;
                            case '3':
                                cUsMC_myjq('.user-data').fadeIn();
                                cUsMC_myjq('.cUsMC_sendapikey').val('If your name is correct, please continue to Step 2').removeAttr('disabled');
                            break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();

                    },
                    fail: function(){
                       message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                       cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 3').removeAttr('disabled'); 
                    }
                });
           }
           
            
       });
       
       function str_clean(str){
           
           str = str.replace("'" , " ");
           str = str.replace("," , "");
           str = str.replace("\"" , "");
           str = str.replace("/" , "");
           
           return str;
       }
       
       function cUsMC_getMClist(mcApiKey){
           if(!mcApiKey) return false;
           cUsMC_myjq('.loadingMessage').show();
           cUsMC_myjq('.cUsMC_sendapikey').val('Loading Lists. . .')
           cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, dataType: 'json', data: {action:'cUsMC_getMCList',apikey:mcApiKey},
                success: function(data) {
                    switch(data.status){
                        case 1:
                            message = "Seems like you don't have Contact List in you MailChimp Account, please add at least one <a href='http://admin.mailchimp.com/lists/' target='_blank'>here</a> to continue.";
                            cUsMC_myjq('.advice_notice').html(message).slideToggle();
                            
                            cUsMC_myjq('.cUsMC_sendapikey').val('Reloading . . .');
                            
                            setTimeout(function(){
                                cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 2').removeAttr('disabled');
                            },3000)
                            
                        break;
                        case 2:
                            message = 'There something wrong with your MailChimp API Key, please try again!';
                            cUsMC_myjq('#apikey').focus();
                            cUsMC_myjq('.advice_notice').html(message).slideToggle().delay(3300).fadeOut(600);
                        break;
                        default:
                            
                            cUsMC_myjq('#listid').html(data.options);
                            cUsMC_myjq('#cUsMC_first_name').val(data.fname);
                            cUsMC_myjq('#cUsMC_last_name').val(data.lname);
                            cUsMC_myjq('#cUsMC_email').val(data.email);
                            
                            
                            cUsMC_myjq('.step1').slideUp().fadeOut();
                            cUsMC_myjq('.step2').slideDown().delay(800);
                        break;
                    }
                    cUsMC_myjq('.loadingMessage').fadeOut();

                },fail: function(){
                   message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                   cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 3').removeAttr('disabled'); 
                }
            });
       }
       
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(3000).fadeOut(2000);
    }
    
    
    //SENT LIST ID AJAX CALL /// STEP 2
    try{
        cUsMC_myjq('.cUsMC_Sendlistid').click(function() {
            
            
           var postData = {};
           
           var mcFname = cUsMC_myjq('#cUsMC_first_name').val();
           var mcLname = cUsMC_myjq('#cUsMC_last_name').val();
           var mcEmail = cUsMC_myjq('#cUsMC_email').val();
           var mcWebsite = cUsMC_myjq('#cUsMC_web').val();
           
           var mcApiKey = cUsMC_myjq('#apikey').val();
           var mcListID = cUsMC_myjq('#listid').val();
           var mcListName = cUsMC_myjq('#listid option:selected').text();
           cUsMC_myjq('.loadingMessage').show();
           
           if(!mcApiKey.length){
               cUsMC_myjq('.advice_notice').html('MailChimp API Key is a required field!').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if(!mcEmail.length){
               cUsMC_myjq('.advice_notice').html('Email is a required field!').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if( !mcFname.length){
               cUsMC_myjq('.advice_notice').html('Your First Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_first_name').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if( !mcLname.length){
               cUsMC_myjq('.advice_notice').html('Your Last Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_last_name').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if(!mcWebsite.length){
               cUsMC_myjq('.advice_notice').html('Your Website is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_web').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else{
                cUsMC_myjq('.cUsMC_Sendlistid').val('Loading . . .').attr({disabled:'disabled'});
                
                postData = {action: 'cUsMC_sendClientList', fName:str_clean(mcFname),lName:str_clean(mcLname),listID:mcListID,mcListName:mcListName,Email:mcEmail,website:mcWebsite}
                
                cUsMC_myjq.ajax({ 
                    type: "POST", 
                    url: ajax_object.ajax_url,
                    data: postData,
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<h4>Welcome to ContactUs.com, and thank you for your registration.</h4>';
                                message += '<p><b>We have sent a verification email.</b>.<br/>Please find the email, and login to your new ContactUs.com account.</p>';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.step3').slideUp().fadeOut();
                                    location.reload();
                                },3000)
                            break;
                            case '2':
                                message = 'Seems like you already have one Contactus.com Account, Please Login below!';
                                setTimeout(function(){
                                    cUsMC_myjq('.step2').slideUp().fadeOut();
                                    cUsMC_myjq('.step3').slideDown().delay(1700);
                                },2000)
                            break;  
                            default:
                                message = '<p>Ouch! unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again!</a></p>';
                                cUsMC_myjq('.cUsMC_Sendlistid').val('Continue to Step 3').removeAttr('disabled');
                            break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show().delay(4000).fadeOut(2000);

                    },
                    fail: function(){
                       message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                       cUsMC_myjq('.cUsMC_Sendlistid').val('Continue to Step 3').removeAttr('disabled'); 
                    }
                });
           }
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
    }
    
    
    cUsMC_myjq('.cUsMC_LoginUser').click(function(){//LOGIN ALREADY USERS
        var email = cUsMC_myjq('#login_email').val();
        var pass = cUsMC_myjq('#user_pass').val();
        cUsMC_myjq('.loadingMessage').show();
        
        if(!email.length){
            cUsMC_myjq('.advice_notice').html('User Email is a required and valid field!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#login_email').focus();
            cUsMC_myjq('.loadingMessage').fadeOut();
        }else if(!pass.length){
            cUsMC_myjq('.advice_notice').html('User password is a required field!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#user_pass').focus();
            cUsMC_myjq('.loadingMessage').fadeOut();
        }else{
            var bValid = checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@jquery.com" );  
            if(!bValid){
                cUsMC_myjq('.advice_notice').html('Please enter a valid User Email!').slideToggle().delay(2000).fadeOut(2000);
                cUsMC_myjq('.loadingMessage').fadeOut();
            }else{
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cusMC_loginAlreadyUser',email:email,pass:pass},
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<p>Welcome to ContactUs.com, and thank you for your registration.</p>';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.step3').slideUp().fadeOut();
                                    location.reload();
                                },2000)
                                
                            break;
                            default:
                                message = '<p>Ouch! unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again!</a></p>';
                                break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show();

                    },
                    async: false
                });
            }
        }
    });
    
    cUsMC_myjq('.cUsMC_LogoutUser').click(function(){
        if(confirm('Are you sure you want to quit?')){
            cUsMC_myjq('.loadingMessage').show();
            cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_logoutUser'},
                success: function(data) {
                    cUsMC_myjq('.loadingMessage').fadeOut();
                      location.reload();
                },
                async: false
            });
        }
    });
    
    
    try{ cUsMC_myjq('.sendtemplate').click(function() {
           
           var mcApiKey = cUsMC_myjq('#apikey').val();
           var mcTemplateID = cUsMC_myjq('#templateid').val();
           cUsMC_myjq('.loadingMessage').show();
           
           if(!mcApiKey.length){
               cUsMC_myjq('.advice_notice').html('MailChimp API Key is a required field!').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else{
                
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'sendTemplateID',templateID:mcTemplateID},
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = 'Template saved succesfuly . . . .';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.step3').slideUp().fadeOut();
                                    cUsMC_myjq('.step4').slideDown().delay(800);
                                },2000)
                                
                            break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show().delay(1900).fadeOut(800);

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
    }
    
    
    cUsMC_myjq('.form_version').change(function(){
        var val = cUsMC_myjq(this).val();
        cUsMC_myjq('.cus_versionform').fadeOut();
        cUsMC_myjq('.' + val).slideToggle();
    });
    
    cUsMC_myjq('#contactus_settings_page').change(function(){
        cUsMC_myjq('.show_preview').fadeOut();
        cUsMC_myjq('.save_page').fadeOut( "highlight" ).fadeIn().val('>> Save your settings');
    });
    
    cUsMC_myjq('.callout-button').click(function() {
        cUsMC_myjq('.getting_wpr').slideToggle('slow');
    });
    
    cUsMC_myjq('#mc_yes').click(function() {
        cUsMC_myjq('#cUsMC_mcsettings').slideToggle('slow');
    });
    
    
});
