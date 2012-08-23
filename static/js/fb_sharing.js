var ZS ={
  is_logged_in : '',
  post_data : {},
  base_url : "http://demo.echo.kuliza.com",
  og_action : '',
  init : function() {
    this.post_data.cust_id = zs_params.customer_id;
    this.post_data.referrer = zs_params.referrer;
    this.post_data.p_id = zs_params.pId;
    this.post_data.p_url = zs_params.pUrl;
    this.post_data.p_name = zs_params.pName;
    this.post_data.p_desc = zs_params.pDesc;
    this.post_data.p_img = zs_params.pImg;
    this.post_data.p_price = zs_params.pPrice;
    this.post_data.p_category = zs_params.pCategory;
    this.post_data.parent_id = zs_params.parent_id;
    this.post_data.to_email = jq('#zs-toEmail').val();
    this.post_data.fb_id = jq('#friends-list').attr('data-friend');
    this.post_data.from_email = jq('#zs-fromEmail').val();
    this.post_data.message = (jq('#zs-message').val()) ? jq("#zs-message").val() : 'This deal is awesome. Get it now!';
  },
  shareOn : function(where) {
    switch(where) {
      case 'post-action':
        ZS.postTo.action();
        break;
      case 'my-wall':
        ZS.postTo.fbWall();
        break;
      case 'friend-wall':
        ZS.switchUiTo.fbFriendsUi();
        break;
      case 'twitter':
        ZS.postTo.twitterFeed();
        break;
      case 'email':
        ZS.switchUiTo.emailUi();
    }
  },
  close : function() {
    window.parent.ZS.close();
  },
  cancel : function() {
    ZS.switchUiTo.baseUi();
  },
  switchUiTo : {
    baseUi : function() {
      jq('.zs-caption').text('Social sharing made easy');
      jq('.zs-friends, .zs-email').hide();
      jq('.zs-share, .zs-twitter-count').show();
    },
    fbFriendsUi : function() {
      jq('.zs-caption').text('Post to friends wall');
      jq('.zs-friends').show();
      jq('.zs-share, .zs-twitter-count').hide();
      ZS.getFriends();
    },
    emailUi : function() {
      jq('.zs-caption').text('Send email');
      jq('.zs-email').show();
      jq('.zs-share, .zs-twitter-count').hide();
    }
  },
  postTo : {
    action : function() {
      var referrer = window.location.hostname;
      var product_url = window.location.href;
      if(window.location.hash!=""){
        product_url = product_url.split(window.location.hash)[0];
      }
      var fb_params = "referrer="+referrer+"&product_name="+client_options.productName+"&object_type="+client_options.objectType+"&product_url="+product_url+"&product_category="+client_options.productCategory+"&product_id="+client_options.productId+"&og_action="+ZS.og_action+"&product_img="+client_options.productImg;
      if(ZS.is_logged_in === 'true'){
        var frame = jq("#postAction_frame");
        if(frame.length == 0){
          jq('body').append('<iframe src="' + base_url + '/fshare/open_action/?' + fb_params +'" id="postAction_frame" class="hidden"></iframe>');
        }else{
          frame.attr('src',base_url+'/fshare/open_action/?'+fb_params);
        }
      }else{
/*
          var element = '<div class="popUpWrapper" style="position: fixed;width:100%;height:100%;top:0;left:0;background-color: #000;opacity: 0.4;-webkit-opacity:0.4;-moz-opacity: 0.4;filter:alpha(Opacity=40);z-index:9; display: none;"></div><div class="popUp" id="fbLoginPopup" style="position: absolute;z-index:10;top:18%;left:25%;width:50%;border:1px solid #686868;color:#595959;font-size:12px;background-color:#ffffff;display: none;"><div class="popUpInnerWrapper" style="position:relative;overflow:auto;padding:10px;"><a href="" class="closeButton closeIndexPopup" style="position: absolute;right:-10px;top:-20px;z-index:11;"><img src="http://ec2-54-251-10-149.ap-southeast-1.compute.amazonaws.com/img/close-button.png" class=""/></a><iframe id="login_frame" src="" style="width:100%;height:100%;"></iframe></div></div>';
          var loginFrame = jq("#login_frame");
          if(loginFrame.length == 0){
            jq("body").append(element);
            jq('.closeButton').click(function(){
              jq('.popUpWrapper').fadeOut('fast');
              jq('.popUp').fadeOut('fast');
              return false;
            });
          }
          loginFrame.attr("src",base_url + "/fshare/open_action/?" + fb_params);
          jq('html, body').animate({scrollTop:0}, 'slow');
          jq('.popUpWrapper').fadeIn('fast');
          jq('#fbLoginPopup').fadeIn('fast');        
*/
          //DODO convert to iframe
          window.open(base_url + "/fshare/open_action/?" + fb_params, "_blank");
      }
    },
    fbWall : function() {
      if(ZS.validate('message')) {
        ZS.init();
        //console.log(ZS.is_logged_in);
        var fb_params = 'post_message=' + ZS.post_data.message + '&customer_id=' + ZS.post_data.cust_id + '&referrer=' + ZS.post_data.referrer + '&product_id=' + ZS.post_data.p_id + '&product_url=' + ZS.post_data.p_url + '&product_name=' + ZS.post_data.p_name + '&product_img=' + ZS.post_data.p_img + '&product_desc=' + ZS.post_data.p_desc + '&product_price=' + ZS.post_data.p_price + '&product_category=' + ZS.post_data.p_category + '&parent_id=' + ZS.post_data.parent_id;
        if(ZS.is_logged_in === 'true') {
            //console.log(ZS.is_logged_in + 'iframe will come');
            jq('body').append('<iframe src="' + base_url + '/fshare/?' + fb_params +'" class="hidden"></iframe>');
        }
        else {
            //console.log(ZS.is_logged_in + 'popup will come');
            window.open(base_url + "/fshare/?"+ fb_params,"_blank","width=760,scrollbars=1,height=270,0,status=0");
        }
      }
    },
    fbFriendsWall : function() {
      if(ZS.validate('message')) {
        ZS.init();
        var fb_params = 'post_message=' + ZS.post_data.message + '&customer_id=' + ZS.post_data.cust_id + '&referrer=' + ZS.post_data.referrer + '&product_id=' + ZS.post_data.p_id + '&product_url=' + ZS.post_data.p_url + '&product_name=' + ZS.post_data.p_name + '&product_img=' + ZS.post_data.p_img + '&product_desc=' + ZS.post_data.p_desc + '&product_price=' + ZS.post_data.p_price + '&product_category=' + ZS.post_data.p_category + '&fb_id=' + ZS.post_data.fb_id + '&parent_id=' + ZS.post_data.parent_id;
        if(ZS.is_logged_in === 'true') {
            jq('body').append('<iframe width="400" height="300" src="' + base_url + '/fshare/?' + fb_params + '" class="hidden"></iframe>');
        }
        else {
            window.open(base_url + "/fshare/?"+ fb_params,"_blank","width=760,scrollbars=1,height=270,0,status=0");
        }
      }
    },
    twitterFeed : function() {
      if(ZS.validate('message')) {
        ZS.init();
        var t_params = 'twitter_message=' + ZS.post_data.message + '&customer_id=' + ZS.post_data.cust_id + '&referrer=' + ZS.post_data.referrer + '&product_id=' + ZS.post_data.p_id + '&product_url=' + ZS.post_data.p_url + '&product_name=' + ZS.post_data.p_name + '&product_img=' + ZS.post_data.p_img + '&product_desc=' + ZS.post_data.p_desc + '&product_price=' + ZS.post_data.p_price + '&product_category=' + ZS.post_data.p_category+ '&parent_id=' + ZS.post_data.parent_id;
        
        window.open(base_url + "/twitter/twitter_auth/?"+ t_params,"_blank","width=760,scrollbars=1,height=270,0,status=0");
      }
    },
    email : function() {
      if(ZS.validate('email')) {
        ZS.init();
        var e_params = 'mail_message=' + ZS.post_data.message + '&mail_to=' + ZS.post_data.to_email + '&mail_from=' + ZS.post_data.from_email + '&customer_id=' + ZS.post_data.cust_id + '&referrer=' + ZS.post_data.referrer + '&site_name=' + ZS.post_data.referrer + '&product_id=' + ZS.post_data.p_id + '&product_url=' + ZS.post_data.p_url + '&product_img=' + ZS.post_data.p_img + '&product_name=' + ZS.post_data.p_name + '&product_desc=' + ZS.post_data.p_desc + '&product_price=' + ZS.post_data.p_price + '&product_category=' + ZS.post_data.p_category +  '&parent_id=' + ZS.post_data.parent_id;
        jq.get(base_url + '/email?' + e_params, function(e) {
          if(e == '1')
            ZS.notify('Your message has been emailed');
          else
            ZS.notify('An error occurred');
        });
      }
    }
  },
  notify : function(notice) {
    jq('.zs-notice-text').text(notice);
    jq('.zs-notice').fadeIn();
    window.setTimeout("jq('.zs-notice').fadeOut()", 3000); // @TODO: refine this method to have clearTimeout - @praveen
  },
  getFriends : function() {
    // get friends list only if the list is empty
    if(!ZS.friends) {
      ZS.friends = {};
      if(ZS.is_logged_in === 'true') {
        jq('body').append('<iframe src="' + base_url + '/fshare/friendlist" class="hidden"></iframe>');
      }
      else {
        window.open(base_url + "/fshare/friendlist","friends","width=760,height=270");
      }
    }
  },
  populateFriends : function() {
    jq.each(ZS.friends.data, function(i,e) {
      e.label = '<img src="http://graph.facebook.com/' + e.id + '/picture"  width="25" />' + '<span>' + e.name + '</span>'; // Making it jQueryUI's "Autocomplete" compatible
      e.value = e.name
    });
    jq('#friends-list').autocomplete({
      source : ZS.friends.data,
      select: function(event, ui) {
        jq('#friends-list').attr('data-friend', ui.item.id);
      }
    });
  },
  charCount : function() {
    var limit = 140;
    var remaining;
    jq('#zs-message').keyup(function() {
      remaining = limit - jq('#zs-message').val().length;
      jq('.zs-twitter-count b').text(remaining);
      if(remaining < 0) {
        jq('.zs-twitter-count').addClass('error');
      }
      else jq('.zs-twitter-count').removeClass('error');
    });
  },
  validate : function(params) {
    var result = false;
    var message = jq('#zs-message');
    if(params == 'email') {
      var toEmail = jq('#zs-toEmail');
      var fromEmail = jq('#zs-fromEmail');
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if(!toEmail.val() || !emailReg.exec(toEmail.val())) toEmail.addClass('error');
      if(!fromEmail.val() || !emailReg.exec(fromEmail.val())) fromEmail.addClass('error');
      if(toEmail.val() && emailReg.exec(toEmail.val()) && fromEmail.val() && emailReg.exec(fromEmail.val())) {
        toEmail.removeClass('error');
        fromEmail.removeClass('error');
        result = true;
      }
    }
    else result = true;    // if params == 'message' there is pretty much nothing to do, hence we ignore that.
    return result;
  },

  isLoggedIn : function(og_action) {
    ZS.og_action = og_action;
    jq('.buttons_loader').show();
    // var product_url = window.location.href;
    var product_url = "http://magento.shoppul.se/index.php/apparel/shoes/womens/anashria-womens-premier-leather-sandal.html";
    var frame = jq("#isLoggedIn_frame");
    if (frame.length == 0){
      jq('body').append('<iframe width="400" height="300" src="' + base_url + '/fshare/is_logged_in/?product_url=' + product_url + '" id="isLoggedIn_frame" class="hidden"></iframe>');
    }else{
      frame.attr('src',base_url+'/fshare/is_logged_in/?product_url='+product_url);
    }
  }
};