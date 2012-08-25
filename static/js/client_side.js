var url = document.URL;
var base_url = 'http://ec2-54-251-10-149.ap-southeast-1.compute.amazonaws.com';
var params = client_options;

var html ="";
var result = jq.ajax({
    url: base_url + '/client/buttons',
    type: 'GET',
    data : { 'params' : client_options, 'url' : url},
    dataType: "jsonp",
    success : function(data){
        // We dont parse json object sent when json-p is used because it already is in Object format.
        jq('#echo-se').html(data.html + data.js);
    },
    error : function(xhr, textStatus, error){
        // alert(xhr);
        // alert(error);
        // alert(textStatus);
    }
});

jq.receiveMessage(
  function(e){
    var obj = JSON.parse('{"' + decodeURI(e.data.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
    if(obj.type == 'is_logged_in'){
        ZS.is_logged_in = obj.status;
        ZS.shareOn("post-action");
    } else {
        //code to disable the button
        //action = obj.action;
        //post_status = obj.status;
        var action = obj.action;
        var post_status = obj.status;
        if(post_status == false || post_status == 'false'){
            // alert('post was not published');
        } else {
            jq('.echo-loader-li').hide();
            jq('.echo-button-'+action).addClass('echo-buttons-disabled');
			jq('.echo-button-'+action).attr('href', '#');
        }  
        //in both the cases close this popup
        //$('.closeButton').click();
    }
  },
  'http://ec2-54-251-10-149.ap-southeast-1.compute.amazonaws.com'
);
