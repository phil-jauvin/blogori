var AppRouter = Backbone.Router.extend({
    routes: {
        "page/:page": "getPage",
        "about": "aboutPage",
        "home" : "getPage",
        "login": "loginPage",
        "admin": "adminPage",
        "addpost": "addpostPage"
    }
});


var router = new AppRouter;
Backbone.history.firstLoad = true;


router.on( 'route:getPage', function(page){
    getPage( page );
} );

router.on( 'route:aboutPage', function(){
    aboutPage();
} );

router.on( 'route:loginPage', function(){

    var loginview = new LoginView();
    Backbone.history.firstLoad = false;

} );

router.on( 'route:adminPage', function(){

    var adminview = new AdminView();

} );

router.on( 'route:addpostPage', function(){

    var addpostview = new EditPostView();

} );


Backbone.history.start();


