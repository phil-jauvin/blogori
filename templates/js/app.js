var AppRouter = Backbone.Router.extend({
    routes: {
        "page/:page": "getPage",
        "about": "aboutPage",
        "home" : "getPage"
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

Backbone.history.start();


