/**
 * Created by raulhuanca on 11/7/16.
 */
// This is called with the results from from FB.getLoginStatus().
var FacebookApi = {
    statusListener:null,
    listenStatus:function(statusListener){
        this.statusListener =  statusListener;
        return this;
    },
    statusChangeCallback:function(response) {
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if(typeof this.statusListener == "function"){
            this.statusListener(response);
        }
    },
    checkLoginState:function() {
        FB.getLoginStatus(function(response) {
            FacebookApi.statusChangeCallback(response);
        });
    },
    login:function(callback){
        if(typeof FB != "undefined") {
            FB.login(function (response) {
                if(typeof callback === "function"){
                    callback(response);
                }
            }, {scope: 'public_profile,email,manage_pages'});
        }
        return this;
    },
    logout:function(){
        FB.api('/me/permissions', 'delete');
    }
}


// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.


window.fbAsyncInit = function() {
    if(typeof FB != "undefined"){
        FB.init({
            appId      : '153884781984642',
            cookie     : true,  // enable cookies to allow the server to access
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.2' // use version 2.2
        });
        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
            FacebookApi.statusChangeCallback(response);
        });
    }
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/es_LA/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));