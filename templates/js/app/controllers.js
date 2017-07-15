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

    });

}

function aboutPage(){
    var aboutview = new AboutView();
}