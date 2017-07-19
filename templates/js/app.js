
// Route definitions
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

// The user is loading the site from scratch, set to false once a view is rendered
// Allows us to load partials instead of requesting header / sidebar every time
Backbone.history.firstLoad = true;

// Functions here are defined in controllers.js

router.on( 'route:getPage', function(page){
    getPage( page );
} );

router.on( 'route:aboutPage', function(){
    aboutPage();
} );

router.on( 'route:loginPage', function(){
    loginPage();
} );

router.on( 'route:adminPage', function(){
    adminPage();
} );

router.on( 'route:addpostPage', function(){
    addpostPage();
} );

Backbone.history.start();


