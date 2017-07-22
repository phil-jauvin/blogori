
// Fetch collage aka pagination page
function getPage( page ){

    if( page === null ){
        page = 1;
    }

    var page1 = new Collage( page );

    page1.fetch().then(function () {

        var view = new PageView( {
            el: $( "body" ),
            collection: page1
        } );

        Backbone.history.firstLoad = false;

    });

}

// These are self explanatory...
// Make sure we set firstload to false so we don't load resources over and over

function aboutPage(){
    var aboutview = new AboutView();
    Backbone.history.firstLoad = false;
}

function loginPage(){
    var loginview = new LoginView();
    Backbone.history.firstLoad = false;
}

function adminPage(){
    var adminview = new AdminView();
    Backbone.history.firstLoad = false;
}

function addpostPage(){
    var addpostview = new AddPostView();
    Backbone.history.firstLoad = false;
}