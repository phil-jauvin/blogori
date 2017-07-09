var page1 = new Collage( 2 );

// render as callback because fetch is async
page1.fetch().then(function () {

    var view = new PageView( {
        el: $( "body" ),
        collection: page1
    } );

    view.render();

});
//