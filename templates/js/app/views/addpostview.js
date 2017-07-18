var AddPostView = Backbone.View.extend( {

    initialize: function(){
        $('html, body').animate({ scrollTop: 0 }, 'fast'); // Can't decide whether I like the animation or not
        this.firstload = Backbone.history.firstLoad;
        this.render();
    },

    render: function(){

        // Create vars so we can pass them into callback function
        var partials = [];
        firstload = this.firstload;

        if( firstload ){
            var header = new Partial( "header" );
            partials.push( header );
        }

        var addpost = new Partial( "addpost" );
        partials.push( addpost );

        // When all partials are done fetching call callback function
        var complete = _.invoke( partials, "fetch" );
        $.when.apply($, complete).done( function(){

            if( firstload ){
                var template = _.template( header.get("template") );
                $("body").append( template );
            }
            else{
                $( "main" ).empty();
            }

            template = _.template( addpost.get("template") );
            $("main").append( template );

            $( "#postit" ).click( function(event){
                event.preventDefault();
                $.post( "/post",
                    {
                        title: $("#title").val(),
                        category: $("#category").val(),
                        content: $("#content").val(),
                    },
                    function(data){
                        console.log( data );
                    }, "json" );
            } );



        } );

    }

} );