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

function aboutPage(){
    var aboutview = new AboutView();
    Backbone.history.firstLoad = false;
}